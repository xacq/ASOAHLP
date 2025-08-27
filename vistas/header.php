
<?php

use PSpell\Config;

if (strlen(session_id()) < 1){
  session_start();
}
  
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AHLP | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <!-- DATATABLES -->
   <link rel="stylesheet" type="../public/text/css" href="datatables/jquery.dataTables.min.css">
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
  <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

  <!-- select mas esteticos -->
  <link  type="text/css"  href="../public/css/bootstrap-select.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../public/css/alertas.css">

  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- HEADER -->
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hipoacusia</b>AHLP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                <p>
                <?php echo $_SESSION['nombre'];?>- Usuario
                  <small>Sistema de Registro</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE OPCIONES</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>
         
        </li>
           
      
        <?php

          if ($_SESSION['almacen']==1)
          {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Administracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav-item"><a href="tbl_miembros.php"><i class="fa fa-circle-o"></i> Miembros</a></li>
            <li class="nav-item"><a href="tbl_apoyo_miembros.php"><i class="fa fa-circle-o"></i> Apoyo a Miembros</a></li>
            <li class="nav-item"><a href="tbl_auspiciantes.php"><i class="fa fa-circle-o"></i> Auspiciantes</a></li>
            <li class="nav-item"><a href="tbl_montos_auspiciantes.php"><i class="fa fa-circle-o"></i> Donaciones</a></li>
            <li class="nav-item"><a href="inventario.php"><i class="fa fa-circle-o"></i> Inventario</a></li>
            <li class="nav-item"><a href="multas.php"><i class="fa fa-circle-o"></i> Multas</a></li>
            <li class="nav-item"><a href="especialidades.php"><i class="fa fa-circle-o"></i> Especialidades</a></li>                              
            <li class="nav-item"><a href="reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
          </ul>
        </li>
        <?php
          
          }
          if ($_SESSION['compras']==1)
          {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Eventos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav-item"><a href="actividades.php"><i class="fa fa-circle-o"></i> Actividades </a></li>
            <li class="nav-item"><a href="participacion.php"><i class="fa fa-circle-o"></i> Participacion</a></li>
          </ul>
        </li>
        <?php
          
        }
        if ($_SESSION['ventas']==1)
        {
      ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Parametricos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="nav-item"><a href="especialidades.php"><i class="fa fa-circle-o"></i> Especialidades </a></li>
            <li class="nav-item"><a href="reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
            <li class="nav-item"><a href="tiposdehipoacusia.php"><i class="fa fa-circle-o"></i> Tipos de Hipoacusia</a></li>
            <li class="nav-item"><a href="tiposdeapoyo.php"><i class="fa fa-circle-o"></i> Tipos de Apoyo </a></li>
            <li class="nav-item"><a href="tiposdeinventario.php"><i class="fa fa-circle-o"></i> Tipos de Inventario</a></li>
            <li class="nav-item"><a href="ocupaciones.php"><i class="fa fa-circle-o"></i> Ocupaciones </a></li>
          </ul>
        </li>
        <?php
          
        }
        if ($_SESSION['accesos']==1)
        {
      ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Accesos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios </a></li>
            <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
            <li class="nav-item"><a href="tbl_mesa_directiva.php"><i class="fa fa-circle-o"></i> Mesa Directiva</a></li>
          </ul>
        </li>

        <?php
          
        }

      ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- FIN HEADER -->