<?php namespace App\Modules\Backend\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Modules\Backend\Models\ProductoModel;
use CodeIgniter\HTTP\RequestInterface;
 
class Productos extends ResourceController
{
    use ResponseTrait;

    protected $id;
    protected $data;
    protected $model;    

    public function __construct()
    {        
        
        $post = json_decode(file_get_contents("php://input"), TRUE);

        $this->id = isset($post['id']) ? $post['id'] : 0;
        $this->model = new ProductoModel($this->id);

        $this->data = [
            'Producto_nombre' => isset($post['nombre']) ? $post['nombre'] : '',
            'Producto_precio' => isset($post['precio']) ? $post['precio'] : ''
        ];  
        
    }

    // obtener todos los productos
    public function index()
    {        
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }
 

    // obtener un único producto
    public function show($id = null)
    {
        $data = $this->model->getWhere(['id_Producto' => $id])->getResult();

        if($data){ return $this->respond($data); }
            
        return $this->failNotFound('No se halló el producto con ID: '. $id);        
    }
 

    public function create()
    {
        $this->model->insert($this->data);

        if($errors = $this->model->errors()){
            return $this->failValidationErrors($errors);
        }
        
        return $this->respondCreated($this->response('Producto guardado correctamente.'));
    }


    // actualizar producto
    public function update($id = null)
    {        
        if($this->model->find($this->id)){
            $this->model->update($this->id, $this->data);
        }
        else 
        { 
           return $this->failNotFound('No se halló el producto con ID: '. $this->id); 
        }        

        if($errors = $this->model->errors()){
            return $this->failValidationErrors($errors);
        }
        
        return $this->respond($this->response('Producto actualizado correctamente.'));        
    }

 
    // Borar producto
    public function delete($id = null)
    {
        if($this->model->find($id)){
            $this->model->delete($id);
        }
        else 
        { 
           return $this->failNotFound( 'No se halló el producto con ID: '. $id); 
        } 

        return $this->respondDeleted($this->response('Producto borrado correctamente.'));
    }


    /* response */
    private function response($messages, $status = 201, $errors = [])
    {
        return [
            'status'   => $status,
            'error'    => $errors,
            'messages' => [
                'info' => $messages
            ]
        ];        
    }

 
}