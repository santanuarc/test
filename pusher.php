<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="http://js.pusher.com/2.0/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging - don't include this in production
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('6af097d939948098db3d');
    var channel = pusher.subscribe('test_channel');
    channel.bind('my_event', function(data) {
      alert(data);
    });
  </script>
</head>