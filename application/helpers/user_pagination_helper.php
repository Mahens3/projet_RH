<?php

function user_pagination($url,$per_page,$rows){
    $config=[
        'base_url' => base_url($url),
        'per_page' => $per_page,
        'total_rows' => $rows,
    ];
    return $config;
}


?>