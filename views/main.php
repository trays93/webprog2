<!DOCTYPE html>
<html>
<head>
    <!-- Bootsrtap required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <title>Beadandó feladat</title>
</head>
<body>
    <?php include_once('header.php'); ?>
    
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
                        Kezdőoldal
                    </a>
                </li>
                <li>
                    <a href="/beadando/index/another" class="nav-link px-2 text-secondary">
                        Aloldal
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
