    <div class="container content">

      <? foreach ($comics as $key => $c) { ?>
        <? if($key % 4 == 0) { ?>
          <div class="row">
        <?}?>
         <div class="col-sm-3">
           <div class="panel panel-default">
             <? if($c['page_id'] != 0) { ?>
               <? echo "<a href=\"" . site_url('comic/' . $c['comic_id']) ."\"><img height=\"100%\" width=\"100%\" src=\"" . site_url('uploads/' . $c['page_id']) . "\" /></a>"; ?>
             <?}?>
             <div class="panel-body">
                <? //echo "<p><a href=\"" . site_url('comic/' . $c['comic_id']) ."\">" . implode(", ", $c) . "</a></p>"; ?>

                <?
                $print_str = "<p>";

                if($c['page_id'] == 0) $print_str .= "<a href=\"" . site_url('comic/' . $c['comic_id']) ."\">";

                if($c['title'] != "") $print_str .= "Title: " . $c['title'];
                if($c['genre'] != "") $print_str .= "<br/>Genre: " . $c['genre'];
                if($c['artist'] != "") $print_str .= "<br/>Artist: " . $c['artist'];

                if($c['page_id'] == 0) $print_str .= "</a>";
                $print_str .= "</p>";

                echo $print_str;
                ?>
             </div>
           </div>
         </div>
         <? if($key % 4 == 3) { ?>
          </div>
         <?}?>
      <?}?>

    </div>
  </body>
