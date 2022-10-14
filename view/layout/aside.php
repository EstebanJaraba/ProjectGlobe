<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="assets/dist/img/icon empre.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">GLOBE</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['nombreCompleto'] ?></a>        
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="inicio.php" class="nav-link">
            <i class="bi bi-house-door"></i>
            <p>&nbsp;&nbsp;&nbsp;Inicio</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="index.php" class="nav-link ">
            <i class="bi bi-speedometer2"></i>
            <p>
              &nbsp;&nbsp;&nbsp;Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="user.php" class="nav-link">
            <i class="bi bi-people"></i>
            <p>&nbsp;&nbsp;&nbsp;Gestión usuarios</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="bi bi-cart3"></i>
            <p>
              &nbsp;&nbsp;&nbsp;Gestión compras
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="compra.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Compra</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="proveedor.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Proveedores</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="insumo.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Insumos</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="bi bi-bag-check"></i>
            <p>
              &nbsp;&nbsp;&nbsp;Gestión ventas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="ventas.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Ventas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="servicios.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Servicios</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="clientes.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="bi bi-gear"></i>
            <p>
              &nbsp;&nbsp;&nbsp;Configuración
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="rol.php" class="nav-link">
                <i class="bi bi-chevron-double-right nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="calendar.php" class="nav-link">
            <i class="bi bi-calendar-event"></i>
            <p class="text">&nbsp;&nbsp;&nbsp;Agenda</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="bi bi-info-circle"></i>
            <p>&nbsp;&nbsp;&nbsp;Ayuda</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>