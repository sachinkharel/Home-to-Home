<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("usernavbar.php");
    require_once("includes/classes/home.php");
    require_once("includes/classes/member.php");
    $mem =  new member($con);
    if($mem -> getmemberCount())
    {
        $mem -> setmembercount();
        echo "EXHCNAGE SUCCESSFULL";
    }
    else
    {
        echo "Maximum capcity of exchange reached";
    }
?>
