<?php
 require_once("includes/classes/FormSanitizer.php");
 require_once("includes/classes/Constants.php");
 require_once("includes/config.php");
 require_once("usernavbar.php");
 require_once("includes/classes/home.php");

 $gethome = new Home($con);


?>

<!DOCTYPE HTML>
<div class = "house-container">
    <?php

        if($gethome->listHouses())
        {
          $place=$_POST['place'];
          $sql = "SELECT * FROM home where location='$place'";
          $query = $con -> prepare($sql);
      // $query -> bindValue(":search",$keyword);
          $query -> execute();
          while($row = $query -> fetch(PDO::FETCH_ASSOC))
          {
              $userid = $row['userid'];
              $query2 = $con -> prepare("SELECT * FROM u_details WHERE id = '$userid'");
              $query2 -> execute();
              $userdata = $query2 -> fetch(PDO::FETCH_ASSOC);
              $loc = $row['location'];
              $photo1 = $row['picture1'];
              $photo2 = $row['picture2'];
              $photo3 = $row['picture3'];
              $photo4 = $row['picture4'];
              $photo5 = $row['picture5'];
              $size = $row['size'];
              $avail = $row['availat'];
              $name = $userdata['Name'];
              $phone = $userdata['Phno'];
              $id=$row['hid'];
              echo "
              <div class='house-body' >
              <img class = 'house-img' id='$id.1' src='uploads/$photo1'/>
                <img class = 'house-img' id='$id.2' src='uploads/$photo2'/>
                  <img class = 'house-img' id='$id.3' src='uploads/$photo3'/>
                    <img class = 'house-img' id='$id.4' src='uploads/$photo4'/>
                      <img class = 'house-img' id='$id.5' src='uploads/$photo5'/>
                       <button class='' onclick='plusDivs(-1)'>prev</button>
                       <button class='' onclick='plusDivs(1)'>next</button>
              <form action = 'exchange.php' method = 'POST'>
              <div class ='house-loc'>Location: $loc</div>
              <div class ='house-size'>Size: $size</div>
              <div class ='house-avail'>Available Till: $avail</div>
              <div>Name: $name</div>
              <div>Phone Number: $phone</div>
              <input type = 'submit' value = 'Echange' name = 'finalbutton' class ='exchangebtn' />
              </form>

              </div>
              <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
            showDivs(slideIndex += n);
            }

            function showDivs(n) {
            var i;
            var x1 = document.getElementById('$id.1');
            var x2 = document.getElementById('$id.2');
            var x3 = document.getElementById('$id.3');
            var x4= document.getElementById('$id.4');
            var x5 = document.getElementById('$id.5');
            var x= new Array(x1,x2,x3,x4,x5);
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
            }
            x[slideIndex-1].style.display = 'block';
            }
            </script>


";
              }
        }
       // echo "<img src ='uploads/$res'>"

    ?>


</div>
