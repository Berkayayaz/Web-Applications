<?php
require('../model/database.php');
require('../model/query/db_category.php');

if (isset($_POST['submit_add_category'])) {
    $temp_category_name = filter_input(INPUT_POST, 'category-name');
    add_category($temp_category_name);
}

if (isset($_POST['delete_cat_btn'])) {
    $temp_category_id = filter_input(INPUT_POST, 'category_id');
    echo $temp_category_id;
    delete_category($temp_category_id);
}

$allCategories = get_all_categories();

include('../view/header.php');
include('../view/admin_menu_bar.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Quiz List</h1>
        

            <div class="form-group">
                <div class="col-xs-6 col-sm-6 col-lg-8">
                    <form role="form" action="add_category_admin.php" method="POST">
                        <button class="btn btn-primary" type="submit" style="top:10px; left:50px;" >Add Quiz</button>
                    </form>
                </div>
            </div>
            
            <div class="form-group pull-right">
                <input type="text" class="search form-control" placeholder="Search..">
            </div>
            
            <span class="counter pull-right"></span>
            <table class="table table-hover table-bordered results">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-5 col-xs-5">Quiz Name</th>
                        <th class="col-md-5 col-xs-5">Number of Questions</th>
                        <th class="col-md-5 col-xs-5">Status</th>
                        <th class="col-md-5 col-xs-5"></th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="6"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $i = 1;
                    foreach ($allCategories as $category) : ?>
                        <tr> 
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $category['categoryName']; ?></td>
                            <td class="category_id_cell"><?php echo ($category['categoryID']); ?></td>
                           <td> <?php  if($category['status']==0){ echo 'Active'; }else{ echo 'Deactive';}; ?> </td>

                            <td>
                                <form action="edit_category_list.php" method="post">
                                    <input type="hidden" name="action"
                                           value="edit_user">
                                    <input type="hidden" name="category_id" id="category_id"
                                               value="<?php echo $category['categoryID']; ?>">

                                    <input class="btn-warning" type="submit" name="edit_category" value="Edit">
                                </form>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="../js/searchbar.js"></script>

<?php include '../view/footer.php'; ?>
