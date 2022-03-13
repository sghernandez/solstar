 <?= form_open('', ['id'  => 'form_usuario', 'class' => 'form-horizontal', 'role="form"']) 
        . form_hidden('send', TRUE)
        . form_hidden('id', $id) ?>	
     
    <div class="text-center">¿ DESEA BORRAR EL USUARIO ?</div>
          
    <div class="form-group">
        <div class="col-sm-12"><br><br>
            <button type="submit" onclick="return valida_formulario('form_usuario')" class="btn btn-danger btn-block">CONFIRMAR</button>
        </div>
    </div><br>
    </form>
