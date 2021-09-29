<!DOCTYPE html>
<html>
<head>
    <!-- Bootsrtap required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Beadandó feladat</title>
</head>
<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/beadando" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    Beadandó
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <a href="/beadando" class="nav-link px-2 text-secondary">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/beadando/index/another" class="nav-link px-2 text-white">
                            Page
                        </a>
                    </li>
                </ul>
                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <?php
        // TODO ide jönnek az oldalankénti view-k
        include_once $viewName;
        ?>
    </main>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li>
                    <a href="/beadando" class="nav-link px-2 text-secondary">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/beadando/index/another" class="nav-link px-2 text-white">
                        Page
                    </a>
                </li>
            </ul>
            <p class="text-center text-muted">&copy; <?= date('Y') ?> Company, Inc</p>
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
