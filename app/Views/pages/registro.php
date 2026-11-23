<div class="row">
    <div class="col-lg-12 text-center">
        <h2>Registro de estudiantes</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?php
        if (!empty($msg)) {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg; ?>
            </div>
            <?php
        }
        if (!empty($errors)) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
                </ul>
            </div>
            <?php
        }
        ?>
        <?php echo form_open('estudiantes/create'); ?>
        <div class="form-group <?php echo (array_key_exists('nombres', $errors))? 'has-error':''; ?>">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" maxlength="50" value="<?php echo set_value('nombres'); ?>" required="required">
            </div>
            <div class="form-group <?php echo (array_key_exists('apellidos', $errors))? 'has-error':''; ?>">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" maxlength="50" value="<?php echo set_value('apellidos'); ?>" required="required">
            </div>
            <div class="form-group <?php echo (array_key_exists('cedula', $errors))? 'has-error':''; ?>">
                <label for="cedula">Identificaci&oacute;n</label>
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Identificaci&oacute;n" maxlength="25" value="<?php echo set_value('cedula'); ?>" required="required">
            </div>
            <div class="form-group <?php echo (array_key_exists('genero', $errors))? 'has-error':''; ?>">
                <label for="genero">G&eacute;nero</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="">- Seleccione -</option>
                    <option value="M" <?php echo (set_value('genero') === 'M')? 'selected="selected"':''; ?>>Masculino</option>
                    <option value="F" <?php echo (set_value('genero') === 'F')? 'selected="selected"':''; ?>>Femenino</option>
                </select>
            </div>
            <div class="form-group <?php echo (array_key_exists('email', $errors))? 'has-error':''; ?>">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" value="<?php echo set_value('email'); ?>" required="required">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        <?php echo form_close(); ?>
    </div>
</div>