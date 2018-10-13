<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pathImg = filter_input(INPUT_GET, "_pathImg");

//if(file_exists($pathImg) || UR_exists($pathImg))
if(file_exists($pathImg))
{
    try{
        $extImg = pathinfo($pathImg, PATHINFO_EXTENSION);
    
        switch (strtolower($extImg))
        {
            case "png":
                header('Content-Type: image/png');				
				//flush();
                readfile($pathImg);
				//echo file_get_contents($pathImg); 
                //$im = imagecreatefrompng($pathImg);            
                //imagepng($im);
                //imagedestroy($im);
				exit;
                break;

            case ("jpg" || "jpeg"):
                header('Content-Type: image/jpeg');
				readfile($pathImg);
                //$im = imagecreatefromjpeg($pathImg);            
                //imagejpeg($im);            
                //imagedestroy($im);
                break;

            case ("tif" || "tiff"):
                header("Content-Type: image/png");
				$im = new Imagicktiff($pathImg);
                $im->setImageFormat("png");            
                imagedestroy($im);
                break;

            case "gif":
                header('Content-Type: image/gif');
				readfile($pathImg);
                //$im = imagecreatefromgif($pathImg);            
                //imagegif($im);            
                //imagedestroy($im);            
                break;
        }		
		
    }catch(Exception $ex)
    {
        header("Content-Type: image/png");
        $im = imagecreate(400, 30);       
        $fondo = imagecolorallocate($im, 255, 255, 255);
        $color_texto = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, 0, 0,  "Archivo: " .$pathImg ." Ex: " .$ex->getMessage(), $color_texto);
        imagepng($im);
        imagedestroy($im);         
    }   
}
else{
    //Crear Imagen por Defecto de Salida
    header("Content-Type: image/png");
    $im = imagecreate(400, 30);       
    $fondo = imagecolorallocate($im, 255, 255, 255);
    $color_texto = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 5, 0, 0,  "Archivo no existe: " .$pathImg, $color_texto);
    imagepng($im);
    imagedestroy($im);
}

function UR_exists($url){
   $headers=get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}