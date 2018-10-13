/*	_version: 1.0.0 */
/*
	Fecha: 2016-11-08
	Autor: Germán Alexander Ramírez Vela
*/
'use strict';
function viewerSDM(opts)
{
    //Object IMG List
    //{'id': 0, 'pathImg' : 'Full Path Img Url Encode', 'urlImg': 'FullPathImg'}

    // Default variables
    var defaultBg = "rgba(0, 0, 0, 0.8)",
        idViewer = "vwSDM_1_0",
        visorSDM = this,
        currentIdx = -1,
        cantImgs = 0,
        curImgWidth = 0,
        curImgHeight = 0,
        listImgs = [];		

    var dvThumbails,
            defaultPosThumb = 'left';

    var dvSideBar,
            defaultPosSideBar = 'bottom';

    var settings = $.extend({
        thumbnails: false,
        zoomInicial: 30,
        btnZoom:true,
        btnRotar: true,
        btnDescargarImg: true,
        btnDescargarGrupoImg: false,
        btnImprimir: true,			
        conCaraB: false,
        posThumb: defaultPosThumb,
        posSideBar: defaultPosSideBar
    }, opts);

    //listImgs = settings.listImgs;

     /** Create viewer's elements  **/
    this.mainPanel = document.createElement('div');
    this.mainPanel.setAttribute('class', 'vwPanel');
    this.mainPanel.setAttribute('id', idViewer);
    $(this.mainPanel).css('background-color', defaultBg);

    if(settings.id){
        this.mainPanel.setAttribute('id', settings.id);		
    }

    if(settings.colorBg){
        $(this.mainPanel).css('background-color', settings.colorBg);
    }

    /** Check if thumbnail **/
    if(settings.thumbnails)
    {
        var widthThumb = 0;
        var widthContThumb = 0;
        var dvContThumb, dvBarThumb;

        dvThumbails = document.createElement('div');
        dvThumbails.setAttribute('id', 'vwThumb');

        if(settings.posThumb === 'right'){
            dvThumbails.style.right = '0px';
        }

        dvContThumb = document.createElement('div');		
        dvContThumb.setAttribute('id', 'vwContThumb');

        if(settings.posThumb === 'left'){
            dvContThumb.setAttribute('class', 'vwContThumbLeft');			
        }
        else{
            dvContThumb.setAttribute('class', 'vwContThumbRight');
        }		

        dvBarThumb = document.createElement('div');		
        dvBarThumb.setAttribute('id', 'vwBarThumb');
        dvBarThumb.setAttribute('class', 'vwThumbActive');

        widthThumb = dvThumbails.clientWidth;
        widthContThumb = dvContThumb.clientWidth;

        dvBarThumb.onclick = function(){
            $(dvContThumb).toggle('blind', {
                           direction: 'left',
                           duration: 150
                   }, function () {
                           if ($(dvContThumb).is(':hidden')) {
                                   $(dvBarThumb).removeClass('vwThumbActive');
                                   $(dvBarThumb).addClass('vwThumbInactive')
                           }
                           else{
                                   $(dvBarThumb).removeClass('vwThumbInactive');
                                   $(dvBarThumb).addClass('vwThumbActive');
                           }
                   });					
        };		

        dvThumbails.appendChild(dvContThumb);
        dvThumbails.appendChild(dvBarThumb);

        this.mainPanel.appendChild(dvThumbails);
    }   

    /** Check SideBar **/
    dvSideBar = document.createElement('div');
    dvSideBar.setAttribute('id', 'vwSideBar');	

    // Zoom
    if(settings.btnZoom)
    {
        var btnZoomIn, btnZoomOut;
        btnZoomIn = document.createElement('div');
        btnZoomIn.setAttribute('id', 'vwZoomIn');
        btnZoomIn.setAttribute('title', 'Aumentar');
        btnZoomIn.onclick = function(){

        };

        btnZoomOut = document.createElement('div');
        btnZoomOut.setAttribute('id', 'vwZoomOut');
        btnZoomOut.setAttribute('title', 'Disminuir');
        btnZoomOut.onclick = function(){

        };

        var dvZoom = document.createElement('div');
        dvZoom.setAttribute('id', 'vwContZoom');
        dvZoom.appendChild(btnZoomOut);
        dvZoom.appendChild(btnZoomIn);	

        dvSideBar.appendChild(dvZoom);
    }

    // Input number Page
    var dvContPag, dvArrowL, dvArrowR, inpNumPage, lblSeparador, lblCantImgs;
    dvContPag = document.createElement('div');
    dvContPag.setAttribute('id', 'vwContPag');

    dvArrowL = document.createElement('div');
    dvArrowL.setAttribute('id', 'vwArrowL');
    dvArrowL.onclick = function(){
        visorSDM.AnteriorImagen();
    };

    dvArrowR = document.createElement('div');
    dvArrowR.setAttribute('id', 'vwArrowR');
    dvArrowR.onclick = function(){
        visorSDM.SiguienteImagen();
    };

    inpNumPage = document.createElement("input");
    inpNumPage.type = "text";
    inpNumPage.setAttribute('id', 'vwInpNumPage');
    inpNumPage.setAttribute('maxlength', 3);
    inpNumPage.onkeypress = function(evt){
            return fu_Validar_Numeros(evt);
    };
    inpNumPage.onkeydown = function(evt){
        // Enter
        if(evt.keyCode === 13)
        {
            if($.isNumeric(this.value))
            {
                var idx = parseInt(this.value);
                if(idx < 1){ idx = 0;}
                else if(idx > cantImgs){ idx = cantImgs - 1;}
                else{ idx = idx - 1;}
                
                CargarImagen(idx);
            }
        }
    };

    lblSeparador = document.createElement('label');
    lblSeparador.setAttribute('id', 'vwLblSepNumPage');
    lblSeparador.innerHTML = '/';

    lblCantImgs = document.createElement('label');
    lblCantImgs.setAttribute('id', 'vwLblCantImgs');

    dvContPag.appendChild(dvArrowL);
    dvContPag.appendChild(inpNumPage);
    dvContPag.appendChild(lblSeparador);
    dvContPag.appendChild(lblCantImgs);
    dvContPag.appendChild(dvArrowR);	

    dvSideBar.appendChild(dvContPag);

    // Add SIDEBAR
    this.mainPanel.appendChild(dvSideBar);	

    // -------------------------------------------------------------------------
    /** IMAGE **/
    var currentImg = new Image();
    var dvImagen = document.createElement('div');
    dvImagen.setAttribute('id', 'vwContImage');
    dvImagen.onmousewheel = function(evt){
        console.log(evt);
        if (evt.deltaY < 0) {
            visorSDM.zoomIn();
            //parent.zoom('in');
        } else {
            visorSDM.zoomOut();
            //parent.zoom('out');
        }

        evt.preventDefault();        
    };

//    var imgTemp = new Image();
//    var img_base64 = {};
//    var dfd = new jQuery.Deferred();
//    imgTemp.src = "C:\Users\GermánA\Dropbox\SyC\Visor\decargar_contratos\decargar_contratos-01.png";
//    getBase64Image(imgTemp, "png", img_base64, dfd);


    var svgViewer = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    var svgImage = document.createElementNS('http://www.w3.org/2000/svg', 'image');

    svgViewer.setAttribute('width', '100%');
    svgViewer.setAttribute('height', '100%');	
    svgViewer.appendChild(svgImage);

    this.CargarImagenes = function(jImgs, index){
        if(jImgs !== null && jImgs !== undefined)
        {
            if(jImgs.length > 0 && index <= jImgs.length)
            {                
                listImgs = jImgs;
                cantImgs = jImgs.length;
                dvImagen.appendChild(svgViewer);
                CargarImagen(index);
                lblCantImgs.innerHTML = cantImgs;

                this.mainPanel.appendChild(dvImagen);          
            }          
        }       
    };  
    
    function CargarImagen(idx)
    {
        currentImg.id = 'vmImg_' + listImgs[idx].id;
        currentImg.src = listImgs[idx].pathImg;
        currentIdx = idx;        
        inpNumPage.value = idx + 1;
    }

    currentImg.onload = function()
    {
        svgImage.setAttributeNS('http://www.w3.org/1999/xlink', 'href', this.src);
        svgImage.setAttribute('width', this.width);
        svgImage.setAttribute('height', this.height);        

        svgViewer.setAttribute('viewBox', '0 0 ' + this.width + ' ' + this.height);
        
        curImgHeight = this.height;
        curImgWidth = this.width;
    };
    
    this.SiguienteImagen = function(){
        if(currentIdx !== -1)
        {
            if(currentIdx < cantImgs)
            {
                CargarImagen(currentIdx + 1);
            }                        
        }
    };
    
    this.AnteriorImagen = function(){
        if(currentIdx !== -1)
        {
            if(currentIdx > 0)
            {
                CargarImagen(currentIdx - 1); 
            }                        
        }       
    };
    
    this.zoomIn = function(){        
        console.log('in');
        var factorIn = 0.10;
        var wImg = svgImage.width.baseVal.value;
        var hImg = svgImage.height.baseVal.value;
        var curPorc = (wImg * 100) / curImgWidth;
        
        console.log(curPorc);
        if(hImg > wImg){
            
        }        
    };
    
    this.zoomOut = function(){        
        console.log('out');
    };    
   
    // -------------------------------------------------------------------------
    // Add Final
    if (settings.container !== null || settings.container !== undefined) {
        $(settings.container).append(this.mainPanel);
    }	

    // -------------------------------------------------------------------------
    //alert("Cargado");
    //
}

// -------------------------------------------------------------------------
/** -------- Funciones -------- **/	
/**
 * @public
 * @summary 
 * @param {string} evt `evt`
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

 function getBase64Image(img, tipo, obj_base64, deferred) 
 {
    // Create an empty canvas element
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;	
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);	
    var dataURL = canvas.toDataURL("image/"+tipo);

    obj_base64.dataURL = dataURL;
    if (deferred !== undefined)
    {
            deferred.resolve();
    }
}