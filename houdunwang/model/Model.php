<?php
/**
 * Created by PhpStorm.
 * User: AAA
 * Date: 2017/7/30
 * Time: 19:26
 */
//model类所在的空间名
namespace houdunwang\model;

//创建一个MODEL类当entry类中的方法调用houdunwang\model空间的这个类时触发当前空间的BASE类完成连接数据库，修改数据库数据，显示数据库数据，删除数据库数据的操作
class Model{
    public static function __callStatic($name, $arguments)
    {
//        将base类中对应的方法返回的操作和数据返回到entry中的对应的方法中
        return call_user_func_array([new Base(),$name],$arguments);
    }

}