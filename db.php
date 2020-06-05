<?php
//链接数据库的操作
$conn=new mysqli("localhost","root","root123","off_work_system");
if(mysqli_errno($conn))
    echo "连接数据库失败！".mysqli_error($conn);
mysqli_set_charset($conn,'utf8');