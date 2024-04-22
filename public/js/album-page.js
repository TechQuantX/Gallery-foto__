// album-page.js

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('deleteAlbumBtn').addEventListener('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAlbumForm').submit();
            }
        });
    });

    // Add a smooth scroll effect to "View Album" button
    document.querySelector('.view-album-btn').addEventListener('click', function (event) {
        event.preventDefault();
        document.querySelector('.card-body').scrollIntoView({
            behavior: 'smooth'
        });
    });
});
