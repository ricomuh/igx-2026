document.addEventListener("DOMContentLoaded", function () {
    const targetDate = document
        .querySelector(".countdown")
        .getAttribute("data-countdown");
    const countdownDate = new Date(targetDate).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            document
                .querySelectorAll(".countdown")
                .forEach((el) => (el.textContent = "00"));
            clearInterval(interval);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.querySelector(".countdown.days").textContent = String(
            days
        ).padStart(2, "0");
        document.querySelector(".countdown.hours").textContent = String(
            hours
        ).padStart(2, "0");
        document.querySelector(".countdown.minutes").textContent = String(
            minutes
        ).padStart(2, "0");
        document.querySelector(".countdown.seconds").textContent = String(
            seconds
        ).padStart(2, "0");
    }

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown();
});
