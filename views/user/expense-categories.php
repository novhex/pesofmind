    <?php
  use \Helpers\System_helpers as Helper;
?>
    <!-- Main content -->
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Expense Category
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-shopping-cart"></i> User's Expense Categories</a></li>
      </ol>
    </section>
    <section class="content">



<a style="margin-bottom: 10px;" href="<?php echo Helper::base_url().'new-expense-category';?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add </a>

<div class="box box-success">
     
     

            <div class="box-body">
            
            <div class="table-responsive">
              <table class="table table-condensed table-stripped table-hover">
                <thead>

                  <th> </th>
                  <th> Category Name </th>
                  <th> Description </th>
                  <th> Date Added </th>
                  <th> Options </th>

                </thead>
                <tbody>
                    <?php $i=1; foreach($contents as $content):?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $content['expense_name']; ?></td>
                        <td><?php echo $content['expense_desc']; ?></td>
                        <td><?php echo $content['date_added']; ?></td>
                        <td>
                          <a href="<?php echo Helper::base_url().'edit-category/'.$content['expense_name_uid']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                          <a href="<?php echo Helper::base_url().'delete-category/'.$content['expense_name_uid']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="text-center"><?php echo $page_links; ?></div>
            </div>

            </div>

            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
  