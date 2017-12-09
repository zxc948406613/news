<?php
    /**
     * Created by PhpStorm.
     * User: Interact
     * Date: 2017/12/1
     * Time: 17:01
     */
$value = $_POST['shanchu'];
$r=$_POST['shanchu'];
include "../PHP/db.php";
$link=db::instance("localhost","root","","news");
foreach ($r as $key=>$values){
    $b=(int)$values;
    $sql="delete from news where id=$b;";
    $result=$link->Query($sql,0);
   }

//header("Refresh:2; URL='../PHP/xinwen_liebiao.php'");
//echo "删除成功";
include "../PHP/tiaozhuan.php";
tiaozhuan('../PHP/xinwen_liebiao.php','删除成功',2);


