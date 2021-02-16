<?php 
error_reporting(0);
//session_regenerate_id(true);

include('includes/config.php');
session_start();
if(!isset( $_SESSION['email']))
{
  header('location:Reg_login.php');
}
else
{
	?>
<table border="1">
									<thead>
										<tr>
										<th>#</th>
											<th>SENDER_ACCOUNT NO</th>
											<th>RECEIVER_ACCOUNT NO</th>
											<th>AMOUNT TRANSFERED</th>
											<th>TRANSACTION DATE</th>
										</tr>
									</thead>

<?php 
$filename="Transaction_details";
$sql = "SELECT * from  transaction_history";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$SENDER_ACCOUNT= $result->SENDER.'</td> 
<td>'.$RECEIVER_ACCOUNT= $result->RECEIVER.'</td> 
<td>'.$AMOUNT= $result->AMOUNT.'</td> 
<td>'.$DATE= $result->DATE_TIME.'</td> 	 					
</tr>  
';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table> 
 <?php } ?>