   <?= form_open('save', ['id'  => 'form_usuario', 'class' => 'form-horizontal', 'role="form"']) 
        . form_hidden('send', TRUE)
        . form_hidden('id', (isset($cantante->id) ? $cantante->id : 0)) ?>	
    
    <div class="info"></div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nombre:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= isset($cantante->nombre) ? $cantante->nombre : '' ?>" placeholder="Nombre" required>
            <div id="error_nombre" class="error"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Fecha Nac.:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="Fecha Nacimiento" required
                   value="<?= isset($cantante->fecha_nac) ? $cantante->fecha_nac : '' ?>">						  					    
                   <div id="error_fecha_nac" class="error"></div>
        </div>
    </div>									
    <div class="form-group">
        <label class="col-sm-3 control-label">Género:</label>
        <div class="col-sm-8">
            <?php $options = [NULL => 'Seleccionar...', 'M' => 'M', 'F' => 'F'] ?>
            <?= form_dropdown('genero', $options, (isset($cantante->genero) ? $cantante->genero : ''), 'required id="genero" class="form-control"') ?>
            <div id="error_genero" class="error"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Biografía:</label>
        <div class="col-sm-8">
            <textarea name="biografia" id="biografia" class="form-control"><?= isset($cantante->biografia) ? $cantante->biografia : '' ?></textarea>				  					    
            <div id="error_biografia" class="error"></div>
        </div>
    </div>	         
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" onclick="return valida_formulario('form_usuario')" class="btn btn-inverse btn-block">Guardar</button>
        </div>
    </div><br>
    </form>
    