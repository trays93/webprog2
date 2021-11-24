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

    public function chartAction()
    {
        return new View('index', 'chart');
    }

}
