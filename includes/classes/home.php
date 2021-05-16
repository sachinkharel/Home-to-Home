<?php
class Home{
    private $con;
    private $error_arrray = array();
    public function __construct($con) {
        $this->con = $con;
    }
    public function getHouseDetails($type, $loc, $size, $date, $img,$tmp){
        $dir = "uploads/";
        $path = $dir . $img;
        $type = pathinfo($path,PATHINFO_EXTENSION);

        $allowedTypes = array('jpg','png','jpeg');
        if (in_array($type, $allowedTypes))
        {
            if(move_uploaded_file($tmp,$path));
            {
                $sql = "INSERT into home (type,location,size,availat,picture,userid) VALUES
                                             (:t,:l,:s,:a,:p,:uid)";
                $query = $this -> con -> prepare($sql);
                $query->bindValue(":l",$loc);
                $query->bindValue(":a",$date);
                $query->bindValue(":s",$size);
                $query->bindValue(":p",$img);
                $query->bindValue(":t",$type);
                $query->bindValue(":uid",$_SESSION["userId"]);
                $query->execute();
            }
           
        }

        else{
            echo "<div>Error</div>";
        }
    }
    
    public function listHouses()
    {
        if(isset($_POST['search']))
        {
        if(isset($_POST['place']))
        {
            $place=$_POST['place'];
            $sql = "SELECT * FROM home where location='$place'";
            $query = $this -> con -> prepare($sql);
        // $query -> bindValue(":search",$keyword);
            $query -> execute();
            while($row = $query -> fetch(PDO::FETCH_ASSOC))              
            {
                $userid = $row['userid'];
                $query2 = $this -> con -> prepare("SELECT * FROM u_details WHERE id = '$userid'");
                $query2 -> execute();
                $userdata = $query2 -> fetch(PDO::FETCH_ASSOC);  
                $loc = $row['location'];
                $photo = $row['picture'];
                $size = $row['size'];
                $avail = $row['availat'];
                $name = $userdata['Name'];
                $phone = $userdata['Phno'];
                echo "<div class = 'house-body'>
                <form action = 'exchange.php' method = 'POST'>
                <img class = 'house-img' src='uploads/$photo'/>
                <div class ='house-loc'>Location: $loc</div>
                <div class ='house-size'>Size: $size</div>
                <div class ='house-avail'>Available Till: $avail</div>
                <div>Name: $name</div>
                <div>Phone Number: $phone</div>
                <input type = 'submit' value = 'Echange' name = 'finalbutton' class ='exchangebtn' />
                </form>
                </div>";
                }
            }
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
