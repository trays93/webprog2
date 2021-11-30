<style>

    .text-end {
        margin: 10px 0px;
        min-width: 30%;
    }

    a {
        font-weight: bold;
        font-size: 17px;
    }

    .btn.btn-outline-light.me-2 {
        margin: 4px;
    }

    .btn.btn-warning {
        margin: 4px;
    }

</style>

<?php 
$controll = new MenuController(Database::getConnection());
$menu = $controll->getItem(0);
$role = (isset($_SESSION['user']) ? $_SESSION['user']->getRole() : 1);

?>
<header class="p-3 bg-dark text-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <?php 
                            foreach($menu as $m) {
                                $permission = $m->getPermission();
                                if($role >= $permission) {
                                    if(count($controll->getItem($m->getId())) > 0) {?>
                                        <li class="nav-item dropdown" id="myDropdown">
                                            <a class="nav-link dropdown-toggle" <?php if($m->getClick()) {?>href="<?=$m->getPagePath()?>" <?php } ?> data-bs-toggle="dropdown">
                                                <?=$m->getComment()?>
                                            </a>
                                            <ul class="dropdown-menu">
                                            <?php $dropdownmenu = $controll->getItem($m->getId());
                                            foreach($dropdownmenu as $d) { 
                                                if($role >= $d->getPermission()) { ?>
                                                <li> <a class="dropdown-item" <?php if($d->getClick()) {?>href="<?=$d->getPagePath()?>" <?php } ?>>
                                                    <?=$d->getComment()?>
                                                </a></li>
                                            <?php }} ?>
                                            </ul>
                                        </li>  
                                  <?php } else { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" <?php if($m->getClick()) {?>href="<?=$m->getPagePath()?>" <?php } ?>>
                                                <?=$m->getComment()?>
                                        </a></li>
                            <?php   }
                                }
                                
                            }
                            ?>
                    </div>
                    <div class="text-end">
                            <?php if (isset($_SESSION['user'])): ?>
                                <?= ($_SESSION['user']->getRole() == 3 ? 'Admin: ' : 'Bejelentkezett: ').$_SESSION['user']->print() ?>
                                <a id="log" href="/Logout" class="btn btn-outline-light me-2">Kijelentkezés</a>
                                <?= $_SESSION['user']->getRole() == 3 ? '<a id="log" href="/Register" class="btn btn-warning">Regisztráció</a>' : ''?>
                                <?php else: ?>
                                <a id="log" href="/Login" class="btn btn-outline-light me-2">Bejelentkezés</a>
                                <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
</header>
