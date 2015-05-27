<?php
//数据库的位置
define('DB_HOST', 'localhost');
//用户名
define('DB_USER', 'root');
//口令
define('DB_PASSWORD', '');
//数据库名
define('DB_NAME','labarng') ;

define('TB_PRE','lab') ;

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_query($dbc,"SET NAMES utf8");
?>