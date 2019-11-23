<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 13/11/2019
 * Time: 12:10
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
                        <div class="form-group" style="display: none;">
                            <input type="text" class="form-control" value="<?php echo $id;?>" id="id_user" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nombre Usuario</label>
                            <input type="text" class="form-control" value="<?php echo $user->user_nickname;?>" id="user_nickname" placeholder="Ingresar Nombre Usuario...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Correo Usuario</label>
                            <input type="text" class="form-control" id="user_email" value="<?php echo $user->user_email;?>" placeholder="Ingresar Correo Usuario...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select id="user_status" class="form-control">
                                <option <?php if($user->user_status == 0) {echo 'selected';} else {echo '';}?> value="0">INHABILITADO</option>
                                <option <?php if($user->user_status == 1) {echo 'selected';} else {echo '';}?> value="1">HABILITADO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"> Rol Usuario</label>
                            <select id="id_role" class="form-control">
                                <?php
                                foreach ($roles as $r){
                                    if($r->id_role != 1){
                                        ?>
                                        <option <?php if($user->id_role == $r->id_role) {echo 'selected';} else {echo '';}?>  value="<?php echo $r->id_role;?>"><?php echo $r->role_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="btn-edituu-guardar" onclick="saveeu()"> Editar Usuario</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>userg.js"></script>
