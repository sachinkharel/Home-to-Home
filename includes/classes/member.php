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
}