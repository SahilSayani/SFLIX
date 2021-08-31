<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account= new Account($con); //con variable coming from config.php

    if(isset($_POST["submitButton"])){
         
        $firstName=FormSanitizer::sanitizeFormString($_POST["firstName"]);//$  used to declare var in php... set var = "name" of the input field 
        $lastName=FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username=FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email=FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2=FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password=FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2=FormSanitizer::sanitizeFormPassword($_POST["password2"]);

       $account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);
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
                <h3>Sign Up</h3>
                <span>to continue to SFlix</span>
                
            </div>
            <form method="POST">
                <?php //echo $account->getError("First name wrong length"); //calling the getError func in Account.php via obj $account created on line 7
                
                echo $account->getError(Constants::$firstNameCharacters); //this does the exact same thing as line 46 
                
                ?>

                <input type="text" name="firstName"placeholder="First name" required>
                <?php  echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName"placeholder="Last name"required>
                <?php  echo $account->getError(Constants::$usernameCharacters); ?>
                <?php  echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username"placeholder="Username"required>
                <?php  echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php  echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email"placeholder="E-mail"required>
                <input type="email" name="email2"placeholder="Confirm E-mail"required>
                <input type="password" name="password"placeholder="Password"required>
                <input type="password" name="password2"placeholder="Confirm Password"required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="login.php" class="signInMessage">Already have an account ? Sign In here !</a>
        </div>
    </div>
</body>

</html>
