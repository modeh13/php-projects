<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Controller/ContratoController.php';
$numContrato = filter_input(INPUT_POST, '_ncon');

if(isset($numContrato))
{
    $ctoController = new ContratoController();
    $result = $ctoController->fu_Obtener_Datos_Contrato($numContrato);
    $objContrato = reset($result);
    $html = '';    
    $html .= '<div class=\"clsContrato\" data-num_contrato=\"' . $numContrato .'\">';
    $html .= '<div class=\"clsRowContrato\"><div class=\"spnLblContrato\">Numero de Contrato:</div><div class=\"spnDatoContrato\">' . $objContrato['numContrato']  . '</div></div>';
    $html .= '<div class=\"clsRowContrato\"><div class=\"spnLblContrato\">Cantidad de Imagenes:</div><div class=\"spnDatoContrato\">' . $objContrato['cantImgs']  . '</div></div>';
    $html .= '</div>';
    
    $html .= '<div id=\"dvTleTiposDoc\">Tipos Documentales</div>';
      
    $html .= '<div class=\"clsTipoDoc\" data-tipo_doc=\"1\">';
    $html .= '<div class=\"clsNombTipoDoc\">Orden de Servicio</div>';
    $html .= '<div class=\"clsCantImgs\">4</div>';
    $html .= '</div>';
    
    $html .= '<div class=\"clsTipoDoc\" data-tipo_doc=\"2\">';
    $html .= '<div class=\"clsNombTipoDoc\">Factura</div>';
    $html .= '<div class=\"clsCantImgs\">6</div>';
    $html .= '</div>';
    
    $html .= '<div class=\"clsTipoDoc\" data-tipo_doc=\"3\">';
    $html .= '<div class=\"clsNombTipoDoc\">Documento de Identidad</div>';
    $html .= '<div class=\"clsCantImgs\">2</div>';
    $html .= '</div>';
    
    $html .= '<div class=\"clsTipoDoc\" data-tipo_doc=\"4\">';
    $html .= '<div class=\"clsNombTipoDoc\">Registro civil de defunción</div>';
    $html .= '<div class=\"clsCantImgs\">1</div>';
    $html .= '</div>';
    
    echo '{"estado":"@OK", "mensaje":"Proceso OK.", "html": "' . $html . '"}';
}
else{
    echo '{"estado":"@ERROR", "mensaje":"No se obtuvieron los parametros."}';
}