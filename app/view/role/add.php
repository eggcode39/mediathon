<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 17:09
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
                    <h4 class="header-title">Agregar Nuevo Rol</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Nombre Rol</label>
                            <input class="form-control" type="text" id="role_name" placeholder="Ingrese Nombre del Rol...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Descripción Rol</label>
                            <input class="form-control" type="text" id="role_description" placeholder="Ingrese Descripción del Rol...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="save()"> Agregar Rol</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>role.js"></script>