<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 18:15
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
    </div>
    <!-- Main row -->
    <div class="row">
        <!-- Dark table start -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Menús con Permiso Para el Rol: <strong><?php echo $role->role_name;?></strong></h4>
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
                    <h6 class="m-0 font-weight-bold text-primary"><strong>Menús con Permiso Para el Rol: <strong><?php echo $role->role_name;?></strong></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Con Permiso</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($menu as $m){
                                $acceso = "<a class=\"btn btn-xs btn-outline-danger\" >NO</a>";
                                $opcion = "<a type=\"button\" class=\"btn btn-xs btn-success\" style='color: white;' onclick=\"agregarRelacion(". $id_role .",". $m->id_menu .")\">Agregar Relacion</a>";
                                if($this->role->SearchRelationship($id_role, $m->id_menu)){
                                    $acceso = "<a class=\"btn btn-xs btn-outline-success\" >SI</a>";
                                    $opcion = "<a type=\"button\" class=\"btn btn-xs btn-danger\" style='color: white;' onclick=\"eliminarRelacion(". $id_role .",". $m->id_menu .")\">Eliminar Relacion</a>";
                                } else {
                                    $acceso = "<a class=\"btn btn-xs btn-outline-danger\" >NO</a>";
                                    $opcion = "<a type=\"button\" class=\"btn btn-xs btn-success\" style='color: white;' onclick=\"agregarRelacion(". $id_role .",". $m->id_menu .")\">Agregar Relacion</a>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $m->id_menu?></td>
                                    <td><?php echo $m->menu_name?></td>
                                    <td><?php echo $acceso?></td>
                                    <td><?php echo $opcion?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <br><a onclick="history.back();" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style='color: white;'><i class="fa fa-history fa-sm text-white-50"></i> Volver Al Menú Anterior</a>
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
