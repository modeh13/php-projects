<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContratoModel
 *
 * @author German Alexander Ramirez Vela
 */
require realpath(dirname(__FILE__) . '/OperacionesBD.php');

class ContratoModel {
    //put your code here
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        //$this->db = OperacionesBD::Singleton();
    }
    
    public function fu_Obtener_Datos_Contrato($numContrato)
    {
        try{
            $sql = 'CALL ' . fu_Obtener_Ini_Valor('NombreBD') .'.PA_Obterner_Datos_Contrato(:num_contrato)';
            $pa = $this->db->prepare($sql);              
            $pa->bindParam(':num_contrato', $numContrato, PDO::PARAM_STR);            
            $pa->execute();
            
            //echo $pa->rowCount();
            $result = $pa->fetchAll();
            
        }catch(PDOException $ex){
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }    
        
        return $result;
    }
}