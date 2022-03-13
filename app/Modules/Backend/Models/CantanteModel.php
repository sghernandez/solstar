<?php 

namespace App\Modules\Backend\Models;
 
use CodeIgniter\Model;
 
class CantanteModel extends Model
{
    protected $id;
    protected $table = 'cantantes';
    protected $primaryKey = 'id';


    protected $returnType = 'object'; 
    protected $allowedFields = ['nombre', 'fecha_nac', 'genero', 'biografia', 'foto'];

    protected $useTimestapms = FALSE;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules;
    protected $data;    

    protected $validationMessages = [
       // 'email' => ['is_unique' => 'El email ya está en uso.']
    ];

    protected $skipValidation = FALSE;
    protected $request;

    public function __construct()
    {
        parent::__construct();     
        
        $this->id = intval($this->id = isset($_POST['id']) ? $_POST['id'] : '');
        $this->validationRules = [
            'nombre' => 'required|min_length[3]|max_length[200]',            
            'genero' => 'required|in_list[M,F]',
            'fecha_nac' => 'required',
            // 'foto' => 'required',
            'biografia' => 'required|min_length[10]',
        ];    

    }   
    
    public static function setPost()
    {
        $request = \Config\Services::request();
 
        return  [ 
            'nombre' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'genero' => $request->getPost('gender'),
            'area_id' => $request->getPost('area'),
            'boletin' => $request->getPost('boletin'),
            'biografia' => $request->getPost('description'),
        ];                           
    } 

}