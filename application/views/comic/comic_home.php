    <div class="container content">

      <? foreach ($comics as $key => $c) { ?>
        <? if($key % 4 == 0) { ?>
          <div class="row">
        <?}?>
         <div class="col-sm-3">
           <div class="panel panel-default">
             <div class="panel-body">
                <? echo "<p><a href=\"" . site_url('comic/' . $c['comic_id']) ."\">" . implode(", ", $c) . "</a></p>"; ?>
                <? if($c['page_id'] != 0) { ?>
                  <? echo "<img height=\"200\" width=\"200\" src=\"" . site_url('uploads/' . $c['page_id']) . "\" />"; ?>
                <?}?>
             </div>
           </div>
         </div>
         <? if($key % 4 == 3) { ?>
          </div>
         <?}?>
      <?}?>

    </div>
  </body>
