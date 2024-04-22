// File: public/js/app.js (atau nama file JavaScript Anda)
document.getElementById('cover_image').addEventListener('change', function (e) {
    var imagePreview = document.getElementById('image-preview');
    var imagePreviewContainer = document.getElementById('image-preview-container');

    var reader = new FileReader();
    reader.onload = function (e) {
        // Periksa dan pastikan bahwa jalur gambar dibentuk dengan benar
        imagePreview.src = '{{ asset('storage / covers / ') }}' + '/' + e.target.result;
        imagePreviewContainer.style.display = 'block';
    };

    reader.readAsDataURL(e.target.files[0]);
});
