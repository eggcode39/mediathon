<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 4:08
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
                    <h4 class="header-title">Agregar Nueva Noticia</h4>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-form-label">Titulo</label>
                            <textarea class="form-control" id="noticia_titulo" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contexto</label>
                            <textarea class="form-control" id="noticia_contexto" cols="30" rows="5">aaa</textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Bajada</label>
                            <textarea class="form-control" id="noticia_bajada" cols="30" rows="5">aaa</textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Link</label>
                            <textarea class="form-control" id="noticia_link" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">¿Es Fake?</label>
                            <select class="form-control" id="noticia_esfake" >
                                <option value="">Seleccionar un estado...</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Motivo</label>
                            <textarea class="form-control" id="noticia_motivo" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select class="form-control" id="noticia_estado" >
                                <option value="">Seleccionar un estado...</option>
                                <option value="1">Habilitado</option>
                                <option value="0">Deshabilitado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">¿Mostrar?</label>
                            <select class="form-control" id="noticia_mostrar" >
                                <option value="">Seleccionar un estado...</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" onclick="agregar_noticia()">Agregar Noticia</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>noticia.js"></script>
