<?php
  session_start();

  if (!isset($_SESSION['verificacion'])) {
    header('location: index.php');
  }

  /*Seguridad para salir de la pagina si no hay un valor por GET y es numérico*/
  if (!$_GET) {
    header('location: main.php');
  }else {
    if (empty($_GET['idLista'])) {
      header('location: main.php');
    }else {
      if (!is_numeric($_GET['idLista'])) {
        header('location: main.php');
      }
    }
  }

  require_once 'admin/includes/conexion.inc.php';

  if ($_GET) {
    $sqlListaCreada = "
      SELECT *
        FROM lista
        WHERE id_lista LIKE ".$_GET['idLista']."
    ";

    $queryListaCreada = mysqli_query($conectar, $sqlListaCreada);

    while ($rowListaCreada = mysqli_fetch_assoc($queryListaCreada)) {
      $nombreLista = $rowListaCreada['nombre_lista'];
    } 
  }

  /*Añadir nueva tarea*/

  if ($_POST) {
    if (isset($_POST['tituloTarea']) && !empty($_POST['tituloTarea'])) {
      $sqlAgregarTarea = "
        INSERT INTO tarea
          VALUES(null, '".$_POST['tituloTarea']."', 'activa', ".$_GET['idLista'].");
      ";

      $queryAgregarTarea = mysqli_query($conectar, $sqlAgregarTarea);
    }
  }
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Do Things | Lista</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/summernote/summernote-bs4.min.css">
  <!-- CSS PROPIO -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/rsc/img/logo.png" alt="Logo TimeList" height="60" width="60">
  </div>

  <!-- Navbar -->
    <?php include_once "includes/navsup.inc.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once "includes/nav.inc.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Do Things | Lista <?php echo $nombreLista;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="main.php">Inicio</a></li>
              <li class="breadcrumb-item active">Do Things</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-7 connectedSortable">
          <div class="card">
            <div class="card-header cardLista">
              <h3 class="card-title"><?php echo $nombreLista;?></h3>
              <div class="tools">
                <i class="fas fa-edit" onclick="modificarTitulo()"></i>
                <i class="fas fa-trash" onclick="eliminarLista()"></i>
              </div>
            </div>
            <div class="card-body">
              <button class="btn btn-outline-success" onclick="agregar()"><i class="fas fa-plus"></i> Nueva Tarea</button>
            </div>
            <div class="card-body nuevaTarea">
              <form action="" method="POST" class="formTarea">
                <input type="text" class="form form-control" name="tituloTarea" placeholder="Tarea" required>
                <button type="submit" class="btn-plus"><i class="fas fa-plus"></i></button>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="todo-list" data-widget="todo-list">
                <?php 
                  /*Sacar las tareas de la lista*/
                  $sqlTareasLista = "
                    SELECT *
                      FROM tarea
                      WHERE id_lista LIKE ".$_GET['idLista'].";
                  ";

                  $queryTareasLista = mysqli_query($conectar, $sqlTareasLista);

                  while ($rowTareasLista = mysqli_fetch_assoc($queryTareasLista)) {
                      $nombreTarea = $rowTareasLista['nombre_tarea'];
                    ?>
                    <li>
                      <!-- mover tarea -->
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                        <label for="todoCheck1"></label>
                      </div>
                      <!-- texto tarea -->
                      <span class="text"><?php echo $nombreTarea;?></span>
                      <!-- opciones tarea-->
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash"></i>
                      </div>
                    </li>
                    <?php
                  }
                ?>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          </section>
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; <?php 
      $year = date('Y');
      echo $year; ?> Web hecha por <a href="https://soniadg.com">Sonia Diaz</a>.
    </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JS propio -->
<script src="assets/js/script.js"></script>
<!-- jQuery -->
<script src="assets/rsc/files/plantilla/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/rsc/files/plantilla/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/rsc/files/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/rsc/files/plantilla/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/rsc/files/plantilla/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/rsc/files/plantilla/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/rsc/files/plantilla/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/rsc/files/plantilla/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/rsc/files/plantilla/plugins/moment/moment.min.js"></script>
<script src="assets/rsc/files/plantilla/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/rsc/files/plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/rsc/files/plantilla/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/rsc/files/plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/rsc/files/plantilla/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/rsc/files/plantilla/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/rsc/files/plantilla/dist/js/pages/dashboard.js"></script>
<!-- iconicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
