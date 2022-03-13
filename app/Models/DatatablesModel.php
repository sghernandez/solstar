<?php

namespace App\Models;
use CodeIgniter\Model;

class DatatablesModel extends Model
{
    
    /*
      -------------------------------------------------------------------
      Nombre: datatables_builder
      -------------------------------------------------------------------
      Descripción:
      genera las busqueda like de los listados datables y pagina los resultados
      que se muestran de la vista; también retorna el conteo de todos los
      registros sin painación   
      -------------------------------------------------------------------
      Entradas: arreglo
      $set_datatables = [
         'sort_columns' => ['field_1', 'field_2'...] -- arreglo con los campos de ordenación de la(s) tabla(s)
         'order_by' => booleano -- verdadero/falso para determinar si se requiere odenar y paginar
         'sort_default' => 'field_1|DESC' -- ordenación por defecto; puede traer solo "field_1" y ordenará por "ASC"
         'search_like' => entero -- es el id del input del formulario que se usa para hacer busqudas por like
	     'group_by' => TRUE -- booleano para agrupar las columnas - es opcional
      ]
	  $paginar: booleano - si es false no pagina sino devulve todos los resultados de la consulta
      -------------------------------------------------------------------
      Salida: arreglo o valor entero
      -------------------------------------------------------------------
    */      
    public function datatables_builder($set_datatables, $paginar = TRUE)
    {        
        extract($set_datatables); 
        $this->request = \Config\Services::request();  
        
        $post = $this->request->getPost();
        $search = isset($post['columns'][$search_like]['search']['value']) ? $post['columns'][$search_like]['search']['value'] : '';
        
		if(! empty($group_by))
		{
		  $select[] = $group_by;
		  foreach ($sort_columns as $field) {
			$item = explode('.', $field);
			$campo = count($item) == 2 ? $item[1] : $field;
			$select[] = "ANY_VALUE($field) AS $campo";
		  }
		  
		  $this->select(implode(',', $select), FALSE)->groupBy($group_by);
		}
		else { $builder->select($sort_columns); }

        if($search) {            
            foreach ($sort_columns as $key => $field) {
                $key == 0 ? $builder->like($field, $search) : $builder->orLike($field, $search);
            }                                  
        }        
        
        if($order_by)
        {
            $orderCol = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : '';
            $col = isset($sort_columns[$orderCol]) ? $sort_columns[$orderCol] : '';

			if($paginar && isset($post['length'])){ $builder->limit(intval($post['length']), intval($post['start'])); }

            if ($col) 
            {
                $dir = strtoupper($post['order'][0]['dir']);
                $order = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';

                $builder->orderBy($col, $order);
            }
            else 
            {
                $sort_default = is_array($sort_default) ? $sort_default : [$sort_default];
				
                foreach ($sort_default as $sort)
				{
                   $default = explode('|', $sort);
                   $builder->orderBy($default[0], isset($default[1]) ? $default[1] : 'ASC');
				}				
            }    
        }
		
        return $order_by ? $builder->get()->getResult() : count($builder->get()->getResult());                   
 
    }    
   
   
/*
    Nombre: affectedRows
    -------------------------------------------------------------------
    Descripción: Devulelve la cantidad de registros afectados en una consulta
    -------------------------------------------------------------------
    Entradas: vacio
    -------------------------------------------------------------------
    Salida: entero  
 */  
  public function affectedRows()
  {
     return $this->db->query('SELECT ROW_COUNT() AS affectedRows')->getRow()->affectedRows;     
  }      
    

} // Finaliza la clase
