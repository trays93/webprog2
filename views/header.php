<?php 
$menu = [
    'home' => [
        'name' => 'Kezdőoldal',
        'ref' => '/Index',
        'login' => 0
    ],
    'news' => [
        'name' => 'Számítógépek',
        'ref' => '/Index/computers',
        'login' => 0
    ], 
    'pdf' => [
        'name' => 'Telepítési adatok pdf-ben',
        'ref' => '/Pdf',
        'login' => 0
    ]
];
?>

    <header class="p-3 bg-dark text-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark" >
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation" style="margin: 10px;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto btn-group">
                        <?php foreach ($menu as $m) { 
                            if($m['login'] == 0) {?>
                                <li class="nav-item">
                                    <b><a class="nav-link" href="<?= $m['ref'] ?>">
                                    <?= $m['name'] ?></a></b>
                                </li> <?php }
                            elseif ($m['login'] == 1 && isset($_SESSION['user'])) { ?>
                                <li class="nav-item">
                                    <b><a class="nav-link" href="<?= $m['ref'] ?>">
                                    <?= $m['name'] ?></a></b>
                                </li>
                        <?php } } ?>
                    </ul>
                </div>
                <div class="text-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        Bejelentkezett: <?= $_SESSION['user']->print() ?>
                        <a href="/Logout" class="btn btn-outline-light me-2">Kijelentkezés</a>
                        <?php else: ?>
                        <a href="/Login" class="btn btn-outline-light me-2">Bejelentkezés</a>
                        <a href="/Register" class="btn btn-warning">Regisztráció</a>
                        <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>
