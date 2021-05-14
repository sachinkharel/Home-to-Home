<?php
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/config.php");
require_once("usernavbar.php");
require_once("includes/classes/home.php");
require_once("includes/classes/member.php");


$chckhome = new Home($con);
$chckmem = new Member($con);
if(!$chckmem -> checkmembership())
{
    if($chckmem -> getmemberCount())
    {
        if($chckhome -> checkList())
        {
            header("Location: exchangeForm.php");
        }
        else
        {
            echo "Listing for this house already created";
        }
    }
    else
    {
        echo "Maximum capcity of exchange reached";
    }
    
}
else
{
    echo "Create a membership first to continue";
}


?>