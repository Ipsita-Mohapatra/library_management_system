<?php

include("data_class.php");

$login_email = isset($_GET['login_email']) ? trim($_GET['login_email']) : '';
$login_pasword = isset($_GET['login_pasword']) ? trim($_GET['login_pasword']) : '';

$errors = array();

if(empty($login_email)){
    $errors['email'] = "Email is required";
}

if(empty($login_pasword)){
    $errors['password'] = "Password is required";
}

if(!empty($errors)){
    $emailmsg = isset($errors['email']) ? $errors['email'] : '';
    $pasdmsg = isset($errors['password']) ? $errors['password'] : '';
    header("Location: student-login.php?emailmsg=" . urlencode($emailmsg) . "&pasdmsg=" . urlencode($pasdmsg));
    exit();
}

$obj = new data();
$obj->setconnection();
$obj->userLogin($login_email, $login_pasword);

