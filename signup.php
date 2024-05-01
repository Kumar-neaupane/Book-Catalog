<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
</head>
<body>
    
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #222f3e;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.signup-container {
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

p {
    margin-top: 20px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
   <div class="signup-container">
    <h2>Sign Up</h2>
    <form action="#" method="post">
        <input type="text" id="name" placeholder="Name" name="name" required>
        <input type="text" id="student-id" placeholder="Student ID" name="student_id" required>
        <input type="email" id="email" placeholder="Email" name="email" required>
        <input type="password" id="password" placeholder="Password" name="password" required>
        <input type="password" id="confirm-password" placeholder="Confirm Password" name="confirm_password" required>
        <button type="submit" name="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="#">Login</a></p>
    <div>
        <?php
        include 'connection.php';

        if(isset($_POST['submit'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $confirmpassword = password_hash($confirm_password, PASSWORD_BCRYPT);
            $emailquery = "select * from usersignup where email = '$email'";
            $query = mysqli_query($conn, $emailquery);
            $emailcount = mysqli_num_rows($query);
            if($emailcount > 0){
                echo "<div id='email-exists-message'>Email already exists</div>";
            } else {
                if($confirm_password === $confirm_password){
                    $insertquery = "insert into usersignup(name, student_id,email,password,confirm_password ) values('$name', '$student_id','$email','$pass','$confirmpassword')";
                    $iquery = mysqli_query($conn, $insertquery);
                    if($iquery){
                        echo "<div id='signup-success-message'>Successfully signed up</div>";
                    } else {
                        echo "<div id='signup-failed-message'>Signup Failed</div>";
                    }
                } else {
                    echo "<div id='password-not-matching-message'>Enter Same password</div>";
                }
            }
        }
        ?>
    </div>
</div>

<script>
    
    setTimeout(function(){
        var emailExistsMessage = document.getElementById('email-exists-message');
        var signupSuccessMessage = document.getElementById('signup-success-message');
        var signupFailedMessage = document.getElementById('signup-failed-message');
        var passwordNotMatchingMessage = document.getElementById('password-not-matching-message');

        if(emailExistsMessage) {
            emailExistsMessage.remove();
        }
        if(signupSuccessMessage) {
            signupSuccessMessage.remove();
        }
        if(signupFailedMessage) {
            signupFailedMessage.remove();
        }
        if(passwordNotMatchingMessage) {
            passwordNotMatchingMessage.remove();
        }
    }, 5000);
</script>

</body>
</html>
