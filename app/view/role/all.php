<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 17:04
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_;?>Role/add" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</a>
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Roles Registrados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($role as $m){
                                ?>
                                <tr>
                                    <td><?php echo $m->id_role?></td>
                                    <td><?php echo $m->role_name?></td>
                                    <td><?php echo $m->role_description?></td>
                                    <td><a type="button" class="btn btn-xs btn-warning btne" href="<?php echo _SERVER_ . 'Role/edit/' . $m->id_role;?>" >Editar</a><a type="button" class="btn btn-xs btn-danger btne" style="color: white;" onclick="preguntarSiNo(<?php echo $m->id_role;?>)">Eliminar</a><a type="button" class="btn btn-xs btn-success btne" href="<?php echo _SERVER_ . 'Role/options/' . $m->id_role;?>" >Ver Accesos</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
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
<script src="<?php echo _SERVER_ . _JS_;?>role.js"></script>
