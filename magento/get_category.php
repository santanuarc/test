<?php
    
    //DebugBreak();
    $client = new SoapClient('http://metalcuttosize.co.uk/api/soap/?wsdl');

    // If somestuff requires api authentification,
    // then get a session token
    $session = $client->login('arc', 'welcome1');

    $result = $client->call($session, 'catalog_category.tree');
    var_dump($result);

    // If you don't need the session anymore
    //$client->endSession($session);
    
    
?>