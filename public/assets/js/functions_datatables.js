REinit();

function REinit() 
{
  $(document).ready(function() 
  {
	  
   if ( ! $.fn.DataTable.isDataTable( '#dataTable' ) ) // De este modo lo inicializa solo cuando es necesario
   {
 	    dtable_serverSide = $('#dataTable').DataTable({ 
	
	        "processing": true, 
	        "serverSide": true, // Procesa los datos del lado del servidor
	        "order": [], // Orden inicial. Ej => "order": [[2, 'asc']],
	
	        // Carga el contenido de la tabla mediante Ajax
	        "ajax": {
	            "url": $('[name="datatables_ruta"]').val(),
	            "type": "POST"
	        },
	        	
	        // Definir las propiedades de inicialización de las columnas
	        "columnDefs": [
		        { 
		            "targets": [$('[name="datatables_targets"]').val()], 
		            "orderable": false, // no ordenable	
		        },
	        ],
	        "displayLength": 10, // Cantidad de filas que muestra inicialmente
            "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
            "searchDelay": 300,        
            "dom": '<"H"lfr>t<"F"ip>',
			 "lengthChange": false,
		    language: {
		        processing:     "Procesando...",
		        search:         "Buscar:",
		        lengthMenu:    " _MENU_ ",
		        info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
		        infoEmpty:      "Mostrando 0 a 0 de 0 registros",
		        infoFiltered:   "(filtrados de _MAX_ en total)",
		        infoPostFix:    "",
		        loadingRecords: "Cargando...",
		        zeroRecords:    "No se hallaron registros",
		        emptyTable:     "No se hallaron registros",
		        paginate: {
		            first:      "Primera Pág",
		            previous:   "<i class='fa fa-backward'></i> Atrás",
		            next:       "Siguiente <i class='fa fa-forward'></i>",
		            last:       "Última pág."
		        }
		    }       
          	
	    });
    }

   });	// Finaliza document.ready
}	


   /*
      search: busca con datatables del lado del servidor
    */
   function search()
   {  
      $('#form_search .search').each(function(){
           var col = $(this).attr('id');
           dtable_serverSide.columns(col).search($('#form_search #' + col).val());
      });  
      
      dtable_serverSide.draw()  
   }
       
/* carga la ruta enviada; si "form" está definida envia mediante
 * Post el contenido del formulario: form */
function ruta(ruta, form)
{        
   var data_post;
   $('#content').html('<div align="center"><img src="'+ baseurl + 'assets/img/tenor.gif" alt="loading" style="margin-top: 100px"/></div>');
   if(valor_variable(form)){ data_post = $('#' + form).serialize(); }  
   
	$.ajax({
      cache: false,
      url: php_baseurl + ruta, 
      type: 'POST', 
	  data: data_post,
      success: function (response) {             
          $('#content').html(response);                              
      }        
   });    
}

/* valor_variable - si la variable no está definida le asinga un valor nulo */
function valor_variable(variable){
  return typeof variable === 'undefined' ? null : variable;
}