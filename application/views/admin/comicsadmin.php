<div class="container">

  <div class="fl_container">
    <div id="alertarea">
    </div>
  </div>

  <div class="row content">

    <div class="modal fade" id="del_cover_modal" tabindex="-1" role="dialog" aria-labelledby="del_cover_modal" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delete Cover</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete the cover image?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="del_cover" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="del_comic_list_item_modal" tabindex="-1" role="dialog" aria-labelledby="del_comic_list_item_modal" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel2">Delete Comic</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this comic?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="del_comic_list_item" value="" data-dismiss="modal">Delete</button>
            <!--<a href="<? //echo $c['comic_id']; ?>" onclick="return false;" class="del_comic_list_item trash">-->
          </div>
        </div>
      </div>
    </div>

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
              <button type="button" class="btn btn-danger btn-xs" id="del_comic_list_item_btn" value="<? echo $c['comic_id']; ?>" data-toggle="modal" data-target="#del_comic_list_item_modal">
                <span class="glyphicon glyphicon-trash"></span>
              </button>&nbsp;&nbsp;
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
            <a id="show_cover_link" href="#" target="_blank"><button class="btn btn-default btn-xs" id="show_cover" style="display: none;">preview cover</button></a>
            <!--<button class="btn btn-danger btn-xs" id="del_cover" style="display: none;">delete cover</button>-->
            <button class="btn btn-danger btn-xs" id="del_cover_btn" data-toggle="modal" data-target="#del_cover_modal" style="display: none;">delete cover</button>
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
            <button type="button" class="btn btn-default" id="clear_editcomic" style="display: none;">Back</button>
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
