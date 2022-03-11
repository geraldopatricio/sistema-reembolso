<?php


$client = new \SoapClient("http://appprod:8080/g5-senior-services/sapiens_Synccom_senior_g5_co_mfi_cpa_titulos?wsdl", 
["trace" => 1,"exceptions" => true,]);
var_dump($client->__getFunctions());



?>