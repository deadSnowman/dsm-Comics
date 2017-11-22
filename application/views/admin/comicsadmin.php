<div class="container">
  <h1>Comic Admin page</h1>

  <div class="row">
    <div class="col-sm-7">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>Comics List</h2>
          <?
          foreach ($comics as $c) {
            ?>
            <p><a href="<? echo $c['comic_id'] ?>" onclick="return false;" class="comic_list_item"><? echo $c['title']; ?> (<? echo $c['genre'] ?>)  ~<? echo $c['artist'] ?></a></p>
            <?
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>Edit Comic</h2>

          <form class="form-horizontal">
            <div class="form-group">
              <label for="inputTitle" class="col-sm-2 control-label">Cover</label>
              <input class="col-sm-10" type="file" name="inputCover" id="inputCover" required>
            </div>
            <div class="form-group">
              <label for="inputTitle" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTitle" placeholder="Title">
              </div>
            </div>
            <div class="form-group">
              <label for="inputGenre" class="col-sm-2 control-label">Genre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputGenre" placeholder="Genre">
              </div>
            </div>
            <div class="form-group">
              <label for="inputArtist" class="col-sm-2 control-label">Artist</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputArtist" placeholder="Artist">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputDescription">Description:</label>
                <textarea class="form-control" rows="5" id="inputDescription"></textarea>
              </div>
            </div>
            <div class="form-group pull-right">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Edit Pages</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
            <div class="clearfix"></div>
          </form>


        </div>
      </div>
    </div>
  </div>


</div>
