<?php
	include('../db.php'); 
	$manager_id = $_GET['manager_id'];
	//把aid = $aid 的文章原来的信息读取出来
	$sql = "select * from manager where manager_id = '$manager_id'";
	$query = $conn->query($sql);  //结果集
	$one = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title>请假系统后台管理-后台管理</title>
<link rel="stylesheet" href="css/pintuer.css">
<link rel="stylesheet" href="css/admin.css">
<link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
<link href="/favicon.ico" rel="bookmark icon" />
</head>
<body>
<?php 
	if(empty($one)){
		echo "<script>alert('非法操作');location='manager.php'</script>";
		die();
	}
?>
<div class="lefter">
  <div class="logo"><a href="#" target="_blank">请假后台管理系统</a></div>
</div>
<div class="righter nav-navicon" id="admin-nav">
  <div class="mainer">
    <div class="admin-navbar"> <span class="float-right">  <a class="button button-little bg-main" href="index.php">前台首页</a> <a class="button button-little bg-yellow" href="login.php">注销登录</a> </span>
      <ul class="nav nav-inline admin-nav">
        <li class="active"><a href="content.html" class="icon-file-text"> 栏目</a>
          <ul>
            <li class="active"><a href="index.php">员工信息管理</a></li>
            <li ><a href="manager.php">负责人信息管理</a></li>
            <li><a href="form.php">请假信息管理</a></li>
          
          </ul>
        </li>
      </ul>
    </div>
    <div class="admin-bread"> <span>您好，admin，欢迎您的光临。</span>
      <ul class="bread">
        <li><a  class="icon-home"> 开始</a></li>
        <li><a >负责人管理</a></li>
       
      </ul>
    </div>
  </div>
</div>
<div class="admin">
  
  <form method="post" action="manager_edit.php?manager_id=<?php echo $one['manager_id'] ?>">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>修改负责人</strong></div>

        <table class="table table-hover">
            <tr>
                <td width="150" align="right">编号:</td>
                <td><input type="text" name="manager_no" value="<?php echo $one['manager_no'] ?>"
                           class="input input30"/></td>
            </tr>
            <tr>
                <td width="150" align="right">密码:</td>
                <td><input type="text" name="password" class="input input30" value=""/></td>
            </tr>
            <tr>
                <td width="150" align="right">姓名:</td>
                <td><input type="text" name="name" class="input input30" value="<?php echo $one['name'] ?>"/></td>
            </tr>
            <tr>
                <td width="150" align="right">性别:</td>
                <td><input type="radio" class="radio" value="0" name="sex" <?php if ($one['sex'] == 0) {
                        echo 'checked="checked"';
                    } ?>>男<input type="radio" value="1" name="sex" <?php if ($one['sex'] == 1) {
                        echo 'checked="checked"';
                    } ?>> 女
                </td>
            </tr>
            <tr>
                <td width="150" align="right">电话:</td>
                <td><input name="phone" class="input input30" value="<?php echo $one['phone'] ?>"/></td>
            </tr>
            <tr>
                <td width="150" align="right">部门id:</td>
                <td><input name="department_id" class="input input30" value="<?php echo $one['department_id'] ?>"/></td>
            </tr>
            <tr>
                <td width="150" align="right">部门名称:</td>
                <td><input name="department_name" class="input input30" value="<?php echo $one['department_name'] ?>"/></td>
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
		$sex = $data['sex'];
		$phone = $data['phone'];
        $department_id = $data['department_id'];
        $department_name = $data['department_name'];
        if (empty($data['password'])) {
            $sql = " update manager set `manager_no`='$manager_no',`name`='$name',`sex`='$sex',`phone`='$phone',`department_id`='$department_id',`department_name`='$department_name' where manager_id = '$manager_id'";
        } else {
            $sql = " update manager set `manager_no`='$manager_no',`name`='$name',`sex`='$sex',`password`='$password',`phone`='$phone',`department_id`='$department_id',`department_name`='$department_name' where manager_id = '$manager_id'";
        }
        $query= $conn->query($sql);
        //$num = mysqli_affected_rows($query);//获取影响行数
		//mysql_query($sql);
		//$num = mysql_affected_rows();//获取影响行数
		if($query){
		
			echo "<script>alert('编辑负责人成功');location='manager.php'</script>";	die();
			
			}else{
				echo "<script>alert('编辑负责人失败');location='manager.php'</script>";	die();
				}
		
	
		
}
	
	
	
	
	
	