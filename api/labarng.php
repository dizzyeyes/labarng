<?php
    require_once '../utils.php';
    require_once '../dbconnect.php';
    
    $usrid="";
    $all="";
    
    if(isset($_GET["eid"]))
        $eventid = mysqli_real_escape_string($dbc,trim($_GET["eid"]));
    if(isset($_GET["uid"]))
        $usrid = mysqli_real_escape_string($dbc,trim($_GET["uid"]));
    if(isset($_GET["data"]))
        $all = mysqli_real_escape_string($dbc,trim($_GET["data"]));

    if(!empty($eventid))
    {
        $query="select * from `lab_events` where `id` = ".$eventid;
        $data = mysqli_query($dbc,$query);           
        if(mysqli_num_rows($data)==1){
            $row = mysqli_fetch_array($data,MYSQL_ASSOC);
            echo '['.encode_json($row).']';
            return;
        }
    }
    if(!empty($usrid)&&!empty($all))
    {
        $query = "SELECT `user_id`, `username`, `role` FROM `lab_user` WHERE `user_id` = '$usrid' ";
        if($_SESSION['role']=='admin')
            $query = "SELECT * FROM `lab_user` WHERE `user_id` = '$usrid' ";
        $data = mysqli_query($dbc,$query);           
        if(mysqli_num_rows($data)==1){
            $row = mysqli_fetch_array($data,MYSQL_ASSOC);
            echo '['.encode_json($row).']';
            return;
        }
    }
    if(!empty($all)&&$all=='all')
    {
        $query="select * from `lab_events`";
        if(!empty($usrid)) $query.=" AND `user_id` = '$usrid'";
        $data = mysqli_query($dbc,$query);  
        $is_first=true;
        while($row = mysqli_fetch_array($data,MYSQL_ASSOC))
        {
            if($is_first)
            {
                $is_first=false;
                echo '[';
            }
            else
            {
                echo ',';
            }
            echo encode_json($row);
        }
        echo ']';  
        return;        
    }
    echo '[]';
    return;    
    
?>