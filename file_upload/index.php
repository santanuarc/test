<?php
    if(isset($_REQUEST['submit'])){
        print_r($_FILES);    
       
        
    }
    
    
    
?>
<html>
    <head>
    
    
    
    </head>
    <body>
      <form action="" name="form1" id="form1" action="" method="post" enctype="multipart/form-data">
         <input type="file" name="file1" id="file1">
         <input type="submit" name="submit"  value="submit">
      </form>
    </body>
</html>