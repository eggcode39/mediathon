<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= _SERVER_;?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-folder"></i>
        </div>
        <div class="sidebar-brand-text mx-3">EggPHP <sup><?= _VERSION_;?></sup></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= _SERVER_;?>">
          <i class="fa fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menú
      </div>
        <?php
        $raioz = 1;
        foreach ($navs as $nav){
            $nav_link = "nav-link collapsed";
            $aria_expanded = "false";
            $collapse = "collapse";
            if($nav->menu_controller == $_SESSION['controlador']){
                $nav_link = "nav-link";
                $aria_expanded = "true";
                $collapse = "collapse show";

                $_SESSION['controlador'] = $nav->menu_name;
                $_SESSION['icono'] = $nav->menu_icon;
                //Obtener el Nombre del Controlador y de la Funcion
                $name = $this->nav->listOptionName($_SESSION['controlador'], $_SESSION['accionnav']);
                (isset($name->optionm_name)) ? $_SESSION['accion'] = $name->optionm_name : $_SESSION['accion'] = "";
            }?>
            <li class="nav-item">
                <a class="<?= $nav_link;?>" href="#" data-toggle="collapse" data-target="#collapseMenu<?= $raioz;?>" aria-expanded="<?= $aria_expanded;?>" aria-controls="collapseMenu<?= $raioz;?>">
                    <i class="<?= $nav->menu_icon;?>"></i>
                    <span><?= $nav->menu_name;?></span>
                </a>
                <div id="collapseMenu<?= $raioz;?>" class="<?= $collapse;?>" aria-labelledby="headingMenu<?= $raioz;?>" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones:</h6>
                        <?php
                        $option = $this->nav->listOptions($nav->id_menu);
                        foreach ($option as $o){
                            ?>
                            <a class="collapse-item" href="<?= _SERVER_. $nav->menu_controller . '/'. $o->optionm_function;?>"><?= $o->optionm_name;?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </li>
            <?php
            $raioz++;
        }
        ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->crypt->decrypt($_SESSION['p_n'],_FULL_KEY_);?></span>
                <img class="img-profile rounded-circle" src="<?= _SERVER_ . $this->crypt->decrypt($_SESSION['u_i'],_FULL_KEY_);?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo _SERVER_;?>Edit/info">
                  <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Editar Datos
                </a>
                <a class="dropdown-item" href="<?php echo _SERVER_;?>Edit/changepass">
                  <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Contraseña
                </a>
                <!--<a class="dropdown-item" href="<?php echo _SERVER_;?>Edit/changeUser">
                  <i class="fa fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo _SERVER_;?>logout/singOut">
                  <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
                  <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fa fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>-->
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->