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
<title>请假系统后台管理-负责人界面</title>
</head>
<body>

</body>
</html>
<?php
include('../db.php');
$form_id = $_GET['form_id'];
$status = $_GET['status'];
$approval_time = time();
//计划实现只能审批一次 设置全局变量，初值为0，审批后置为1
$sql="select form_flag from form where form_id='$form_id'";
$query=$conn->query($sql);
$result=mysqli_fetch_assoc($query);
$flag=$result['form_flag'];
if($flag==1)
{
    echo "<script>alert('您已经审批过该申请！');location='index.php'</script>";
    die();
}
    $sql = "update `form` set status = '$status',approval_time='$approval_time',form_flag=1 where form_id='$form_id'";
    $query = $conn->query($sql);
    if ($query) {

        echo "<script>alert('审批成功');location='index.php'</script>";
        die();

    } else {
        echo "<script>alert('审批失败');location='index.php'</script>";
        die();
    }

	