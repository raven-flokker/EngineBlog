<?php
include '../connect.php';//подлючение бд
//Отредактировать под добавление поста
if (!empty($_SESSION['auth'])) {
	function getPage()
	{
		$title = 'Admin Add New Post';

		if (isset($_POST['author']) and isset($_POST['title']) and isset($_POST['text'])) {
			$author = $_POST['author'];
			$title = $_POST['title'];
			$text = $_POST['text'];

		} else {
			$author ='';
			$title = '';
			$url = '';
			$text = '';
		}

		ob_start();
		include 'elems/formpos.php';
		$content = ob_get_clean();

		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function addPage($link)
	{
		if (isset($_POST['author']) and isset($_POST['title']) and isset($_POST['text'])) {
			$author = mysqli_real_escape_string($link, $_POST['author']);
			$title = mysqli_real_escape_string($link, $_POST['title']);
			$text = mysqli_real_escape_string($link, $_POST['text']);

			$query = "SELECT COUNT(*) as count FROM posts WHERE title='$title'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$isPage = mysqli_fetch_assoc($result)['count'];

			if ($isPage) {
				$_SESSION['message'] = [
					'text' => 'Post with title exist!',
					'status' => 'alert-danger'
				];
			} else {
				$query = "INSERT INTO posts (author, title, text) VALUES ('$author','$title','$text')";
				mysqli_query($link, $query) or die(mysqli_error($link));

				$_SESSION['message'] = [
					'text' => 'Post add success!',
					'status' => 'alert-success'
				];

				header('Location: /admin/posts.php');
				die();
			}
		}
	}

	addPage($link);
	getPage();
}else{
	header('Location: /admin/login.php'); die();
}
