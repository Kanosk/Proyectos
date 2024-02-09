<?php  
require_once '../vendor/autoload.php';
require 'fp.php';

$serverUrl = "http://localhost/ApiSoap/act1/apisoap1/servidorsoapfp.php";

if (isset($_GET['wsdl'])) {
    $soapAutoDiscover = new \Zend\Soap\AutoDiscover(new \Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeSequence());
    $soapAutoDiscover->setBindingStyle(array('style' => 'document'));
    $soapAutoDiscover->setOperationBodyStyle(array('use' => 'literal'));
    $soapAutoDiscover->setClass('Fp');
    $soapAutoDiscover->setUri($serverUrl);
    header("Content-Type: text/xml; charset=UTF-8");
    echo $soapAutoDiscover->generate()->toXml();
} else {
    $soap = new \Zend\Soap\Server($serverUrl . '?wsdl');
    $soap->setObject(new \Zend\Soap\Server\DocumentLiteralWrapper(new Fp()));
    $soap->handle();	
}