<?php

class StatisticsController
{
    public function indexAction()
    {
        return new View('statistics', 'index', ['Számstatisztika']);
    }
}
