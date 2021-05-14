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
        $gethome->listHouses();
       // echo "<img src ='uploads/$res'>"
    ?>
</div>