<!-- connecting database -->

<!-- PHP is a server side language and is executed even before the page is loaded -->

<?php
ob_start();//turns on output buffering...waits until all PHP code is executed before outputting it to the page

session_start(); //session lasts until browser is closed,we are using sessions to tell if a user is logged in or not. if session has been set => user is logged in

date_default_timezone_set("Asia/Kolkata");//set default timezone to enter current date time if we decide use it in our DB
//CODE TO CONNECT TO THE DATABASE GIVEN BELOW
//NO NEED TO REMEMBER THIS YOU CAN LOOK IT UP.
try{//$con is the connector variable
    $con=new PDO("mysql:dbname=sflix;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

}
catch(PDOException $e){
    exit("Connection Failed: ".$e->getMessage());//exit means stop running any php code and output the following mssg to the user ... the (.) dot operator allows us to append a string . we access the error obj e and call the get error mssg method
}




?>