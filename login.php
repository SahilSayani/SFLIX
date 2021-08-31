<?php
    if(isset($_POST["submitButton"])){
        echo"Form was submitted";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SFlix</title>
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/logo.png" title="logo" alt="Site Logo"/>
                <h3>Sign In</h3>
                <span>to continue to SFlix</span>
                
            </div>
            <form method="POST">
                
                <input type="text" name="username "placeholder="Username"required>
                
                <input type="password" name="password"placeholder="Password"required>
               
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="register.php" class="signInMessage">Dont have an account ? Sign Up here !</a>
        </div>
    </div>
</body>

</html>