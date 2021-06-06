<?php
class Home{
    private $con;
    private $error_arrray = array();
    public function __construct($con) {
        $this->con = $con;
    }
    public function getHouseDetails($type, $loc, $size, $date, $img1,$img2,$img3,$img4,$img5,$tmp1,$tmp2,$tmp3,$tmp4,$tmp5){
        $dir = "uploads/";
        $path1 = $dir . $img1;
        $path2 = $dir . $img2;
        $path3 = $dir . $img3;
        $path4 = $dir . $img4;
        $path5 = $dir . $img5;
        $type1 = pathinfo($path1,PATHINFO_EXTENSION);
        $type2 = pathinfo($path2,PATHINFO_EXTENSION);
        $type3 = pathinfo($path3,PATHINFO_EXTENSION);
        $type4 = pathinfo($path4,PATHINFO_EXTENSION);
        $type5 = pathinfo($path5,PATHINFO_EXTENSION);

        $allowedTypes = array('jpg','png','jpeg');
        if (in_array($type1, $allowedTypes))
        {
            move_uploaded_file($tmp1,$path1);
            move_uploaded_file($tmp2,$path2);
            move_uploaded_file($tmp3,$path3);
            move_uploaded_file($tmp4,$path4);
            move_uploaded_file($tmp5,$path5);


                $sql = "INSERT into home (type,location,size,availat,picture1,picture2,picture3,picture4,picture5,userid) VALUES
                                             (:t,:l,:s,:a,:p1,:p2,:p3,:p4,:p5,:uid)";
                $query = $this -> con -> prepare($sql);
                $query->bindValue(":l",$loc);
                $query->bindValue(":a",$date);
                $query->bindValue(":s",$size);
                $query->bindValue(":p1",$img1);
                $query->bindValue(":p2",$img2);
                $query->bindValue(":p3",$img3);
                $query->bindValue(":p4",$img4);
                $query->bindValue(":p5",$img5);
                $query->bindValue(":t",$type);
                $query->bindValue(":uid",$_SESSION["userId"]);
                $query->execute();


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
          return true;
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
