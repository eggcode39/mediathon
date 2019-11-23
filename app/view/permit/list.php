<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 11:51
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_ . 'Menu/addp/' . $id_optionm;?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</a>
    </div>
    <!-- Main row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5><strong>Permisos de la Opción: <?php echo $optionname;?></strong></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <input class="form-control" type="password" id="password"  placeholder="Ingrese su Contraseña AQUÍ para Permitir Cambios...">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permisos de la Opción: <?php echo $optionname;?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Nombre Acción</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($permits as $m){

                                $status = "<a class=\"btn btn-xs btn-outline-danger\">DESHABILITADO</a>";

                                if($m->permit_status == 1){
                                    $status = "<a class=\"btn btn-xs btn-outline-success\">HABILITADO</a>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $m->id_permit?></td>
                                    <td><?php echo $m->permit_action?></td>
                                    <td><?php echo $status?></td>
                                    <td><a type="button" class="btn btn-xs btn-danger btne" style="color:white;" onclick="preguntarSiNoDP(<?php echo $m->id_permit;?>)">Eliminar</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table><br>
                        <a href="<?php echo _SERVER_ . 'Menu/functions/' . $id_menu;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-history fa-sm text-white-50"></i> Volver Al Menú Anterior</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>menu.js"></script>
