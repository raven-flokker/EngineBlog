<?php
include '../connect.php';//подлючение бд

if (!empty($_SESSION['auth'])) {
	function getPage($link)
	{
		$title = 'Admin Edit Page';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$query = "SELECT * FROM pages WHERE id='$id'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$page = mysqli_fetch_assoc($result);

			if ($page) {
				if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
					$title = $_POST['title'];
					$url = $_POST['url'];
					$text = $_POST['text'];
				} else {
					$title = $page['title'];
					$url = $page['url'];
					$text = $page['text'];
				}

				ob_start();
				include 'elems/form.php';
				$content = ob_get_clean();
			} else {
				$content = 'Page not found';
			}
		} else {
			$content = 'Page not found';
		}
		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function addPage($link)
	{
		if (isset($_POST['title']) and isset($_POST['url']) and isset($_POST['text'])) {
			$title = mysqli_real_escape_string($link, $_POST['title']);
			$url = mysqli_real_escape_string($link, $_POST['url']);
			$text = mysqli_real_escape_string($link, $_POST['text']);

			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				$query = "SELECT * FROM pages WHERE id=$id";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$page = mysqli_fetch_assoc($result);

				if ($page['url'] !== $url) {
					$query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					$isPage = mysqli_fetch_assoc($result)['count'];

					if ($isPage == 1) {
						$_SESSION['message'] = [
							'text' => 'Page with url exist!',
							'status' => 'alert-danger'
						];
					}
				}

				$query = "UPDATE pages SET title='$title', url='$url', text='$text' WHERE id='$id'";
				mysqli_query($link, $query) or die(mysqli_error($link));

				$_SESSION['message'] = [
					'text' => "Page '{$page['title']}' edit success!",
					'status' => 'alert-success'
				];

				header('Location: /admin/');
				die();
			}
		}
	}

	addPage($link);
	getPage($link);
}else{
	header('Location: /admin/login.php'); die();
}