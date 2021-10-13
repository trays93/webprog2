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
        $huzas = $client->getHuzas($id);
        return new View('previous', 'index', [
            'huzas' => $huzas,
        ]);
    }
}
