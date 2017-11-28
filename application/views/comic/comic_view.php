<!-- https://www.w3schools.com/howto/howto_css_loader.asp -->
<style>
.padthis {
  padding-bottom: 15px;
}
.loader {
  border: 4px solid #f3f3f3; /* Light grey */
  border-top: 4px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  /*float: right;*/
  margin: 0 auto;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

  <div class="container">
    <? if(isset($pages[0]['page_id'])) { ?>
    <h1 class="text-center"><? if($comic_title != "") echo $comic_title; ?></h1><br/>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form class="form-horizontal text-center">
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="first" id="first"><span class="glyphicon glyphicon-step-backward"></span></button>
            <button type="button" class="btn btn-primary" name="prev" id="prev"><span class="glyphicon glyphicon-triangle-left"></span></button>
            <button type="button" class="btn btn-primary" name="rand" id="rand"><b>random</b></button>
            <button type="button" class="btn btn-primary" name="next" id="next"><span class="glyphicon glyphicon-triangle-right"></button>
            <button type="button" class="btn btn-primary" name="last" id="last"><span class="glyphicon glyphicon-step-forward"></span></button>
          </div>
        </form>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="padthis" id="padthis" style="display: none;">
        <div class="loader" id="loader" style="display: none;"></div></div>
        <div class="panel panel-default" id="img_panel">
          <!-- could also be max-width -->
          <? echo "<a name=\"next\" id=\"next3\"><img style=\"display: block; margin: 0 auto; width:100%; cursor:pointer;\" id=\"comic_page\" src=\"" . site_url('uploads/' . $pages[$page_num]['page_id']) . "\" /></a>"; ?>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form class="form-horizontal text-center">
          <input type="hidden" name="comic_id" id="comic_id" value="<? echo $pages[0]['comic_id'] ?>">
          <input type="hidden" name="page_id_list[]" id="page_id_list" value='<? /*I'm sorry...*/ $el = array(); foreach ($pages as $key => $p) { array_push($el, $p['page_id']); } echo "[".implode(", ", $el)."]";?>'>
          <input type="hidden" name="page_total" id="page_total" value="<? echo sizeof($pages)-1; ?>">
          <input type="hidden" name="page_num" id="page_num" value="<? echo $page_num; ?>">
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="first" id="first2"><span class="glyphicon glyphicon-step-backward"></span></button>
            <button type="button" class="btn btn-primary" name="prev" id="prev2"><span class="glyphicon glyphicon-triangle-left"></span></button>
            <button type="button" class="btn btn-primary" name="rand" id="rand2"><b>random</b></button>
            <button type="button" class="btn btn-primary" name="next" id="next2"><span class="glyphicon glyphicon-triangle-right"></button>
            <button type="button" class="btn btn-primary" name="last" id="last2"><span class="glyphicon glyphicon-step-forward"></span></button>
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
