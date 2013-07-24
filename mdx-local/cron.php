<?php
    $files = scandir("mdx-local");
    
    //DebugBreak();
   
    
    function getheadercontent(){
        $base_url = "http://projects.arcinfotec.com/iccube-wp/";
        $content = file_get_contents($base_url);
        $header_pos_start = strpos($content,'<header');
        $header_pos_end = strpos($content,'</header');
        $main_str = substr($content,$header_pos_start,($header_pos_end-$header_pos_start)).'</header>';
        $css_path = "<link rel='stylesheet' id='twentytwelve-style-css'  href='http://projects.arcinfotec.com/iccube-wp/wp-content/themes/iccube/style.css?ver=3.5.1' type='text/css' media='all' />";
        $main_content = $css_path.$main_str;
        return $main_content;
    }
    
    $header_content = getheadercontent();
     scanoutput('mdx-local',$header_content); 
    
    
    function scanoutput($path,$header_content){  
        if(is_dir($path)){
          $files = scandir($path);
          foreach($files as $key=>$data){
              if($data != '.' && $data != '..'){
              $newpath = $path.'/'.$data;
              scanoutput($newpath,$header_content);
              }
          } 
        }
        else{
          $filename = $path;
          $filename_arr = explode('.',$filename);
          $filename_arr_length = count($filename_arr);
          $extenssion = $filename_arr[$filename_arr_length-1];                                                      
          
          if($extenssion == 'html'){
             // DebugBreak();
              
            echo $filename;
           // echo "<br>"; 
            
            
            $html_file_content =  file_get_contents($filename);
            
            $strpos1 = strpos($html_file_content,'<div id="header-wrapper">');
            $strpos2 = strpos($html_file_content,'<div id="content">');
            
            $replace_for = substr($html_file_content,$strpos1,($strpos2-$strpos1));
            
            
            
            
            
            $header_content = '<div id="header-wrapper">'.$header_content.'</div>';
            $replace_content = str_replace($replace_for,$header_content,$html_file_content);
            
            $fp = fopen($filename,'w');
            fwrite($fp,$replace_content);
            fclose($fp);  
              
          }
        } 
    }
    
    
    
    
    
?>