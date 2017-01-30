<?php
  use \Helpers\System_helpers as Helper;
  use \Plugins\GUMP;
?>
    <!-- Main content -->
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
New Expense
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Add New Expense</a></li>
      </ol>
    </section>
    <section class="content">

<?php
                if(is_string($success_msg)&& strlen($success_msg)){

                  echo "<div class='alert alert-success'>  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-thumbs-o-up'></i><strong>
".$success_msg."</strong></div>";
                }

              ?>

<div class="box box-success">
        
            <div class="box-body">
              
              <form action="<?php echo Helper::base_url().'submit-expense'; ?>" method="POST" accept-charset="utf-8">

              <div class="form-group">
                <label>Date Spent:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="datespent" class="form-control" />
                  
                </div>
                <span style="color:red;"><?php echo GUMP::field_error('datespent',$errors,'* Please select date'); ?></span>
              </div>
              <!-- /.form group -->


              <div class="form-group">
                <label>Expense Name :</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <input type="text" class="form-control" name="expensename" placeholder="Expense Name" />
                  
                </div>
                <span style="color:red;"><?php echo GUMP::field_error('expensename',$errors,'* Please enter expense name'); ?></span>
              </div>
              <!-- /.form group -->

            
              
              <div class="form-group">
                <label>Amount Spent :</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" class="form-control" name="amountspent" placeholder="0.00" />
                  
                </div>
                <span style="color:red;"><?php echo GUMP::field_error('amount',$errors,'* Please enter amount spent'); ?></span>
              </div>
              <!-- /.form group -->

              
              <div class="form-group">
                <label>Category :</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-list-ol"></i>
                  </div>
                  <select name="expensecateg" class="form-control">
                    <option value="">-Select-</option>
                      <?php foreach($expcateg as $exp_categ): ?>
                        <option value="<?php echo $exp_categ['expense_name_uid']; ?>"><?php echo $exp_categ['expense_name']; ?></option>
                      <?php endforeach; ?>
                  </select>

                </div>
                <span style="color:red;"><?php echo GUMP::field_error('expensecateg',$errors,'* Please select category'); ?></span>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->


              <div class="box-footer">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>

            </form>

            </div>

            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
  