<!DOCTYPE html>
<html data-theme="true" data-theme-mode="light" lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ @$title ? $title . ' | ' : '' }}{{ config('app.name') }}</title>

        <meta name="description" content="Beli tiket Indonesia Game Expo 2026 — ICE BSD, Hall 9-10, 24-25 Oktober 2026.">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite('resources/css/app.css')
        @endif
        <link rel="stylesheet" href="/font-css">

        {{-- Alpine.js for interactive cart --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @stack('style')
    </head>
    <body class="bg-secondary min-h-screen flex flex-col antialiased font-moon"
          x-data="{
              cart: JSON.parse(localStorage.getItem('igx_cart') || '[]'),
              cartOpen: false,
              saveCart() {
                  localStorage.setItem('igx_cart', JSON.stringify(this.cart));
              },
              addToCart(id, name, price, qty = 1) {
                  let existing = this.cart.find(item => item.ticket_type_id === id);
                  if (existing) {
                      existing.qty = Math.min(10, existing.qty + qty);
                  } else {
                      this.cart.push({ ticket_type_id: id, name: name, price: price, qty: qty });
                  }
                  this.saveCart();
                  this.cartOpen = true;
              },
              removeFromCart(id) {
                  this.cart = this.cart.filter(item => item.ticket_type_id !== id);
                  this.saveCart();
              },
              updateQty(id, qty) {
                  let item = this.cart.find(item => item.ticket_type_id === id);
                  if (item) {
                      item.qty = Math.max(1, Math.min(10, qty));
                      this.saveCart();
                  }
              },
              get cartTotal() {
                  return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
              },
              get cartCount() {
                  return this.cart.reduce((sum, item) => sum + item.qty, 0);
              },
              formatRupiah(val) {
                  return 'IDR ' + new Intl.NumberFormat('id-ID').format(val);
              }
          }">
        {{-- ===== HEADER — Neo-Brutalism Style (matches igx-03.leolitgames.com) ===== --}}
        <header class="bg-secondary border-b-4 border-black relative z-20">
            <div class="mx-auto px-5 xl:px-12 py-2.5 flex items-center justify-between gap-4">
                <a href="{{ route('ticket.landing') }}" class="flex items-center gap-3">
                    <span class="bg-surface border-3 border-black p-1 shadow-brutal-sm rotate-[-1deg] block">
                        <img src="{{ asset('media/images/logos/logo-stage03-v3.webp') }}" class="h-7 sm:h-9 lg:h-10" alt="IGX Logo">
                    </span>
                    <span class="hidden sm:block">
                        <span class="block text-[10px] font-extrabold uppercase text-secondary-lighter tracking-widest leading-tight">Indonesia Game Expo 2026</span>
                        <span class="block text-xs font-extrabold uppercase text-accent leading-tight">ICE BSD · Hall 9-10 · 24-25 Oct</span>
                    </span>
                </a>
                <nav class="flex items-center gap-2 sm:gap-3">
                    {{-- Interactive Floating Cart Button --}}
                    <button @click="cartOpen = true"
                            class="bg-highlight border-3 border-black px-3 py-1.5 text-[10px] sm:text-xs font-extrabold uppercase text-black shadow-brutal-sm hover:bg-accent hover:-translate-y-0.5 transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        <span class="hidden sm:inline">Cart</span> (<span x-text="cartCount">0</span>)
                    </button>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener"
                       class="bg-cyan border-3 border-black px-3 py-1.5 text-[10px] sm:text-xs font-extrabold uppercase text-black shadow-brutal-sm hover:bg-highlight hover:-translate-y-0.5 transition-all">
                        igx.co.id
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-1 relative">
            @yield('content')
        </main>

        {{-- ===== FOOTER — Neo-Brutalism Style ===== --}}
        <footer class="bg-black border-t-4 border-black py-3">
            <div class="container mx-auto px-5 text-center">
                <p class="text-[10px] font-extrabold uppercase text-white/60 tracking-wider">
                    Indonesia Game Expo 2026 · ICE BSD Hall 9-10 · 24-25 October 2026 · <a href="mailto:hello@igx.co.id" class="text-accent hover:text-white transition-colors underline decoration-2">hello@igx.co.id</a>
                </p>
            </div>
        </footer>

        {{-- ===== INTERACTIVE BRUTAL CART MODAL/DRAWER ===== --}}
        <div class="fixed inset-0 z-50 overflow-hidden" x-show="cartOpen" x-transition.opacity style="display: none;">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="cartOpen = false"></div>

            {{-- Cart Panel --}}
            <div class="absolute right-0 top-0 bottom-0 w-full max-w-md bg-bg border-l-4 border-black p-6 flex flex-col shadow-[0_0_50px_rgba(0,0,0,0.5)]"
                 x-show="cartOpen" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                
                {{-- Cart Header --}}
                <div class="flex items-center justify-between border-b-3 border-black pb-4 mb-6">
                    <div class="bg-primary border-3 border-black px-4 py-1.5 shadow-brutal-sm rotate-[-1deg]">
                        <h2 class="text-lg font-extrabold uppercase text-black tracking-wider flex items-center gap-2">
                            Shopping Cart
                        </h2>
                    </div>
                    <button @click="cartOpen = false"
                            class="bg-crimson text-white border-3 border-black w-8 h-8 flex items-center justify-center font-extrabold shadow-brutal-sm hover:bg-accent transition-colors">
                        &times;
                    </button>
                </div>

                {{-- Cart Content --}}
                <div class="flex-1 overflow-y-auto space-y-4 pr-1">
                    <template x-if="cart.length === 0">
                        <div class="card-brutal bg-surface p-8 text-center my-10">
                            <p class="font-extrabold uppercase text-black/50">Keranjang Belanja Kosong</p>
                            <p class="text-xs font-bold text-black/40 mt-1">Pilih tiket di halaman depan untuk memesan.</p>
                        </div>
                    </template>

                    <template x-for="item in cart" :key="item.ticket_type_id">
                        <div class="card-brutal bg-surface p-4 flex flex-col gap-3 relative">
                            {{-- Delete button --}}
                            <button @click="removeFromCart(item.ticket_type_id)"
                                    class="absolute top-2 right-2 bg-crimson/10 border-2 border-black w-6 h-6 flex items-center justify-center text-xs font-extrabold hover:bg-crimson hover:text-white transition-colors">
                                &times;
                            </button>
                            <div>
                                <span class="text-xs font-extrabold uppercase text-accent tracking-wider block" x-text="item.name"></span>
                                <span class="text-sm font-extrabold text-black block mt-0.5" x-text="formatRupiah(item.price)"></span>
                            </div>
                            <div class="flex items-center justify-between border-t border-black/10 pt-2">
                                <div class="flex items-center gap-2">
                                    <button @click="updateQty(item.ticket_type_id, item.qty - 1)"
                                            class="bg-surface border-2 border-black w-7 h-7 flex items-center justify-center font-extrabold hover:bg-black/5">-</button>
                                    <span class="w-8 text-center font-extrabold" x-text="item.qty"></span>
                                    <button @click="updateQty(item.ticket_type_id, item.qty + 1)"
                                            class="bg-surface border-2 border-black w-7 h-7 flex items-center justify-center font-extrabold hover:bg-black/5">+</button>
                                </div>
                                <span class="font-extrabold text-black" x-text="formatRupiah(item.price * item.qty)"></span>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Cart Footer --}}
                <div class="border-t-3 border-black pt-4 mt-6 space-y-4" x-show="cart.length > 0">
                    <div class="flex justify-between items-center bg-highlight border-3 border-black px-4 py-3 shadow-brutal-sm">
                        <span class="font-extrabold uppercase text-black text-sm">Grand Total</span>
                        <span class="font-extrabold text-black text-lg" x-text="formatRupiah(cartTotal)"></span>
                    </div>

                    <a href="{{ route('ticket.checkout') }}"
                       class="block w-full bg-accent border-3 border-black px-6 py-4 text-center font-extrabold uppercase text-black shadow-brutal hover:shadow-brutal-lg hover:-translate-y-0.5 transition-all">
                        Proceed to Checkout &rarr;
                    </a>
                </div>
            </div>
        </div>

        @stack('scripts')
        @vite('resources/js/countdown.js')
    </body>
</html>
