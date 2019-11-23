<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 19:54
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_;?>Userg/addu" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</a>
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios Registrados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Correo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Fecha Nacimiento</th>
                                <th>N° Celular</th>
                                <th>Sexo</th>
                                <th>Dirección Casa</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 1;
                            foreach ($users as $m){
                                $status = "<a class=\"btn btn-xs btn-outline-danger\">DESHABILITADO</a>";
                                $new_status = 1;
                                if($m->user_status == 1){
                                    $status = "<a class=\"btn btn-xs btn-outline-success\">HABILITADO</a>";
                                    $new_status = 0;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $a;?></td>
                                    <td><?php echo $m->user_nickname;?></td>
                                    <td><strong><?php echo $m->role_name;?></strong></td>
                                    <td><?php echo $status;?></td>
                                    <td><?php echo $m->user_email;?></td>
                                    <td><?php echo $m->person_name;?></td>
                                    <td><?php echo $m->person_surname;?></td>
                                    <td><?php echo $m->person_dni;?></td>
                                    <td><?php echo $m->person_birth;?></td>
                                    <td><?php echo $m->person_number_phone;?></td>
                                    <td><?php echo $m->person_genre;?></td>
                                    <td><?php echo $m->person_address;?></td>
                                    <td><a type="button" class="btn btn-xs btn-primary btne" href="<?php echo _SERVER_ . 'Userg/editpu/' . $m->id_person;?>" >Editar Persona</a><a type="button" class="btn btn-xs btn-info btne" href="<?php echo _SERVER_ . 'Userg/edituu/' . $m->id_user;?>" >Editar Usuario</a><a type="button" class="btn btn-xs btn-secondary btne" style="background-color: #00559b;color: white;border-color: steelblue;" onclick="preguntarSiNoRC(<?php echo $m->id_user;?>)">Resetear Contraseña</a><a type="button" class="btn btn-xs btn-danger btne" style="color: white;" onclick="preguntarSiNoI(<?php echo $m->id_user;?>,<?php echo $new_status;?>)">Cambiar Estado</a></td>
                                </tr>
                                <?php
                                $a++;
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
<script src="<?php echo _SERVER_ . _JS_;?>userg.js"></script>
