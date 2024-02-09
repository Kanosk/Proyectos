<?php
require_once '../vendor/autoload.php';

$serverUrl = "http://localhost/ApiSoap/act1/apisoap1/servidorsoapfp.php?wsdl";

$cliente = new \Zend\Soap\Client($serverUrl);
$cliente->setEncoding("UTF-8");
$resultModulo = $cliente->infoModulo(["id"=> 2]);
$resultDepartamento = $cliente->infoDepartamento();
$resultNomenclaturas = $cliente->infoNomenclaturas();


echo "Respuesta modulo solicitado: <br>";
echo $resultModulo->infoModuloResult;
echo "<br>--------------<br>";
echo "Respuesta Departamentos de los modulos:<br> " ;
echo $resultDepartamento->infoDepartamentoResult;
echo "<br>--------------<br>";
echo "Respuesta Nomenclaturas de los modulos: <br>";
echo $resultNomenclaturas->infoNomenclaturasResult;