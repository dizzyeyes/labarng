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


function fectch_url_json($url)
{
    // set_time_limit(1800);
    $contents1 = file_get_contents($url); 
    if(preg_match('/^\xEF\xBB\xBF/',$contents1))
    {
        $contents1=substr($contents1,3);
    }
  //  $arr1= json_decode($contents1,true);
    return $contents1;
}
?>