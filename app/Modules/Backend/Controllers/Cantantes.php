<?php namespace App\Modules\Backend\Controllers;

// use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Modules\Backend\Models\CantanteModel;
use App\Models\DatatablesModel;

class Cantantes extends BaseController
{
    use ResponseTrait;

    protected $id;
    protected $data;
    protected $model; 

    public function __construct() 
    {       
        $this->data = [];       
        helper('form');
        $this->id = isset($_POST['id']) ? $_POST['id'] : 0;
        $this->model = new CantanteModel($this->id);     
        $this->frontend = 'App\Modules\Frontend\Views';                              
    }  
    
    
	public function index() 
    {    
        $data = [
            'view' => $this->frontend. '\cantantes\cantantes',
            'datatables' => (form_hidden('datatables_ruta', base_url('ajax_list')). form_hidden('datatables_targets', '-1, -2'))         
        ];

        if ($this->request->isAJAX()) {
            return view($data['view'], $data);
        }      
     
        return view($this->frontend. '\layout', $data);	        

	}


    public function form()
    {          
        $id = $this->request->getGet('id');
        echo view($this->frontend. '\cantantes\form_cantante', ['cantante' => ($id ? $this->model->find($id) : [])]);	
    }    

    
    public function save()
    {          
        $post = json_decode(file_get_contents('php://input'), true) ? : $this->request->getPost();
        $response['success'] = 'Datos correctamente guardados';
        

        $data = [
          'nombre' => isset($post['nombre']) ? $post['nombre'] : '',
          'fecha_nac' => isset($post['fecha_nac']) ? $post['fecha_nac'] : '',
          'genero' => isset($post['genero']) ? $post['genero'] : '',
          'foto' => isset($post['foto']) ? $post['foto'] : '',
          'biografia' => isset($post['biografia']) ? $post['biografia'] : '',         
        ];   
    
        if($id = $post['id']){
          //  $this->model->where('id', $id)->update($data);   
            $this->model->where('id', $id)->set($data)->update();         
        }    
        else { $this->model->insert($data); }    

        if($errors = $this->model->errors()) { 
            $response['success'] = false;
            $response = $errors; 
        }

        return json_encode($response);       
    }
 

/*
  -------------------------------------------------------------------
  Nombre: ajax_list
  -------------------------------------------------------------------
  Descripción:
  devuelve los registros de los usuarios para ser cargados mediante datatables
  -------------------------------------------------------------------
  Entradas: $_POST
  -------------------------------------------------------------------
  Salida: arreglo en formato json
  -------------------------------------------------------------------
 */
public function ajax_list() 
{
   $data = [];
   foreach ($this->get_records(TRUE) as $r) 
   {
     $fn_edit = "carga_modal('" .'form?id=' . $r->id . "')";
     $fn_delete = "carga_modal('" .'delete?id=' . $r->id . "')";
     // $fn_delete = "if(confirm('Desea borrar el usuario?')) { ruta('" .'usercrud/add?id=' . $r->ID . "'); }";

     $fila = [];
     $fila[] = "<div align='center'>$r->nombre</div>";
     $fila[] = "<div align='center'>$r->fecha_nac</div>";
     $fila[] = "<div align='center'>$r->genero</div>";
     $fila[] = "<div align='center'>$r->biografia</div>";
     $fila[] = '<div align="center"><span onclick="' . $fn_edit . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></span></div>';
     $fila[] = '<div align="center"><span onclick="' . $fn_delete . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></span></div>';
     
     $data[] = $fila;
  }

  $total = $this->get_records();
  
  $salida = [
    'draw' => $_POST['draw'],
    'recordsTotal' => $total,
    'recordsFiltered' => $total,
     'data' => $data
   ];

   echo json_encode($salida);
         
 }    
    


/*
    Nombre: get_records
    -------------------------------------------------------------------
    Descripción: Retorna los Usuarios de acuerdo a los parametros solicicitados
    -------------------------------------------------------------------
    Entradas:
    $_POST
    $order_by: si es verdadero devuelve el arreglo con los resultados para generar el contenido de datatables
    -------------------------------------------------------------------
    Salida: int o arreglo
  
*/      
public function get_records($order_by=FALSE) 
{   
    $search_like = 0; 
    $sort_default = 'nombre|ASC';    
    $post = $this->request->getPost();

    $dt = new DatatablesModel();
    $this->db = \Config\Database::connect();

    $sort_columns = ['nombre', 'fecha_nac', 'genero'];
    $builder = $this->db->table('cantantes');
    $builder->select('id, biografia');

    return $dt->datatables_builder(compact('sort_columns', 'sort_default', 'order_by', 'search_like', 'builder'));
}      


} // Finaliza la clase




    /*
    public function delete()
    {                
        if($id = $this->request->getPost('id')) 
        {
            $this->model->query('DELETE FROM empleados WHERE id = '. $id);
            $this->model->query('DELETE FROM empleado_rol WHERE empleado_id = '. $id);
            
            session()->setFlashdata('success', 'Registro borrado satisfactoriamente.');
        }
        
        return redirect()->to('empleados');
    }    */
    