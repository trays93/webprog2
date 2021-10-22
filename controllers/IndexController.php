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

    public function arfolyamAction()
    {
        $arfolyam = [];

        $client = new SoapClient('http://www.mnb.hu/arfolyamok.asmx?WSDL', [
            'soap_version' => 'SOAP_1_1',
            'trace' => 1,
        ]);

        $result = new SimpleXMLElement($client->GetCurrencies()->GetCurrenciesResult);
        $valutak = (array) $result->Currencies->Curr;

        $date = new SimpleXMLElement($client->GetDateInterval()->GetDateIntervalResult);

        if (isset($_POST['datum'])) {
            $param = [
                'startDate' => $_POST['datum'],
                'endDate' => $_POST['datum'],
                'currencyNames' => $_POST['valuta1'] . ',' . $_POST['valuta2']
            ];
            $result = new SimpleXMLElement($client->GetExchangeRates($param)->GetExchangeRatesResult);

            foreach($result->Day->Rate as $rate) {
                $arfolyam[(string) $rate->attributes()->curr] = (string) $rate;
            }
        }

        return new View('index', 'arfolyam', [
            'valutak' => $valutak,
            'start' => (string) $date->DateInterval->attributes()->startdate,
            'end' => (string) $date->DateInterval->attributes()->enddate,
            'arfolyam' => $arfolyam,
        ]);
    }

}
