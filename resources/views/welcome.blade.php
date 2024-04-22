<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:wght@100;400;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        main {
            flex: 1;
            display: flex;
        }

        aside {
            background-color: #f4f4f4;
            padding: 20px;
            flex: 1;
        }

        article {
            flex: 2;
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .jumbotron {
            background-image: url('img/cover.png');
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 100px 20px;
            margin-bottom: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Album styling */
        .album {
            margin-top: 20px;
        }

        .album .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .album .card img {
            width: 100%;
            height: auto;
        }

        .album .card-body {
            text-align: center;
        }

        .album .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .album .card-text {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="jumbotron">
        <h1 class="display-4">Welcome to our Gallery App</h1>
        <p class="lead">Explore beautiful photos from around the world</p>
        <a href="login" class="btn btn-primary btn-lg">Explore Gallery</a>
    </div>

    <div class="container album">
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <div class="col mb-4">
                <div class="card h-100 shadow">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">Example Album</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                    efficitur dui id lectus facilisis, sit amet ultricies felis gravida.</p>
                                <p class="card-text"><strong>Created by:</strong> John Doe</p>
                                <p class="card-text"><strong>Created at:</strong> January 1, 2024</p>
                                <a href="#gallery" class="btn btn-primary btn-view-album">View Album</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="https://picsum.photos/300/300" class="card-img-top img-fluid rounded"
                                alt="Placeholder image" style="height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100 shadow">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">Example Album</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                    efficitur dui id lectus facilisis, sit amet ultricies felis gravida.</p>
                                <p class="card-text"><strong>Created by:</strong> John Doe</p>
                                <p class="card-text"><strong>Created at:</strong> January 1, 2024</p>
                                <a href="#gallery" class="btn btn-primary btn-view-album">View Album</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="https://picsum.photos/1000/1000" class="card-img-top img-fluid rounded"
                                alt="Placeholder image" style="height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100 shadow">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">Example Album</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                                    efficitur dui id lectus facilisis, sit amet ultricies felis gravida.</p>
                                <p class="card-text"><strong>Created by:</strong> John Doe</p>
                                <p class="card-text"><strong>Created at:</strong> January 1, 2024</p>
                                <a href="#gallery" class="btn btn-primary btn-view-album">View Album</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="https://picsum.photos/2000/2000" class="card-img-top img-fluid rounded"
                                alt="Placeholder image" style="height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <section id="gallery" class="gallery">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-10 text-center">
                        <span></span>
                        <h2>Galeri Foto</h2>
                        <p>Ini adalah tampilan View Album & View Foto</p>
                    </div>
                </div>

                <div class="row mt-3 justify-content-end">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="img/1.png" data-toggle="lightbox" data-caption="View Album" data-lightbox="gallery"
                            data-gallery="mygallery">
                            <img src="img/1.png" alt="Gallery-foto_ 1" class="img-fluid img-thumbnail rounded"
                                style="width: 100%; height: 50%; object-fit: cover;">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="img/2.png" data-toggle="lightbox" data-caption="View Detil Foto"
                            data-lightbox="gallery" data-gallery="mygallery">
                            <img src="img/2.png" alt="Gallery-foto_ 2" class="img-fluid img-thumbnail rounded"
                                style="width: 100%; height: 50%; object-fit: cover;">
                        </a>
                    </div>
                </div>
            </div>
        </section>



        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
                                                                                                                                                                                                                text-white"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>

</html>
