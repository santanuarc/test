<?php
include_once("src/facebook.php"); //include facebook SDK

######### edit details ##########
$appId = '383999535051903'; //Facebook App ID
$appSecret = '8de7f7ab45f80bdb888ddeec19f68f95'; // Facebook App Secret
$return_url = 'http://localhost/test/fbapp/process.php';  //return url (url to script)
$homeurl = 'http://localhost/test/fbapp/';  //return to home
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API



$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));

$fbuser = $facebook->getUser();

?>