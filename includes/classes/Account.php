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
        $this->validatePasswords($pw,$pw2);
        //if errorArray (defined above) is empty => completely valid input hence isnsert into database
        if(empty($this->errorArray)){
            return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        return false;
    }

    private function insertUserDetails($fn,$ln,$un,$em,$pw){
        // start by hashing the pwd
        $pw=hash("sha256",$pw);
        $query=$this->con->prepare("INSERT INTO users (firstName,lastName,username,email,password)
        VALUES(:fn,:ln,:un,:em,:pw)");
        // :fn,:ln,:un,:em,:pw these are placeholders and now we'll have to bind values to them
        $query->bindValue(":fn",$fn);
        $query->bindValue(":ln",$ln);
        $query->bindValue(":un",$un);
        $query->bindValue(":em",$em);
        $query->bindValue(":pw",$pw);

        return $query->execute();//returns true if query executes properly
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
    //    if(!filter_var){}        ".com" checker not created. (skip)
    $query=$this->con->prepare("SELECT * FROM users WHERE email=:em");//preparing an SQL query and then we have to bind the em parameter
        $query->bindValue(":em",$em);
        //executing the query
        $query->execute();
        if ($query->rowCount()!=0){
            array_push($this->errorArray,Constants::$emailTaken);
        }
    }
    
    private function validatePasswords($pw,$pw2)
    {
        if($pw!=$pw2){
            array_push($this->errorArray,Constants::$passwordsDontMatch);
            return;
        }
        if(strlen($pw)<5 || strlen($pw)>25){
            array_push($this->errorArray,Constants::$passwordLength);
        }
    }


    public function getError($error)
    {
        if(in_array($error,$this->errorArray)){
            // return $error;
            return "<span class='errorMessage'>$error</span>";
        }
    }

}


?>