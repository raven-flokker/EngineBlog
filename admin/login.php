<?php
include '../connect.php';

if (isset($_POST['password']) and md5($_POST['password']) == md5($passwordAdmin)) {
	$_SESSION['auth'] = true;

	$_SESSION['message'] = [
		'text' => "Login success!",
		'status' => 'success'
	];

	header('Location: /admin/'); die();
}else{
	include 'elems/admform.php';
}