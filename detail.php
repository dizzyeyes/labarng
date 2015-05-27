<?php 
    require_once 'utils.php';
    require_once 'logged.php';
    require_once 'dbconnect.php';
    $eventid = mysqli_real_escape_string($dbc,trim($_GET["event"]));

    if(empty($eventid))
    {
        $home_url = 'index.php';
        header('Location: '.$home_url);
    }
    $query="select * from `lab_events` where `id` = ".$eventid;
    $data = mysqli_query($dbc,$query);           
    if(mysqli_num_rows($data)==1){
        $row = mysqli_fetch_array($data,MYSQL_ASSOC);
        echo encode_json($row).'<br>';
    }
    echo "当前用户".$_SESSION['username'];
    echo '<button class="btn btn-info btn-small" onclick="close_window();"> 关　闭</button>';
?>
<html>
<head>
<meta charset='utf-8' />

<link href="css/bootstrap.2.1.0.css" rel="stylesheet">
<link href='css/demo.css' rel='stylesheet' />
<link href='css/themes/black-tie/jquery-ui.min.css' rel='stylesheet' />
<link href='css/cal/fullcalendar.css' rel='stylesheet' />
<link href='css/cal/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='libs/moment/moment.js'></script>
<script src='libs/jquery-2.1.3.js'></script>
<script src='libs/fullcalendar.js'></script>
<script src='js/calendar.js'></script>
<script>
function close_window()
{
    window.opener=null;
    window.open('','_self');
    window.close();
}
</script>
</head>
<body>

    

</body>
</html>