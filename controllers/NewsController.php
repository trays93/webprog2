<?php

class NewsController
{
    public function indexAction()
    {
        return new View('news', 'index', ['egy', 'kettő']);
    }

}