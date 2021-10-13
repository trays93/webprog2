<?php

class PreviousController {

    public function indexAction()
    {
        return new View('previous', 'index', ['Előző sorsolások']);
    }
}

?>