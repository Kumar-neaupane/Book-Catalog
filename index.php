<?php 
include 'connection.php';
$login_message = ""; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email_search = "select * from usersignup where email = '$email'";
    $query = mysqli_query($conn,$email_search);
    $email_count = mysqli_num_rows($query);
    
    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass["password"];
        $pass_decode = password_verify($password, $db_pass);
        
        if($pass_decode){
            $login_message = "Login successful";
            ?>
            <script>
                location.replace("userinterface.php");
            </script>
            <?php
        } else {
            $login_message = "Wrong Password"; 
        }
    } else {
        $login_message = "Invalid email"; 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <title>Book Catalog System</title>
    <script src="https://kit.fontawesome.com/d21d709eb4.js" crossorigin="anonymous"></script>
    <script>
        setTimeout(function(){
            document.getElementById('login_message').innerHTML = '';
        }, 3000); 
    </script>
</head>
<body>


    <div id="header">
        <div class="container">
            <nav>
                <img src="bookcatalog.png" alt="logo" class="logo">
                <ul id="sidemenu">
                    <li><a href="#header">Home</a></li>
                    <li><a href="#userlogin">User Login</a></li>
                    <li><a href="signup.html">User Signup</a></li>
                    <li><a href="adminlogin.php">Admin Login</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                    <!---<i class="fa-solid fa-xmark" onclick="closemenu()"></i>
                </ul>
                <i class="fa-solid fa-bars" onclick="openmenu()"></i>-->
            </nav>
            <div class="header-text">
                
                <h1><span>Book Catalog System </span></h1>
                <p>Empower Your Shelf:<span> Book Catalog System</span> - Your Gateway to Knowledge</p>
            </div>

        </div>
        <div class="login-container">
        <h2>User Login</h2>
        <form action="#" method="post">
            <input type="email" id="username" placeholder="Email" name="email" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <button type="submit" name="submit">Login</button><br><br>
        </form>
        <p id="login_message"><?php echo $login_message; ?></p> 
        <p> Don't have an account?<a href="signup.php">Signup</a></p>
    </div>
        
    </div>
    
    
  <div id="contact">
    <div class="container">
        <div class="row">
            <div class="contact-left">
                <h1 class="sub-title">Contact Us</h1>
                <p><i class="fa-regular fa-envelope"></i>bookcatalogsystem@gmail.com</p>
                <p><i class="fa-solid fa-phone-volume"></i> 9818041863</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/profile.php?id=100077754874916"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/kumar__neupane?igsh=dmpmNHYxY3hkYTZ6"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/kumarneupane?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fa-brands fa-linkedin"></i></a>

                </div>
                
            </div>
           
        </div>
    </div>
    <div class="copyright">
        <p>Copyright © [2024] Book Catalog System. All Rights Reserved.
        </p>
    </div>
</div>

    </body>
    
    </html>