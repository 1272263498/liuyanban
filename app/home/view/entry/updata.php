<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
</head>
<body>
<div style="width: 500px;margin:100px auto;">
    <form action="" method="post">
        <div class="form-group">
            <label for="exampleInputPassword1">修改内容</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="name" value="<?php echo $data[0]['title'] ;?>">
        </div>
        <button type="submit" class="btn btn-default btn btn-info">修改</button>
        <a href="index.php" class="btn btn-default btn btn-primary">返回主页</a>
    </form>
</div>
</body>
</html>