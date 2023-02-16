<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToDo Listas | Iniciar Sesión</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/rsc/files/plantilla/dist/css/adminlte.min.css">
  <!-- CSS propio -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="hold-transition login-page" style="flex-direction: row; justify-content: space-evenly;">

<!-- registro-box -->
<div class="register-box">
  <div class="card card-outline card-orange">
    <div class="card-header text-center">
      <h2><b>ToDo</b>Listas</h2>
	  <p class="mensajeRegistro">¿No tienes cuenta?<b>Registrate Aquí</b></p>
    </div>
    <div class="card-body">
      

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre y apellidos*" name="nombreRegistro">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email*" name="correoRegistro" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Crear contraseña*" name="claveRegistro">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Repite la contraseña*">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row" style="justify-content: center;">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Continuar</button>
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
			<h2><b>ToDo</b>Listas</h2>
		</div>
		<div class="card-body">
		<p class="mensajeRegistro"><b>INICIAR SESIÓN</b></p>

		<form action="" method="post">
			<div class="input-group mb-3">
			<input type="email" class="form-control" placeholder="Email" name="correo">
			<div class="input-group-append">
				<div class="input-group-text">
				<span class="fas fa-envelope"></span>
				</div>
			</div>
			</div>
			<div class="input-group mb-3">
			<input type="password" class="form-control" placeholder="Password" name="clave">
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
				<button type="submit" class="btn btn-primary">Iniciar Sesión</button>
			</div>
			<!-- /.col -->
			</div>
		</form>

		<p class="mb-1">
			<a href="forgot-password.html">Olvidé mi contraseña</a>
		</p>
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
</body>
</html>
