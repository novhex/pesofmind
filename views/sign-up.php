<?php
	use \Helpers\System_helpers as Helper;
	use \Plugins\GUMP;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<h1> Member Registration</h1>
			<hr>
			<div class="col-md-12">
            <?php
            
            if(!empty($errors) && is_string($errors)){
                    
                    echo "<div class='' style='color:red;'>* ".$errors."</div>";
            }

            ?>
          
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo Helper::base_url().'submit-registration' ?>">
                       
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" />
                                <?php
                                if(is_array($errors)){
                                ?>
                                <span style="color:red;"><?php echo GUMP::field_error('name',$errors,'* Please provide your name'); ?></span>
                                <?php }?>
                            </div>
                            
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="" />
                               <?php
                                if(is_array($errors)){
                                ?>
                                <span style="color:red;"><?php echo GUMP::field_error('lastname',$errors,'* Please provide your last name'); ?></span>
                                 <?php }?>
						 </div>

                        </div>




                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" />
                                <?php
                                if(is_array($errors)){
                                ?>
                                <span style="color:red;"><?php echo GUMP::field_error('email',$errors,'* Please provide your valid email'); ?></span>
                                 <?php }?>
                         	</div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" />
                                <?php
                                if(is_array($errors)){
                                ?>
                                <span style="color:red;"><?php echo GUMP::field_error('name',$errors,'* Please provide password'); ?></span>
                                <?php }?>
                         </div>

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="passwordconfirmation" />
                                <?php
                                if(is_array($errors)){?>
                                <span style="color:red;"><?php echo GUMP::field_error('passwordconfirmation',$errors,'* Password confirmation should match with password field'); ?></span>
                                <?php }?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                                <button type="reset" class="btn btn-warning">
                                	Clear Fields
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
