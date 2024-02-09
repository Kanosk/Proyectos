<?php

require_once 'bd.php';

class Fp{
    /**
     * @param int $id
     * @return string $resul
     */
    public function infoModulo($id){
        $fp = informacionModulo($id);
        var_dump($fp);
        $fpJson = json_encode(iterator_to_array($fp),true,JSON_UNESCAPED_UNICODE);
        var_dump($fpJson);
        return $fpJson;
    }
    /**
     * @return string $resul
     */
    public function infoDepartamento(){
        $fp = informacionDepartamentos();
        $fpJson = json_encode(iterator_to_array($fp),true);
        return $fpJson;
    }
    /**
    * @return string $resul
    */
    public function infoNomenclaturas(){
        $fp = informacionNomenclaturas();
        $fpJson = json_encode(iterator_to_array($fp),true);
        return $fpJson;
    }
}