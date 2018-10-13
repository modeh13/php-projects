/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function fu_Validar_Numeros(evt) 
{
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
          theEvent.returnValue = false;
          if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

$(document).on("click", ".dvMenuItem", function(){
    _visor = undefined;
    
    var dvMain = document.getElementById("dvMain");    
    dvMain.innerHTML = "";
    
    var dvContainer = document.createElement('div');
    dvContainer.setAttribute('id', 'ctn_Consulta');    
    
    var dvTleContainer = document.createElement('div');
    dvTleContainer.setAttribute('class', 'ctn_Title');
    dvTleContainer.innerHTML = "Consulta";
    
    var dvContBody = document.createElement('div');
    dvContBody.setAttribute('class', 'ctn_body');   
    
    // Crear HTML 
    var inpContrato = document.createElement('input');
    inpContrato.setAttribute('id', 'inpBuscador');
    inpContrato.type = 'text';
    inpContrato.value = '';    
    inpContrato.onkeypress = function(evt){
            return fu_Validar_Numeros(evt);
    };
    
    var dvBtnConsultar = document.createElement('div');
    dvBtnConsultar.setAttribute('id', 'btnConsultar');
    dvBtnConsultar.setAttribute('class', 'clsButton');
    dvBtnConsultar.innerHTML = "Consultar";    
    dvBtnConsultar.onclick = function(){
        var numContrato = inpContrato.value.trim();
        fu_Consultar_Contrato(numContrato);
    };
    
    var dvResultados = document.createElement('div');
    dvResultados.setAttribute('id', 'dvResultados');
    
    var dvBuscador = document.createElement('div');
    dvBuscador.setAttribute('id', 'dvBuscador');
    dvBuscador.appendChild(inpContrato);
    dvBuscador.appendChild(dvBtnConsultar);   
    
    dvContBody.appendChild(dvBuscador);
    dvContBody.appendChild(dvResultados);
    dvContainer.appendChild(dvTleContainer);
    dvContainer.appendChild(dvContBody);   
    dvContainer.style.display = "none";
    dvMain.appendChild(dvContainer);   
    $(dvContainer).fadeIn('slow');
});

function fu_Consultar_Contrato(numContrato)
{
    $('#dvResultados').empty();
    $('#dvResultados').hide();
    $('#dvVisor').remove();
    _visor = undefined;
    
    $.when(
        $.ajax({
            data:  "_ncon=" + numContrato,
            url:   'View/ConsultaContrato.php',
            type:  'post',
            beforeSend: function () {
                //fu_Set_Mensaje_Login('Validando usuario...');
                console.log('Consultando Contrato...');
            }
        }).done(function(result){            
            if(result !== null)
            {
                if(isJson(result))
                {                
                    var jSalida = $.parseJSON(result);

                    if(jSalida.estado === '@OK'){        
                        var html = $.parseHTML(jSalida.html);
                        //document.getElementById('dvResultados').innerHTML = jSalida.html;
                        $('#dvResultados').append(html);
                        $('#dvResultados').fadeIn('slow');
                        //fu_Set_Mensaje_Login(jSalida.mensaje);
                        
                    }else{
                        //fu_Set_Mensaje_Login(jSalida.mensaje);
                    }                
                }
                else{
                    //fu_Set_Mensaje_Login('Solicitud fallida, datos incompletos.');                
                }            
            }
            else{
               //fu_Set_Mensaje_Login('Solicitud fallida, no se obtuvieron datos.'); 
            }     

        }).fail(function(jqXHR, textStatus, errorThrown){            
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            //fu_Set_Mensaje_Login('Solicitud fallida ' + textStatus + '. ' + errorThrown);
        })).then(function(){
                        
        });         
}
function padLeft(nr, n, str){
    return Array(n-String(nr).length+1).join(str||'0')+nr;
}
var _visor;

$(document).on('click', '.clsTipoDoc', function(){
    var numContrato = $(this).data("num_contrato");
    
    //var jImgs = [{'id': 1, 'pathImg': 'https://www.planwallpaper.com/static/images/ZhGEqAP.jpg', 'urlImg': 'https://www.planwallpaper.com/static/images/ZhGEqAP.jpg'}];
    //var rootPath = window.location.origin + "//" + "SDM_Web//Function//ObtenerImagen.php?_pathImg=";
	var rootPath = window.location.origin + "//" + "Function//ObtenerImagen.php?_pathImg=";
    var jImgs2 = [{'id': 1, 
                  'pathImg': rootPath + 'C:\\Users\\Familia\\Dropbox\\SyC\\Visor\\decargar_contratos\\decargar_contratos-01.png', 
                  'urlImg': rootPath + 'C:\\Users\\Familia\\Dropbox\\SyC\\Visor\\decargar_contratos\\decargar_contratos-01.png'}];

    var maxImgs = 20;
    var jImgs = [];
    //var rootCatalogo = window.location.origin + "//SDM_Web//Catalogo//";
    //var rootCatalogo = "http://sdm.harysof.com//Catalogo//";
	var rootCatalogo = "../Catalogo//";
    
    for(var i=1;i<=maxImgs;i++)
    {
        jImgs.push({
           'id': i,
           'pathImg': rootPath + rootCatalogo + "decargar_contratos-" + padLeft(i, 2) + ".png",
           'urlImg': rootPath + rootCatalogo + "decargar_contratos-" + padLeft(i, 2) + ".png"          
        });        
    }

    if(!_visor)
    {
        _visor = new viewerSDM({
            id: 'id_prueba',
            colorBg : 'rgba(150, 150, 150, 0.8)',
            thumbnails: false            
        });            
        
        _visor.CargarImagenes(jImgs, 0);        
        
        var dvVisor = document.createElement('div');
        dvVisor.setAttribute('id', 'dvVisor');
        dvVisor.style.display = "none";
        dvVisor.appendChild(_visor.mainPanel);
        document.getElementById('dvMain').appendChild(dvVisor);
        $(dvVisor).fadeIn('slow');
    }
    else{
        _visor.CargarImagenes(jImgs, 0);
    }          
});