// public/js/scripts.js

// Pastikan skrip dijalankan setelah dokumen selesai dimuat
$(document).ready(function () {
    // Tambahkan dan hapus kelas pada hover
    $('.album-card').hover(
        function () {
            $(this).addClass('zoom');
        },
        function () {
            $(this).removeClass('zoom');
        }
    );

    // Jika sedang dalam mode edit
    $('.album-card').addClass('edit-mode');

    // Jika ingin menghilangkan mode edit
    // $('.album-card').removeClass('edit-mode');
});
