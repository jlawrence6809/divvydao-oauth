<?php

require_once 'vendor/autoload.php';
require 'config.php';
require_once 'functions.php';

ini_set('display_errors', 'On');
session_start();

print('reaching index.php');

if(currentPage() == 'authorize'){
	pageContent();
}else{
    // $request = getProvider()->getAuthenticatedRequest(
    //     'GET',
    //     'https://chat.divvydao.net/api/v4/users',
    //     $_SESSION['accessToken']
    // );
    // $response = getProvider()->getResponse($request);
    // var_export($response->getBody()->getContents());

    // var_export(makeMattermostRequest('api/v4/users'));

	run();
}
