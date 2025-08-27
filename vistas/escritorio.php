<?php
require 'header.php';
require '../modelos/Alertas.php';
$alerta = new Alertas();
$rspta = $alerta->listar();
?>
  <!-- CONTENIDO -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="alertas-container">
        <?php while ($reg = $rspta->fetch_object()) { ?>
          <span class="badge-alerta <?php echo $reg->leida ? 'badge-leida' : ''; ?>">
            <?php echo $reg->tipo_alerta . ' ' . $reg->fecha; ?>
            <?php if (!$reg->leida) { ?>
              <a href="../ajax/alertas.php?op=marcar&id=<?php echo $reg->id; ?>">✔</a>
            <?php } ?>
          </span>
        <?php } ?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- FIN CONTENIDO -->

<?php
require 'footer.php';
?>