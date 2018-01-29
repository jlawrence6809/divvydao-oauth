<?php

require_once 'vendor/autoload.php';
require 'config.php';
require_once 'functions.php';

ini_set('display_errors', 'On');
session_start();

if(currentPage() == 'authorize' || isset($_GET['code'])){
	pageContent('authorize');
}else{
	run();
}
