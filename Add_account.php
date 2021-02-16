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
if(isset($_POST['submit']))
  {
$fullname=$_POST['fullname'];
$mobile=$_POST['mobileno'];
$ACCOUNT_NO=$_POST['ACCOUNT_NO'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$account_type=$_POST['account2_type'];
$address=$_POST['address'];
$status=1;
$sql="INSERT INTO  account_holders(FullName,MobileNumber,ACCOUNT_NO,Age,Account_Type,Address,status) VALUES(:fullname,:mobile,:ACCOUNT_NO,:age,:account2_type,:address,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':ACCOUNT_NO',$ACCOUNT_NO,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':account2_type',$account_type,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Your info submitted successfully";
}
else 
{
$error="Something went wrong. Please try again";
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

    <title>TSF | ADD NEW_ACCOUNT</title>
    <link rel = "icon" href = "images/icon.gif" 
        type = "image/x-icon"> 
     <script src="https://kit.fontawesome.com/43a7d476c9.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
<br>

    <!-- Page Content -->
    <div class="container text-center">

        <!-- Page Heading/Breadcrumbs -->
       <div class=" py-2 input-group-text bg-warning"><h1 class="mt-4 mb-3 text-light rounded"><i class="fas fa-swatchbook"></i> Book Your Event</h1></div>
       <?php echo '<strong><h5 style="color:green">'.$_SESSION['email'].'</h5></strong>'; ?>


        <ol class="breadcrumb input-group-text bg-muted">
            <li class="breadcrumb-item ">
                <a href="home.php"><strong>HOME</strong></a>
            </li>
            <li class="breadcrumb-item active"><strong>ADD EVENT<strong></li>
        </ol>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <!-- Content Row -->
        <form name="donar" method="post">
<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">FULL NAME<span style="color:red">*</span></div>
<div><input type="text" name="fullname" class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">MOBILE NUMBER<span style="color:red">*</span></div>
<div><input type="text" name="mobileno" class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">ACCOUNT_NO</div>
<div><input type="text" name="ACCOUNT_NO" class="form-control"></div>
</div>
</div>

<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">AGE<span style="color:red">*</span></div>
<div><input type="text" name="age" class="form-control" required></div>
</div>


<div class="col-lg-4 mb-4">
<div class="font-italic">ACCOUNT_TYPE<span style="color:red">*</span> </div>
<div><select name="account2_type" class="form-control" required>
        <option>Select your Account type...</option>
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
</div> 


<div class="col-lg-4 mb-4">
<div class="font-italic">ADDRESS</div>
<div><textarea class="form-control" name="address"></textarea></div>
</div>
<br>
<div class="col-lg-4 mb-4">
<div><input type="submit" name="submit" class="btn btn-primary" value="SUBMIT" style="cursor:pointer"></div>
</div>



</div>



        <!-- /.row -->
</form>   
        <!-- /.row -->


<br>
<br>


  

     </div>




  <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html> <?php } ?>
