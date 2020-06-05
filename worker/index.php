<?php
    session_start(); //使用session传值
	include('../db.php'); //连接数据库
	$page = empty($_GET['page'])?1:$_GET['page'];//获取地址栏的参数 page的值
	$keyword = empty($_GET['keyword'])?'':$_GET['keyword'];
	$pagesize = 5; //每页显示5条记录
	$offset = ($page-1)*$pagesize;
	$id=$_SESSION['worker']['worker_id'];
	//echo  $id;
	$sql = "select * from `form` where form_reason like '%$keyword%'and worker_id=$id limit $offset,$pagesize";
	$query = $conn->query($sql); //执行查询命令返回的是结果集
    //echo var_dump($query);
	//$row = mysql_fetch_assoc($query); //将结果集转换成数组 ，但是每次只转换一条数据，指针指向下一条,如果下一条没有数据了，直接返回false
	$result = array();
    while($row = mysqli_fetch_assoc($query)){
		
		$sql = "select * from manager where manager_id = ".$row['manager_id'];
		$q = $conn->query($sql);
		$one = mysqli_fetch_assoc($q);
		
		$row['manager_name'] = $one['name'];
		
		$result[] = $row;
		//print_r($row);
	}
	//print_r($result);

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
    <div class="admin-navbar"> <span class="float-right">  <a class="button button-little bg-yellow" href="../admin/login.php">注销登录</a> </span>
      <ul class="nav nav-inline admin-nav">
        <li class="active"><a  class="icon-file-text"> 栏目</a>
          <ul>
            <li class="active"><a href="index.php">我的请假信息</a></li>
            <li class="active"><a href="worker_change.php">修改密码</a></li>
           
          </ul>
        </li>
      </ul>
    </div>
    <div class="admin-bread"> <span>您好，<?php echo $_SESSION['worker']['name'];?>，欢迎您的光临。</span>
      <ul class="bread">
        <li><a  class="icon-home"> 开始</a></li>
        <li><a ">请假记录</a></li>
       
      </ul>
    </div>
  </div>
</div>
<div class="admin">
  
    <div class="panel admin-panel">
      <div class="panel-head"><strong>我的请假信息列表</strong></div>
      <div class="padding border-bottom">
          <!--填写关键字对自己的请假信息查询-->
      	<form action="index.php" method="get">
    	关键字：<input type="text" name="keyword" /><input class="button button-small checkall" type="submit" value="查询" />
        </form>
         <form method="post">
            <a href="form_add.php" class="button button-small border-green">我要请假</a>
       </form>
      </div>
      <table class="table table-hover">
        <tr>
            <th width="220">请假开始时间</th>
            <th width="220">请假结束时间</th>
            <th width="120">请假天数</th>
            <th width="300">请假原因</th>
            <th width="100">请假类型</th>
            <th width="200">请假提交时间</th>
            <th width="100">审批人</th>
            <th width="100">审批时间</th>
            <th width="100">审批状态</th>
       
        </tr>
          <?php foreach ($result as $key => $val) { ?>
              <tr>
                  <td><?php echo $val['form_start_time'] ?></td>
                  <td><?php echo $val['form_end_time'] ?></td>
                  <td><?php echo $val['form_length'] ?></td>
                  <td><?php echo $val['form_reason'] ?></td>
                  <td><?php echo $val['form_type'] ?></td>
                  <td><?php echo date("Y-m-d H:i:s", $val['add_time']) ?></td>
                  <td><?php echo $val['manager_name'] ?></td>
                  <td><?php echo date("Y-m-d H:i:s", $val['approval_time']); ?></td>
                  <td>
		  <?php
		    switch($val['status']){
				case '1':
					echo "<font color='green'>审批通过</font>";
				break;
				case '0':
					echo "<font color='orange'>等待审批</font>";
				break;
				case '-1':
					echo "<font color='red'>审批不通过</font>";
				break;
				
				}
		    ?>
          
          </td>
         
        </tr>
         <?php } ?>
       
      </table>
   
      <div class="panel-foot text-center">
        <ul class="pagination">
          <li><a href="index.php?page=<?php echo $page-1?>&keyword=<?php echo $keyword  ?>">上一页</a></li>
        </ul>
       
        <ul class="pagination">
          <li><a href="index.php?page=<?php echo $page+1?>&keyword=<?php echo $keyword  ?>">下一页</a></li>
        </ul>
      </div>
    </div>
  
  <br />
  
</body>
</html>