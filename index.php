<?php
include 'connect.php';

function contentPage($link) {
	if (isset($_GET['page'])){
		$page = $_GET['page'];//Гет запрос на страницу
	}else{
	    $page = '/';
	}

	//Ищем страницу в бд и выводим ее
	$query = "SELECT * FROM pages WHERE url='$page'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$page = mysqli_fetch_assoc($result);

	//страница с ошибкой, если такой страницы не найдено
	if (!$page) {

		$query = "SELECT * FROM pages WHERE url='404'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$page = mysqli_fetch_assoc($result);
		header("HTTP/1.0 404 Not Found");
	}

	$title = $page['title'];//выводит title
	echo $page['text'];//Выводит контент
//	include 'elems/layouts.php';//инклюдим макет страницы
}

//contentPage($link);
include 'elems/layouts.php';//инклюдим макет страницы