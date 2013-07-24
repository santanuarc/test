<?php
    $base_url = "http://projects.arcinfotec.com/iccube-wp/";
    $content = file_get_contents($base_url);
    
    // echo $content;
    
    
    $header_pos_start = strpos($content,'<header');
    $header_pos_end = strpos($content,'</header');
    $main_str = substr($content,$header_pos_start,($header_pos_end-$header_pos_start)).'</header>';
    echo "<link rel='stylesheet' id='twentytwelve-style-css'  href='http://projects.arcinfotec.com/iccube-wp/wp-content/themes/iccube/style.css?ver=3.5.1' type='text/css' media='all' />";
    echo $main_str;
    
    
    
?>