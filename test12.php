<!DOCTYPE html>
<html>
<head>
  <style>
  p { color:red; margin:4px; }
  b { color:blue; }
  </style>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>           
</head>
<body>
  <p></p>
 
  <select id="single">
    <option>Single</option>
    <option>Single2</option>
  </select>
 
  <select id="multiple" multiple="multiple">
    <option selected="selected">Multiple</option>
    <option>Multiple2</option>
    <option selected="selected">Multiple3</option>
  </select>
 
<script>
    function displayVals() {
      var singleValues = $("#single").val();
      
      alert(singleValues);
      
      var multipleValues = $("#multiple").val() || [];
      $("p").html("<b>Single:</b> " +
                  singleValues +
                  " <b>Multiple:</b> " +
                  multipleValues.join(", "));
    }
 
    $("select").change(displayVals);
    displayVals();
 
</script>
 
</body>
</html>