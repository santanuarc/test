<?php
require_once('lib/squeeks-Pusher-PHP/lib/Pusher.php');
require_once('config.php');

DebugBreak();
$pusher = new Pusher('823d9054e16e645cf867', '8c9cbc61673c2c601e9d', '42556');

$message = sanitize( $_GET['message'] );
$data = array('message' => $message);

$pusher->trigger('test_channel', 'notification', $data);

function sanitize($data) {
  return htmlspecialchars($data);
}
?>