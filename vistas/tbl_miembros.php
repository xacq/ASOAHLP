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
                        <h1 class="box-title">Miembros 
                          <!--  para el viernes -->
                          <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)">
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
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Fecha de<p>Nacimiento</p></th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Departamento</th>
                            <th>Ocupacion</th>
                            <th>Direccion</th>
                            <th>Tiempo</th>
                            <th>CI</th>
                            <th>Civil</th>
                            <th>Carnet <p>Discapacidad</p></th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                                                                        
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Fecha de<p>Nacimiento</p></th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Departamento</th>
                            <th>Ocupacion</th>
                            <th>Direccion</th>
                            <th>Tiempo</th>
                            <th>CI</th>
                            <th>Civil</th>
                            <th>Carnet <p>Discapacidad</p></th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    
                     <!-- el div de formularioregistros -->
                    <div class="panel-body" id="formularioregistros">

                        <form name="formulario" id="formulario" method="POST">
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres(*):</label>
                            <input type="hidden" name="Mi_id" id="Mi_id">
                            <input type="text" class="form-control" name="Mi_Nombres" id="Mi_Nombres" maxlength="100" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos(*):</label>
                            <input type="text" class="form-control" name="Mi_Apellido" id="Mi_Apellido" maxlength="100" placeholder="Apellidos" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">                           
                            <label>Fecha de nacimiento:</label>
                            <div class="input-group date" id="Mi_FechaNacimiento" data-target-input="Mi_FechaNacimiento">
                                <input type="date" name="Mi_FechaNacimiento" id="Mi_FechaNacimiento" class="form-control datetimepicker-input" data-target="Mi_FechaNacimiento"/>
                            </div>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Número(*):</label>
                            <input type="text" class="form-control" name="Mi_Celular" id="Mi_Celular" maxlength="20" placeholder="Celular o telefono" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="Mi_Email" id="Mi_Email" maxlength="50" placeholder="Email">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Departamento:</label>
                            <select class="form-control select-picker" name="Mi_Departamento" id="Mi_Departamento">
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
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ocupacion:</label>
                            <input type="text" class="form-control" name="Mi_Ocupacion" id="Mi_Ocupacion" placeholder="Ocupacion" maxlength="70">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion:</label>
                            <input type="text" class="form-control" name="Mi_Direccion" id="Mi_Direccion" maxlength="200" placeholder="Direccion">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tiempo</label>
                            <input type="text" class="form-control" name="Mi_tiempo" id="Mi_tiempo" maxlength="50" placeholder="Antuguedad">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Carnet de Identidad</label>
                            <input type="text" class="form-control" name="CI" id="CI" maxlength="20" placeholder="Carnet de Identidad">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado Civil:</label>
                            <select class="form-control select-picker" name="Civil" id="Civil">
                              <option selected>Seleccionar estado Civil</option> 
                              <option value="Soltero/a">Soltero/a</option>
                              <option value="Casado/a">Casado/a</option>
                              <option value="Divorciado/a">Divorciado/a</option>
                              <option value="Otros">Otros</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Carnet de Discapacidad:</label>
                            <select class="form-control select-picker" name="CarnetDiscapacidad" id="CarnetDiscapacidad" required>
                              <option selected>Seleccionar una opción</option> 
                              <option value="Si">Si</option>
                              <option value="No">No</option>
                              <option value="En tramite">En tramite</option>
                            </select>
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

 <script type="text/javascript" src="scripts/tbl_miembros.js"></script>
 <?php 
}
ob_end_flush();
?>
