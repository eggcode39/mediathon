<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 09/11/2019
 * Time: 3:25
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_;?>Menu/add" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</a>
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Menús Registrados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Nombre Menu</th>
                                <th>Código Icono</th>
                                <th>Imagen Icono</th>
                                <th>Controlador</th>
                                <th>Orden de Aparación</th>
                                <th>Estado</th>
                                <th>Visibilidad</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($menu as $m){
                                $show = "<a class=\"btn btn-sm btn-outline-danger btne\">NO</a>";
                                $status = "<a class=\"btn btn-sm btn-outline-danger btne\">DESHABILITADO</a>";
                                if($m->menu_show == 1){
                                    $show = "<a class=\"btn btn-sm btn-outline-success btne\">SI</a>";
                                }
                                if($m->menu_status == 1){
                                    $status = "<a class=\"btn btn-sm btn-outline-success btne\">HABILITADO</a>";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $m->id_menu?></td>
                                    <td><?php echo $m->menu_name?></td>
                                    <td><?php echo $m->menu_icon?></td>
                                    <td><i class="<?php echo $m->menu_icon?>"></i></td>
                                    <td><?php echo $m->menu_controller?></td>
                                    <td><?php echo $m->menu_order?></td>
                                    <td><?php echo $status;?></td>
                                    <td><?php echo $show;?></td>
                                    <td><a type="button" class="btn btn-sm btn-warning btne" href="<?php echo _SERVER_ . 'Menu/edit/' . $m->id_menu;?>" >Editar</a><a type="button" class="btn btn-sm btn-primary btne" href="<?php echo _SERVER_ . 'Menu/role/' . $m->id_menu;?>" >Ver Acceso de Roles</a><a type="button" class="btn btn-sm btn-info btne" href="<?php echo _SERVER_ . 'Menu/functions/' . $m->id_menu;?>" target="_blank">Ver Opciones</a></td>
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
