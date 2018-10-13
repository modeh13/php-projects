<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php   
    include realpath(dirname(__FILE__) . '/Function/Funciones.php');    
    include realpath(dirname(__FILE__) . '/Model/Session.php'); 
    
    $sesion = Session::getInstance();        
    $sesion->validateLogin();    
    $sesion->setValue('LastActivity', time());    
   
    // Datos del usuario
    $tituloApp = fu_Obtener_Ini_Valor('NombreApp'); 
    $idUsuario = $sesion->getValue('IdUsuario');
    $docUsuario = $sesion->getValue('DocUsu');
    $nombreUsuario = $sesion->getValue('NombUsu');       
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $tituloApp ?></title>
        
        <!-- Estilos -->
        <link href="css/font_face.css" rel="stylesheet" />        
        <link href="css/login.css" rel="stylesheet" />
        <link href="css/viewerSDM.css" rel="stylesheet" />
        <link href="css/global.css" rel="stylesheet" />
        
        <!-- Js -->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js" ></script>
        <script type="text/javascript" src="js/underscore.js"></script>
        
        <!-- Js App -->
        <script type="text/javascript" src="js/viewerSDM.js" ></script>
        <script type="text/javascript" src="js/login.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
    </head>
    <body>
        <header id="mainHeader">
            <div id="dvInfoApp">
                <div id="imgLogoApp"></div>
                <div id="dvTleNombreApp"><?php echo $tituloApp?></div>
            </div>
            <div id="dvInfoUsuario">
                <div id="dvUsuario">
                    <div id="dvNombreUsuario"><?php echo $nombreUsuario?></div>
                    <div id="dvNroDocUsuario"><?php echo $docUsuario?></div>
                </div>
                <div id="imgUsuario"></div>
            </div>            
        </header>
        
        <!-- Menu -->
        <nav>   
            <div class="dvMenuItem">Visor Documental</div>
        </nav>
        
        <!-- Contenedor Principal -->
        <main id="dvMain">                
        </main>        
        
        <footer>            
        </footer>    
    </body>
</html>