<?php
class Home{
    private $con;
    private $error_arrray = array();
    public function __construct($con) {
        $this->con = $con;
    }
    public function getHouseDetails($type, $loc, $availableat, $size, $img,$tmp){
        $dir = "uploads/";
        $path = $dir . $img;
        $type = pathinfo($path,PATHINFO_EXTENSION);

        $allowedTypes = array('jpg','png','jpeg');
        if (in_array($type, $allowedTypes))
        {
            if(move_uploaded_file($tmp,$path));
            {
                $sql = "INSERT into home (type,location,size,availableat,picture,userid) VALUES
                                             (:t,:l,:s,:a,:p,:uid)";
                $query = $this -> con -> prepare($sql);
                $query->bindValue(":l",$loc);
                $query->bindValue(":a",$availableat);
                $query->bindValue(":s",$size);
                $query->bindValue(":p",$img);
                $query->bindValue(":t",$type);
                $query->bindValue(":uid",$_SESSION["userId"]);
                $query->execute();
                header("Location: userpage.php");
            }
           
        }

        else{
            echo "<div>Error</div>";
        }

    }
    public function listHouses()
    {
        $sql = "SELECT * FROM home";
        $query = $this -> con -> prepare($sql);
       // $query -> bindValue(":search",$keyword);
        $query -> execute();
        while($row = $query -> fetch(PDO::FETCH_ASSOC))              
        {
            $loc = $row['location'];
            echo $loc;
            $photo = $row['picture'];
            echo "<img height = '200px' width = '100px' class= 'house-img' src='uploads/$photo'>";
        }
    }


    public function checkList()
    {
        $query = $this -> con -> prepare("SELECT * FROM home WHERE userid = :uid");
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


?>