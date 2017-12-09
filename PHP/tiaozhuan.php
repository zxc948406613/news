<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/9 0009
 * Time: 18:10
 */
function tiaozhuan($URL,$notice,$second=3){
    header("Refresh:$second; URL=$URL");
    echo $notice;
}