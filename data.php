
<script>
var datajson=
<?php
    require_once 'logged.php';
    require_once 'utils.php';
    header("Content-Type: text/html; charset=UTF-8");
    $fullname='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
    if(strrchr($fullname,'.')==".php")
        $prefix=dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]).'/';
    else 
        $prefix=$fullname;
    $url=$prefix.'api/labarng.php?data=all';
    echo fectch_url_json($url);
    
?>
;
</script>