<?php
	session_start();
	include('../db.php'); 
	//读取部门负责人信息列表
    //本部门员工只能向本部门负责人提出申请
    $department_id=$_SESSION['worker']['department_id'];
	$sql = "select * from manager where department_id='$department_id' ";
	$query = $conn->query($sql);
	$result = array();
    while($row = mysqli_fetch_assoc($query)){
		$result[] = $row;
	}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
    <title>员工登录-请假系统</title>
<link rel="stylesheet" href="css/pintuer.css">
<link rel="stylesheet" href="css/admin.css">
<link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
<link href="/favicon.ico" rel="bookmark icon" />
</head>
<body>
<div class="lefter">
    <div class="logo"><a href="#" target="_blank">员工登录-请假系统</a></div>
</div>
<div class="righter nav-navicon" id="admin-nav">
  <div class="mainer">
    <div class="admin-navbar"> <span class="float-right"> <a class="button button-little bg-main" href="index.php">前台首页</a> <a class="button button-little bg-yellow" href="../admin/login.php">注销登录</a> </span>
      <ul class="nav nav-inline admin-nav">
        <li class="active"><a href="content.html" class="icon-file-text"> 栏目</a>
          <ul>
            <li class="active"><a href="index.php">我的请假信息</a></li>
            
          
          </ul>
        </li>
      </ul>
    </div>
    <div class="admin-bread"> <span>您好，<?php echo  $_SESSION['worker']['name']?>，欢迎您的光临。</span>
      <ul class="bread">
        <li><a class="icon-home">开始</a></li>
        <li><a >请假申请填写</a></li>
       
      </ul>
    </div>
  </div>
</div>
<div class="admin">
  
  <form method="post" action="form_add.php">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>我要请假</strong></div>
     
        <table class="table table-hover">
        	<tr><td width="150" align="right">请假起始日期:</td><td><input type="date" name="form_start_time" class="input input30"/></td></tr>
            <tr><td width="150" align="right">请假结束日期:</td><td><input type="date" name="form_end_time" class="input input30"/></td></tr>
            <tr><td width="150" align="right">请假的理由:</td><td><textarea  name="form_reason" cols="80"></textarea></td></tr>
            <tr>
                <td width="150" align="right">请假类型:</td>
                <td>
                <select name="form_type">
                    <option value="01">事假</option>
                    <option value="02">病假</option>
                    <option value="03">出差</option>
                    <option value="04">带薪休假</option>
                </select>

                </td>
            </tr>
            <tr>
                <td width="150" align="right">审批人:</td>
                <td>
                    <select name="manager_id">
                        <option value="0" >---选择申请对象---</option>
                        <?php foreach ($result as $k => $v) { ?>
                            <option value="<?php echo $v['manager_id'] ?>"><?php echo $v['name'] ?></option>
                        <?php } ?>

                    </select>
                </td>
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
	
	
	$data = $_POST;
	
	//判断表单是否有提交
	if(!empty($data)){
		
		$form_start_time = $data['form_start_time'];
		$form_end_time=$data['form_end_time'];
		$form_reason = $data['form_reason'];
		$worker_name=$_SESSION['worker']['name'];
		$manager_id = $data['manager_id'];  //dsada
		$worker_id = $_SESSION['worker']['worker_id']; //
		$form_type=$data['form_type'];
        $add_time = time();
		$status = 0;
		//算出请假日期
        for($i = strtotime($form_start_time); $i <=strtotime($form_end_time); $i+=86400)
        {
            $days[] =strtotime(date('Y-m-d',$i));
        }
        $form_length = count($days);
        $form_length--;
        $sql = "insert into `form` (`form_start_time`, `form_end_time`,`form_length`,`form_reason`,`manager_id`,`worker_id`,`add_time`,`status`,`worker_name`,`form_type`,`department_id`) 
            values ('$form_start_time','$form_end_time','$form_length','$form_reason','$manager_id','$worker_id','$add_time','$status','$worker_name','$form_type','$department_id')";
        $query = $conn->query($sql);
		//mysql_query($sql);
		//$num = mysqli_affected_rows($query);//获取影响行数
		if($query){
		
			echo "<script>alert('申请成功,等待负责人审批');location='index.php'</script>";	die();

			}else{
		        echo "$form_start_time,$form_reason,$worker_name,$manager_id,$worker_id,$form_type,$add_time,$status";
				//echo "<script>alert('申请失败');location='index.php'</script>";	die();
				}
		
	
		
}
	
	
	
	