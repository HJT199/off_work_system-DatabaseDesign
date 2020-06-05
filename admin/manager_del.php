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
$manager_id = $_GET['manager_id'];

//保证文章存在
$sql = "select * from manager where manager_id = '$manager_id'";
$query = $conn->query($sql);  //结果集
$one = mysqli_fetch_assoc($query);
if(empty($one)){
		echo "<script>alert('非法操作');location='manager.php'</script>";
		die();
 }


$sql ="delete from manager where manager_id='$manager_id' ";
//mysql_query($sql);
//$num = mysql_affected_rows();//获取影响行数
$query= $conn->query($sql);
//$num = mysqli_affected_rows($query);//获取影响行数
if($query){
		   
			echo "<script>alert('删除负责人成功');location='manager.php'</script>";	die();
			
			}else{
				echo "<script>alert('删除负责人失败');location='manager.php'</script>";	die();
				}
		


	
	
	