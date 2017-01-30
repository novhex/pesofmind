<?php
  use \Plugins\GUMP;
  use \Helpers\System_helpers as Helper;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Expense Category
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-shopping-cart"></i> Expense Category</a></li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
              <?php
                  if(!empty($errors) && is_array($errors)){

                      echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                      foreach($errors as $err):
                        echo "<li>".$err."</li>";
                      endforeach;
                      echo "</div>";
                    }

                if(is_string($success_msg)&& strlen($success_msg)){

                  echo "<div class='alert alert-success'>  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-thumbs-o-up'></i><strong>
".$success_msg."</strong></div>";
                }
              ?>
<div class="box box-success">
    
            <div class="box-body">

              <form action="<?php echo Helper::base_url().'submit-expense-category'; ?>" method="POST" accept-charset="utf-8">
              <div class="form-group">
                <label>Expense Category Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input type="text" class="form-control" name="expensename" placeholder=" (Ex : Groceries,Travel,Shopping etc..)" />
                  
                </div>
                
              </div>
              <!-- /.form group -->

              <div class="form-group">
                <label>Expense Description: </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-info-circle"></i>
                  </div>
                  <input type="text" class="form-control" name="expensedesc" placeholder="Short Description (max 160 characters)" />
                </div>
                
              </div>
              <!-- /.form group -->


              <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
              </div>

            </form>

            </div>

            <!-- /.box-body -->
  </div>

    </section>
    <!-- /.content -->
  