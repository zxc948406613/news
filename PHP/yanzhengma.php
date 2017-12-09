<?php
    /**
     * 验证码 工具
     */



    /**
     * 输出生成的验证码输出
     *
     * @param $code_len=4 码值的长度
     * @return void
     */


    $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';//所有可能字符
    $chars_len = strlen($chars);
    $code_len=4;//设置码长，这个是自己设定的
    $code = '';//初始化码值字符串
    for($i=1; $i<=$code_len;++$i) {
        $rand_index = mt_rand(0, $chars_len-1);//就是堆积生成一个字符,这个得到上面$chars字符串的下标
        $code .= $chars[$rand_index];//由下标找到对应的字符，字符串支持[]操作，通过下标取得某个字符
    }
    //            echo $code;

    //存储于session，用于验证
    @session_start();//保证session机制一定是开启的，同时重复开启不会报错，@屏蔽错误。
    $_SESSION['captcha_code'] = strtolower($code);

    //生成验证码图片

    //背景图，随便加的
    $bg_file =  '../captcha/captcha' . mt_rand(1, 2) . '.png';

    //基于jpg格式的图片创建画布
    $img = imagecreatefrompng($bg_file);

    //随机分配字符串颜色，就是三分之一的比例
    $str_color = mt_rand(1, 3) == 1 ? imageColorAllocate($img, 0, 0, 0) : imageColorAllocate($img, 0xff, 0xff, 0xff);

    //字符串
    $font = 5;
    // 画布尺寸
    $img_w = imageSX($img);
    $img_h = imageSY($img);
    // 字体的尺寸
    $font_w = imageFontWidth($font);
    $font_h = imageFontHeight($font);
    // 字符串的尺寸
    $code_w = $font_w * $code_len;
    $code_h = $font_h;
    $x = ($img_w-$code_w)/2;
    $y = ($img_h-$code_h)/2;
    imageString($img, $font, $x, $y, $code, $str_color);

    //输出
    header('Content-Type: image/jpeg;');
    imagepng($img);

