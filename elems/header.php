<?php
/*
	function createLink($href, $ancor) {

		if ($_SERVER['REQUEST_URI'] == $href){
			$class = ' class="active"';
		}else{
			$class = '';
		}
		echo "<a href=\"$href\"$class>$ancor</a>";
	}
	createLink('/engineJob/Engine/?page=index', 'Main');
	createLink('/engineJob/Engine/?page=about', 'About');
	createLink('/engineJob/Engine/?page=contacts', 'Contacts');
*/
function createLink($href, $ancor) {

	if ((!isset($_GET['page']) and $href == '/') or (isset($_GET['page']) and $_GET['page'] == $href)){
		$class = ' class="nav-item active"';
	}else{
		$class = ' class="nav-item"';
	}

	if ($href != '/'){
		$hrefPart = '/?page=';
	}else{
		$hrefPart = '';
	}
	echo "<ul class=\"navbar-nav\"><li$class><a href=\"$hrefPart$href\" class=\"nav-link\">$ancor</a></li></ul>";
}
//createLink('/engineJob/Engine/?page=index', 'Main');
//createLink('/engineJob/Engine/?page=about', 'About');
//createLink('/engineJob/Engine/?page=contacts', 'Contacts');

$query = "SELECT * FROM pages WHERE url!='404'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

foreach ($data as $page){
	createLink($page['url'], $page['title']);
}