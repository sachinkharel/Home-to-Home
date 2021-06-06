<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("usernavbar.php");

    if($_SESSION["userLoggedIn"]){
        echo'<a href="$userpage.php"></a>';

    }else{
        header("Location:login.php");
        exit;
    }
?>
<html>
<head>
    <title>Home2Home</title>
    <link rel="stylesheet" href="assets/style/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js%22%3E%22%3E"></script>
</head>

<body>

    <div class="banner">
      <form action="listhouses.php" method="post">
    <div class ="search-box">

    <input class="search-txt" type ="text" name="place" placeholder="Type to search">
    <a class ="search-btn" >
        <input type = 'submit' value='🔍'  name="search">
    </a>

    </div>
      </form>
        <div class="content">
            <h1>YOUR EXCHANGE IS A CLICK AWAY, <?php echo $_SESSION["userLoggedIn"] ?></h1>
            <P>Check out our membership for exciting features<p>
            <div>
            <a href='validate.php'><button type = "button"> <span></span> Exchange</button></a>
            <a href='validatemember.php'><button type = "button"> <span></span> Membership</button></a>
            </div>
        </div>

   </div>
</body>
</html>