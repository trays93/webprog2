<?php

class LogoutController
{
    public function indexAction()
    {
        $_SESSION['uesr'] = null;
        session_destroy();
        
        header("Location: {$_SERVER['HTTP_ORIGIN']}/beadando");
    }
}
