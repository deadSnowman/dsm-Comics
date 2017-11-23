<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- ending javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- comics admin specific code -->
<script type="text/javascript">

$(document).ready(function () {
  //alert("test");
});

$('#clear_editcomic').click(function() {
  $('#ec_title').html("Edit Comic");
  $('#comic_id').val(0);

  $('#inputCover').val("");
  $('#inputTitle').val("");
  $('#inputGenre').val("");
  $('#inputArtist').val("");
  $('#inputDescription').val("");

  return false;
});


$('#editComicForm').on('submit', function(e){
  e.preventDefault();
  //alert("test");

  var base_url = "<? echo base_url(); ?>";
  var comic_id = $('#comic_id').val();

  var cover_image = $('#inputCover').val();
  var title = $('#inputTitle').val();
  var genre = $('#inputGenre').val();
  var artist = $('#inputArtist').val();
  var description = $('#inputDescription').val();

  // set data for the AJAX post
  var post_data = {
    'comic_id': comic_id,
    'title': title,
    'genre': genre,
    'artist': artist,
    'description': description,
    'cover_image': cover_image
  };

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/updateAddComic",
    //data: post_data,
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function(result) {
      //alert(result);
      if(comic_id == 0) {
        $('#comic_id').val(result); // update with insert_id
        $('#ec_title').html("Edit Comic - " + result); // update with insert_id
        $('.comic_list').append("<p class=\"comic_list_element_" + result + "\">"+
        "<a href=\"" + result + "\" onclick=\"return false;\" class=\"del_comic_list_item\"><span class=\"glyphicon glyphicon-trash\"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
        "<a href=\"" + result + "\" onclick=\"return false;\" class=\"comic_list_item\">" + title + " (" + genre + ") ~" + artist + "</a></p>");
      }
    }
  });
});

/*$('#update_add_comic').click(function() {
  var base_url = "<? //echo base_url(); ?>";
  var comic_id = $('#comic_id').val();

  var cover_image = $('#inputCover').val();
  var title = $('#inputTitle').val();
  var genre = $('#inputGenre').val();
  var artist = $('#inputArtist').val();
  var description = $('#inputDescription').val();

  // set data for the AJAX post
  var post_data = {
    'comic_id': comic_id,
    'title': title,
    'genre': genre,
    'artist': artist,
    'description': description,
    'cover_image': cover_image
  };

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/updateAddComic",
    data: post_data,
    mimeType:"multipart/form-data", //added
    success: function(result) {
      if(comic_id == 0) {
        $('#comic_id').val(result); // update with insert_id
        $('#ec_title').html("Edit Comic - " + result); // update with insert_id
        $('.comic_list').append("<p class=\"comic_list_element_" + result + "\">"+
        "<a href=\"" + result + "\" onclick=\"return false;\" class=\"del_comic_list_item\"><span class=\"glyphicon glyphicon-trash\"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
        "<a href=\"" + result + "\" onclick=\"return false;\" class=\"comic_list_item\">" + title + " (" + genre + ") ~" + artist + "</a></p>");
      }
    }
  });

});*/

$(document).on("click", 'a.del_comic_list_item', function(event) {
  var base_url = "<? echo base_url(); ?>";
  var comic_id = $(this).attr('href');

  // set data for the AJAX post
  var post_data = {
    'comic_id': comic_id
  };

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/delComic",
    data: post_data,
    success: function(result) {
      if(result == true) {
        $(document).ajaxComplete(function() {
          $(".comic_list_element_"+comic_id).hide();
        })
      }
    }
  });
});

$(document).on("click", 'a.comic_list_item', function(event) {
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
    success: function(result) {
      $('#comic_id').val(comic_id);
      $('#ec_title').html("Edit Comic - " + comic_id);

      var data = JSON.parse(result);
      //$('#inputCover').val(data.cover_image); // breaks atm
      $('#inputTitle').val(data.title);
      $('#inputGenre').val(data.genre);
      $('#inputArtist').val(data.artist);
      $('#inputDescription').val(data.description);
    }
  });

});

</script>
