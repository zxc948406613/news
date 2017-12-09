<?php
    /**
     * Created by PhpStorm.
     * User: Interact
     * Date: 2017/12/1
     * Time: 16:17
     */
include "../PHP/db.php";
$type=$_POST['leibie'];
$sql="insert into newstype(name) values('$type');";

//$sql="select * from news;";
$link=db::instance("localhost","root","","news");
var_dump($link->Query($sql,0));
var_dump($_POST);


