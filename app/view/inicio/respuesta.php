<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">La noticia es...</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <?php
            if($noticia->noticia_esfake == 1){
                ?>
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" style="font-size: 20px;">FALSA</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-newspaper-o fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 20px;">VERDADERA</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-newspaper-o fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4 bg-gradient-primary text-white">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Noticia: <?= $noticia->noticia_titulo;?></h6>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <iframe src="<?= $noticia->noticia_link;?>" frameborder="0" style="width: 100%; height: 500px;"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4 bg-gradient-primary text-white">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center">¡Acá te explicamos el motivo!</h6>
                </div>
                <div class="card-body">
                    <h2 style="color: white;"><?= $noticia->noticia_motivo;?></h2>
                </div>
            </div>

        </div>
    </div>
    <br>
    <?php
    if($respuesta->calificacion_respuesta == $noticia->noticia_esfake){
        ?>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4 bg-gradient-success text-white">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="text-align: center">Tu respuesta fue:</h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-lg btn-success" style="width: 100%">CORRECTA</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4 bg-gradient-danger text-white">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="text-align: center">Tu respuesta fue:</h6>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-lg btn-danger" style="width: 100%">INCORRECTA</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4 bg-gradient-primary text-white">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center"><a href="<?= _SERVER_ . 'inicio/aprender';?>">Calificar Otras Noticias</a></h6>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>inicio.js"></script>