<?= $datatables ?>
<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b style="font-size: 16px">Listado de Cantantes</b>             
        <span class="pull-right"> 
            <button type="button" class="btn btn-xs" onclick='ruta("usercrud")'><i class="fad fa-plus" aria-hidden="true"></i>                    
                <i class="glyphicon glyphicon-refresh"></i>
            </button>
            &nbsp;
            <button type="button" class="btn btn-xs" onclick='carga_modal("form")'><i class="fad fa-plus" aria-hidden="true"></i>                    
                <i class="glyphicon glyphicon-plus-sign"></i> <b>Nuevo</b> 
            </button>            
        </span>                  
    </div>   
        
    <div class="panel-body">
        <div class="dataTable_wrapper hide_filter">
            <div id="form_search" class="col-xs-12" style="margin-bottom: 15px">                                                  
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>               
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <input type="text" name="search" id="0" placeholder="Buscar..." class="search form-control">                      
                </div>	                         

                <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                    <button type="button" onclick="search()" class="btn btn-inverse btn-block"><i class="glyphicon glyphicon-search"></i></button>
                </div>                                        
            </div>         
            <table id="dataTable" class="table table-bordered table-striped" style="margin-top: 40px"> 	
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Fecha Nac.</th>
                        <th class="text-center">Género</th>	
                        <th class="text-center">Biografía</th>
                        <th class="text-center">Editar</th>  		
                        <th class="text-center">Borrar</th>  
                    </tr>
                </thead>
                <tbody> 	
                </tbody>
            </table>
        </div>
    </div>
</div>    