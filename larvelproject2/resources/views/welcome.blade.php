<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Website</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .banner {
            background-image: url('https://via.placeholder.com/1200x400');
            background-size: cover;
            background-position: center;
            height: 400px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    @include('layouts.header') <!-- include header -->

    <!-- Banner -->
    <div class="banner">
        Welcome to Our Website!
    </div>

    <!-- Services Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Service One</h5>
                        <p class="card-text">This is a dummy service description. We provide high-quality services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Service Two</h5>
                        <p class="card-text">This is another dummy service. We always deliver professional solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer') <!-- include footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
