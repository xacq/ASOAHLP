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
require_once "../modelos/Reportes.php";

$reportes = new Reportes();
$registros = $reportes->miembrosPorEstado();
// Registramos la generación del reporte
if(isset($_SESSION['idusuario'])){
    $reportes->registrar('Miembros por Estado',$_SESSION['idusuario']);
}
?>
<!--Contenido-->
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Reportes</h1>
          </div>
          <div class="box-body">
            <p>Fecha/Hora: <?php echo date('Y-m-d H:i:s'); ?></p>
            <table class="table table-bordered table-striped">
              <thead>
                <tr><th>Estado</th><th>Total</th></tr>
              </thead>
              <tbody>
                <?php while ($reg=$registros->fetch_object()) { ?>
                <tr>
                  <td><?php echo $reg->Mi_Estado; ?></td>
                  <td><?php echo $reg->total; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--Fin Contenido-->

<?php
require 'footer.php';
}
ob_end_flush();
?>

