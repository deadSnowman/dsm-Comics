<div class="container">

  <div class="fl_container">
    <div id="alertarea">
    </div>
  </div>

  <!--<h1>Pages Admin</h1>-->

  <div class="row content">
    <div class="col-sm-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Pages List</strong>
          <button class="btn btn-primary btn-xs pull-right" id="pin_pages_list"><span class="glyphicon glyphicon-pushpin"></span></button>
        </div>
        <div class="panel-body">
          <div class="pages_list clearfix" id="sortable">
          <?
          foreach ($pages as $p) {
            ?>
            <p class="page_list_element_<? echo $p['page_id']; ?>">
              <a href="<? echo $p['page_id']; ?>" onclick="return false;" class="del_page_list_item trash">
                <span class="glyphicon glyphicon-trash"></span>
              </a>&nbsp;&nbsp;&nbsp;
              <a href="<? echo site_url('uploads/' . $p['page_id']) ?>" target="_blank" class="page_list_item"><? echo $p['filename']; ?></a>
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
          <strong id="ep_title">Add Page(s)</strong>
        </div>
        <div class="panel-body">

          <form class="form-horizontal" id="editPagesForm" enctype="multipart/form-data">
            <input type="hidden" name="comic_id" id="comic_id" value="<? echo $comic_id; ?>">
            <div class="form-group">
              <input class="col-sm-12" type="file" id="inputPages" name="inputPages[]" multiple size="20">
            </div>
            <!--<button type="button" class="btn btn-default" id="clear_editcomic">Clear</button>-->
            <div class="form-group pull-right">
              <div class="col-sm-offset-2 col-sm-10 pull-right">
                <button type="submit" class="btn btn-primary pull-right" id="update_add_page" value="upload">Add</button>
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
