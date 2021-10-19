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
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
 				<span class="navbar-toggler-icon"></span>
 			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
 				<ul class="navbar-nav mr-auto btn-group">
				 	<?php foreach ($menu as $m) { ?>
						<li class="nav-item">
					    	<b><a class="nav-link" href="<?= $m['ref'] ?>">
                            <?= $m['name'] ?></a></b>
						</li>
					<?php } ?>
 				</ul>
 			</div>
            <div class="text-end">
                <?php if (isset($_SESSION['user'])): ?>
                    Bejelentkezett: <?= $_SESSION['user']->print() ?>
                    <a href="/beadando/logout" class="btn btn-outline-light me-2">Kijelentkezés</a>
                    <?php else: ?>
                    <a href="/beadando/login" class="btn btn-outline-light me-2">Bejelentkezés</a>
                    <a href="/beadando/register" class="btn btn-warning">Regisztráció</a>
                    <?php endif; ?>
            </div>
		</nav>
    </div>
</header>


