
<script>
var datajson=
<?php
    require_once 'logged.php';
    require_once 'utils.php';
    header("Content-Type: text/html; charset=UTF-8");
    $prefix='http://tlaborange.sinaapp.com/';
    $url=$prefix.'api/labarng.php?data=all';
    echo fectch_url_json($url);
    
?>
;
</script>