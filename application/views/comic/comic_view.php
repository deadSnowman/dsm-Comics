  <div class="container">
    <? if(isset($pages[0]['page_id'])) { ?>
    <h1 class="text-center"><? if($comic_title != "") echo $comic_title; ?></h1><br/>
    

    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form class="form-horizontal text-center">
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="first" id="first">|<</button>
            <button type="button" class="btn btn-primary" name="prev" id="prev"><</button>
            <button type="button" class="btn btn-primary" name="rand" id="rand">random</button>
            <button type="button" class="btn btn-primary" name="next" id="next">></button>
            <button type="button" class="btn btn-primary" name="last" id="last">>|</button>
          </div>
        </form>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
          <!-- could also be max-width -->
          <? echo "<img style=\"display: block; margin: 0 auto; width:100%;\" id=\"comic_page\" src=\"" . site_url('uploads/' . $pages[0]['page_id']) . "\" />"; ?>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form class="form-horizontal text-center">

          <input type="hidden" name="page_id_list[]" id="page_id_list" value='<? /*I'm sorry...*/ $el = array(); foreach ($pages as $key => $p) { array_push($el, $p['page_id']); } echo "[".implode(", ", $el)."]";?>'>
          <input type="hidden" name="page_total" id="page_total" value="<? echo sizeof($pages)-1; ?>">
          <input type="hidden" name="page_num" id="page_num" value="0">
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="first" id="first2">|<</button>
            <button type="button" class="btn btn-primary" name="prev" id="prev2"><</button>
            <button type="button" class="btn btn-primary" name="rand" id="rand2">random</button>
            <button type="button" class="btn btn-primary" name="next" id="next2">></button>
            <button type="button" class="btn btn-primary" name="last" id="last2">>|</button>
          </div>
        </form>
      </div>
      <!--<br/>
      <br/>
      <div class="col-sm-6 col-sm-offset-3">
        <?
        /*foreach ($pages as $key => $p) {
          echo "<p>" . $p['page_id'] . " - " . $p['filename'] . "</p>";
        }*/
        ?>
      </div>-->
    </div>
    <? } else { ?>
      <br/><br/><br/>
      <h1 class="text-center">no pages...</h1>
    <? } ?>


  </div>
