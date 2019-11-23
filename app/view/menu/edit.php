<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 09/11/2019
 * Time: 11:29
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
                    <h4 class="header-title">Editar Menú</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Nombre Menú</label>
                            <input class="form-control" type="text" id="menu_name" value="<?php echo $menue->menu_name;?>" placeholder="Ingrese Nombre del Menú...">
                            <input style="display: none;" type="text" id="id_menu" value="<?php echo $id;?>" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Icono <a href="<?php echo _SERVER_;?>Menu/icons" target="_blank">(Ver Ejemplos Aquí)</a> Icono Actual = <i class="<?php echo $menue->menu_icon?>"></i></label>
                            <input class="form-control" type="text" id="menu_icon" value="<?php echo $menue->menu_icon;?>" placeholder="Ingrese Icono del Menú...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nombre Controlador</label>
                            <input class="form-control" type="text" id="menu_controller" value="<?php echo $menue->menu_controller;?>" placeholder="Ingrese Nombre del Menú...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Orden Aparición</label>
                            <input class="form-control" type="text" id="menu_order" value="<?php echo $menue->menu_order;?>" placeholder="Ingrese Orden de Aparación del Menú...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select class="form-control" id="menu_status">
                                <option <?php echo ($menue->menu_status == 0) ? 'selected' : '';?> value="0">NO ACTIVO</option>
                                <option <?php echo ($menue->menu_status == 1) ? 'selected' : '';?> value="1">ACTIVO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">¿Visible En Navegación?</label>
                            <select class="form-control" id="menu_show">
                                <option <?php echo ($menue->menu_show == 0) ? 'selected' : '';?> value="0">NO ACTIVO</option>
                                <option <?php echo ($menue->menu_show == 1) ? 'selected' : '';?> value="1">ACTIVO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contraseña De Usuario Actual</label>
                            <input class="form-control" type="password" id="password"  placeholder="Ingrese su Contraseña...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="btn-editar-menu" onclick="save_edit()"> Guardar Edición</button>
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
