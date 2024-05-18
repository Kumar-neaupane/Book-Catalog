<?php 
include 'connection.php';
$login_message = ""; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email_search = "SELECT * FROM adminlogin WHERE email = '$email'";
    $query = mysqli_query($conn, $email_search);
    $email_count = mysqli_num_rows($query);
    
    if ($email_count) {
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass["password"];
        
        
        if ($password == $db_pass) {
            $login_message = "Login successful";
           
            ?>
            <script>
                location.replace("addbook.php");
            </script>
            <?php
            exit; 
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <script>
        setTimeout(function(){
            document.getElementById('login_message').innerHTML = '';
        }, 3000); 
    </script>
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

input {
    width: 300px;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

    </style>
     <div class="login-container">
        <h2>Admin Login</h2>
        <form action="#" method="post">
            <input type="email" id="username" placeholder="Email" name="email" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <button type="submit" name="submit">Login</button><br><br>
        </form>
        <p id="login_message"><?php echo $login_message; ?></p> 
        
    </div>
    
</body>
</html>
