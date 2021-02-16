 <!-- Video Source -->
  <!-- https://www.pexels.com/video/aerial-view-of-beautiful-resort-2169880/ -->
<!DOCTYPE html>
<html>
<head>
  <title>TSF Bank</title>
   <link rel = "icon" href = "images/icon.gif" 
        type = "image/x-icon"> 
      <link href="style.css" rel="stylesheet">
</head>
<body>
  
  <section class="showcase">
    <header>
      <h2 class="logo">Welcome to TSF</h2>
      <div class="toggle"></div>
    </header>
    <video src="city_moving.mp4"muted loop autoplay></video>
    <div class="overlay"></div>
    <div class="text">
      <h3>Never Stop  </h3> 
      <h3>Untill satisfied</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat.</p>
      <a href="Reg.php">Register</a><br><br>
      <a href="Reg_login.php">Login</a>

    </div>
    <ul class="social">
      <li><a href="https://www.facebook.com/"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
      <li><a href="https://twitter.com/"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
      <li><a href="https://www.instagram.com/"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
    </ul>
  </section>
  <div class="menu">
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="Reg.php">Become User</a></li>
      <li><a href="Reg.php">Transfer Money</a></li>
      <li><a href="contact_us.php">Contact Us</a></li>
    </ul>
  </div>
  <script type="text/javascript">
    
     const menuToggle = document.querySelector('.toggle');
      const showcase = document.querySelector('.showcase');

      menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        showcase.classList.toggle('active');
      })


  </script>





</body>
</html>