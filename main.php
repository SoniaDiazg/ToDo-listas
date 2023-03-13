<?php
  session_start();

  if (!isset($_SESSION['verificacion'])) {
    header('location: index.php');
  }

  require_once 'admin/includes/conexion.inc.php';

  
  $nombreQueListaBorrar = "";
  $idQueListaBorrar = "";
  /*===================
  Numero listas creadas
  ====================*/

  $sqlNumListas = "
  SELECT *
    FROM lista
    WHERE id_usuario LIKE ".$_SESSION['idUsu'].";
  ";

  $queryNumListas = mysqli_query($conectar, $sqlNumListas);

  $rowNumListas = mysqli_num_rows($queryNumListas);

  /*========================
  Crear a una lista
  ==========================*/
  $fechaLista = date('d-m-Y');
  if ($_POST) {
    if (isset($_POST['nombreLista']) && !empty($_POST['nombreLista'])) {
      $sqlNuevaLista = "
        INSERT INTO lista
          VALUES(null, '".$_POST['nombreLista']."', '".$fechaLista."', '', 'activa', ".$_SESSION['idUsu'].");
      ";

      $queryNuevaLista = mysqli_query($conectar, $sqlNuevaLista);
    }
  }

  /*================
  Listas creadas
  =================*/
  $sqlLista
  

  /*======================
  Borrar lista
  ========================*/
  if ($_GET) {

    $sqlQueListaBorrar = "
      SELECT *
        FROM lista
          WHERE id_usuario LIKE '".$_SESSION['idUsu']."'
            AND estado_lista LIKE 'activa';
    ";

    $queryQueListaBorrar = mysqli_query($conectar, $sqlQueListaBorrar);

    while ($rowQueListaBorrar = mysqli_fetch_assoc($queryQueListaBorrar)) {
      $idQueListaBorrar = $rowQueListaBorrar['id_lista'];
      $nombreQueListaBorrar = $rowQueListaBorrar['nombre_lista'];
    }


    if (isset($_GET['borrarLista']) ) {
      $sqlBorrarLista = "
      UPDATE lista
        SET estado_lista = no activa
        WHERE id_lista LIKE $idQueListaBorrar;
    ";

    $queryBorrarLista = mysqli_query($conectar, $sqlBorrarLista);
    }
    
  }
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Do Things| Inicio</title>

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
  <!-- CSS propio -->
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
            <h1 class="m-0">Do Things | Inicio</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $rowNumListas;?></h3>
                <p>Listas creadas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="listasUSu.php" class="small-box-footer">Ver mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            
            <!-- Do Things List -->
            <form action="" method="POST">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <h4>Crear nueva lista</h3>
                    <i class="ion ion-clipboard mr-2"></i>
                    <input class="form nombreLista" type="text" name="nombreLista" placeholder=" Titulo Lista *" required>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Guardar Lista</a></button>
                  </h3>
                </div>
                <div class="card-body nuevaTarea">
                  <form action="" method="POST">
                    <input type="text" class="form form-control" name="nuevaTarea" placeholder="Tarea">
                    <button type="submit" class="btn-plus"><i class="fas fa-plus"></i></button>
                  </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <h4>Mis listas</h4>
                  <ul class="todo-list" data-widget="todo-list">
                    <?php 
                      /*Actualizacion de listas creadas*/

                      $sqlListas = "
                        SELECT *
                          FROM lista
                          WHERE id_usuario LIKE '".$_SESSION['idUsu']."' 
                            AND estado_lista LIKE 'activa';
                      ";

                      $queryListas = mysqli_query($conectar, $sqlListas);

                      while ($rowListas = mysqli_fetch_assoc($queryListas)) {
                        ?>
                        <li>
                          <a href="lista.php?idLista=<?php echo $idLista?>" class="enlaceLista">
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
                            <span class="text"><?php echo $rowListas['nombre_lista']?></span>
                          </a>
                          <!-- opciones tarea-->
                          <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash" type="button" data-toggle="modal" data-target="#modal-borrar"></i>
                          </div>
                        </li>
                        <?php
                      }
                    ?>
                  </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </form>
              
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Calendar -->
            
            <!-- /.card -->
          </section>
          <!-- right col -->
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
      echo $year; ?> Backend desarrollado por <a href="https://soniadg.com">Sonia Diaz</a>.
    </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modal Eliminar -->
<form action="" method="GET">
  <div class="modal fade" id="modal-borrar">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $nombreQueListaBorrar;?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¡Hola <?php echo $_SESSION['nombreUsu']?>! <br> ¿Quieres <strong>borrar</strong> la lista "<?php echo $nombreQueListaBorrar;?>"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn-cancelar btn-outline-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn" name="borrarLista">Confirmar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</form>


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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/rsc/files/plantilla/dist/js/pages/dashboard.js"></script>
<!-- iconicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
