<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 23:32
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
                    <h4 class="header-title">Editar Persona</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Nombres</label>
                            <input class="form-control" type="text" id="person_name" value="<?php echo $person->person_name;?>" placeholder="Ingrese Nombres...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos</label>
                            <input class="form-control" type="text" id="person_surname" value="<?php echo $person->person_surname;?>" placeholder="Ingrese Apellidos...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fecha de Nacimiento</label>
                            <input class="form-control" type="date" id="person_birth" value="<?php echo $person->person_birth;?>" placeholder="Ingrese Apellido...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Número de Teléfono</label>
                            <input class="form-control" type="text" id="person_number_phone" value="<?php echo $person->person_number_phone;?>" onkeypress="return valida(event)" placeholder="Ingrese Teléfono...">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Género</label>
                            <select class="form-control" id="person_genre">
                                <option <?php if($person->person_genre == 'M') {echo 'selected';} else {echo '';}?> value="M">Masculino</option>
                                <option <?php if($person->person_genre == 'F') {echo 'selected';} else {echo '';}?> value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Dirección Casa</label>
                            <input class="form-control" type="text" id="person_address" value="<?php echo $person->person_address;?>" placeholder="Ingrese Dirección...">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="save()">Guardar Datos</button>
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
