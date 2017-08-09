<?php
/**
 * Created by PhpStorm.
 * User: AAA
 * Date: 2017/7/30
 * Time: 17:10
 */
//entry类坐在的空间名
namespace app\home\controller;

//开启houdunwang\core\空间用来调用父类中的对应方法时去对应的空间查找
use houdunwang\core\Controller;
//开启houdunwang\model\空间用来调用Model类时去对应的空间查找
use houdunwang\model\Model;
//开启houdunwang\view\空间用来调用View类时去对应的空间查找
use houdunwang\view\View;
//创建一个entry类来完成一些载入数据、改动数据和模版的操作，
class Entry extends Controller{
//    创建一个index方法完成默认载入数据和载入默认页面的操作
    public function index(){
//        调用\houdunwang\model空间中的model类触发同样空间的base类连接数据库，
//        并执行其中的q方法完成执行有结果集的sql语句获得arc表中的数据并将返回的数据传给\houdunwang\view空间的
//        执行view类触发的base类中的with方法
        $data=Model::q("SELECT * FROM arc ORDER BY aid ASC");
//        将返回的对象返回到houdunwang/core/boot文件中的boot类中的appRun方法中，
//        echo触发__tostring方法，完成载入模版的操作显示默认页面
        return View::make()->with(compact('data'));
    }
//    创建一个add方法完成用户点击添加是跳转到添加页面并完成添加内容的操作
    public function add(){
//        判断是不是POST模式表示用户点击了提交按钮，如果点击了提交按钮就见提交的数据添加到对应的数据库中
        if(IS_POST){
//            将提交的内容添加到对应的表中
            $sql="INSERT INTO arc (title) VALUES ('{$_POST['name']}')";
//            将添加的内容通过无结果集的操作完成SQL语句的执行，将内容添加到数据库的对应表中
            Model::e($sql);
//            将成功的信息传到success方法中将跳转地址传送到setRedirect方法中，并返回来，然后返回到boot类中的APPRUN方法触发__tostring方法载入提示模版，并显示传送的提示信息，完成跳转到index.php
            return $this->success('添加成功')->setRedirect('index.php');

        }
//        调用view中的MAKE方法完成载入添加页面的操作
        return View::make();
    }
//    创建一个remove方法完成删除数据的操作
    public function remove(){
//        将要删除的对应的aid数据也就是get参数传递过来的id添加到sql语句的aid对应的参数上
        $sql="DELETE FROM arc WHERE aid=".$_GET['id'];
//        将编写好的sql语句通过modle类中的e方法也就是无结果集的操作方法，执行sql语句完成删除操作
        Model::e($sql);
//        将对应的提示信息返回到BOOT类中的arrrun方法，将对象输出触发父类/houdunwang/core/controller的__tostring方法将模版引入，将对应的提示信息显示在模版
        return $this->success('删除成功');
    }
//    创建一个updata方法用来完成修改内容的操作
    public function updata(){
//        判断是不是post模式，如果是表示点击了提交按钮，也就是将修改好的内容提交了
        if(IS_POST){
//            将提交的数据通过SQL语句进行修改，将对应的arc表中的aid也就是get参数ID对应的内容修改
            $sql="UPDATE arc SET title='{$_POST['name']}' WHERE aid={$_GET['id']}";
//            通过houdunwang/model空间的base类中的e方法，也就是无结果集的操作执行这个SQL语句完成修改的操作
            Model::e($sql);
//            将修改成功的信息传到父类的success方法中，将对应的跳转地址传送到setRedirect方法中，返回到arrRUN方法中触发父类的__tostring方法引入提示页面，并将传入的提示信息显示在提示页面
            return $this->success('修改成功')->setRedirect('index.php');
        }
//        将修改的内容通过MOdel类中的q方法也就是有结果集的操作执行SQL语句获取对应内容的操作，并将获取的内容传送VIEW类所在空间的base类中的with方法将获得的数据返回到houdunwang/core中的apprun方法输出对象触发__tostring方法将载入修改页面将获得数据显示在修改页面中
        $data=Model::q("SELECT * FROM arc WHERE aid={$_GET['id']}");
//        通过view类空间的base类中的make方法载入修改页面，并将对应的数据一并载入，让修改的内容显示在修改页面
       return View::make()->with(compact('data'));
    }
//    创建一个search方法完成页面的搜索操作
    public function search(){
//        将提交的搜索内容进行转义，防止搜索中有符号被浏览器解析
        $seek=$_GET['seek'];
//        将提交的内容转义
        $seek=addslashes($seek);
//        将要搜索的内容用sql语句跟对应的表中的数据进行匹配，然后通过有结果集的操作执行SQL语句完成查询，最后将查询的结果通过View类空间的BASE类中的with方法将数据接收并返回到/houdunwang/core中的boot类中的ARRRUN方法输出，触发with方法类中的__tostring方法将数据加载到搜索页面
        $sql="SELECT * FROM arc WHERE title LIKE '%{$seek}%'";
//        将sql语句传送到Model类空间的base类中的Q方法完成有结果集的操作，获得查询的数据
        $data=Model::q($sql);
//        将View类空间中的BASE类中的make方法和with方法返回的对象返回到houdunwang/core中的boot类里的apprun方法中输出，触发make方法和with方法类中的__tostring方法完成先加载数据，在加载搜索页面的操作，最后将搜索的数据显示在搜索页面。
        return View::make()->with(compact('data'));
    }

}