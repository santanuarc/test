<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>          
  <form action="/" id="searchForm">
   <input type="text" name="s" placeholder="Search..." />
   <input type="submit" value="Search" />
  </form>
  <!-- the result of the search will be rendered inside this div -->
  <div id="result"></div>
 
<script>
/* attach a submit handler to the form */
$("#searchForm").submit(function(event) {
 
  /* stop form from submitting normally */
  event.preventDefault();
 
  /* get some values from elements on the page: */
  var $form = $( this ),
      term = $form.find( 'input[name="s"]' ).val(),
      url = $form.attr( 'action' );
 
  /* Send the data using post */
  var posting = $.post( url, { s: term } );
 
  /* Put the results in a div */
  posting.done(function( data ) {
    var content = $( data ).find( '#content' );
    $( "#result" ).empty().append( content );
  });
});
</script>
 
</body>
</html>