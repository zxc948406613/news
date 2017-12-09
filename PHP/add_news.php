<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/2 0002
 * Time: 15:26
 */
include "../html/AAA.php";
include "../PHP/db.php";
$name=$_POST['name'];
$type=$_POST['type'];
$date=$_POST["date"];
$short=$_POST["short"];
$status=(int)$_POST["status"];
$content=$_POST["editorValue"];
$author=$_POST["author"];
$date=$_POST["date"];
$keyword=$_POST["keyword"];
$sql="insert into news(name,type,picture,content,author,time,status,keyword,short) values('$name','$type','$url','$content','$author','$date',$status,'$keyword','$short');";
//
//$sql="select * from news;";
$link=db::instance("localhost","root","","news");
var_dump($link->Query($sql,0));
//var_dump($_POST);
var_dump($url);

