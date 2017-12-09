<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/9 0009
 * Time: 18:16
 */
include "../PHP/tiaozhuan.php";
$username=$_POST['username'];
$password=$_POST['password'];
$password=$_POST['yanzhengma'];
var_dump($_POST);
var_dump($username);
var_dump($password);
session_start();
var_dump($_SESSION);
if($_POST['username']=="123" && $_POST['password']=="123"&&$_POST['yanzhengma']==$_SESSION['captcha_code']){

    tiaozhuan('../PHP/index.php','',0);
}
else{
    tiaozhuan('../PHP/login.php','登录失败',2);
}