<?php
include('../db.php');
//连接部门表
$sql = 'select * from department  ';
$query = $conn->query($sql);
//$result = array();
while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}
//echo var_dump($result);
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
            <div class="admin-navbar"><span class="float-right"> <a class="button button-little bg-main"
                                                                    href="index.php">前台首页</a> <a
                            class="button button-little bg-yellow" href="login.pph">注销登录</a> </span>
                <ul class="nav nav-inline admin-nav">
                    <li class="active"><a href="content.html" class="icon-file-text"> 栏目</a>
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
                    <li><a ">员工管理</a></li>

                </ul>
            </div>
        </div>
    </div>
<div class="admin">

    <form method="post" action="worker_add.php">
    <div class="panel admin-panel">
    <div class="panel-head"><strong>添加员工</strong></div>

    <table class="table table-hover">
    <tr>
        <td width="150" align="right">工号:</td>
        <td><input type="text" name="worker_no" class="input input30"/></td>
    </tr>
    <tr>
        <td width="150" align="right">密码:</td>
        <td><input type="text" name="password" class="input input30"/></td>
    </tr>
    <tr>
        <td width="150" align="right">姓名:</td>
        <td><input type="text" name="name" class="input input30"/></td>
    </tr>
    <tr>
        <td width="150" align="right">电话:</td>
        <td><input name="phone" type="text" class="input input30"/></td>
    </tr>
    <tr>
        <td width="150" align="right">性别:</td>
        <td><input type="radio" class="radio" value="0" name="sex">男<input type="radio" value="1" name="sex"> 女</td>
    </tr>
    <!--<tr>
        <td width="150" align="right">部门id:</td>
        <td><input type="text" name="department_id" class="input input30"/></td>
    </tr>-->
    <tr>
    <td width="150" align="right">部门名称:</td>
        <td>
            <select name="department_name">
                <?php foreach ($result as $k => $v) { ?>
                    <option value="<?php echo $v['department_name'] ?>"><?php echo $v['department_name'] ?></option>
                <?php } ?>

            </select>
        </td>
    </tr>
    </table>
    <div class="panel-foot text-center">
        <div class="panel-foot text-center"><input type="submit" value="提交" style="text-align:center;"
                                                   class="button button-block bg-main text-big"></div>
    </div>
    </div>
    </form>

    </div>

    </body>
    </html>
    <?php


    $data = $_POST;

    //判断表单是否有提交
    if (!empty($data)) {
        $worker_no = $data['worker_no'];
        $password = md5($data['password']);
        $name = $data['name'];
        $department_name = $data['department_name'];
        //echo  $department_name;
        $sql="select department_id from department where department_name='$department_name'";
        $query = $conn->query($sql);
        $result=mysqli_fetch_assoc($query);
        $department_id=$result['department_id'];
        $sex = $data['sex'];
        $phone = $data['phone'];
        $sql = "insert into worker (`worker_no`,`password`,`name`,`phone`,`sex`,`department_id`,`department_name`) value('$worker_no','$password','$name','$phone','$sex','$department_id','$department_name')";
        $query = $conn->query($sql);
        if ($query) {
            echo "<script>alert('添加员工成功');location='index.php'</script>";
            die();
        } else {
            //echo $department_id,$name,$department_name;
            echo "<script>alert('添加员工失败');//location='index.php'</script>";
            die();
        }
    }
	
	
	
	
	
	