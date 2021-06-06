<?php

    session_start();
    unset($_SESSION["userLoggedIn"]);
    header("Location:Homepage.php");
?>