<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginController
 *
 * @author German Alexander Ramirez Vela
 */
require realpath(dirname(__FILE__) . '/../Model/LoginModel.php');

class LoginController {
    //put your code here
    protected $lgModel;
    
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        //$this->view = new View();
        $this->lgModel = new LoginModel();
    }
    
    public function fu_Validar_Usuario($usuario, $pass)
    {
        return $this->lgModel->fu_Validar_Usuario($usuario, $pass);        
    }    
}