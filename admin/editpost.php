<?php
include '../connect.php';//подлючение бд

if (!empty($_SESSION['auth'])) {
	function getPage($link)
	{
		$title = 'Admin Edit Post';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$query = "SELECT * FROM posts WHERE id='$id'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$post = mysqli_fetch_assoc($result);

			if ($post) {
				if (isset($_POST['author']) and isset($_POST['title']) and isset($_POST['text'])) {
					$author = $_POST['author'];
					$title = $_POST['title'];
					$text = $_POST['text'];
				} else {
					$author = $post['author'];
					$title = $post['title'];
					$text = $post['text'];
				}

				ob_start();
				include 'elems/formpos.php';
				$content = ob_get_clean();
			} else {
				$content = 'Post not found';
			}
		} else {
			$content = 'Post not found';
		}
		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function addPage($link)
	{
		if (isset($_POST['author']) and isset($_POST['title']) and isset($_POST['text'])) {
			$author = mysqli_real_escape_string($link, $_POST['author']);
			$title = mysqli_real_escape_string($link, $_POST['title']);
			$text = mysqli_real_escape_string($link, $_POST['text']);

			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				$query = "SELECT * FROM posts WHERE id=$id";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$post = mysqli_fetch_assoc($result);

				if ($post['title'] !== $title) {
					$query = "SELECT COUNT(*) as count FROM posts WHERE title='$title'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));
					$isPost = mysqli_fetch_assoc($result)['count'];

					if ($isPost == 1) {
						$_SESSION['message'] = [
							'text' => 'Post with title exist!',
							'status' => 'alert-danger'
						];
					}
				}

				$query = "UPDATE posts SET author='$author', title='$title', text='$text' WHERE id='$id'";
				mysqli_query($link, $query) or die(mysqli_error($link));

				$_SESSION['message'] = [
					'text' => "Post '{$post['title']}' edit success!",
					'status' => 'alert-success'
				];

				header('Location: /admin/posts.php');
				die();
			}
		}
	}

	addPage($link);
	getPage($link);
}else{
	header('Location: /admin/login.php'); die();
}