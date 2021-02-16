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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TSF |Sparks Banking</title>
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
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }
    </style>

</head>

<body>

    <!-- Navigation -->
<?php include('includes/header.php');?>
<strong><h5 style="color:green"> WELCOME</h5></strong><?php echo '<strong><h5 style="color:green">'.$_SESSION['email'].'</h5></strong>'; ?>
<?php include('includes/slider.php');?>
   
    <!-- Page Content -->
    <div class="container">

        <br>
        <br>

        <h2><strong>A Vision for Event Collaboration<strong><h2><br>
<p><h7>Planning the buffet, placing the mics, laying it all out — it’s not easy making the little details come to life. So in 2020, we set out to change the way events are designed by introducing better collaboration between planners and properties.

Today, we’ve evolved that vision into an innovative platform offering the regular leading solutions for events  like Cultural , Birthday, and many group events . All to help the world create the best face-to-face events happening.<h7></p><br>
 
    <p class="m-2 text-left text-black"><h2><strong><u>SOME OF THE EVENTS HANDLED BY US</u><strong><h2></p>
        


        <div class="row">
                   <?php 
$status=1;
$sql = "SELECT * from account_holders where status=:status order by rand(4) limit 4";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

        <?php if($result->Account_Type == 'Savings account'){
        ?>  
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-30">
                    <a href="Search-donor.php"><img class="card-img-top img-fluid" src="images/Users.png"  ></a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#"><?php echo htmlentities($result->FullName);?></a></h4>
<p class="card-text"></p>
<p class="card-text"></p>

                    </div>
                </div>
            </div>
        <?php } ?>

           


            <?php if($result->Account_Type == 'Salary account'){
        ?>  
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-30">
                    <a href="#"><img class="card-img-top img-fluid" src="images/Users.jpg"  ></a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#"><?php echo htmlentities($result->FullName);?></a></h4>
<p class="card-text"></p>
<p class="card-text"></p>

                    </div>
                </div>
            </div>

        <?php } ?>


        <?php if($result->Account_Type == 'Salary account'){
        ?>  
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-30">
                    <a href="#"><img class="card-img-top img-fluid" src="images/users.jpg"  ></a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#"><?php echo htmlentities($result->FullName);?></a></h4>
<p class="card-text"></p>
<p class="card-text"><b></p>

                    </div>
                </div>
            </div>

        <?php } ?>



        <?php if($result->Account_Type == 'Salary account'){
        ?>  
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-30">
                    <a href="#"><img class="card-img-top img-fluid" src="images/lapy.jpg"  ></a>
                    <div class="card-block">
                        <h4 class="card-title"><a href="#"><?php echo htmlentities($result->FullName);?></a></h4>
<p class="card-text"></p>
<p class="card-text"></p>

                    </div>
                </div>
            </div>

        <?php } ?>





             <?php   }} ?>
          
 



        </div>



  <div class="jumbotron text-center" style="margin-bottom:2">
  <h1>Event_platform</h1>
  <p>Resize this responsive page to see the effect!</p> 
</div>





    
  <?php include('includes/footer.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html> 
<?php } ?>
