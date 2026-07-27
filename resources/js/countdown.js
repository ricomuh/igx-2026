document.addEventListener("DOMContentLoaded", function () {
    const firstCountdown = document.querySelector(".countdown");
    if (!firstCountdown) return;
    const targetDate = firstCountdown.getAttribute("data-countdown");
    if (!targetDate) return;
    const countdownDate = new Date(targetDate).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            document.querySelectorAll(".countdown").forEach((el) => (el.textContent = "00"));
            clearInterval(interval);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update ALL matching elements (supports multiple countdowns on page)
        document.querySelectorAll(".countdown.days").forEach(el => el.textContent = String(days).padStart(2, "0"));
        document.querySelectorAll(".countdown.hours").forEach(el => el.textContent = String(hours).padStart(2, "0"));
        document.querySelectorAll(".countdown.minutes").forEach(el => el.textContent = String(minutes).padStart(2, "0"));
        document.querySelectorAll(".countdown.seconds").forEach(el => el.textContent = String(seconds).padStart(2, "0"));

        // Update HP bar width (days as percentage of ~365 days)
        const hpBar = document.querySelector(".hp-bar");
        if (hpBar) {
            const pct = Math.max(0, Math.min(100, ((365 - days) / 365) * 100));
            hpBar.style.width = pct + "%";
        }
    }

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown();
});
