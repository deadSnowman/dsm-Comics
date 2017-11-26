<div class="container">

  <div class="fl_container">
    <div id="alertarea">
    </div>
  </div>

  <!--<h1>Comic Admin</h1>-->

  <div class="row content">
    <div class="col-sm-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Comics List</strong>
          <button class="btn btn-primary btn-xs pull-right" id="pin_comic_list"><span class="glyphicon glyphicon-pushpin"></span></button>
        </div>
        <div class="panel-body">


          <div class="comic_list clearfix" id="sortable">
          <?
          foreach ($comics as $c) {
            ?>
            <p class="comic_list_element_<? echo $c['comic_id']; ?>">
              <a href="<? echo $c['comic_id']; ?>" onclick="return false;" class="del_comic_list_item trash">
                <span class="glyphicon glyphicon-trash"></span>
              </a>&nbsp;&nbsp;&nbsp;
              <a href="<? echo $c['comic_id']; ?>" onclick="return false;" class="comic_list_item"><? echo $c['title']; ?><? if($c['genre'] != "") echo " (".$c['genre'].")"; ?><? if($c['artist'] != "") echo " ~".$c['artist']; ?></a>
            </p>
            <?
          }
          ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong id="ec_title">Add Comic</strong>
          <div class="pull-right">
            <button class="btn btn-default btn-xs" id="show_cover">preview cover</button>
            <button class="btn btn-danger btn-xs" id="del_cover">delete cover</button>
          </div>
        </div>
        <div class="panel-body">

          <!--form-horizontal-->
          <form class="form-horizontal" id="editComicForm" enctype="multipart/form-data">
            <input type="hidden" name="comic_id" id="comic_id" value="0">
            <div class="form-group">
              <label for="inputCover" class="col-sm-2 control-label">Cover</label>
              <input class="col-sm-6" type="file" name="inputCover" id="inputCover">
              <!--<input class="col-sm-10" type="file" multiple name="inputCover[]" id="inputCover">-->
            </div>
            <div class="form-group">
              <label for="inputTitle" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Title">
              </div>
            </div>
            <div class="form-group">
              <label for="inputGenre" class="col-sm-2 control-label">Genre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputGenre" id="inputGenre" placeholder="Genre">
              </div>
            </div>
            <div class="form-group">
              <label for="inputArtist" class="col-sm-2 control-label">Artist</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputArtist" id="inputArtist" placeholder="Artist">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="inputDescription">Description:</label>
                <textarea class="form-control" rows="5" name="inputDescription" id="inputDescription" placeholder="lorem ipsum and whatnot..."></textarea>
              </div>
            </div>
            <button type="button" class="btn btn-default" id="clear_editcomic">Clear</button>
            <div class="form-group pull-right">
              <div class="col-sm-12">
                <div class="pull-right">
                  <button type="button" name="editpages" id="editpages" class="btn btn-default" style="display: none;">Edit Pages</button>
                  <button type="submit" class="btn btn-primary" id="update_add_comic" value="upload">Add</button>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          </form>


        </div>
      </div>
    </div>
  </div>


</div>
