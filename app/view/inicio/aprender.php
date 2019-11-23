<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Aquí vamos...</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 20px;">¿Estás listo para empezar?</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-newspaper-o fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4 bg-gradient-primary text-white">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">¡Bienvenido!</h6>
                </div>
                <div class="card-body">
                    <p>En este momento vas a poner a prueba tus conocimientos sobre detección de noticias falsas. Te recomendamos ver los videos que están al inicio del portal (Entra
                        <a style="color: yellow;" href="<?= _SERVER_;?>">Aquí</a>)</p>
                    <p class="mb-0">A continuación, listaremos diferentes noticias, y tienes que ser capaz de detectar si es o no es una noticia falsa.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="text-align: center">¡¡NOTICIAS!!</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>¿Respondió?</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($noticias as $m){
                                $respuesta_usuario = $this->calificacion->listar_usuario_noticia($m->id_noticia, $this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_));

                                $respuesta = "<a class=\"btn btn-sm btn-outline-danger btne\">NO</a>";
                                $accion = "<a type=\"button\" class=\"btn btn-xs btn-warning btne\" href=\"". _SERVER_ . 'inicio/ver/' . $m->id_noticia."\" >Ver Noticia</a>";

                                if(isset($respuesta_usuario->calificacion_respuesta)){
                                    $accion = "<a type=\"button\" class=\"btn btn-xs btn-success btne\" href=\"". _SERVER_ . 'inicio/respuesta/' . $m->id_noticia."\" >Ver Respuesta</a>";
                                    if($m->noticia_esfake == $respuesta_usuario->calificacion_respuesta){
                                        $respuesta = "<a class=\"btn btn-sm btn-outline-success btne\">RESPUESTA CORRECTA</a>";
                                    } else {
                                        $respuesta = "<a class=\"btn btn-sm btn-outline-danger btne\">RESPUECTA INCORRECTA</a>";
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?php echo $m->id_noticia;?></td>
                                    <td><?php echo $m->noticia_titulo;?></td>
                                    <td><?php echo $respuesta;?></td>
                                    <td><?php echo $accion;?></td>
                                    <td></td>
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