<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");


$account= new Account($con); //con variable coming from config.php
if(isset($_POST["submitButton"])) {

    $username=FormSanitizer::sanitizeFormUsername($_POST["username"]);
        
    $password=FormSanitizer::sanitizeFormPassword($_POST["password"]);
    //success var will contain true or false based on whether or not the insert into users query ran successfully or not.
    $success = $account->login($username,$password);
    //if success is true=>query worked =>redirect user to index.php 
    if($success) {
        // Store session
        header("Location: index.php");
    }
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

                <?php echo $account->getError(Constants::$loginFailed); ?>

                <input type="text" name="username" placeholder="Username"required>
                
                <input type="password" name="password"placeholder="Password"required>
               
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="register.php" class="signInMessage">Dont have an account ? Sign Up here !</a>
        </div>
    </div>
</body>

</html>