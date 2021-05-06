<?php
    session_start();
    if(!Empty($_SESSION["userLoggedIn"])){
        require_once("usernavbar.php");
        

    }else{
        require_once("navbar.php");
    }
    
?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" href="assets/style/style.css">
    <body>
    <div class = "banner">
        <p>If a person doesn’t have enough money for paying his accommodation charges for his trip, he can look in Home-to-Home for people who are interested to visit his city so
            that they can exchange their houses. It helps a person to reduce their expenditure on the trip and have a comfortable stay. In case if a person stays in a villa and wishes to
            swap, then the filter will be applied to show houses that fall in the same category.</p>

        <p> Unlike the traditional Hotel system we are trying to introduce a new concept where a
            person, instead of spending his hard earned money on a Hotel for a couple of nights,
            he/she/other can find a person who is willing to swap their home for a couple of
            days. We will create a listing of homes on our own website. Once we have enough
            users, we will manage an exchange service between the users seeking to exchange
            their homes.</p>

        <h2>Our Team</h2>
         <div class = "usimg">
            <img onmouseout = "outImg(this)"  onmouseenter = "nameImg(this,'Aryak')" src="assets/images/aryak.jpg" width = "200" height = "200">
            <div class ="us"  id = "name"></div>
            <img onmouseout = "outImg(this)" onmouseenter = "nameImg(this,'Shradaya')" id="img2"  src = "assets/images/shradaya.jpg" width = "200" height = "200">
            <div class ="us" id = "name"></div>
            <img onmouseout = "outImg(this)" onmouseenter = "nameImg(this,'Sachin')" id = "img3" src = "assets/images/sachin.jpg" width = "200" height = "200">
            <div class ="us" id = "name"></div>
         </div>

        <h2>How It works</h2>
            <p>The person who wants to exchange his home can log in to our website and search for the city he/she wants to travel. After entering the city name
                the user is shown list of houses on the same city. The user can choose among the houses listed and once they are satisfied, they can call 
                the house owner for a swap. Note that the house listed on out website have all agreed to exchange their homes. The user is provided details of 
                the hosues(images, location, size etc.). Our website is responsible for setting up the users for an exchange, we are not responsible for 
                additional factors such as payement, refund or cancellation. The users have to settle with the home owner manually if they face issues regarding
                the house.
            </p>
    </div>
    </body>

    <script>
    function nameImg(element, name)
    {
        element.style.opacity = "0.2";
        document.getElementById("name").innerHTML = name;
    }

    function outImg(element)
    {
        document.getElementById("name").innerHTML = "";
        element.style.opacity = "1";
    }
    </script>
</html>