<?php
	use \Helpers\System_helpers as Helper;
?>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php  echo Helper::base_url(); ?>">
            <img src="<?php echo Helper::base_url().'assets/logo.png'; ?>" style="margin-top: -17px;">
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php  echo Helper::base_url(); ?>">Home</a></li>
              <li><a href="<?php  echo Helper::base_url().'about'; ?>">About</a></li>
              <li><a href="<?php  echo Helper::base_url().'sign-up'; ?>">Sign Up</a></li>
              <li><a href="<?php  echo Helper::base_url().'sign-in'; ?>">Sign In</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>