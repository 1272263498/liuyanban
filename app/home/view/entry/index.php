<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
</head>
<body>
<div style="width: 800px;margin: 0px auto;">
    <form action="" method="get">
        <div class="form-group">
            <input type="hidden" class="form-control" id="exampleInputName2" name="s" value="home/entry/search">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="exampleInputName2" name="seek">
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
</div>
<div style="width: 800px; margin: 0px auto;">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $v ):?>
        <tr>
            <td><?php echo $v['aid']?></td>
            <td><?php echo $v['title']?></td>
            <td>
                <a href="javascript:if(confirm('确定删除吗？')) location.href='?s=home/entry/remove&id=<?php echo $v['aid']?>';" class="btn btn-primary btn-xs btn-danger">删除</a>
                <a href="?s=home/entry/updata&id=<?php echo $v['aid']?>" class="btn btn-primary btn-xs">修改</a>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <a href="?s=home/entry/add" class="btn btn-primary">去添加</a>
</div>
</body>
</html>