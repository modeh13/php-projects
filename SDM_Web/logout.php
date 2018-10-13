<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include realpath(dirname(__FILE__) . '/Function/Funciones.php');
    // put your code here
    session_start();
    session_unset();
    session_destroy();    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cerrando Sesion - <?php echo $tituloApp ?></title>
        
        <!-- Estilos -->
        <link href="css/font_face.css" rel="stylesheet" />  
        <link href="css/login.css" rel="stylesheet" />        
        <link href="css/global.css" rel="stylesheet" />
        
        <script type="text/javascript">
            setTimeout(function(){
                window.location = window.location.origin + '/login.php';                
            }, 3000);
        </script>        
    </head>
    <body>
        <div id="dvLblLogout">
            <div id="dvLblMensajeLogout">Su session a caducado, Redireccionando ...  </div>              
            <div id="dvImgLogount"></div>
        </div>        
    </body>
</html>