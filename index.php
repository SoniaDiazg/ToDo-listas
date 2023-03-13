<?php 
  $mensajeClave = "";
  $mensajeRegistro = "";
  $mesajeUsuarioExist = "";
  $mensajeLogin = "";
  $usuarioExist = false;
  $formRegistro = "";
  $formLogin = "";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
    
  require_once 'admin/rsc/files/PHPMailer/Exception.php';
  require_once 'admin/rsc/files/PHPMailer/PHPMailer.php';

  if ($_POST) {
    if ($_POST['formRegistro']) {
      require_once "admin/includes/conexion.inc.php";
      /*===================
      Registro nuevo usuario
      =====================*/
      if ((isset($_POST['nombreRegistro']) && !empty($_POST['nombreRegistro'])) && (isset($_POST['correoRegistro']) && !empty($_POST['correoRegistro'])) && (isset($_POST['claveRegistro']) && !empty($_POST['claveRegistro'])) && (isset($_POST['confClaveRegistro']) && !empty($_POST['confClaveRegistro']))) {
  
        $sqlComprobacion = "
          SELECT *
            FROM usuario;
        ";
  
        $queryComprobacion = mysqli_query($conectar, $sqlComprobacion);
  
        while ($rowComprobacion = mysqli_fetch_assoc($queryComprobacion)) {
          $usuarioExistente = $rowComprobacion['correo_usuario'];
  
          if ($_POST['correoRegistro'] == $usuarioExistente) {
            $usuarioExist = true;
            $mesajeUsuarioExist = "Este usuario ya existe, por favor inicia sesión para continuar";
          }
        }

        if (!$usuarioExist) {
          if ($_POST['claveRegistro'] == $_POST['confClaveRegistro'] ) {
            $miClave = $_POST['claveRegistro'];
            $miClaveEnc = password_hash($miClave, PASSWORD_DEFAULT);
    
            $sqlRegistro = "
              INSERT INTO usuario
                VALUES (null, '".$_POST['nombreRegistro']."', '".$_POST['correoRegistro']."',  '".$miClaveEnc."', 0, '', 'no validado',  'admin/assets/rsc/img/fotoUsuario.png');
            ";
    
            $queryRegistro = mysqli_query($conectar, $sqlRegistro);

            /*==============================
            Validacion usuario: envio email
            ================================*/
            
            $correo = new PHPMailer();
                
            $correo->setFrom('no-reply.validacion.timelist@soniadg.com','TimeList');
            $correo->addAddress($_POST['correoRegistro'],$_POST['nombreRegistro']);
            $correo->Subject = 'Valida tu cuenta en TimeList';
            $correo->MsgHTML('<h1>Hola, necesitamos que valides tu cuenta para continuar</h1>
            <br>
            <p>Haz click <a href="validacion.php?correousu='.$_POST['correoRegistro'].'">aqui</a> para validar tu cuenta y continuar con el registro</p>');
            
            if(!$correo->send()){
                echo "Ocurrió un error en tu registro, por favor contacta con el administrador del sitio";
            }else{
              $mensajeRegistro = "¡Genial! ya tienes tu cuenta confirmada, revisa tu bandeja de entrada y/o Spam para verificar tu usuario";
              
              $sqlSacaId = "
                  SELECT id_usuario
                      FROM usuario
                      WHERE correo_usuario LIKE '".$_POST['correoRegistro']."';
              ";
              
              $querySacaId = mysqli_query($conectar, $sqlSacaId);
              
              while($rowSacaId = mysqli_fetch_assoc($querySacaId)){
                  mkdir('users/'.$rowSacaId['id_usuario']);
              }
            }
          }else {
            $mensajeClave = "La contraseña no coincide, por favor repite la contraseña";
          }
        }
      }
    } elseif ($_POST['formLogin']) {
      require_once "admin/includes/conexion.inc.php";
      /*==============
      Login Usuario
      ================*/
      if ((isset($_POST['correo']) && !empty($_POST['correo'])) && (isset($_POST['clave']) && !empty($_POST['clave']))) {
        
  
        $sqlLogin = "
          SELECT *
            FROM usuario
            WHERE correo_usuario LIKE '".$_POST['correo']."';
        ";
  
        $queryLogin = mysqli_query($conectar, $sqlLogin);
  
        
        while ($rowLogin = mysqli_fetch_assoc($queryLogin)) {
  
          if (($_POST['correo'] == $rowLogin['correo_usuario']) && (password_verify($_POST['clave'], $rowLogin['clave_usuario']))) {
            session_start();  
            $_SESSION['verificacion'] = true;
            $_SESSION['nombreUsu'] = $rowLogin['nombre_usuario'];
            $_SESSION['fotoUsu'] = $rowLogin['foto_usuario'];
            $_SESSION['idUsu'] = $rowLogin['id_usuario'];
            $_SESSION['correoUsu'] = $rowLogin['correo_usuario'];
            $_SESSION['estadoUsu'] = $rowLogin['estado_usuario'];
            header('location:main.php');
          } else {
            $mensajeLogin = "Email y/o contraseña incorrectos";
          }
        } 
      } 
    }
  }
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TimeList | Iniciar Sesión</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/dist/css/adminlte.min.css">
  <!-- CSS propio -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- SweetAlert -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="flex-direction: row; justify-content: space-evenly;">

<!-- registro-box -->
<div class="register-box">
  <div class="card card-outline card-orange">
    <div class="card-header text-center">
      <h2><b>Time</b>List</h2>
	  <p class="mensajeLogin">¿No tienes cuenta? <b>Registrate Aquí</b></p>
    </div>
    <div class="card-body">
      
      <!-- Formulario nuevo usuario -->
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre y apellidos*" name="nombreRegistro" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email*" name="correoRegistro" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Crear contraseña*" name="claveRegistro" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Repite la contraseña*" name="confClaveRegistro" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row" style="justify-content: center;">
          <!-- /.col -->
          <div class="col-11">
            <input type="submit" class="btn btn-success btn-block" name="formRegistro"></input>
            <br>
            <p style="text-align:center">Todos los campos con (*) son obligatorios.</p>
            <p id="mensajeClave"><?php echo $mensajeClave; ?></p>
            <p id="mensajeRegistro"><?php echo $mensajeRegistro; ?></p>
            <p><?php echo $mesajeUsuarioExist ?></p>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.registro-box -->

<hr>

<!-- login-box -->
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-orange">
		<div class="card-header text-center">
			<h2><b>Time</b>List</h2>
		</div>
		<div class="card-body">
		  <p class="mensajeRegistro"><b>INICIAR SESIÓN</b></p>

      <!-- Formulario login -->
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="correo" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="clave" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row" style="justify-content: space-between !important">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="recordarCuenta">
              <label for="remember">
                Recuérdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div style="padding-left: 7.5px; padding-right: 7.5px">
            <input type="submit" class="btn btn-primary" name="formLogin">Iniciar Sesión</input>
          </div>
          <!-- /.col -->
        </div>
      </form>

        <p class="mb-1">
          <a href="forgot-password.html">Olvidé mi contraseña</a>
        </p>
        <p><?php echo $mensajeLogin; ?></p>
	  </div>
		<!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->



<!-- jQuery -->
<script src="assets/rsc/files/plantilla/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/rsc/files/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
</body>
</html>
