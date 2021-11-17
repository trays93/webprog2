<?php

class IndexController
{
    public function indexAction()
    {
        return new View('index', 'index', ['egy', 'kettő']);
    }

}
