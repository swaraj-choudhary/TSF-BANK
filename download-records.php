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
											<th>Name</th>
											<th>Mobile No</th>
											<th>Email</th>
											<th>Gender</th>
											<th>Age</th>
											<th>address</th>
											<th>posting date </th>
										</tr>
									</thead>

<?php 
$filename="View_users";
$sql = "SELECT * from  account_holders ";
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
<td>'.$FullName= $result->FullName.'</td> 
<td>'.	$MobileNumber= $result->MobileNumber.'</td> 
<td>'.$EmailId= $result->EmailId.'</td> 
<td>'.$Gender= $result->Gender.'</td> 
<td>'.$Age= $result->Age.'</td>	
  <td>'.$Address=$result->Address.'</td>	 
  <td>'.$Date=$result->PostingDate.'</td>	 					
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