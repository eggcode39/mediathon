<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 09/11/2019
 * Time: 16:33
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_ . 'Menu/list'?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-history fa-sm text-white-50"></i>  Volver Al Menú Anterior</a>
    </div>

    <!-- Content Row -->
    <!-- Main row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Roles con Acceso a Menú: <strong><?php echo $menuname;?></strong></h5>
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
    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles con Acceso a Menú: <strong><?php echo $menuname;?></strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>¿Con Acceso?</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($menusf as $m){
                                //$acceso = array_search($m->id_role, array_column($menust, 'id_role'));
                                $acceso = $this->menu->searchRelation($m->id_role, $id_menu);
                                if($acceso === false){
                                    $permiso_vista = "<a type=\"button\" class=\"btn btn-sm btn-outline-danger\">Sin Acceso</a>";
                                    $opcion_vista = "<a type=\"button\" style='color: white;' class=\"btn btn-sm btn-success\" onclick=\"preguntarSiNoAR(" .$id_menu.",". $m->id_role.")\">Permitir Acceso</a>";
                                } else {
                                    $permiso_vista = "<a type=\"button\" class=\"btn btn-sm btn-outline-success\">Con Acceso</a>";
                                    $opcion_vista = "<a type=\"button\" style='color: white;' class=\"btn btn-sm btn-danger\" onclick=\"preguntarSiNoDR(" .$id_menu.",". $m->id_role.")\">Eliminar Acceso</a>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $m->id_role;?></td>
                                    <td><?php echo $m->role_name;?></td>
                                    <td><?php echo $m->role_description;?></td>
                                    <td><?php echo $permiso_vista;?></td>
                                    <td><?php echo $opcion_vista;?></td>
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
<script src="<?php echo _SERVER_ . _JS_;?>menu.js"></script>
