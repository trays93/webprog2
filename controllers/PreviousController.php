<?php

class PreviousController
{
    public function indexAction()
    {
        $id = 0;

        if (isset($_GET['huzas_id']) && intval($_GET['huzas_id'])) {
            $id = $_GET['huzas_id'];
        }

        $client = new SoapClient('http://localhost/beadando/lotto.wsdl');

        if (isset($_POST['year']) && intval($_POST['year']) && isset($_POST['week']) && intval($_POST['week']))
        {
                $year = $_POST['year'];
                $week = $_POST['week'];
                $id = $client->getIdFromYW($year,$week);
        }
        
        if($id == -1) {
            return new View('previous', '404', ['HIBA']);
        }

        $huzas = $client->getHuzas($id);
        return new View('previous', 'index', [
            'huzas' => $huzas,
        ]);
    }
}
