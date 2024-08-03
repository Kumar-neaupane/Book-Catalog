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

    .error {
        color: red;
        margin-top: 10px;
    }
    </style>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form id="signup-form" action="#" method="post" onsubmit="return validateForm()">
            <input type="text" id="name" placeholder="Name" name="name" required>
            <input type="number" id="student-id" placeholder="Student ID" name="student_id" required>
            <input type="email" id="email" placeholder="Email" name="email" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <input type="password" id="confirm-password" placeholder="Confirm Password" name="confirm_password"
                required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
        <div id="error-message" class="error"></div>
        <p>Already have an account? <a href="index.php">Login</a></p>
        <div>
            <?php
            include 'connection.php';

            if(isset($_POST['submit'])){
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                if($password === $confirm_password){
                    $pass = password_hash($password, PASSWORD_BCRYPT);
                    $emailquery = "SELECT * FROM usersignup WHERE email = '$email'";
                    $query = mysqli_query($conn, $emailquery);
                    $emailcount = mysqli_num_rows($query);

                    if($emailcount > 0){
                        echo "<div id='email-exists-message'>Email already exists</div>";
                    } else {
                        $insertquery = "INSERT INTO usersignup(name, student_id, email, password) VALUES('$name', '$student_id', '$email', '$pass')";
                        $iquery = mysqli_query($conn, $insertquery);
                        if($iquery){
                            echo "<div id='signup-success-message'>Successfully signed up</div>";
                            ?>
            <script>
            // Redirect after 3 seconds
            setTimeout(function() {
                location.replace("index.php");
            }, 3000);
            </script>
            <?php
                        } else {
                            echo "<div id='signup-failed-message'>Signup Failed</div>";
                        }
                    }
                } else {
                    echo "<div id='password-not-matching-message'>Passwords do not match</div>";
                }
            }
            ?>
            <script>
            // Function to remove messages after 5 seconds
            setTimeout(function() {
                var emailExistsMessage = document.getElementById('email-exists-message');
                var signupSuccessMessage = document.getElementById('signup-success-message');
                var signupFailedMessage = document.getElementById('signup-failed-message');
                var passwordNotMatchingMessage = document.getElementById('password-not-matching-message');

                if (emailExistsMessage) {
                    emailExistsMessage.remove();
                }
                if (signupSuccessMessage) {
                    signupSuccessMessage.remove();
                }
                if (signupFailedMessage) {
                    signupFailedMessage.remove();
                }
                if (passwordNotMatchingMessage) {
                    passwordNotMatchingMessage.remove();
                }
            }, 5000);

            function validateForm() {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirm-password").value;
                var errorMessage = document.getElementById("error-message");

                var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;

                if (!passwordRegex.test(password)) {
                    errorMessage.textContent =
                        "Password must be at least 6 characters long and contain both letters and numbers.";
                    setTimeout(function() {
                        errorMessage.textContent = "";
                    }, 2000);
                    return false;
                }

                if (password !== confirmPassword) {
                    errorMessage.textContent = "Passwords do not match.";
                    setTimeout(function() {
                        errorMessage.textContent = "";
                    }, 2000);
                    return false;
                }

                errorMessage.textContent = "";
                return true;
            }
            </script>
        </div>
    </div>
</body>

</html>