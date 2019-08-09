<?php
if (isset($_GET['page'])){
	contentPage($link);
}else {
	if (isset($_GET['id'])) {


		$id = $_GET['id'];
		$query = "SELECT * FROM posts WHERE id='$id'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$article = mysqli_fetch_assoc($result);


		?>

        <div class="card">
            <div class="card-header">
                <h1><?=$article['title']?></h1>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <img src="<?=$article['img']?>" class="img-fluid" alt="Responsive image">
	                <?=$article['text']?>
                    <footer class="blockquote-footer"><?=$article['author']?> <cite title="Source Title"> <?=$article['date']?></cite></footer>
                </blockquote>
            </div>
        </div>





<?php
	} else {

		//Получаем все записи
		if (isset($_GET['pages'])) {
			$pages = $_GET['pages'];
		} else {
			$pages = 1;
		}

		$notesOnPage = 4;//Кол-во постов на страницу
		$from = ($pages - 1) * $notesOnPage;//

		$query = "SELECT * FROM posts ORDER BY `date` DESC LIMIT $from, $notesOnPage";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

		//
		$query = "SELECT COUNT(*) as count FROM posts";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$count = mysqli_fetch_assoc($result)['count'];
		$pagesCount = ceil($count / $notesOnPage);

		//Получаем записи
		$result = '';

		foreach ($data as $elem) {
			$result .= "<div class=\"card w-75\">
			<div class=\"card-body\">";

			$result .= '<h5 class="card-title">' . $elem['title'] . '</h5>';

			$result .= '<p class="card-text">'. $elem['author'] .'</p>';

			$result .= "<a href=\"?id={$elem['id']}\" class=\"btn btn-primary\">Button</a>";

			$result .= "</div>
 
		</div>";
		}

		echo $result;
        echo '<hr>';
		if ($pages != 1) {
			$prev = $pages - 1;
			echo "<a class=\"btn btn-primary float-left\" href=\"?pages=$prev\">New Posts</a> ";
		}

		if ($pages != $pagesCount) {
			$next = $pages + 1;
			echo "<a class=\"btn btn-primary float-right\" href=\"?pages=$next\">Older Posts &rarr;</a>";
		}
	}
}
?>

