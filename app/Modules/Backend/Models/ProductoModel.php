<?php 

namespace App\Modules\Backend\Models;
 
use CodeIgniter\Model;
 
class ProductoModel extends Model
{
    protected $id;
    protected $table = 'Producto';
    protected $primaryKey = 'id_Producto';

    protected $returnType = 'array';
    protected $allowedFields = ['Producto_nombre', 'Producto_precio'];

    protected $useTimestapms = FALSE;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules;

    protected $validationMessages = [
        'Producto_nombre' => ['is_unique' => 'El nombre ya está en uso.']
    ];

    protected $skipValidation = FALSE;

    public function __construct($id = 0)
    {
        parent::__construct();     

        $this->id = $id;
        $this->validationRules = [
            'Producto_nombre' => "required|is_unique[Producto.Producto_nombre,$this->primaryKey,$this->id]|min_length[3]|max_length[50]",
            'Producto_precio' => 'required|numeric',
        ];    

    }   


}