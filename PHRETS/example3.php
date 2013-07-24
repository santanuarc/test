<?php @include_once('login.php'); ?>
<pre>
<?php

$rets = new PHRETS;

$connect = $rets->Connect($login, $un, $pw);
 //DebugBreak();
if($connect) {

    //$sixmonths = date('Y-m-d\TH:i:s', time()-15778800); // get listings updated within last 6 months
	$sixmonths = '2009-10-27T07:08:28'; // get listings updated within last 6 months
	
	/* Search RETS server */
	$search = $rets->SearchQuery(
		'COMM',								// Resource
		'CI',										// Class
		'((UPDATE_DATE='.$sixmonths.'+))',	// DMQL, with SystemNames
		array(
			'Format'	=> 'COMPACT-DECODED',
			'Select'	=> 'SyndicateToCurrentUser,IdxOfficeOptedOut,IdxListingOptedOut,RealtorComDisplayAddress,Latitude,Longitude,ACRE,PHOTO_MASK',
			'Count'		=> 1,
			'Limit'		=> 20
		)
	);
	
	/* If search returned results */
	if($rets->TotalRecordsFound() > 0) {
		while($data = $rets->FetchRow($search)) {
			print_r($data);
		}
	} else {
		echo '0 Records Found';
	}

	$rets->FreeResult($search);
	$rets->Disconnect();
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>