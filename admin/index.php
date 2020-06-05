<?php
include('../db.php');
$page = empty($_GET['page']) ? 1 : $_GET['page'];//获取地址栏的参数 page的值
$keyword = empty($_GET['keyword']) ? '' : $_GET['keyword'];
$pagesize = 20; //每页显示20条记录
$offset = ($page - 1) * $pagesize;
$sql = "select * from worker where name like '%$keyword%' limit $offset,$pagesize";

$query = $conn->query($sql); //执行查询命令返回的是结果集
//$row = mysql_fetch_assoc($query); //将结果集转换成数组 ，但是每次只转换一条数据，指针指向下一条,如果下一条没有数据了，直接返回false
$result = array();//创建一个数组
while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
    //print_r($row);
}
//print_r($result);

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>请假系统后台管理-后台管理</title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon"/>
    <link href="/favicon.ico" rel="bookmark icon"/>
</head>
<body>
<div class="lefter">
    <div class="logo"><a href="#" target="_blank">请假后台管理系统</a></div>
</div>
<div class="righter nav-navicon" id="admin-nav">
    <div class="mainer">
        <div class="admin-navbar"><span class="float-right">
                        <a class="button button-little bg-yellow" href="login.php">注销登录</a> </span>
            <ul class="nav nav-inline admin-nav">
                <li class="active"><a href="index.php" class="icon-file-text"> 栏目</a>
                    <ul>
                        <li class="active"><a href="index.php">员工信息管理</a></li>
                        <li><a href="manager.php">部门负责人信息管理</a></li>
                        <li><a href="form.php">请假信息管理</a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-bread"><span>您好，admin，欢迎您的光临。</span>
            <ul class="bread">
                <li><a href="index.php" class="icon-home"> 开始</a></li>
                <li><a href="#">员工管理</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="admin">

    <div class="panel admin-panel">
        <div class="panel-head"><strong>员工列表</strong></div>
        <div class="padding border-bottom">
            <form action="index.php" method="get">
                关键字：<input type="text" name="keyword"/><input class="button button-small checkall" type="submit"
                                                              value="查询"/>
            </form>
            `
            <form method="post">
                <input type="button" class="button button-small checkall" name="checkall" checkfor="id" value="全选"/>
                <a href="worker_add.php" class="button button-small border-green">添加员工</a>
            </form>
        </div>
        <table class="table table-hover">
            <tr>
                <th width="45">选择</th>
                <th width="120">工号</th>
                <th width="*">姓名</th>
                <th width="100">性别</th>
                <th width="100">部门名</th>
                <th width="100">手机号码</th>
                <th width="100">操作</th>
            </tr>
            <?php foreach ($result as $key => $val) { ?>
                <tr>
                    <td><input type="checkbox" name="id" value="1"/></td>
                    <td><?php echo $val['worker_no'] ?></td>
                    <td><?php echo $val['name'] ?></td>
                    <td><?php echo $val['sex'] ? '女' : '男' ?></td>
                    <td><?php echo $val['department_name'] ?></td>
                    <td><?php echo $val['phone'] ?></td>
                    <td><a class="button border-blue button-little"
                           href="worker_edit.php?worker_id=<?php echo $val['worker_id'] ?>">修改</a> <a
                                class="button border-yellow button-little"
                                href="worker_del.php?worker_id=<?php echo $val['worker_id'] ?>"
                                onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
                </tr>
            <?php } ?>

        </table>

        <div class="panel-foot text-center">
            <ul class="pagination">
                <li><a href="index.php?page=<?php echo $page - 1 ?>&keyword=<?php echo $keyword ?>">上一页</a></li>
            </ul>

            <ul class="pagination">
                <li><a href="index.php?page=<?php echo $page + 1 ?>&keyword=<?php echo $keyword ?>">下一页</a></li>
            </ul>
        </div>
    </div>

    <br/>

</body>
</html>