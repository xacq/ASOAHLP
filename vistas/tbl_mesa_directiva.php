<?php
require 'header.php';
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Mesa Directiva <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Fecha de inicio de funciones</th>
                            <th>Login</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Fecha de inicio de funciones</th>
                            <th>Login</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario:</label>
                            <input type="hidden" name="MeDi_id" id="MeDi_id">
                            <!-- se obtiene de la BD -->
                            <select id="Mi_id" name="Mi_id" class="form-control selectpicker" data-live-search="true" title="Seleccione usuario">
                              <!-- aqui va la respuesta de la base de datos   -->
                            </select>
                        </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cargo(*):</label>
                            <select class="form-control select-picker" name="cargo" id="cargo" required>
                              <option value="Presidente/a">Presidente/a</option>
                              <option value="Vice-Presidente/a">Vice-Presidente/a</option>
                              <option value="Secretario de Actas/a">Secretario/a de Actas</option>
                              <option value="Secretario de Haciendas/a">Secretario/a de Haciendas</option>
                              <option value="Vocal 1">Vocal 1</option>
                              <option value="Vocal 2">Vocal 2</option>
                              <option value="Vocal 3">vocal 3</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">                           
                            <label>Fecha de inicio de funciones:</label>
                            <div class="input-group date" id="MeDi_FechaInicioFunciones" data-target-input="MeDi_FechaInicioFunciones">
                                <input type="date" name="MeDi_FechaInicioFunciones" id="MeDi_FechaInicioFunciones" class="form-control datetimepicker-input" data-target="ApoMi_registro"/>
                            </div>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Login (*):</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="50" placeholder="Login" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Clave (*):</label>
                            <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Clave" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Permisos:</label>
                            <ul style="list-style: none;" id="permisos">
                                 <!-- contenido desde la base de datos  -->
                            </ul>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-success" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

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
require 'footer.php';
?>

 <script type="text/javascript" src="scripts/tbl_mesa_directiva.js"></script>














