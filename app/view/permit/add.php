<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 16:47
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="header-title">Agregar Permiso a Opción <?php echo $optionname;?></h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Acción</label>
                            <input class="form-control" type="text" id="permit_action"  placeholder="Ingrese Nombre de la Opción...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select class="form-control" id="permit_status">
                                <option value="1">HABILITADO</option>
                                <option value="0">DESHABILITADO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contraseña De Usuario Actual</label>
                            <input class="form-control" type="password" id="password"  placeholder="Ingrese su Contraseña...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="savep(<?php echo $id_optionm;?>)"> Guardar Opción</button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" onclick="volverp(<?php echo $id_optionm;?>)"> Volver a Listar Funciones</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>menu.js"></script>
