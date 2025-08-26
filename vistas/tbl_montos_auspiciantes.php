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
                        <h1 class="box-title">Donaciones 
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
                            <th>Auspiciante</th>
                            <th>Monto</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de Cierre</th>
                            <th>Observación</th>
                            <th>Mesa directiva</th>
                            <th>Factura</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                                                                        
                          </tbody>
                          <tfoot>
                            <th>Auspiciante</th>
                            <th>Monto</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de Cierre</th>
                            <th>Observación</th>
                            <th>Mesa directiva</th>
                            <th>Factura</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    
                     <!-- el div de formularioregistros -->
                    <div class="panel-body" id="formularioregistros">

                        <form name="formulario" id="formulario" method="POST">
                          
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario:</label>
                            <input type="hidden" name="MonAus_id" id="MonAus_id">
                            <!-- se obtiene de la BD -->
                            <select id="aus_id" name="aus_id" class="form-control selectpicker" data-live-search="true" title="Seleccione usuario">
                              <!-- aqui va la respuesta de la base de datos   -->
                            </select>
                         </div>
 
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Monto:</label>
                            <input type="decimal" class="form-control" name="MonAus_Monto" id="MonAus_Monto" maxlength="50" placeholder="Monto" required>
                         </div>

                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">                           
                            <label>Fecha de Inicio:</label>
                            <div class="input-group date" id="MonAus_Inicio" data-target-input="MonAus_Inicio">
                                <input type="date" name="MonAus_Inicio" id="MonAus_Inicio" class="form-control datetimepicker-input" data-target="MonAus_Inicio"/>
                            </div>
                         </div>

                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">                           
                          <label>Fecha de Cierre:</label>
                          <div class="input-group date" id="MonAus_Cierre" data-target-input="MonAus_Cierre">
                              <input type="date" name="MonAus_Cierre" id="MonAus_Cierre" class="form-control datetimepicker-input" data-target="MonAus_Cierre"/>
                          </div>
                         </div>

                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Observación:</label>
                            <input type="text" class="form-control" name="MonAus_Observaciones" id="MonAus_Observaciones" maxlength="256" placeholder="Observación">
                         </div>

                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Mesa directiva:</label>
                            <input type="hidden" name="Aus_id" id="Aus_id">
                            <!-- se obtiene de la BD -->
                            <select id="MeDi_id" name="MeDi_id" class="form-control selectpicker" data-live-search="true" title="Seleccione usuario">
                              <!-- aqui va la respuesta de la base de datos   -->
                            </select>
                         </div>
                   
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Factura:</label>
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

 <script type="text/javascript" src="scripts/tbl_apoyo_miembros.js"></script>
 <?php 
}
ob_end_flush();
?>
