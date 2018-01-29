<?php

require_once 'vendor/autoload.php';
require 'config.php';
require_once 'functions.php';

ini_set('display_errors', 'On');
session_start();

print('reaching index.php');
print('current page: '.currentPage());

if(currentPage() == 'authorize' || isset($_GET['code'])){
	pageContent();
}else{
	run();
}
