<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/config.php");
    require_once("usernavbar.php");
    require_once("includes/classes/home.php");
    require_once("includes/classes/member.php");

    
    if(!Empty($_SESSION["userLoggedIn"])){
        require_once("usernavbar.php");
        

    }else{
        require_once("navbar.php");
    }
    $member = new member($con);
    if(!$member -> checkmembership())
    {
        header("Location:validatemember.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <div class="membership">
        <div class ="card">
            <div class="box">
                <div class="cont">
                    <h2>Rs.2000</h2>
                    <h3>Silver</h3>
                    <p>✓ 2 exhchanges/year</p>
                    <p>✓ Free listing</p>
                    <p>✗ Free Cancellation</p>
                    <a href="membershipForm1.php">Buy</a>
                </div>
            </div>
        </div>
        <div class ="card">
            <div class="box">
                <div class="cont">
                    <h2>Rs.5000</h2>
                    <h3>Gold</h3>
                    <p>✓ 4 exhchanges/year</p>
                    <p>✓ Free listing</p>
                    <p>✗ Free Cancellation</p>
                    <a href="membershipForm2.php">Buy</a>
                </div>
            </div>
        </div>
        <div class ="card">
            <div class="box">
                <div class="cont">
                    <h2>Rs.10000</h2>
                    <h3>Platinum</h3>
                    <p>✓ Unlimited exhchanges/year</p>
                    <p>✓ Free listing</p>
                    <p>✓ Free Cancellation</p>
                    <a href="membershipForm3.php">Buy</a>
                </div>
            </div>
        </div>
    </div>
</html>
