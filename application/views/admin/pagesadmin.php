<div class="container">
  <h1>Pages Admin</h1>

  <div class="row">
    <div class="col-sm-7">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>Pages List</h2>
          <div class="pages_list">
          <?
          print "<p>pages in here</p>";
          ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2 id="ec_title">Add Page</h2>

          <form class="form-horizontal" id="editComicForm" enctype="multipart/form-data">
            <input type="hidden" name="comic_id" id="comic_id" value="0">
            <div class="form-group">
              <label for="inputPages" class="col-sm-2 control-label">Pages</label>
              <input class="col-sm-10" type="file" id="inputPages" name="inputPages[]" multiple size="20">
              <!--<input class="col-sm-10" type="file" multiple name="inputCover[]" id="inputCover">-->
            </div>
            <!--<button type="button" class="btn btn-default" id="clear_editcomic">Clear</button>-->
            <div class="form-group pull-right">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="update_add_page" value="upload">Add</button>
              </div>
            </div>
            <div class="clearfix"></div>
          </form>

        </div>
      </div>

    </div>
  </div>


</div>
