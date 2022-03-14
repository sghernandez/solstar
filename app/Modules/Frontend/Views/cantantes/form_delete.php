 <?= form_open('delete', ['id'  => 'formulario', 'class' => 'form-horizontal', 'role="form"']) 
        . form_hidden('send', TRUE)
        . form_hidden('id', $id) ?>	
     
    <div class="text-center">¿ Desea borrar el registro ?</div>
          
    <div class="form-group">
        <div class="col-sm-12"><br><br>
            <button type="submit" class="btn btn-danger btn-block">Confirmar</button>
        </div>
    </div><br>
    </form>
