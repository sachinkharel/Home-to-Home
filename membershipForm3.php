<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("usernavbar.php");
    require_once("includes/classes/home.php");
    require_once("includes/classes/member.php");

    $member = new member($con);
    if(!$member -> checkmembership())
    {
        header("Location:validatemember.php");
    }
    if(isset($_POST["submitButton"]))
    {
        $mType = $_POST["membershipType"];
        $mDate=$_POST["registrationDate"];
        $payment=$_POST["payment"];
        $member -> getmembership($mType,$mDate,$payment);

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
                    <input type = "text" id = "membershipType" name = "membershipType"  value="PLATINUM" readonly>
                    <br>
                    Registration Date: 
                    <input type = "date" id = "registrationDate" name ="registrationDate" value = "<?php echo date('Y-m-d'); ?>" readonly>
                    <br><br>
                    Payment Method:
                    <select name="payment" id="payment">
                        <option value="Card">Card</option>
                        <option value="PhonePay">PhonePay</option>
                        <option value="Esewa">Esewa</option>
                        <option value="GPay">GPay</option>
                    </select>
                    <br><br>
                    <input type = "submit" name = "submitButton" value = "SUBMIT">
                </form>
            </div>
        </div>
    </body>
</html>