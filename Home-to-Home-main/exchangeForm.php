<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("usernavbar.php");
    require_once("includes/classes/home.php");

    $home = new Home($con);

    if($_SESSION["userLoggedIn"]){
        echo'<a href="$userpage.php"></a>';

    }else{
        header("Location:login.php");
        exit;
    }
    if(!$home -> checkList())
    {
        header("Location:validate.php");
    }

    if(isset($_POST["submitButton"]))
    {
        $type = $_POST["homeType"];
        $address = FormSanitizer::sanitizeFormString($_POST["homeAddress"]);
        $size = FormSanitizer::sanitizeFormString($_POST["homeSize"]);
        $avail = $_POST["homeAvailability"];
        $img1 = basename($_FILES["file1"]["name"]);

        $img2 = basename($_FILES["file2"]["name"]);

        $img3 = basename($_FILES["file3"]["name"]);

        $img4 = basename($_FILES["file4"]["name"]);

        $img5 = basename($_FILES["file5"]["name"]);
          $tmpdir1 = $_FILES["file1"]["tmp_name"];
            $tmpdir2 = $_FILES["file2"]["tmp_name"];
              $tmpdir3 = $_FILES["file3"]["tmp_name"];
                $tmpdir4 = $_FILES["file4"]["tmp_name"];
        $tmpdir5 = $_FILES["file5"]["tmp_name"];
        $home -> getHouseDetails($type, $address, $size, $avail, $img1,$img2,$img3,$img4,$img5,$tmpdir1,$tmpdir2,$tmpdir3,$tmpdir4,$tmpdir5);

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Home to Home </title>
        <link rel = "stylesheet" type = "text/css" href = "assets/style/style.css">
    </head>
    <body>

        <div class = "signInContainer">
            <div class = "houseColumn">
                <div class = "header">

                    <h3> Hello <?php echo $_SESSION["userLoggedIn"]?>, let us know about your home. </h3><br>
                </div>
                <form method = "POST" action = "" enctype="multipart/form-data">
                    Home Type:
                    <input type = "radio" id = "homeType" name = "homeType"  value="apartment"> Apartment
                    <input type = "radio" id = "homeType" name = "homeType"  value="house"> House
                    <input type = "radio" id = "homeType" name = "homeType"  value="yacht"> Yacht
                    <br>
                    Address:
                    <input type = "text" id = "homeAddress" name = "homeAddress" placeholder = "16th Street Pulchowk" value = "" required>
                    <br>
                    Size:
                    <input type = "text" id = "homeSize" name ="homeSize" placeholder = "eg.2BHK" value = "" required>
                    <br>
                    Amenities:
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "parkingSpace"> Parking Space
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "tv"> TV
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "wifi"> WiFi
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "fridge"> Fridge
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "bathtub"> Bathtub
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "fireplace"> Fireplace
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "oven"> Oven
                    <input type = "checkbox" id = "homeAmenities" name = "homeAmenities"  value = "washingMachine"> Washing Machine
                    <br>
                    Available at:
                    <input type = "date" id = "homeAvailability" name ="homeAvailability" value = "" required>
                    <br>
                    Upload image:</br></br>
                    House:
                    <input type = "file" name="file1" value = "Upload"><br>
                    Bedroom:
                    <input type = "file" name="file2" value = "Upload"><br>
                    Bathroom:
                    <input type = "file" name="file3" value = "Upload"><br>
                  Kitchen:
                    <input type = "file" name="file4" value = "Upload"><br>
                    Living Room:
                      <input type = "file" name="file5" value = "Upload"><br>

                    <input type = "submit" name = "submitButton" value = "SUBMIT">
                </form>
            </div>
        </div>
    </body>
</html>
