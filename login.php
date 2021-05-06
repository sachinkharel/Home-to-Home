<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("navbar.php");
    //require_once("includes/classes/otpget.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {
        $Username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $Password = FormSanitizer::sanitizeFormPassword($_POST["Password"]);

        $success = $account -> login($Username, $Password);
        if($success) {
            $_SESSION["userLoggedIn"] = $Username;
            /*$get = new otpget($con,$_SESSION["userLoggedIn"]);
            $address = $get->getcred();
            $number = array($address);
            $otp = $get->generate_otp();
            setcookie('otp',$otp,time() + 30);
            $get->send($number, $otp); */
            header("Location: userpage.php");
        }
    }

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Welcome to H2H</title>
        <link rel = "stylesheet" type = "text/css" href = "assets/style/style.css">
    </head>
    <body>
        <div class = "signInContainer">
            <div class = "column">
                <div class = "header">
                    <h3> Sign In </h3><br>
                    <p> to continue to H2H </p>
                </div>

                <form method = "POST">
                    <?php echo $account -> getError(Constants::$loginFailed); ?>
                    <input type = "text" name = "username" placeholder = "Username" value = "<?php getInputValue("username");?>" required>
                    <input type = "password" name = "Password" placeholder = "Password" required>
                    <input type = "submit" name = "submitButton" value = "SUBMIT">
                </form>
            
                <a href = "register.php" class = "signInMessage"> Need an account? Sign up here! </a>
            </div>
        </div>
    </body>
</html>