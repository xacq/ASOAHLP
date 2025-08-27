<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{

require 'header.php';
?>
<!--Contenido-->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Historial de miembro</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <input type="hidden" id="Mi_id" value="<?php echo $_GET['Mi_id']; ?>">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Descripción</th>
                            <th>Fecha</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Descripción</th>
                            <th>Fecha</th>
                          </tfoot>
                        </table>
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
 <script type="text/javascript" src="scripts/historial_miembro.js"></script>
<?php
}
ob_end_flush();
?>

