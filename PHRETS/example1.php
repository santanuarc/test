<?php @include_once('login.php'); ?>
<pre>
<?php

/* Initialize Object */
DebugBreak();
$rets = new PHRETS;

/* Connect */
$connect = $rets->Connect($login, $un, $pw);

/* Query Server */
if($connect) {
    $types = $rets->GetMetadataTypes();
    print_r($types);
    $rets->Disconnect();
} else {
    $error = $rets->Error();
    print_r($error);
}

?>
</pre>