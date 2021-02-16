<?php
error_reporting(0);
include('includes/config.php');
session_start();
if(!isset( $_SESSION['email']))
{
  header('location:Reg_login.php');
}
else
{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;
$sql = "UPDATE transaction_history SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Testimonial Successfully Inacrive";
}

if(isset($_REQUEST['del']))
	{
$did=intval($_GET['del']);
$sql = "delete from transaction_history WHERE  id=:did";
$query = $dbh->prepare($sql);
$query-> bindParam(':did',$did, PDO::PARAM_STR);
$query -> execute();

$msg="Record deleted Successfully ";
}



 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>TSF | Transaction Details   </title>
	<link rel = "icon" href = "images/icon.gif" 
        type = "image/x-icon"> 
        <script src="https://kit.fontawesome.com/43a7d476c9.js" crossorigin="anonymous"></script>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css_admin/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css_admin/bootstrap.min.css">


	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">


	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css_admin/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css_admin/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css_admin/bootstrap-select.css">
	<!--Bootstrap file input-->
	
	<link rel="stylesheet" href="css_admin/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css_admin/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css_admin/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">TRANSACTION DETAILS</h2>
						<?php echo '<strong><h4 style="color:green">'.$_SESSION['email'].'</h4></strong>'; ?>


						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">USER QUERIES</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<a href="download-trans.php" style="color:red; font-size:16px;">DOWNLOAD EVENT LIST</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>SENDER_ACCOUNT NO</th>
											<th>RECEIVER_ACCOUNT NO</th>
											<th>AMOUNT TRANSFERED</th>
											<th>TRANSACTION DATE</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>SENDER_ACCOUNT NO</th>
											<th>RECEIVER_ACCOUNT NO</th>
											<th>AMOUNT TRANSFERED</th>
											<th>TRANSACTION DATE</th>
											<th>ACTION</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from  transaction_history ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->SENDER);?></td>
											<td><?php echo htmlentities($result->RECEIVER);?></td>
											<td><?php echo htmlentities($result->AMOUNT);?></td>
											<td><?php echo htmlentities($result->DATE_TIME);?></td>
																<?php if($result->status==1)
{
	?><td>Read<br />
		<a href="Transaction_details.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to read')" >Delete</a></td>
<?php } else {?>

<td><a href="Transaction_details.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to read')" >Pending</a><br />
	<a href="manage-conactusquery.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to read')" >Delete</a>
</td>
<?php } ?>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>










<?php include('includes/footer.php');?>
	<!-- Loading Scripts -->
	<script src="js_admin/jquery.min.js"></script>
	<script src="js_admin/bootstrap-select.min.js"></script>
	<script src="js_admin/bootstrap.min.js"></script>
	<script src="js_admin/jquery.dataTables.min.js"></script>
	<script src="js_admin/dataTables.bootstrap.min.js"></script>
	<script src="js_admin/Chart.min.js"></script>
	<script src="js_admin/fileinput.js"></script>
	<script src="js_admin/chartData.js"></script>
	<script src="js_admin/main.js"></script>
	
</body>
</html>
<?php } ?>

