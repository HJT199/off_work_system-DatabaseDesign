<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>请假系统登录</title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link href="/favicon.ico" rel="bookmark icon" />
</head>

<body background="css/login.jpg">
<div class="container">
    <div class="line">
        <div class="xs6 xm4 xs3-move xm4-move">
            <br /><br />
            <div class="media media-y"></div>
            <br /><br />
            <form action="login.php" method="post">
            <div class="panel">
                <div class="panel-head"><strong>登录请假后台管理系统</strong></div>
                <div class="panel-body" style="padding:30px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input" name="name" placeholder="登陆账号" required />
                            <span class="icon icon-user"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input" name="password" placeholder="登录密码" required />
                            <span class="icon icon-key"></span>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="field field-icon-right">
                            <select name="id_type">
                                <option value="部门负责人">部门负责人</option>
                                <option value="员工">员工</option>
                                <option value="后台管理员">后台管理员</option>
                            </select>
                            <span class="icon icon-user"></span>
                        </div>
                    </div>
                </div>
                <div class="panel-foot text-center"><input type="submit" class="button button-block bg-main text-big" value="立即登录后台"></div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
include('../db.php');
$data = $_POST;
//echo var_dump($data);
//保证表单提交数据后才处理
if(!empty($data)){
	$name = $data['name'];
	$id_type=$data['id_type'];
	//根据登陆选择的身份类型查找不同的表,再跳转到不同的页面
    switch($id_type){
        case '部门负责人':
            $password = md5($data['password']);
            $sql = "select * from manager where manager_no = '$name' and password = '$password'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if(!empty($row)){
                $_SESSION['manager'] = $row;
                echo "<script>location='../manager/index.php'</script>";die();
            }else{
                echo "<script>alert('账号密码错误');location='login.php'</script>";die();
            }

            break;
        case '员工' :
            $password = md5($data['password']);
            $sql = "select * from worker where worker_no = '$name' and password = '$password'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if(!empty($row)){
                $_SESSION['worker'] = $row;
                echo "<script>location='../worker/index.php'</script>";die();
            }else{
                echo "<script>alert('账号密码错误');location='login.php'</script>";die();
            }
            break;
        default:
            $password = $data['password'];
            $sql = "select * from admin where name = '$name' and password = '$password'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if(!empty($row)){
                echo "<script>location='index.php'</script>";die();
            }else{
                echo "<script>alert('账号密码错误');location='login.php'</script>";die();
            }
            break;
            $check='admin';
    }

}


