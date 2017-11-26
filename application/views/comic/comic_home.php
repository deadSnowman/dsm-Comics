<!-- https://css-tricks.com/text-blocks-over-image/ -->
<style type="text/css">
.home-panels {
  /*min-height: 30%;
  min-height: 30vh;
  max-height: 50%;
  max-height: 50vh;*/
  /*display: flex;
  align-items: center;*/
}

.text {
  position: absolute;
}

/*.image {
   position: relative;
   width: 100%;
}
h2.text {
   position: absolute;
   top: 20px;
   width: 100%;
}
h2 span {
   color: white;
   font: bold 24px/45px Helvetica, Sans-Serif;
   letter-spacing: -1px;
   background: rgb(0, 0, 0);
   background: rgba(0, 0, 0, 0.7);
   padding: 12px;
   font-size: 16px;
}
h2 span.spacer {
   padding:0 5px;
}*/
/*text-center*/
</style>

    <div class="container content">

      <? foreach ($comics as $key => $c) { ?>
        <? if($key % 4 == 0) { ?>
          <div class="row">
        <?}?>
         <div class="col-sm-3">
           <div class="panel panel-default home-panels">
             <? if($c['page_id'] != 0) { ?>
               <? echo "<div class=\"image\"><a href=\"" . site_url('comic/' . $c['comic_id']) ."\"><img height=\"100%\" width=\"100%\" src=\"" . site_url('uploads/' . $c['page_id']) . "\" /></a>"; ?>
               <? echo "</div>"; ?>
             <?}?>
             <? //if($c['page_id'] == 0) { ?>
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
             <? //} ?>
           </div>
         </div>
         <? if($key % 4 == 3) { ?>
          </div>
         <?}?>
      <?}?>

    </div>
  </body>
