<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 4:04
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION['controlador'] . '/' . $_SESSION['accion'];?></h1>
        <a href="<?php echo _SERVER_;?>noticia/agregar" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa fa-plus fa-sm text-white-50"></i> Agregar Nuevo</a>
    </div>

    <!-- /.row (main row) -->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Noticias Registradas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-capitalize">
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Contexto</th>
                                <th>Bajada</th>
                                <th>Estado</th>
                                <th>Mostrar</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($noticias as $m){
                                ?>
                                <tr>
                                    <td><?php echo $m->id_noticia;?></td>
                                    <td><?php echo $m->noticia_titulo;?></td>
                                    <td><?php echo $m->noticia_contexto;?></td>
                                    <td><?php echo $m->noticia_bajada;?></td>
                                    <td><?php echo $m->noticia_estado;?></td>
                                    <td><?php echo $m->noticia_mostrar?></td>
                                    <td><a type="button" class="btn btn-xs btn-warning btne" href="<?php echo _SERVER_ . 'noticia/editar/' . $m->id_noticia;?>" >Editar</a></td>
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
