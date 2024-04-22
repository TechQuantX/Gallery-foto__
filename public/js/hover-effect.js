document.addEventListener('DOMContentLoaded', function () {
    const albumCards = document.querySelectorAll('.album-card');

    albumCards.forEach(function (card) {
        card.addEventListener('mousemove', function (event) {
            const { left, top, width, height } = card.getBoundingClientRect();
            const x = (event.clientX - left) / width;
            const y = (event.clientY - top) / height;

            // Pemeriksaan apakah elemen mendukung transformasi CSS
            if (card.style.transform !== undefined) {
                // Sesuaikan efek yang diinginkan berdasarkan posisi kursor
                card.style.transform = `scale(1.1)`;
                card.style.zIndex = '2';

                // Contoh: Efek parallax dengan pergerakan kursor
                const parallaxStrength = 20;
                card.style.transform = `scale(1.1) translate(${x * parallaxStrength}px, ${y * parallaxStrength}px)`;
            }
        });

        card.addEventListener('mouseleave', function () {
            // Kembalikan ke keadaan semula ketika kursor meninggalkan elemen
            card.style.transform = '';
            card.style.zIndex = '';
        });
    });
});
