<?php
/**
 * 上传函数
 * @param $tmp_file  $_FILES的五个信息,比如upload（$_FILES('mingzi')
 * $_FILES里面的名字是你的对应的html代码中的上传文件的那个name
 * @return bool  失败返回false，成功就是true
 */
$tmp_file=$_FILES['picture'];
function upload($tmp_file){

    /**
     * 是否存在错误
     */

    if($tmp_file['error']!=0){
        echo '文件上传错误';
        return false;
    }
    /**
     * 尺寸，
     * 这个函数自己定的，但是应该是初始化设定的，就是这个值是变化的，不是一个固定的值。
     */

    $max_size=1024*1024*10;//自己设定的最大尺寸
    if($tmp_file['size']>$max_size){
        echo "文件过大";
        return false;
    }
    /**
     * 验证后缀名，
     * 用验证后缀和MIME方法
     */
    //首先是验证后缀名
    $tmp_file_zhui=strrchr($tmp_file['name'],'.') ;
    //strrchr函数是来剪切字符串的最后出现.的包括这个.后面的全部截取
    //后缀的映射数组，其实就是那个满足条件的后缀表（用关联数组表示）
    $tmp_file_zhui_list=array(
        '.png','.gif','.jpeg','.jpg'
    );
    if(!in_array($tmp_file_zhui,$tmp_file_zhui_list)){
        echo "文件格式有问题";
        return false;
    }
    //就是那个$_FILES['type']有一个格式，下面的是对应那个映射表
    $tmp_file_zhui_MIMElist=array(
        '.png'=>array('image/png','image/x-png'),
        '.jpg'=>array('image/jpeg','image/x-pjpeg'),
        '.jpeg'=>array('image/jpeg','image/pjpeg'),
        '.gif'=>array('image/gif'),
    );
    $old_list=array();//下面直接用$old_list不行，我觉得这个就是声明，这是自己加的
    //得出真正的映射表，因为在我的后缀映射表中，可能不是这四个，一旦发生改动，我的下面的映射关系，我还得自己改，所以，我就用一个foreach，上面有什么后缀，我的下面就给他对应上什么$_FILE['type']格式，然后得到我要的MIME映射表
    foreach ($tmp_file_zhui_list as $value){
        foreach($tmp_file_zhui_MIMElist[$value] as $key=>$item){
            //               var_dump($tmp_file_zhui_MIMElist[$value][$key]);
            $new_MIME_list=array_merge($old_list,(array)$tmp_file_zhui_MIMElist[$value][$key]);
            $old_list=$new_MIME_list;
        }

    }
    //去重
    $new_MIME_list=array_unique($new_MIME_list);

    //然后用MIME验证
    $phpfinfo=new finfo(FILEINFO_MIME_TYPE);
    $f_type=$phpfinfo->file($tmp_file['tmp_name']);
//        echo $f_type;
    if(!in_array($f_type,$new_MIME_list)){
        echo "文件格式有误";
        return false;
    }
    //后缀验证完成。
    //建立一个文件夹，来存我的临时文件
    if(!is_dir('./upload')){
        mkdir('./upload');
    }

    $sub_dir_name=date('Y--m-d-H');//截取年月日小时
    //unipid是产生一个随机名字，可以试验一下  echo uniqid（）;

    move_uploaded_file($tmp_file['tmp_name'],'../upload/'.uniqid('upload_'.$sub_dir_name.'_').$tmp_file_zhui);
    $url="../upload/".uniqid('upload_'.$sub_dir_name.'_').$tmp_file_zhui;
//    var_dump($url);
    return $url;
}
$url=upload($tmp_file);