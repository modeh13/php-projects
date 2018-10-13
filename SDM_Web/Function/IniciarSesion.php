<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Controller/LoginController.php';
include '../Model/Session.php';

$usr = filter_input(INPUT_POST, '_usr');
$ps = filter_input(INPUT_POST, '_ps');

if(isset($usr) && isset($ps))
{
    $lgController = new LoginController();
    $result = $lgController->fu_Validar_Usuario($usr, $ps);   
    
    //echo 'numero de registros: ' .count($result);
    if(count($result))
    {
        $objUsuario = reset($result);
        $nombCompleto = $objUsuario['PrimerNombre'] . ' ' . $objUsuario['SegundoNombre'] . ' ' .
                        $objUsuario['PrimerApellido'] . ' ' . $objUsuario['SegundoApellido'];
        
        $nombCompleto = strtoupper(str_replace('  ', ' ', $nombCompleto));
 
        $session = Session::getInstance();
        $session->setValue('IdUsuario', $objUsuario['IdUsuario']);        
        $session->setValue('DocUsu', $objUsuario['NroDoc']);
        $session->setValue('NombUsu', $nombCompleto);
        
        echo '{"estado":"@OK", "mensaje":"Usuario OK."}';        
    }
    else{
        echo '{"estado":"@ERROR", "mensaje":"Usuario no encontrado."}';
    }
}