<?php
    require_once 'logged.php';
    require_once 'data.php';
?>
<html>
<head>
<meta charset='utf-8' />

<link href="css/bootstrap.2.1.0.css" rel="stylesheet">
<link href='css/demo.css' rel='stylesheet' />
<link href='css/select.css' rel='stylesheet' />
<link href='css/themes/black-tie/jquery-ui.min.css' rel='stylesheet' />
<link href='css/cal/fullcalendar.css' rel='stylesheet' />
<link href='css/cal/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='libs/moment/moment.js'></script>
<script src='libs/jquery-2.1.3.js'></script>
<script src='libs/fullcalendar.js'></script>
<script src='libs/zh-cn.js'></script>
<script src='js/calendar.js'></script>
</head>
<body>

	<div id='top'>

		<a id="lblanguage">语言:</a>
		<select id='lang-selector'></select>

	</div>
    
<?php
    //点击“Log Out”,则转到logOut页面进行注销
    echo '<button class="btn btn-info btn-small" onclick="window.location.href=\'logout.php\';"> 注　销('.$_SESSION['username'].')</button>';
/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
 * $_SESSION['user_id']对数据库进行查询，可以做好多好多事情*/
?>
    <div id='calendar'></div>

</body>
</html>
