<form method="post" action="">
	<div class="form-group">
		<label for="formGroupExampleInput" class="col-sm-2 col-form-label">Author: </label>
		<div class="col-sm-10">
			<input name="author" value="<?= $author ?>" class="form-control form-control-sm" type="text" placeholder="Author">
		</div>
	</div>
		<div class="form-group">
		<label for="formGroupExampleInput" class="col-sm-2 col-form-label">Title: </label>
		<div class="col-sm-10">
			<input name="title" value="<?= $title ?>" class="form-control form-control-sm" type="text" placeholder="Title">
		</div>
		</div>
		<div class="form-group">
		<label for="formGroupExampleInput" class="col-sm-2 col-form-label">Text: </label>
		<div class="col-sm-10">
			<textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $text ?></textarea>
		</div>
		</div>

		<div class="form-group">
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary">Add</button>
		</div>
	</div>
</form>