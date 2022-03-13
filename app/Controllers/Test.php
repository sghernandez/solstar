<?php namespace App\Controllers;
 
use App\Models\ProductoModel;
 
class Test extends BaseController
{
   public function save()
   {
        $model = new ProductoModel();

        $product = [
          'product_name' => 'PHP MASTER',
          'product_price' => 5000
        ];
    
       $model->insert($product);
      
       print_r($model->errors());

   }


   public function update()
   {
        $id = 1;
        $model = new ProductoModel($id);

        $product = [
          'product_name' => 'JAVA MASTER',
          'product_price' => 5000
        ];
      
       $model
       ->where('product_id', $id)
       ->set($product)
       ->update();      

       print_r($model->errors());

   }   


}