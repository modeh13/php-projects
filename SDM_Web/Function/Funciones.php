<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$filename = realpath(dirname(__FILE__) . '/../resources.ini');
        
// Leer variable de Archivo .ini
function fu_Obtener_Ini_Valor($key)
{
    global $filename;
    $array_ini = parse_ini_file($filename);
    $value = '';
    
    if(is_array($array_ini) && array_key_exists($key, $array_ini))
    {
        $value = $array_ini[$key];        
    }    
    
    return $value;
}