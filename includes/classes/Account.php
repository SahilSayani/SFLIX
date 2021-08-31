<?php
class Account{
    private $con;
    private $errorArray =array(); //create an empty error array

    //creating a constructor
    public function __construct($con){
        //assign private con variable (referenced to current context using this keyword) to con variable defined in config.php
        $this->con=$con;
    }
    public function register($fn,$ln,$un,$em,$em2,$pw,$pw2){
        $this->validateFirstName($fn);
        $this->validatelastName($ln);
        $this->validateUsername($un);
        $this->validateEmails($em,$em2);



    }
    private function validateFirstName($fn){
        if (strlen($fn)<2 || strlen($fn)>25){
            array_push($this->errorArray,Constants::$firstNameCharacters);
            return;

        }
    }
    private function validateLastName($ln){
        if(strlen($ln)<2 || strlen($ln)>25){
            array_push($this->errorArray,Constants::$lastNameCharacters);

        }
    }

    private function validateUsername($un){
        if(strlen($un)<2 || strlen($un)>25){
            array_push($this->errorArray,Constants::$usernameCharacters);
        }
        $query=$this->con->prepare("SELECT * FROM users WHERE username=:un");//preparing an SQL query and then we have to bind the un parameter
        $query->bindValue(":un",$un);
        //executing the query
        $query->execute();
        if ($query->rowCount()!=0){
            array_push($this->errorArray,Constants::$usernameTaken);
        }
    }

    private function validateEmails($em,$em2){
        if($em!=$em2){
            array_push($this->errorArray,Constants::$emailsDontMatch);
            return;
        }
    //    if(){}        ".com" checker not created. (skip)
    $query=$this->con->prepare("SELECT * FROM users WHERE email=:em");//preparing an SQL query and then we have to bind the em parameter
        $query->bindValue(":em",$em);
        //executing the query
        $query->execute();
        if ($query->rowCount()!=0){
            array_push($this->errorArray,Constants::$emailTaken);
        }
    }
    
    public function getError($error)
    {
        if(in_array($error,$this->errorArray)){
            return $error;
        }
    }

    }


?>