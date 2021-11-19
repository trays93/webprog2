<?php

class LogoutController
{
    public function indexAction()
    {
        $_SESSION['user'] = null;
        session_destroy();
        
        header("Location: {$_SERVER['HTTP_ORIGIN']}/");
    }
}
