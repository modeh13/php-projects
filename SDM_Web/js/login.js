/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function isJson(jsonString)
{
    if (/^[\],:{}\s]*$/.test(jsonString.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
        return true;
        //the json is ok
    } else {
        return false;
        //the json is not ok
    }
}
function fu_Set_Mensaje_Login(mensaje, color){    
    document.getElementById('dvLblMensaje').innerHTML = mensaje;
    document.getElementById('dvLblMensaje').style.color = color;
}

function fu_Validar_Usuario(usuario, pass)
{
    var _usuario = usuario.trim();
    var _pass = pass.trim();
    
    $.ajax({
        data:  "_usr=" + _usuario + "&_ps=" + _pass,
        url:   'Function/IniciarSesion.php',
        type:  'post',
        beforeSend: function () {
            fu_Set_Mensaje_Login('Validando usuario...', "#ff0000");
        }
    }).done(function(result){            
        if(result !== null)
        {
            if(isJson(result))
            {                
                var jSalida = $.parseJSON(result);
                
                if(jSalida.estado === '@OK'){                    
                    fu_Set_Mensaje_Login(jSalida.mensaje, "#008000");                    
					window.location = window.location.origin + '/index.php';
                }else{
                    fu_Set_Mensaje_Login(jSalida.mensaje, "#ff0000");
                }                
            }
            else{
                fu_Set_Mensaje_Login('Solicitud fallida, datos incompletos.', "#ff0000");                
            }            
        }
        else{
           fu_Set_Mensaje_Login('Solicitud fallida, no se obtuvieron datos.', "#ff0000"); 
        }     

    }).fail(function(jqXHR, textStatus, errorThrown){            
        fu_Set_Mensaje_Login('Solicitud fallida ' + textStatus + '. ' + errorThrown, "#ff0000");
    });    
}

$(document).on("click", "#dvBtnIngresar", function(){
   var _usuario = document.getElementById("inpUsuario").value.trim();
   var _pass = document.getElementById("inpPassword").value.trim();  
   fu_Set_Mensaje_Login('');   
   
   if(_usuario !== '' && _pass !== '')
   {
       fu_Validar_Usuario(_usuario, _pass);
   }
   else{
       if(_usuario === '' && _pass !== ''){ fu_Set_Mensaje_Login('Debe ingresar un usuario...', "#ff0000");}
       if(_usuario !== '' && _pass === ''){ fu_Set_Mensaje_Login('Debe ingresar una contrasena...', "#ff0000");}
       if(_usuario === '' && _pass === ''){ fu_Set_Mensaje_Login('Datos incompletos...', "#ff0000");}
   }      
});

$(document).on("click", "#imgUsuario", function(){
    var dvBtnCerrar, dvOpciones, dvContOpciones;
   
    if($('#dvOpcLogin').length > 0){ $('#dvOpcLogin').remove();};
    
    dvOpciones = document.createElement('div');
    dvOpciones.setAttribute('id', 'dvOpcLogin');
    dvOpciones.style.display = 'none';
    dvOpciones.onmouseleave=function(){
        $('#dvOpcLogin').slideUp('fast', 'linear', function(){            
            $(this).remove();
        });        
    };
    
    dvContOpciones = document.createElement('div');
    dvContOpciones.setAttribute('id', 'dvContOpciones');
    
    dvBtnCerrar = document.createElement('div');
    dvBtnCerrar.setAttribute('id', 'dvBtnCerrar');
    dvBtnCerrar.setAttribute('class', 'clsButton');
    dvBtnCerrar.style.width = '100%';
    dvBtnCerrar.innerHTML = 'Cerrar Sesion';
    dvBtnCerrar.onclick = function(){
        fu_Cerrar_Sesion();        
    };
    
    dvContOpciones.appendChild(dvBtnCerrar);
    dvOpciones.appendChild(dvContOpciones);

    document.getElementById('mainHeader').appendChild(dvOpciones);

    $('#dvOpcLogin').slideDown('slow', 'linear');   
});

function fu_Cerrar_Sesion(){
    $.ajax({
        data:  "",
        url:   'Function/CerrarSesion.php',
        type:  'post',
        beforeSend: function () {
            
        }
    }).done(function(result){            
        if(result !== null)
        {
            if(isJson(result))
            {                
                var jSalida = $.parseJSON(result);
                
                if(jSalida.estado === '@OK'){
                    window.location = window.location.origin + '/login.php';
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
        //fu_Set_Mensaje_Login('Solicitud fallida ' + textStatus + '. ' + errorThrown);
    });   
}