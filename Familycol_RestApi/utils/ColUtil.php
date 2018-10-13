<?php
require '../vendor/autoload.php';

function echoResponse($status_code, $response) {
    echo "Entro2";
    //$app = new Slim\App();
    $app = \Slim::getInstance();
    echo "Entro3";
    // Http response code
    $app->status($status_code);
 
    // setting response content type to json
    $app->contentType('application/json'); 
    echo "Entro3";
    echo json_encode($response);
}

function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
     
    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        //$db = new DbHandler(); //utilizar para manejar autenticacion contra base de datos     
        // get the api key
        $token = $headers['Authorization'];
     
        // validating api key
        if (!($token == API_KEY)) { //API_KEY declarada en Config.php     
            // api key is not present in users table
            $response["error"] = true;
            $response["message"] = "Acceso denegado. Token inválido";
            echoResponse(401, $response);
            
            $app->stop(); //Detenemos la ejecución del programa al no validar     
        } else {
            //procede utilizar el recurso o metodo del llamado
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Falta token de autorización";
        echoResponse(400, $response);        
        $app->stop();
    }
}