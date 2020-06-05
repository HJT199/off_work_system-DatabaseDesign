<?php
session_start();
include('../db.php');
$page = empty($_GET['page'])?1:$_GET['page'];//获取地址栏的参数 page的值
$keyword = empty($_GET['keyword'])?'':$_GET['keyword'];

$pagesize = 5; //每页显示5条记录
$offset = ($page-1)*$pagesize;
$sql = "select * from `form` where  status='1' and form_start_time<current_date() and form_reason like '%$keyword%' limit $offset,$pagesize";
$query = $conn->query($sql); //执行查询命令返回的是结果集
//将结果集转换成数组 ，但是每次只转换一条数据，指针指向下一条,如果下一条没有数据了，直接返回false
$result = array();
while($row = mysqli_fetch_assoc($query)){

    $sql = "select * from worker where worker_id = ".$row['worker_id'];
    $q = $conn->query($sql);
    $one = mysqli_fetch_assoc($q);
    $row['worker_name'] = $one['name'];
    $row['department_id']=$one['department_id'];
    $row['department_name'] = $one['department_name'];
    $row['worker_no'] = $one['worker_no'];
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
    <title>请假系统后台管理-负责人界面</title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link href="/favicon.ico" rel="bookmark icon" />
</head>
<body>
<div class="lefter">
    <div class="logo"><a href="#" target="_blank">请假后台管理系统</a></div>
</div>
<div class="righter nav-navicon" id="admin-nav">
    <div class="mainer">
        <div class="admin-navbar"> <span class="float-right"> <a class="button button-little bg-main" href="index.php">前台首页</a><a class="button button-little bg-yellow" href="../admin/login.php">注销登录</a> </span>
            <ul class="nav nav-inline admin-nav">
                <li class="active"><a  class="icon-file-text"> 栏目</a>
                    <ul>
                        <li class="active"><a href="index.php">审批请假信息</a></li>
                        <li><a href="form.php">请假历史记录</a></li>
                        <li class="active"><a href="form_message.php">请假信息统计表</a></li>
                        <Li class="active"><a href="manager_change.php">修改密码</a></Li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-bread"> <span>您好，<?php echo $_SESSION['manager']['name']; ?>，欢迎您的光临。</span>
            <ul class="bread">
                <li><a href="index.php" class="icon-home"> 开始</a></li>
                <li><a员工请假管理</a></li>

            </ul>
        </div>
    </div>
</div>
<div class="admin">

    <div class="panel admin-panel">
        <div class="panel-head"><strong>全体员工请假信息列表</div>

        <div class="padding border-bottom">
            <form action="index.php" method="get">
                关键字：<input type="text" name="keyword"  /><input class="button button-small checkall" type="submit" value="查询" />
            </form>
        </div>
        <table class="table table-hover">
            <tr>
                <th width="350">请假开始时间</th>
                <th width="80">员工编号</th>
                <th width="180">员工姓名</th>
                <th width="200">部门编号</th>
                <th width="280">部门名称</th>
                <th width="200">请假类型</th>
                <th width="100">累计天数</th>
            </tr>
            <?php
            foreach($result as $key=>$val){
                for($i = strtotime($val['form_start_time']); $i <=strtotime($date_now=date('Y-m-d')); $i+=86400)
                {
                    $days[] =strtotime(date('Y-m-d',$i));
                }
                //echo $val['form_start_time'];
                $counts=count($days);
                //echo $counts;
                $counts=$counts-1;
                //echo $counts;
                //echo $date_now;
                if($counts<$val['form_length'])
                    $val['form_length']=$counts;
                ?>
                <tr>
                    <td><?php echo $val['form_start_time'] ?></td>
                    <td><?php echo $val['worker_no'] ?></td>
                    <td><?php echo $val['worker_name'] ?></td>
                    <td><?php echo $val['department_id'] ?></td>
                    <td><?php echo $val['department_name'] ?></td>
                    <td><?php
                        switch ($val['form_type']) {
                            case '1':
                                echo "事假";
                                break;
                            case '2':
                                echo "病假";
                                break;
                            case '3':
                                echo "出差";
                                break;
                            default:
                                echo "带薪休假";
                        } ?></td>
                    <td><?php echo $val['form_length'] ?></td>
                </tr>
            <?php } ?>

        </table>

        <div class="panel-foot text-center">
            <ul class="pagination">
                <li><a href="index.php?page=<?php echo $page-1?>&keyword=<?php echo $keyword  ?>">上一页</a></li>
            </ul>

            <ul class="pagination">
                <li><a href="index.php?page=<?php echo $page-1?>&keyword=<?php echo $keyword  ?>">下一页</a></li>
            </ul>
        </div>
    </div>
    <br />
</body>
</html>