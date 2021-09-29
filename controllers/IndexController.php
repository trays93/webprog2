<?php

class IndexController
{
    public function indexAction()
    {
        return new View('index', 'index', ['egy', 'kettő']);
    }

    public function anotherAction()
    {
        return new View('index', 'another', ['Másik']);
    }
}
