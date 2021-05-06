<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("navbar.php");


    $account = new Account($con);
    if (isset($_POST['submitButton'])){
      $account = new Account($con);
      $Name = FormSanitizer::sanitizeFormString($_POST["Name"]);
      $Username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
      $Phno = FormSanitizer::sanitizeFormNumber($_POST["number"]);
      $Email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
      $Password = FormSanitizer::sanitizeFormPassword($_POST["Password"]);
      $Password2 = FormSanitizer::sanitizeFormPassword($_POST["Password2"]);
     

      $success = $account -> register($Name, $Username, $Phno, $Email, $Password, $Password2);
      if($success) {
          $_SESSION["userLoggedIn"] = $username;
        	header("Location: login.php");
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
        <title> Home to Home </title>
        <link rel = "stylesheet" type = "text/css" href = "assets/style/style.css">
    </head>
    <body>
    <?php 
  
    ?>
        <div class = "signInContainer">
            <div class = "column">
                <div class = "header">
                    
                    <h3> Sign Up </h3><br>
                    <p> to continue to H2H </p>
                </div>
                <form method = "POST">
                    <?php echo $account -> getError(Constants::$NameCharacters); ?>
                    <input type = "text" id = "Name" name = "Name" placeholder = "Name" value = "<?php getInputValue("Name");?>" required>

                    <?php echo $account -> getError(Constants::$usernameCharacters); ?>
                    <?php	echo $account -> getError(Constants::$usernameTaken); ?>
                    <input type = "text" id = "username" name = "username" placeholder = "Username" value = "<?php getInputValue("username");?>" required>

                    <?php echo $account -> getError(Constants::$numberCharacters); ?>
                    <?php echo $account -> getError(Constants::$numberTaken); ?>
                    <input type = "text" id = "number" name ="number" placeholder = "Mobile Number" value = "<?php getInputValue("number");?>" required>

                    <?php echo $account -> getError(Constants::$emailInvalid); ?>
                    <?php echo $account -> getError(Constants::$emailTaken); ?>
                    <input type = "email" id = "email" name = "email" placeholder = "Email" value = "<?php getInputValue("email");?>" required>
                    
                    <?php echo $account -> getError(Constants::$passwordsDontMatch); ?>
                    <?php echo $account -> getError(Constants::$passwordLength); ?>
                    <input type = "password" id = "Password" name = "Password" placeholder = "Password" required>
                    <input type = "password" id = "Password2" name = "Password2" placeholder = "Confirm Password" required>

                   
                    <input type = "submit" name = "submitButton" value = "SUBMIT">
                </form>
                
                <a href = "login.php" class = "signInMessage"> Already have an account? Sign in here! </a>
            </div>
        </div>
    </body>
</html>