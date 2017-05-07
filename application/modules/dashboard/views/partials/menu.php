<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">AEx</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= $appTitle ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    </nav>
</header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?= @$menu['item'] == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= $basePath.'dashboard' ?>">
                <i class="fa fa-book"></i> <span>Dashboard</span>
            </a>
        </li>
            <li class="<?= @$menu['item'] == 'usuarios' ? 'active' : '' ?> treeview">
              <a href="">
                  <i class="fa fa-users"></i>
                  <span>Usuários</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?= @$menu['subitem'] == 'listagem' ? 'active' : '' ?>" >
                      <a href="<?= $basePath.'usuarios/listagem' ?>">
                          <i class="fa fa-list"></i> Listagem
                      </a>
                  </li>
                  <li class="<?= @$menu['subitem'] == 'criar' ? 'active' : '' ?>" >
                      <a href="<?= $basePath.'usuarios/criar' ?>">
                          <i class="fa fa-plus"></i> Criar Usuário
                      </a>
                  </li>
              </ul>
          </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>