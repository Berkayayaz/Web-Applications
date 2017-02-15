<?php
require('../model/database.php');
require('../model/query/db_user.php');
require('../model/query/db_test.php');
require('../model/query/db_category.php');
$allcategories=get_all_categories();
$allusers = get_all_users();
$alltests = get_all_tests();
$numberofusers=count($allusers);
$total_fail_attempts=0;
$total_succeed_attempts=0;
$total_attempts=count($alltests);
$online_users = 0;
$currentlytaketest=0;
$avg_score=0;
$total_number_of_categories = count($allcategories);
foreach ($allusers as $user){
	if ($user['status'] == 1 ||  $user['status'] == 2 ){
		$online_users++;
	}
    if ($user['status'] == 2  ){
		$currentlytaketest++;
	}
	
}
foreach ($alltests as $test){
	if ($test['passed']==1){
		$total_succeed_attempts++;
	}
	else{
		$total_fail_attempts++;
	}
	$avg_score+=$test['score'];
}
if ($total_attempts ==0){
$avg_score=0;
}
else
{
	$avg_score =round( $avg_score / $total_attempts);
}
include('../view/header.php');
include('../view/admin_menu_bar.php');
?> 

<div class="container-fluid">
    <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Overview</h1>
            <div class="container">
                   <div class="row">
                       
                       <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td>Total Number of Users</td>
                            <td><?php echo $numberofusers;?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Online Users</td>
                            <td><?php echo $online_users;?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Users Currently Taking a Test</td>
                            <td><?php echo $currentlytaketest;?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Attempts</td>
                            <td><?php echo $total_attempts;?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Successful Attempts</td>
                            <td><?php echo $total_succeed_attempts;?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Successful Attempts</td>
                            <td><?php echo $total_succeed_attempts; ?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Faild Attempts</td>
                            <td><?php echo $total_fail_attempts; ?></td>
                        </tr>
                        <tr>
                            <td>Avarage Score of All Attempts</td>
                            <td><?php echo $avg_score; ?></td>
                        </tr>
                        <tr>
                            <td>Total Number of Categories</td>
                            <td><?php echo $total_number_of_categories; ?></td>
                        </tr>
                        
                    </tbody>
                </table>
			
			</div>
                </div>
            </div>
        </div>
</div>

<?php include '../view/footer.php'; ?>
