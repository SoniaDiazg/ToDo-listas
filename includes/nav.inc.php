<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="main.php" class="brand-link">
      <img src="assets/rsc/img/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ToDo Listas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/rsc/img/fotoUsuario.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="perfil.php" class="d-block">Alexander Pierce</a>
        </div>
      </div>   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-solid fa-list"></i>
              <p>
                Mis listas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="nuevaLista.php" class="nav-link">
                  <i class="fa fa-solid fa-plus nav-icon"></i>
                  <p>Nueva Lista</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="verListas.php" class="nav-link">
                  <i class="fa fa-solid fa-eye nav-icon"></i>
                  <p>Ver Listas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="perfil.php" class="nav-link">
              <i class="nav-icon fa fa-solid fa-user"></i>
              <p>
                Mi perfil
              </p>
            </a>
          <li class="nav-item">
            <a href="calendario.php" class="nav-link" target="_blank">
              <i class="nav-icon fa fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
              <i class="nav-icon fa fa-th-large"></i>
              <p>Personalización</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>