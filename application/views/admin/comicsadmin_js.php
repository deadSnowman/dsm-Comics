<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- ending javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- comics admin specific code -->
<script type="text/javascript">

$(document).ready(function () {
  //alert("test");
});

$("a.comic_list_item").click(function() {
  var base_url = "<? echo base_url(); ?>";
  var comic_id = $(this).attr('href');

  // set data for the AJAX post
  var post_data = {
   'comic_id': comic_id
  };

  // ajax post
  return $.ajax({
   type: 'POST',
   url: base_url + "comic/loadEditComic",
   data: post_data,
   success: function(result){
     var data = JSON.parse(result);
     $('#inputTitle').val(data.title);
     $('#inputGenre').val(data.genre);
     $('#inputArtist').val(data.artist);
     $('#inputDescription').val(data.description);
   }
  });

});

</script>
