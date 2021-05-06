<?php
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/config.php");
require_once("usernavbar.php");
require_once("includes/classes/home.php");


$chckhome = new Home($con);
if($chckhome -> checkList())
{
    header("Location: exchangeForm.php");
}
else
{
    echo "Listing for this house already created";
}


?>