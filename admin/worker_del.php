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
</body>
</html>
<?php
include('../db.php');
$worker_id = $_GET['worker_id'];

//保证文章存在
$sql = "select * from worker where worker_id = '$worker_id'";
$query = $conn->query($sql);  //结果集
$one = mysqli_fetch_assoc($query);
if(empty($one)){
		echo "<script>alert('非法操作');location='index.php'</script>";
		die();
 }


$sql ="delete from worker where worker_id='$worker_id' ";
$query= $conn->query($sql);
if($query){
		   
			echo "<script>alert('删除员工成功');location='index.php'</script>";	die();
			
			}else{
				echo "<script>alert('删除员工失败');location='index.php'</script>";	die();
				}
		


	
	
	