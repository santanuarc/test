<?php
/* GET MLS DATA ON CRON JOB */

// Required Files
//require_once('../config/config.inc.php');
require_once("phprets.php");

// Connection Settings
DebugBreak();
$rets_login_url = "https://rets-beta.mlspin.com:12109/rets/login";
$rets_username = "FR0235";
$rets_password = "8jkgss";

// Perform connection/setup class.
$rets = new phRETS;

$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);




/* Query Server */
if($connect) {
    $types = $rets->GetMetadataTypes();
    print_r($types);
    $rets->Disconnect();
} else {
    $error = $rets->Error();
    print_r($error);
}

/* HANDLE SINGLE FAMILY */
$resource = "RESI";
$class    = "SF";
//DATE IS Y-m-d
$search = $rets->SearchQuery($resource, $class, "UPDATE_DATE=2009-10-27");
$table_name = 'rets_' . strtolower($resource) . '_' . strtolower($class);


while ($listing = $rets->FetchRow($search)) {
    // Check if LIST_NO exists...if it does, delete it.
    $check = "SELECT * FROM " . $table_name . " WHERE LIST_NO = '" . $listing['LIST_NO'] . "'";
    $query = mysql_query($check);
    if (mysql_num_rows($query)) {
        mysql_query("DELETE FROM " . $table_name . " WHERE LIST_NO = '" . $listing['LIST_NO'] . "'");
    }
    
    $sql = "INSERT INTO " . $table_name;
    $data_var = '';
    $data_val = '';
    foreach($listing as $key=>$value) {
        $data_var .= mysql_real_escape_string($key) . ', ';
        $data_val .= "'" . mysql_real_escape_string($value) . "', ";        
    }
    $data_var = substr($data_var, 0, -2);
    $data_val = substr($data_val, 0, -2);
    $sql .= ' (' . $data_var . ') VALUES (' . $data_val . ')'; 
    
    if (mysql_query($sql)) {
        echo 'saved';
    }else {
        echo 'not saved';
    }
}
$rets->FreeResult($search);

/* HANDLE MULTI FAMILY */

?>