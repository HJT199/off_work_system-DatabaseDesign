<?php
session_start();
include('../db.php');
$manager_id = $_SESSION['manager']['manager_id'];
//把aid = $aid 的文章原来的信息读取出来
$sql = "select * from manager where manager_id = '$manager_id'";
$query = $conn->query($sql);  //结果集
$one = mysqli_fetch_assoc($query);
$sql_de = 'select * from department  ';
$query_de = $conn->query($sql_de);
while ($row_de = mysqli_fetch_assoc($query_de)) {
    $result_de[] = $row_de;
}
?>
    <!DOCTYPE html>
    <html lang="zh-cn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="renderer" content="webkit">
        <title>负责人登陆-修改密码</title>
        <link rel="stylesheet" href="css/pintuer.css">
        <link rel="stylesheet" href="css/admin.css">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
        <link href="/favicon.ico" rel="bookmark icon" />
    </head>
    <body>
    <?php
    if(empty($one)){
        echo "<script>alert('非法操作');location='index.php'</script>";
        die();
    }
    ?>
    <div class="lefter">
        <div class="logo"><a href="#" target="_blank">负责人登录-请假系统</a></div>
    </div>
    <div class="righter nav-navicon" id="admin-nav">
        <div class="mainer">
            <div class="admin-navbar"> <span class="float-right">  <a class="button button-little bg-main" href="index.php">前台首页</a> <a class="button button-little bg-yellow" href="../admin/login.php">注销登录</a> </span>
                <ul class="nav nav-inline admin-nav">
                    <li class="active"><a  class="icon-file-text"> 栏目</a>
                        <ul>
                            <li class="active"><a href="index.php">审批请假信息</a></li>
                            <Li class="active"><a href="form.php">请假历史记录</a></Li>
                            <li class="active"><a href="form_message.php">请假信息统计表</a></li>
                            <Li class="active"><a href="manager_change.php">修改密码</a></Li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div class="admin-bread"> <span>您好，<?php echo $_SESSION['manager']['name'];?>，欢迎您的光临。</span>
                <ul class="bread">
                    <li><a  class="icon-home"> 开始</a></li>
                    <li><a >修改密码</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="admin">

        <form method="post" action="manager_change.php?manager_id=<?php echo $one['manager_id'] ?>">
            <div class="panel admin-panel">
                <div class="panel-head"><strong>修改密码</strong></div>

                <table class="table table-hover">
                    <tr>
                        <td width="150" align="right">工号:</td>
                        <td><input type="text" name="manager_no" value="<?php echo $one['manager_no'] ?> "readonly class="input input30"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right">密码:</td>
                        <td><input type="text" name="password" class="input input30" value="" required/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right">姓名:</td>
                        <td><input type="text" name="name" class="input input30" value="<?php echo $one['name'] ?>" readonly/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right">电话:</td>
                        <td><input name="phone" class="input input30" value="<?php echo $one['phone'] ?>" readonly/></td>
                    </tr>
                </table>
                <div class="panel-foot text-center">
                    <div class="panel-foot text-center"><input type="submit" value="提交" style="text-align:center;" class="button button-block bg-main text-big"></div>
                </div>
            </div>
        </form>

    </div>

    </body>
    </html>
<?php
include('../db.php');

$data = $_POST;

//判断表单是否有提交
if(!empty($data)){

    $manager_no = $data['manager_no'];
    $password = md5($data['password']);
    $name = $data['name'];
    $phone = $data['phone'];
    $sql = " update manager set `password`='$password'";
    $query=$conn->query($sql);
    if($query){

        echo "<script>alert('修改密码成功');location='index.php'</script>";	die();

    }else{
        echo "<script>alert('修改密码失败');location='index.php'</script>";	die();
    }



}





