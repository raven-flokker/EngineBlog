<?php
include '../connect.php';

//if (isset($_GET['page'])){
//	$page = $_GET['page'];//Гет запрос на страницу
//}else{
//    $page = '/';
//}
if (!empty($_SESSION['auth'])) {
	function showPageTable($link)
	{
		//Ищем страницу в бд и выводим ее
		$query = "SELECT id, title, url FROM pages WHERE url !='404'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;



		$content = '<table class="table table-bordered table-dark">
 <thead>
    <tr>
    	<th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">url</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
';
		foreach ($data as $page) {
			$content .= "<tbody>
<tr>
      <th scope=\"row\">{$page['id']}</th>
      <td>{$page['title']}</td>
      <td>{$page['url']}</td>
      <td><a href=\"edit.php?id={$page['id']}\">Edit</a></td>
      <td><a href=\"?delete={$page['id']}\">Delete</a></td>
    </tr>";
		}
		$content .= '</tbody>
</table>';

		$title = 'Admin Page';

		include 'elems/layouts.php';//инклюдим макет страницы
	}

	function deletePageTable($link)
	{
		if (isset($_GET['delete'])) {
			$id = $_GET['delete'];
			$query = "DELETE FROM pages WHERE id=$id";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));

			$_SESSION['message'] = [
				'text' => "Page deleted success!",
				'status' => 'alert-success'
			];
			var_dump($_SESSION['message']);
			header('Location: /admin/'); die();
		}
	}

	deletePageTable($link);

	showPageTable($link);

}else{
	header('Location: /admin/login.php'); die();
}


