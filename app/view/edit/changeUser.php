<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 23:36
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
                    <h4 class="header-title">Editar Usuario</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Nombre Usuario</label>
                            <input type="text" class="form-control" value="<?php echo $user->user_nickname;?>" id="user_nickname" placeholder="Ingresar Nombre Usuario...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="savenick()">Editar Nombre de Usuario</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>edit.js"></script>
