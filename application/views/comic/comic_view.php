  <div class="container">
    <h1>Comic View <? if($comic_title != "") echo "- " . $comic_title; ?></h1>

    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
          <p>Image content</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">

        <form class="form-horizontal">
          <div class="form-group">
            <button type="button" class="btn btn-primary">|<</button>
            <button type="button" class="btn btn-primary"><</button>
            <button type="button" class="btn btn-primary">random</button>
            <button type="button" class="btn btn-primary">></button>
            <button type="button" class="btn btn-primary">>|</button>
          </div>
        </form>

      </div>


      <br/>
      <br/>
      <div class="col-sm-6 col-sm-offset-3">
        <?
        foreach ($pages as $key => $p) {
          echo "<p>" . $p['page_id'] . " - " . $p['filename'] . "</p>";
        }
        ?>
      </div>
    </div>


  </div>
  </body>
