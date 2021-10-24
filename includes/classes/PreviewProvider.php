<?php
class PreviewProvider{
    private $con,$username;
    public function __construct($con,$username)
    {
        $this->con=$con;
        $this->username=$username;
        
    }

    public function createPreviewVideo($entity){
    
        if($entity==null){
            $entity=$this->getRandomEntity();
        }
    }
    private function getRandomEntity(){


        $query=$this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();
        $row=$query->fetch(PDO::FETCH_ASSOC);
        echo $row["name"];
    }
}

?>