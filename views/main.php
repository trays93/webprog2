<!DOCTYPE html>
<html class="h-100">
<head>
    <!-- Bootsrtap required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 	
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="<?= SITE_ROOT ?>/css/styles.css" rel="stylesheet">
    <title>Beadandó feladat</title>

    <?php
    //Autoloader scripts -- A lényeg, hogy a js fájl azonos néven legyen elmentve, mint
    //mint az oldal (ez alól kivétel a kezdő oldal, mert ott az URL-ban nics hozzá meghatározva név, ezért a kezdőoldalnál a js fájl neve home.js)
    //Aloldalnál pl.: /previous/404  a js elnevezése 'previous404.js'-nek kell lennie
    $title = $_SERVER['QUERY_STRING'];
    $path = array_values(array_filter(explode('/', $title), function ($value) {
        return trim($value) !== '';
    }));
    $filename = isset($path[1]) ? $path[1] : '';
    ?>
    <?php if(file_exists('css/'.$filename.'.css')): ?>
        <link rel="stylesheet" href=<?= SITE_ROOT . 'css/' . $filename . '.css'?> type="text/css">
    <?php endif; ?>

</head>
<body class="d-flex flex-column h-100">

    <?php include_once('header.php'); ?>
    
    <main class="container">
<?php include_once $viewName; ?>
    </main>

    

    <footer class="mt-auto py-3 my-4">
        <div class="container">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li>
                    <a href="/" class="nav-link px-2 text-secondary">
                        Kezdőoldal
                    </a>
                </li>
            </ul>
            <p class="text-center text-muted">&copy; <?= date('Y') ?> Készítették: Lovas Bálint és Fekete Zoltán</p>
        </div>
    </footer>

    <!-- JS files: jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php if(file_exists('scripts/'.$filename.'.js')): ?>
        <script type="text/javascript" src=<?= SITE_ROOT . '/scripts/' . $filename . '.js'?>></script>
    <?php endif; ?>
    
</body>
</html>
