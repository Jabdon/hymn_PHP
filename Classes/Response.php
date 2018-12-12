
<?php

class Response{

    public $Status;
    public $json;

    function __construct($Status, $json){
        $this->Status = $Status;
        $this->json = $json;
    }
}


?>