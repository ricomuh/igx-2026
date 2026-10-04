# IGX 2026 — Game Score API & Construct 3 Integration Guide

Dokumentasi lengkap untuk integrasi skor game Indonesia Game Expo 2026. Dokumentasi ini mencakup arsitektur enkripsi, spesifikasi endpoint backend, dan panduan penggunaan script JavaScript di Construct 3.

---

## 1. Arsitektur & Konsep Keamanan

Untuk mencegah manipulasi skor (cheat) pada leaderboard event IGX, pengiriman skor dienkripsi menggunakan kombinasi **Dua Kunci**:

1. **`CONST_KEY` (Kunci Statis)**:
   - Secret key konstan yang disimpan di dalam client game Construct 3 dan di server backend `.env`.
   - Default: `igx_game_secret_2026_x7k9p2m4`.
2. **`param` (Kunci Dinamis / Session Token)**:
   - Token sesi unik sekali pakai (*one-time ticket*) yang diterbitkan oleh server.
   - Digunakan bersama `CONST_KEY` untuk menghasilkan kunci enkripsi **AES-256-CBC**:
     $$\text{DerivedKey} = \text{SHA-256}(\text{CONST\_KEY} + \text{":"} + \text{param})$$
   - Setelah skor berhasil dicatat, token `param` langsung di-consume (hangus) untuk mencegah *replay attacks*.

---

## 2. Cara Kerja Pengambilan Parameter (`param`)

Game dapat berjalan di dua lingkungan:

### A. Di dalam Web Embed (Iframe `/experience` atau `/experiences`)
Ketika pengunjung membuka halaman web IGX (`/experience`), server Laravel otomatis membuatkan sesi permainan baru dan menyisipkannya ke URL iframe:
```
https://experience.igx.co.id/3.4/?param=a1b2c3d4e5f6...
```
Script di Construct 3 akan otomatis membaca parameter `param` dari query string URL (`window.location.search`).

### B. Mode Demo / Standalone / Preview Construct 3
Saat game programmer melakukan testing di Construct 3 editor preview atau build standalone lokal (tanpa iframe web IGX), parameter `param` tidak ada di URL.
Dalam kondisi ini, game memanggil endpoint demo:
```http
POST /api/v1/game/session
```
Server akan mengembalikan parameter sesi baru.
> **Catatan Keamanan:** Endpoint demo ini dapat dinonaktifkan di production dengan mengatur `GAME_DEMO_ENABLED=false` di `.env` server.

---

## 3. Spesifikasi Endpoint API

### Base URL

| Environment | Base URL | Keterangan |
|---|---|---|
| **Production** | `https://igx.co.id` | Server live IGX |
| **Staging** | `https://igx-03.leolitgames.com` | Server testing / stage |
| **Local** | `http://127.0.0.1:8000` | Local development |

---

### Endpoint 1: Ambil Session Parameter (Demo / Standalone)

Menerbitkan session parameter baru untuk pengujian.

- **URL:** `/api/v1/game/session`
- **Method:** `GET` atau `POST`
- **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  ```

#### Response Sukses (201 Created):
```json
{
  "success": true,
  "param": "c7a8b9f0e1d2c3b4a59687...64chars",
  "token": "c7a8b9f0e1d2c3b4a59687...64chars",
  "token_type": "Bearer",
  "expires_at": "2026-10-04T22:30:00+00:00",
  "lifetime_minutes": 120
}
```

#### Response Error jika dinonaktifkan di Production (403 Forbidden):
```json
{
  "success": false,
  "message": "Demo session generation is disabled."
}
```

---

### Endpoint 2: Kirim Skor Terenkripsi

Merekam skor pemain ke leaderboard mingguan IGX.

- **URL:** `/api/v1/scores`
- **Method:** `POST`
- **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  ```

#### Request Body:
```json
{
  "param": "c7a8b9f0e1d2c3b4a59687...",
  "payload": "T21nVGhpcyBJcyBBbiBFbmNyeXB0ZWQgQ2lwaGVydGV4dD09...",
  "iv": "KjhnWTRiM1gyTVpSQ3NkRA=="
}
```

- `param`: Token sesi (diambil dari URL `?param=` atau endpoint `/api/v1/game/session`).
- `payload`: Ciphertext Base64 hasil enkripsi AES-256-CBC dari JSON data skor.
- `iv`: 16-byte Initialization Vector dalam format Base64.

#### Struktur Data Asli Sebelum Dienkripsi (Plaintext JSON):
```json
{
  "username": "player_one",
  "email": "player@example.com",
  "score": 12500,
  "timestamp": 1726074000000
}
```
*Username hanya boleh huruf kecil a-z, angka 0-9, titik (.), dan garis bawah (_).*

#### Response Sukses (201 Created):
```json
{
  "message": "Score recorded successfully",
  "data": {
    "id": 142,
    "username": "player_one",
    "email": "player@example.com",
    "score": 12500,
    "created_at": "2026-10-04T20:45:00.000000Z"
  },
  "leaderboard": [
    { "username": "pro_gamer", "score": 25000 },
    { "username": "player_one", "score": 12500 },
    { "username": "rival_x", "score": 9800 }
  ],
  "position": 2
}
```

#### Kemungkinan Response Error:
- `400 Bad Request`: `Decryption failed. Invalid payload or encryption key.`
- `403 Forbidden`: `Invalid, expired, or already used game session parameter.`
- `422 Unprocessable Entity`: Validasi email / username / score tidak sesuai.

---

## 4. Panduan Integrasi di Construct 3

File SDK JavaScript sudah disediakan dan siap pakai:
**Lokasi File:** `public/js/game/igx-game-api.js`  
**URL:** `https://igx.co.id/js/game/igx-game-api.js` (atau di repo: `public/js/game/igx-game-api.js`)

SDK ini menggunakan **Web Crypto API bawaan browser (`window.crypto.subtle`)**, sehingga:
- 100% Native browser modern — **tidak perlu library eksternal (tanpa CryptoJS / NPM)**.
- Bekerja di semua browser desktop & mobile (Chrome, Safari, Edge, Firefox, WebView).

### Langkah 1: Masukkan Script ke Project Construct 3

1. Di Construct 3, buka panel **Project Bar**.
2. Klik kanan pada folder **Scripts** -> **Add script**.
3. Beri nama `igx-game-api.js`.
4. Salin seluruh isi dari file `public/js/game/igx-game-api.js` ke dalam file tersebut.

### Langkah 2: Konfigurasi Environment & Key

Di bagian atas `igx-game-api.js`, programmer dapat memilih environment:

```javascript
// Ganti ke 'prod' saat export untuk event production
let CURRENT_ENV = 'stage'; // 'prod' | 'stage' | 'local'

// Key CONST (harus sama dengan GAME_SECRET_KEY di server)
const CONST_KEY = 'igx_game_secret_2026_x7k9p2m4';
```

Atau bisa juga diatur via kode JavaScript kapan saja:
```javascript
IgxGameApi.setEnvironment('prod'); // atau 'stage'
```

---

### Langkah 3: Penggunaan di Event Sheet Construct 3

#### A. Inisialisasi Saat Game Mulai (On Start of Layout):
Tambahkan action **Run JavaScript**:

```javascript
// Mengambil parameter dari URL embed atau request token demo
IgxGameApi.init().then(param => {
    console.log("IGX Game Session Initialized. Param:", param);
}).catch(err => {
    console.warn("IGX Session Init Warning:", err.message);
});
```

#### B. Mengirimkan Skor di Layar Game Over:
Saat pemain selesai bermain dan memasukkan username serta email, panggil action **Run JavaScript**:

```javascript
(async () => {
    // Ambil data dari Global Variables Construct 3
    const playerName = runtime.globalVars.PlayerName;
    const playerEmail = runtime.globalVars.PlayerEmail;
    const finalScore = runtime.globalVars.PlayerScore;

    try {
        const result = await IgxGameApi.sendScore(playerName, playerEmail, finalScore);

        if (result.success) {
            console.log("Score saved! Rank:", result.position);

            // Simpan posisi dan leaderboard ke Global Variable Construct 3
            runtime.globalVars.PlayerRank = result.position;
            runtime.globalVars.LeaderboardJson = JSON.stringify(result.leaderboard);

            // Panggil fungsi event di Construct 3
            runtime.callFunction("OnScoreSubmitSuccess");
        } else {
            console.error("Score submit failed:", result.message);
            runtime.globalVars.ErrorMessage = result.message || "Failed to submit score";
            runtime.callFunction("OnScoreSubmitFailed");
        }
    } catch (error) {
        console.error("Unexpected error:", error);
        runtime.globalVars.ErrorMessage = error.message;
        runtime.callFunction("OnScoreSubmitFailed");
    }
})();
```

---

## 5. Ringkasan Checklist untuk Game Programmer

- [ ] Import `igx-game-api.js` ke dalam folder `Scripts` project Construct 3.
- [ ] Atur environment target (`'stage'` untuk testing, `'prod'` untuk rilis akhir).
- [ ] Panggil `await IgxGameApi.init()` di layout awal.
- [ ] Panggil `await IgxGameApi.sendScore(name, email, score)` di layout Game Over.
- [ ] Tampilkan `result.position` (peringkat mingguan) dan `result.leaderboard` di UI game.
