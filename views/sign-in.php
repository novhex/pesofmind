<?php
	use \Helpers\System_helpers as Helper;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<h1>Sign In</h1>
			<hr>
			        <div class="col-md-8 col-md-offset-2">
     
                    <form class="form-horizontal" role="form" method="POST" action="<?php  echo Helper::base_url().'auth'; ?>">
                        
                        <?php
                        // Validate if $errors var is not empty and the value is array of error message

                        	if(!empty($errors) && is_array($errors)){

                        		echo "<div class='alert alert-danger'>";
                        		foreach($errors as $err):
                        			echo "<li>".$err."</li>";
                        		endforeach;
                        		echo "</div>";
                        	}

                        	// Validate if $errors var is not empty and the value is string
                        	else if(!empty($errors) && is_string($errors)){
                        		echo "<div class='alert alert-danger'>".$errors."</div>";
                        	}
                        ?>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" />

                           </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="http://twitbook.app/password/reset">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>