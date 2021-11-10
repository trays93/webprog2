<?php

class PreviousController
{
    public function indexAction()
    {
        $id = 0;

        if (isset($_GET['huzas_id']) && intval($_GET['huzas_id'])) {
            $id = $_GET['huzas_id'];
        }

        $client = new SoapClient(SITE_ROOT . '/beadando/lotto.wsdl');

        if (isset($_POST['year']) && intval($_POST['year']) && isset($_POST['week']) && intval($_POST['week']))
        {
                $year = $_POST['year'];
                $week = $_POST['week'];
                $id = $client->getIdFromYW($year,$week);
        }
        
        if($id == -1) {
            return new View('error', 'error',
                    ['error' => '<h4>A keresett dátumnál nem történ sorsolás </h3><a href="\beadando\previous" class="button button-back">Vissza</a>']);
        }

        $huzas = $client->getHuzas($id);
        return new View('previous', 'index', [
            'huzas' => $huzas,
        ]);
    }
}
