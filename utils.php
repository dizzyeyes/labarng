<?php
function encode_json($array) {
return urldecode(json_encode(url_encode($array)));    
}

function url_encode($str) {
    if(is_array($str)) {
        foreach($str as $key=>$value) {
            $str[urlencode($key)] = url_encode($value);
        }
    } else {
        $str = urlencode($str);
    }
    
    return $str;
}
?>