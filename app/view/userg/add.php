<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 20:14
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
                    <h4 class="header-title">Agregar Nuevo Usuario Al Sistema</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Nombres</label>
                            <input class="form-control" type="text" id="person_name" placeholder="Ingrese Nombres...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos</label>
                            <input class="form-control" type="text" id="person_surname" placeholder="Ingrese Apellidos...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI</label>
                            <input class="form-control" type="text" id="person_dni" placeholder="Ingrese DNI..." maxlength="8" onkeyup="return validar_numeros(this.id)">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fecha de Nacimiento</label>
                            <input class="form-control" type="date" id="person_birth">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Número de Teléfono</label>
                            <input class="form-control" type="text" id="person_number_phone" onkeyup="return validar_numeros(this.id)" placeholder="Ingrese Teléfono...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Género</label>
                            <select class="form-control" id="person_genre">
                                <option value="">Seleccione un Género...</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Dirección Casa</label>
                            <input class="form-control" type="text" id="person_address" placeholder="Ingrese Dirección...">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Nombre Usuario</label>
                            <input type="text" class="form-control" id="user_nickname" placeholder="Ingresar Nombre Usuario...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contraseña</label>
                            <input type="password" class="form-control" id="user_password1" placeholder="Ingresar Contraseña...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Repetir Contraseña</label>
                            <input type="password" class="form-control" id="user_password2" placeholder="Vuelva a Ingresar Contraseña...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Correo Usuario</label>
                            <input type="text" class="form-control" id="user_email" placeholder="Ingresar Correo Usuario...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Rol de Usuario</label>
                            <select class="form-control" id="id_role">
                                <option value="">Seleccione un Rol...</option>
                                <?php
                                foreach ($role as $r){
                                    if($r->id_role != 1){
                                        ?>
                                        <option value="<?= $r->id_role;?>"><?= $r->role_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" onclick="save()" id="btn-userg-addu"> Agregar Usuario</button>
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
