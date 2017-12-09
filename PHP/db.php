<?php

/**
 * Created by PhpStorm.
 * User: Interact
 * Date: 2017/11/21
 * Time: 12:37
 */
class db
{
    public $host; //这个是主机的地址
    public $User;//数据库的使用者
    public $Pwd;//数据库使用者的密码
    public $Dbname;//数据库的名字
    public $my_sql;//这个是你搜寻的mysql语句
    public $link;//这个是连接结果
    public $result;//这个是搜寻的结果
    private $type;

    public $config = array();

    private static $_instance=null;

    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->User = $config['user'];
        $this->Pwd = $config['pwd'];
        $this->Dbname = $config['dbname'];
        //$this->my_sql=$sql;
        $this->link = $this->connect();
        mysqli_set_charset($this->link,'utf8');
        //$this->result=  $this->Query($this->my_sql);
        //$this->type=$type;
    }

    //成员方法   是用来执行sql语句的方法
    public function Query($sql, $type = 1)
        //两个参数：sql语句，判断返回1查询或是增删改的返回
    {
        //造一个连接对象，参数是上面的那四个
        //            $db = new mysqli($this->host,$this->zhang,$this->mi,$this->dbname);
        $db = $this->connect();
        $r = $db->query($sql);

        if ($type == "1") {
            return $r->fetch_all();//查询语句，返回数组.执行sql的返回方式是all，也可以换成row
        } else {
            return $r;
        }
    }

    public function connect()
    {

        return mysqli_connect($this->host, $this->User, $this->Pwd, $this->Dbname);

    }



    public static function instance($host, $user, $pwd, $dbname)
    {
        $config['host'] = $host;
        $config['user'] = $user;
        $config['pwd'] = $pwd;
        $config['dbname'] = $dbname;

            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self($config);
            }
            return self::$_instance;

    }

}
/**
 * $a=db::getinstance(localg=host,root,root,test);
 *
 */