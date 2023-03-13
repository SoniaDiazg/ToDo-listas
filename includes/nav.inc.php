<?php 
require_once 'admin/includes/conexion.inc.php';
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="main.php" class="brand-link">
      <img src="assets/rsc/img/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Do Things</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $_SESSION['fotoUsu'];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="perfil.php?idUsu=<?php echo $_SESSION['idUsu']?>" class="d-block"><?php echo $_SESSION['nombreUsu'];?></a>
        </div>
      </div>   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="main.php" class="nav-link">
              <i class="nav-icon fa fa-solid fa-list"></i>
              <p>
                Mis listas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="perfil.php?idUsu=<?php echo $_SESSION['idUsu']?>" class="nav-link">
              <i class="nav-icon fa fa-solid fa-user"></i>
              <p>
                Mi perfil
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>