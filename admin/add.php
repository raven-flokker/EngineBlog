<?php
include '../connect.php';//подлючение бд

if (!empty($_SESSION['auth'])) {
	function getPage()
	{
		$title = 'Admin Add New Page';

		if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
			$title = $_POST['title'];
			$url = $_POST['url'];
			$text = $_POST['text'];

		} else {
			$title = '';
			$url = '';
			$text = '';
		}

		ob_start();
		include 'elems/form.php';
		$content = ob_get_clean();

		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function addPage($link)
	{
		if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
			$title = mysqli_real_escape_string($link, $_POST['title']);
			$url = mysqli_real_escape_string($link, $_POST['url']);
			$text = mysqli_real_escape_string($link, $_POST['text']);

			$query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$isPage = mysqli_fetch_assoc($result)['count'];

			if ($isPage) {
				$_SESSION['message'] = [
					'text' => 'Page with url exist!',
					'status' => 'alert-danger'
				];
			} else {
				$query = "INSERT INTO pages (title, url, text) VALUES ('$title','$url','$text')";
				mysqli_query($link, $query) or die(mysqli_error($link));

				$_SESSION['message'] = [
					'text' => 'Page add success!',
					'status' => 'alert-success'
				];

				header('Location: /admin/');
				die();
			}
		}
	}

	addPage($link);
	getPage();
}else{
	header('Location: /admin/login.php'); die();
}
