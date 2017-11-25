<style type="text/css">
.vertical-center {
  min-height: 50%;
  min-height: 50vh;
  display: flex;
  align-items: center;
}
/*text-center*/
</style>

<div class="vertical-center">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <!-- panel-primary -->
        <div class="panel panel-default">
          <div class="panel-heading blue-heading">
            <strong>Login</strong>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" id="editComicForm" enctype="multipart/form-data">
              <input type="hidden" name="comic_id" id="comic_id" value="0">
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="username" id="username" placeholder="username">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="password" id="password" placeholder="password">
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right" name="login" id="login" value="login">Log In</button>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
