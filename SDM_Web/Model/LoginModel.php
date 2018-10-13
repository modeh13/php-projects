<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginModel
 *
 * @author German Alexander Ramirez Vela
 */
require realpath(dirname(__FILE__) . '/OperacionesBD.php');

class LoginModel {
    //put your code here
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        //$this->db = OperacionesBD::Singleton();
    }
    
    public function fu_Validar_Usuario($usuario, $pass)
    {
        //$result = [];
//        try{
//            $sql = 'CALL ' . fu_Obtener_Ini_Valor('NombreBD') .'.PA_Validar_Usuario(:usuario, :clave)';
//            $pa = $this->db->prepare($sql);              
//            $pa->bindParam(':usuario', $usuario, PDO::PARAM_STR);
//            $pa->bindParam(':clave', $pass, PDO::PARAM_STR);
//            $pa->execute();
//            
//            //echo $pa->rowCount();
//            $result = $pa->fetchAll();
//            
//        }catch(PDOException $ex){
//            echo 'Excepción capturada: ',  $ex->getMessage(), "\n";
//        }
        
        $result = array(array(
            "IdUsuario"=>"1", 
            "NroDoc"=>"1098698008", 
            "PrimerNombre"=>"German", 
            "SegundoNombre"=>"Alexander",
            "PrimerApellido"=>"Ramirez",
            "SegundoApellido"=>"Vela",
        ));
        
        //echo $result;
        //foreach($result as $rst)
        //{
        //    echo $rst['IdUsuario'];
        //    echo $rst['NroDoc'];
        //}
        
        return $result;
    }
}