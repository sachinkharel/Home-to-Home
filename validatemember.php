<?php
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/config.php");
require_once("usernavbar.php");
require_once("includes/classes/home.php");
require_once("includes/classes/member.php");


$checkmember = new member($con);
if($checkmember -> checkmembership())
{
    header("Location: membership.php");
}
else
{
    echo "You already have a membership";
}


?>