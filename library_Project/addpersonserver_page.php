<?php

include("data_class.php");

// Check if required fields are present
if(empty($_POST['addname']) || empty($_POST['addpass']) || empty($_POST['addemail']) || empty($_POST['type'])){
    header("Location: student-signup.php?error=All fields are required");
    exit();
}

$addnames = trim($_POST['addname']);
$addpass = trim($_POST['addpass']);
$addemail = trim($_POST['addemail']);
$type = trim($_POST['type']);

// Validate email format
if(!filter_var($addemail, FILTER_VALIDATE_EMAIL)){
    header("Location: student-signup.php?error=Invalid email address");
    exit();
}

// Validate password length
if(strlen($addpass) < 6){
    header("Location: student-signup.php?error=Password must be at least 6 characters long");
    exit();
}

$obj = new data();
$obj->setconnection();
$obj->addnewuser($addnames, $addpass, $addemail, $type);

