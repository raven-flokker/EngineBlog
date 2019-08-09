<?php
include '../connect.php';

if (!empty($_SESSION['auth'])) {
	function showPostTable($link)
	{
		//Ищем страницу в бд и выводим ее
		$query = "SELECT id, author, title, date FROM posts";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;


		$content = '<table class="table table-bordered table-dark">
 <thead>
    <tr>
    	<th scope="col">id</th>
    	<th scope="col">author</th>
      	<th scope="col">title</th>
      	<th scope="col">edit</th>
      	<th scope="col">delete</th>
    </tr>
  </thead>
';
		foreach ($data as $post) {
			$content .= "<tbody>
<tr>
      <th scope=\"row\">{$post['id']}</th>
      <td>{$post['author']}</td>
      <td>{$post['title']}</td>
      <td><a href=\"editpost.php?id={$post['id']}\">Edit</a></td>
      <td><a href=\"?postdel={$post['id']}\">Delete</a></td>
    </tr>";
		}
		$content .= '</tbody>
</table>';

		$title = 'Admin Page all Posts';

		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function deletePostTable($link)
	{
		if (isset($_GET['postdel'])) {
			$id = $_GET['postdel'];
			$query = "DELETE FROM posts WHERE id=$id";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));

			$_SESSION['message'] = [
				'text' => "Post deleted success!",
				'status' => 'alert-success'
			];

			header('Location: /admin/posts.php');
			die();
		}
	}


		deletePostTable($link);

		showPostTable($link);

}else {
	header('Location: /admin/login.php');
	die();
}