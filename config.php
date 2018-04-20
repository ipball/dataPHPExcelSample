<?php
$baseurl = 'http://localhost/ajax_edit/';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ajax_edit';
$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if($connect->connect_error){
	die('Connecition fail '. $connect->connect_error);
}else{
	$connect->set_charset('utf8');
}
