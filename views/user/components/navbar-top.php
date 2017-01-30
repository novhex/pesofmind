  <?php
  use \Helpers\System_helpers as Helper;
?>
  <header class="main-header">
      <!-- Logo -->
      <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>OM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           <img src="<?php echo Helper::base_url().'assets/logo.png'; ?>" style="margin-top: -7px;">
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
           
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo Helper::base_url().'assets/user2-160x160.jpg'; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo Helper::get_session_userdata('usr_fullname'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo Helper::base_url().'assets/user2-160x160.jpg'; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo Helper::get_session_userdata('usr_fullname'); ?>
                    <small>Member since <?php echo date('F  j, Y',strtotime(Helper::get_session_userdata('usr_date_reg'))); ?></small>
                  </p>
                </li>
       
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?php echo Helper::base_url().'user/logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>