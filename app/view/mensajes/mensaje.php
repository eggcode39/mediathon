<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 13:21
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
                    <h4 class="header-title">Envio Masivo de Mensajes:</h4>
                    <h6 class="header-title">Envio de Información a todos los docentes registrados en la plataforma.</h6>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Texto del Mensaje</label>
                            <textarea class="form-control" type="text" cols="10" rows="5" ></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Enviar:</label><br>
                            <input type="checkbox"  value="wa"> WhatsApp<br>
                            <input type="checkbox" value="co"> Correo<br>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="enviar()">Enviar Mensajes</button>
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
<script>
    function enviar() {
        alert('Mensajes Enviados');
        location.reload();
    }
</script>
