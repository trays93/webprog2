<?php

class IndexController
{
    public function indexAction()
    {
        return new View('index', 'index', ['egy', 'kettő']);
    }

    public function computersAction()
    {
        return new View('index', 'computers', []);
    }

}
