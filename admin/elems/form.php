<form method="post" action="">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Title:</label>
        <div class="col-sm-10">
            <input name="title" value="<?= $title ?>" class="form-control form-control-sm" type="text" placeholder="Title">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Url:</label>
        <div class="col-sm-10">
            <input name="url" value="<?= $url ?>" placeholder="Url" class="form-control form-control-sm" type="text" >
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Text:</label>
        <div class="col-sm-10">

            <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $text ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>
