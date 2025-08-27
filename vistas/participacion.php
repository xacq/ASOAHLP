<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
if ($_SESSION['compras']==1)
{
require 'header.php';
?>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Participación inicial</h1>
          </div>
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Actividad</th>
                <th>Miembro</th>
                <th>Tipo</th>
                <th>Observaciones</th>
                <th>Registro</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Actividad</th>
                <th>Miembro</th>
                <th>Tipo</th>
                <th>Observaciones</th>
                <th>Registro</th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/participacion.js"></script>
<?php
}
ob_end_flush();
?>
