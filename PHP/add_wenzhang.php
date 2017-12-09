<?php
    /**
     * Created by PhpStorm.
     * User: Interact
     * Date: 2017/12/1
     * Time: 11:43
     */
include "../PHP/db.php";
$sql="select name from newstype;";
$link=db::instance("localhost","root","","news");
$result=$link->Query($sql);
include "../html/article-add.html";