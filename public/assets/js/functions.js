jQuery(function($){
	$.datepicker.regional['es'] = {
		  closeText: 'Cerrar',
		  prevText: '&#x3c;Ant',
		  nextText: 'Sig&#x3e;',
		  currentText: 'Hoy',
		  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		  'Jul','Ago','Sep','Oct','Nov','Dic'],
		  dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		  dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		  weekHeader: 'Sm',
		  dateFormat: 'yy-mm-dd',
		  firstDay: 0,
		  isRTL: false,
		  showMonthAfterYear: false,
		  yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
}); 

$(function(){ calendario(); });	

function calendario(){
	
	var years, fecha, range;	
	 
	fecha = new Date();
	years = 1903 + fecha.getYear();   
	range = 2000 + ':' + years;	
	
	  $( '.fecha' ).datepicker({
		  changeMonth: true, 
		  changeYear: true
	  });	  
	
   $( '.fecha' ).datepicker( "option", "yearRange", range);	
  
}



/* carga la ruta enviada; si "form" está definida envia mediante
 * Post el contenido del formulario: form */
function carga_modal(ruta)
{    
     axios({
         method: 'GET',
         url: ruta,
         responseType: 'json'
     }).then(response => {
          $('#modal_form .modal-title').html(response.data.title);
		  $('#contenido_modal').html(response.data.view); 		  
		  $('#modal_form').modal('show'); 
          calendario();		     
     });  
}


$('body').on('submit','#formulario',function(e)
{
    e.preventDefault();
    let formulario = $(this); 
    $('#submit').attr('disabled', 'disabled');

    axios({
        method: 'POST',
        url: formulario.attr('action'),
        responseType: 'json',
        data: new FormData(formulario[0]),
    }).then(response => {

        let data = response.data;
        $('.error').html('');
        for(key in data){ $('#error_'+ key).html(data[key]); } 

        if(data.success)
        {  
           for(key in data){ $('#error_'+ key).html(''); } 
		   $('#contenido_modal').html('<div class="alert alert-success" align="center" style="margin: 30px 40px">'+ data.success + '</div>'); 
		   setTimeout(function() 
		   {
			  $('#modal_form').modal('hide'); 				  			   
			  dtable_serverSide.ajax.reload(null, false);
			}, 1000);			                             
        }        
        
        $('#submit').attr('disabled', false);
   });     
     
})





/*
function deshabilita_form(deshabilita = true)
{
    if(deshabilita)
    {
        $('#' + formulario).find(':input:not(:enabled)').each(function(){
            $(this).addClass( "deshabilitado");
        })
              
        $('#' + formulario).find(':input:not(:disabled)').attr('disabled', 'disabled');

        return;
    }

    $('#' + formulario).find("*").removeAttr('disabled'); // habilita el formulario
    $('#' + formulario + ' .deshabilitado').attr('disabled', 'disabled').removeClass('deshabilitado');       
} */