<?php 
$menu = [
    'home' => [
        'name' => 'Kezdőoldal',
        'ref' => '/beadando'
    ],
    'another' => [
        'name' => 'Aloldal',
        'ref' => '/beadando/index/another'
    ],
    'previous' => [
        'name' => 'Előző sorsolások',
        'ref' => '/beadando/previous'
    ],
    'statistics' => [
        'name' => 'Számstatisztika',
        'ref' => '/beadando/statistics'
    ],
];
?>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <?php foreach ($menu as $m) { ?>
                <li>
                    <a href="<?= $m['ref'] ?>" class="nav-link px-2 text-secondary">
                    <?= $m['name'] ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <div class="text-end">
                <?php if (isset($_SESSION['user'])): ?>
                Bejelentkezett: <?= $_SESSION['user']->print() ?>
                <a href="/beadando/logout" class="btn btn-outline-light me-2">Kijelentkezés</a>
                <?php else: ?>
                <a href="/beadando/login" class="btn btn-outline-light me-2">Bejelentkezés</a>
                <a href="/beadando/register" class="btn btn-warning">Regisztráció</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
