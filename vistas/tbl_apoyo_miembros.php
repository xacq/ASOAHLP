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
                        <h1 class="box-title">Apoyo de Miembros 
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
                      <div class="row">
                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" id="ciBuscar" placeholder="Buscar por CI">
                        </div>
                        <div class="form-group col-md-2 col-sm-6 col-xs-12">
                          <button class="btn btn-primary" type="button" onclick="buscarPorCI()">Buscar</button>
                        </div>
                      </div>
                      <!-- el div de tbllistado donde se usa el datatable que se llama desde el categoria.js -->
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Usuario</th>
                            <th>Tipo de Apoyo</th>
                            <th>Cantidad</th>
                            <th>Observación</th>
                            <th>Registro</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                                                                        
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Usuario</th>
                            <th>Tipo de Apoyo</th>
                            <th>Cantidad</th>
                            <th>Observación</th>
                            <th>Registro</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    
                     <!-- el div de formularioregistros -->
                    <div class="panel-body" id="formularioregistros">

                        <form name="formulario" id="formulario" method="POST">
                          
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario:</label>
                            <input type="hidden" name="ApoMi_id" id="ApoMi_id">
                            <!-- se obtiene de la BD -->
                            <select id="Mi_id" name="Mi_id" class="form-control selectpicker" data-live-search="true" title="Seleccione usuario">
                              <!-- aqui va la respuesta de la base de datos   -->
                            </select>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipos de Apoyo:</label>
                            <select class="form-control select-picker" name="TiApo" id="TiApo">
                              <option value="Charla grupal">Charla grupal</option>
                              <option value="Charla individual">Charla individual</option>
                              <option value="Psicologo/a">Psicologo/a</option>
                              <option value="Donacion de pilas">Donacion de pilas</option>
                              <option value="Donacion de Audifono">Donacion de Audifono</option>
                              <option value="Derivacion al Fonoaudilogo">Derivacion al Fonoaudilogo</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="double" class="form-control" name="ApoMi_Cantidad" id="ApoMi_Cantidad" maxlength="50" placeholder="Cantidad" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Observación:</label>
                            <input type="text" class="form-control" name="ApoMi_Observaciones" id="ApoMi_Observaciones" maxlength="256" placeholder="Observación">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">                           
                            <label>Fecha de registro:</label>
                            <div class="input-group date" id="ApoMi_registro" data-target-input="ApoMi_registro">
                                <input type="date" name="ApoMi_registro" id="ApoMi_registro" class="form-control datetimepicker-input" data-target="ApoMi_registro"/>
                            </div>
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

 <script type="text/javascript" src="scripts/tbl_apoyo_miembros.js"></script>
 <?php 
}
ob_end_flush();
?>
