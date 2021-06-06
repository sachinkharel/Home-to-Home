<?php
class member{
    private $con;
    private $error_arrray = array();
    public function __construct($con) {
        $this->con = $con;
    }
    public function getmembership($mType,$mDate,$payment){
            $sql = "INSERT into member (mType,mDate,payment,uid) VALUES
                                             (:t,:d,:p,:uid)";
            $query = $this -> con -> prepare($sql);
            $query->bindValue(":t",$mType);
            $query->bindValue(":d",$mDate);
            $query->bindValue(":p",$payment);
             $query->bindValue(":uid",$_SESSION["userId"]);
            $query->execute();
            header("Location: userpage.php");
        }

    public function checkmembership()
    {
        $query = $this -> con -> prepare("SELECT * FROM member WHERE uid = :uid");
        $query -> bindValue(":uid",$_SESSION["userId"]);
        $query ->execute();
        $this -> data = $query -> fetch(PDO::FETCH_ASSOC);
        if ($query -> rowCount() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

 public function setmembercount(){
        $query = $this -> con -> prepare("SELECT * FROM member WHERE uid = :uid");
        $query -> bindValue(":uid",$_SESSION["userId"]);
        $query ->execute();
        $data = $query -> fetch(PDO::FETCH_ASSOC);
        $hi = $data["ExchangeCount"];
        $hi++;
        $sql = "UPDATE member SET ExchangeCount = :c WHERE uid = :uid"; 
        $query = $this -> con -> prepare($sql);
        $query->bindValue(":c",$hi);
        $query->bindValue(":uid",$_SESSION["userId"]);
        $query->execute();
        // if ($con->query($sql) === TRUE) {
        //     echo "Record updated successfully";
        //   } else {
        //     echo "Error updating record: " . $con->error;
        //   }
    }

    

    public function getmemberCount()
    {
        $query = $this -> con -> prepare("SELECT * FROM member WHERE uid = :uid");
        $query -> bindValue(":uid",$_SESSION["userId"]);
        $query ->execute();
        $this -> data = $query -> fetch(PDO::FETCH_ASSOC);
        $count = $this -> data["ExchangeCount"];
        $type = $this -> data["mType"];

        if ($type == "PLATINUM")
        {   
            return true;
        }
       else if($type == "GOLD")
        {
            if ($count < 4)
                return true;
            else
                return false;
        }
        else if($type == "SILVER")
        {
            if ($count < 2)
                return true;
            else
                return false;
        }
        return false;
    }
    
}