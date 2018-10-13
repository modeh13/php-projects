<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OperacionesBD
 *
 * @author German Alexander Ramirez Vela
 */
require realpath(dirname(__FILE__) . '/../Function/Funciones.php');

class OperacionesBD extends PDO {
    //put your code here
    private static $instance = null;
 
    public function __construct()
    {        
        try{            
            parent::__construct('mysql:host=' . fu_Obtener_Ini_Valor('ServidorBD') . ';dbname=' . fu_Obtener_Ini_Valor('NombreBD'),
            fu_Obtener_Ini_Valor('UsuarioBD'), fu_Obtener_Ini_Valor('ClaveBD'));
        }catch(Exception $ex){
            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
        }
    }
 
    public static function Singleton()
    {
        if( self::$instance == null )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}