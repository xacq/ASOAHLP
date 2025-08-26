<?php

ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{

if ($_SESSION['almacen']==1)
{

require 'header.php';
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="srow">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Auspiciantes 
                          <!--  para el viernes -->
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                          <!-- llamamos a la funcion mostrar form de scripts/categoria.js -->
                            <i class="fa fa-plus-circle"></i> 
                            Agregar
                          </button>
                        </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->

                    <!-- el div de listadoregistros -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <!-- el div de tbllistado donde se usa el datatable que se llama desde el categoria.js -->
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Pais</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Otro dato</th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                                                                        
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Pais</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Otro dato</th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    
                     <!-- el div de formularioregistros -->
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">

                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="aus_id" id="aus_id">
                            <input type="text" class="form-control" name="aus_Nombre" id="aus_Nombre" maxlength="50" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pais:</label>
                            <input type="text" class="form-control" name="aus_pais" id="aus_pais" maxlength="100" placeholder="Pais">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Departamento:</label>
                            <select class="form-control select-picker" name="aus_departamento" id="aus_departamento">
                              <option selected>Seleccionar departamento</option>
                              <option value="La Paz">La Paz</option>
                              <option value="Oruro">Oruro</option>
                              <option value="Potosi">Potosi</option>
                              <option value="Cochabamba">Cochabamba</option>
                              <option value="Chuquisaca">Chuquisaca</option>
                              <option value="Tarija">Tarija</option>
                              <option value="Pando">Pando</option>
                              <option value="Beni">Beni</option>
                              <option value="Santa Cruz">Santa Cruz</option>
                              <option value="Otro">Otro</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad</label>
                            <input type="text" class="form-control" name="aus_ciudad" id="aus_ciudad" maxlength="100" placeholder="Ciudad">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Otro dato:</label>
                            <input type="text" class="form-control" name="Otro_dato" id="Otro_dato" maxlength="256" placeholder="Otro dato">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

 <script type="text/javascript" src="scripts/tbl_auspiciantes.js"></script>
 <?php 
}
ob_end_flush();
?>
