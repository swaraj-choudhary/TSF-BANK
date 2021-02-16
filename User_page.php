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
if(isset($_POST['send']))
  {
$RECEIVER=$_POST['RECEIVER'];
$AMOUNT=$_POST['AMOUNT'];
$SENDER=$_POST['SENDER'];
$sql="INSERT INTO  transaction_history(SENDER,RECEIVER,AMOUNT) VALUES(:SENDER,:RECEIVER,:AMOUNT)";
$query = $dbh->prepare($sql);
$query->bindParam(':SENDER',$SENDER,PDO::PARAM_STR);
$query->bindParam(':RECEIVER',$RECEIVER,PDO::PARAM_STR);
$query->bindParam(':AMOUNT',$AMOUNT,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Transaction done Successfully";
}
else 
{
$error="Transaction Failed";
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TSF | User Account</title>
    <link rel = "icon" href = "images/icon.gif" 
        type = "image/x-icon"> 

    <script src="https://kit.fontawesome.com/43a7d476c9.js" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">SEARCH USER</h1>
        <?php echo '<strong><h5 style="color:green">'.$_SESSION['email'].'</h5></strong>'; ?>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="home.php">HOME</a>
            </li>
            <li class="breadcrumb-item active">SEARCH USER</li>
        </ol>



            <?php if($error){
                ?><div class="errorWrap"><strong>ERROR</strong>:
                    <?php echo htmlentities($error); ?>
                     </div>
                     <?php
                 } 
        else if($msg){
            ?>
            <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
            </div><?php
             }?>
        <!-- Content Row -->
        <form name="User_page" method="post">
<div class="row">


<!--

<div class="col-lg-4 mb-4">
<div class="font-italic">ACCOUNT TYPE<span style="color:red">*</span> </div>
<div><select name="account_type2" class="form-control" required>
<?php $sql = "SELECT * from  account_type ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->Type);?>"><?php echo htmlentities($result->Type);?></option>
<?php }} ?>
</select>
</div>
</div> -->





<div class="col-lg-4 mb-4">
<div class="font-italic">ACCOUNT_NO</div>
<div><input type="text" class="form-control" name="ACCOUNT_NO" required="required"></div>
</div>
<br>

<div class="row">
<div class="col-lg-4 mb-4">
<div><input type="submit" name="submit" class="btn btn-primary" value="SUBMIT" style="cursor:pointer"></div>
</div>
</div>
       <!-- /.row -->
</form>   

        <div class="row">
                   <?php 
if(isset($_POST['submit']))
{
$status=1;
$ACCOUNT_NO=$_POST['ACCOUNT_NO'];
$sql = "SELECT * from account_holders where (status=:status and ACCOUNT_NO =:ACCOUNT_NO)";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':ACCOUNT_NO',$ACCOUNT_NO,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

            <div class="col-lg-6 col-sm-4 portfolio-item">
                <div class="card h-40">
                    <a href="View_users.php"><img class="card-img-top img-fluid" src="images/user.png" ></a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="View_users.php"><?php echo htmlentities($result->FullName);?></a></h4>
                        <p class="card-text">
                            <Strong><h6>ACCOUNT_NO</h6></Strong>
                        <?php if($result->ACCOUNT_NO=="")
                        {
                        echo htmlentities(NA);
                        } else {
echo htmlentities($result->ACCOUNT_NO);
}
?><br><b>Mobile No</b> <?php echo htmlentities($result->MobileNumber);?> <br>  
                             </p>
<p class="card-text"><b> Age:</b> <?php echo htmlentities($result->Age);?></p>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
 Transcit
</button>

<!-- Modal -->

<form name="Paymoney"  method="post">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Transfer Money</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">






      <div class="row">
            <!-- Map Column -->
              <div class="col-lg-8 mb-4">
                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                <form name="sentMessage"  method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>RECEIVER ACCOUNT NO:</label>
                            <input type="text" class="form-control" id="name" name="RECEIVER" required data-validation-required-message="Please enter Receiver name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>SENDER ACCOUNT NO :</label>
                            <input type="text" class="form-control" id="phone" name="SENDER"  required data-validation-required-message="Please enter sender name.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>AMOUNT:</label>
                            <input type="text" class="form-control" id="email" name="AMOUNT" required data-validation-required-message="Please enter your Your  amount.">
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" name="send"  class="btn btn-primary">Pay Money</button>
                </form>
            </div>


            <!-- Contact Details Column -->
          <!--          <?php 
$pagetype=$_GET['type'];
$sql = "SELECT Address,EmailId,ContactNo from tblcontactusinfo";
$query = $dbh -> prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
            <div class="col-lg-6 mb-4">
                <h3>CONTACT DETAILS</h3>
                <p>
                   <?php   echo htmlentities($result->Address); ?>
                    <br>
                </p>
                <p>
                    <abbr title="Phone">P</abbr>: <?php   echo htmlentities($result->ContactNo); ?>
                </p>
                <p>
                    <abbr title="Email">E</abbr>: <a href="mailto:name@example.com"><?php   echo htmlentities($result->EmailId); ?>
                    </a>
                </p>
              <?php }} ?>-->
            </div>
        </div>








    </div>
    <!-- /.container -->












      </div>
      

















                    </div>
                </div>
            </div>

            <?php }}




else
{
echo htmlentities("No Record Found");

}


            } ?>
          
 



        </div>



</div>
  <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
<?php } ?>
