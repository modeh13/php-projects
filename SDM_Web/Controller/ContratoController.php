<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContratoController
 *
 * @author German Alexander Ramirez
 */
require realpath(dirname(__FILE__) . '/../Model/ContratoModel.php');

class ContratoController {
    //put your code here
    protected $ctoModel;
    
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas        
        $this->ctoModel = new ContratoModel();
    }
    
    public function fu_Obtener_Datos_Contrato($numContrato)
    {
        //return $this->ctoModel->fu_Obtener_Datos_Contrato($numContrato);        
        $datosContrato = array(array("numContrato"=>$numContrato, "cantImgs"=>13));
        return $datosContrato;        
    }
}