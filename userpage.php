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
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
</style>

<body>

    <div class="banner">
    <div class ="search-box">
    <input class="search-txt" type ="text" name="" placeholder="Type to search">
    <a class ="search-btn" href="#">
        <i class="fas fa-search"></i>
    </a>
    </div>
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