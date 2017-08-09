<?php
/**
 * Created by PhpStorm.
 * User: AAA
 * Date: 2017/7/30
 * Time: 19:27
 */
//base类所在的空间名
namespace houdunwang\model;
//开启pdo所在的空间，完成操作数据库的一些操作
use PDO;
//开启PDOException所在的空间
use PDOException;
//创建一个base类用来执行连接数据库，查看数据库数据，修改数据的一些操作并对应的数据返回给对应的方法中
class Base{
//    创建一个静态属性pdo用来连接数据库，如果为空就连接数据库，如果不为空表示数据库已经连接
    private static $pdo=NULL;
//    当调用BASE类时自动执行这个方法，并调用当前类的connect方法连接数据库
    public function __construct()
    {
        $this->connect();
    }
//    创建一个CONNECT方法用来连接数据库的操作
    private function connect(){
//        判断静态属性的值是不是为NULL如果为NULL表示没有连接数据库，如果不为NULL表示数据库已经连接，防止重复连接数据库
        if(is_null(self::$pdo)){
//            将产生的错误转化为异常错误，因为只有异常错误才能捕获到，并将异常错误输出到页面
            try{
//                调用C函数引用c函数中的参数连接对应的数据库
                $dsn="mysql:host=".c('database.db_host').';'.'dbname='.c('database.db_name');
//                连接数据库
                $pdo=new PDO($dsn,c('database.db_user'),c('database.db_password'));
//                设置错误方法为异常错误
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//                将数据库编码设置成c函数对应的参数
                $pdo->exec("SET NAMES ".c("database.db_charset"));
//                将$pdo对象赋值给静态属性$pdo，表示已经连接了数据库防止重复连接
                self::$pdo=$pdo;
            }catch(PDOException $e){
//                输出抓获的异常错误并中断后面的代码
                exit($e->getMessage());
            }
        }
    }
//    创建一个get方法用来获取对应表的所有数据
    public function get($src){
//        1获取传过来的对应的表的数据，将对应的表添加到获取所有数据的SQL语句中，
//         2并通过有结果集的操作完成获取数据，并将获取的数据转换才关联数组返回到对应的对象
        $sql = "SELECT * FROM {$src}";
//        通过有结果集的操作执行sql语句完成获取对应表的数据
        $result=self::$pdo->query($sql);
//        将多去的数据转换成关联数组
        $data= $result->fetchAll(PDO::FETCH_ASSOC);
//        将转好的数据返回给当前的对象
        return $data;

    }
//    创建一个q方法用来执行一些有结果集的sql语句，并将获取的数据返回给当前对象
    public function q($sql){
//        将错误信息转换成异常错误，因为只有异常错误才能捕获
        try{
//            通过有结果集的操作执行传递过来的sql语句，并将获取的结果赋值给$result
            $result=self::$pdo->query($sql);
//            将获取的结果转换成关联数组返回给当前对象
            return $result->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){//捕获错误信息并传到对象$e
//            输出捕获的错误信息并中断代码执行
            exit($e->getMessage());
        }
    }
//创建一个e方法用来执行一些没有结果集的sql语句，并将获取的数据返回给当前对象
    public function e($sql){
//        将错误信息转换成异常错误，因为只有异常错误才能捕获
        try{
//            通过没有结果集的操作执行传递过来的sql语句，并将执行完获取的结果赋值给$afRows
            $afRows=self::$pdo->exec($sql);
//            将获取的结果返回给当前对象
            return $afRows;
        }catch(PDOException $e){//捕获错误信息并传到对象$e
//            输出捕获的错误信息并中断代码执行
            exit($e->getMessage());
        }
    }
}