<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php    
    include realpath(dirname(__FILE__) . '/Function/Funciones.php');
    $tituloApp = fu_Obtener_Ini_Valor('NombreApp');
    $lblUsuario = fu_Obtener_Ini_Valor('lblUsuario');
    $lblClave = fu_Obtener_Ini_Valor('lblClave');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $tituloApp ?></title>   
        
        <!-- Estilos -->
        <link href="css/font_face.css" rel="stylesheet" />
        <link href="css/login.css" rel="stylesheet" />
        <link href="css/global.css" rel="stylesheet" />
        
        <!-- Js -->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="js/underscore.js"></script>
        
        <!-- Js App -->
        <script type="text/javascript" src="js/login.js"></script>
    </head>  
    <body>        
        <div id="dvImgLogin"></div>
        <div id="dvContLogin">
            <div id="dvContCtrlLogin">
                <div id="dvContInpLogin">
                    <div class="dvFilaInpLogin">
                        <div class="dvLblLogin"/><?php echo $lblUsuario ?></div>
                        <div class="dvInpLogin">
                            <input id="inpUsuario" class="inpLogin" type="text" value="" tabIndex="1" />
                        </div>
                    </div>
                    <div class="dvFilaInpLogin">
                        <div class="dvLblLogin"><?php echo $lblClave ?></div>    
                        <div class="dvInpLogin">
                            <input id="inpPassword" class="inpLogin" type="password" value="" tabIndex="2" />
                        </div>                    
                    </div> 
                </div>
                <div id="dvContBtnLogin">
                    <div id="dvBtnIngresar" title="Ingresar" tabindex="3"> 
                    </div>                
                </div>   
            </div>
            <div id="dvLblMensaje">                
            </div>
        </div>        
    </body>
</html>