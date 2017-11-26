<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- ending javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- for draggable ui -->
<script>
$( function() {
  $( "#sortable" ).sortable({
    cursor: "grabbing"
  });
  $( "#sortable" ).disableSelection();
} );
</script>

<!-- comics admin specific code -->
<script type="text/javascript">

$(document).ready(function () {
  //alert("test");
});

$('#clear_editcomic').click(function() {
  $('#ec_title').html("Add Comic");
  $('#comic_id').val(0);

  $('#inputCover').val("");
  $('#inputTitle').val("");
  $('#inputGenre').val("");
  $('#inputArtist').val("");
  $('#inputDescription').val("");
  $('#update_add_comic').html('Add');
  $('#editpages').hide();

  return false;
});


$('#editPagesForm').on('submit', function(e){
  e.preventDefault();

  var base_url = "<? echo base_url(); ?>";
  var comic_id = $('#comic_id').val();

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/updateAddPages",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function(result) {
      //alert(result);
      var data = JSON.parse(result);

      if(data['status'] == "w") {
        alert_bar(JSON.stringify(data['alert_bar']), 'w');
      } else {
        var key = 0;
        data['added_page_ids'].forEach(function(page_id) {
          //alert(page_id);
          $('.pages_list').append('<p class="page_list_element_' + page_id + '">'+
          '<a href="' + page_id + '" onclick="return false;" class="del_page_list_item trash"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
          /*'<a href="' + page_id + '" onclick="return false;" class="page_list_item">' + data['ofiles']['inputPages']['name'][key] + '</a>'*/
          '<a href="' + base_url + '/uploads/' + page_id + '" target="_blank" class="page_list_item">' + data['ofiles']['inputPages']['name'][key] + '</a>'
          );
          key = key + 1;
        });

        alert_bar('pages added', 's');
        pin_pages_layout(false); // click pin button, but don't show the notification
      }
    }
  });
});

$('#editComicForm').on('submit', function(e){
  e.preventDefault();

  var base_url = "<? echo base_url(); ?>";
  var comic_id = $('#comic_id').val();

  var cover_image = $('#inputCover').val();
  var title = $('#inputTitle').val();
  var genre = $('#inputGenre').val();
  var artist = $('#inputArtist').val();
  var description = $('#inputDescription').val();

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/updateAddComic",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function(result) {
      //alert(result);
      var res = JSON.parse(result);
      var status = res['status'];
      //var status = JSON.parse(result)['status'];

      //var mess = JSON.parse(result)['alert_bar'];
      //alert(status);
      if(status === "w") {
        alert_bar(res['alert_bar'], 'w');
      } else {
        var c_id = res['comic_id'];
        //alert(result);
        //alert(result);
        // update Comic List based on the Edit Comic criteria that was submitted
        if(comic_id == 0) {
          $('#comic_id').val(c_id); // update with insert_id
          $('#ec_title').html("Edit Comic - " + c_id); // update with insert_id

          var append_str = "";
          append_str += "<p class=\"comic_list_element_" + c_id + "\">"+
          "<a href=\"" + c_id + "\" onclick=\"return false;\" class=\"del_comic_list_item trash\"><span class=\"glyphicon glyphicon-trash\"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
          "<a href=\"" + c_id + "\" onclick=\"return false;\" class=\"comic_list_item\">" + title;
          if(genre != "") append_str += " (" + genre + ")";
          if(artist != "") append_str += " ~" + artist;
          append_str += "</a></p>";
          $('.comic_list').append(append_str);
          $('#update_add_comic').html('Update');
          $('#editpages').show();

          alert_bar('comic added', 's');
        } else {

          var swap_str = "";
          swap_str += "<p class=\"comic_list_element_" + comic_id + "\">"+
          "<a href=\"" + comic_id + "\" onclick=\"return false;\" class=\"del_comic_list_item trash\"><span class=\"glyphicon glyphicon-trash\"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
          "<a href=\"" + comic_id + "\" onclick=\"return false;\" class=\"comic_list_item\">" + title;
          if(genre != "") swap_str += " (" + genre + ")";
          if(artist != "") swap_str += " ~" + artist;
          swap_str += "</a></p>";
          $('p.comic_list_element_' + comic_id).html(swap_str);

          alert_bar('comic updated', 's');
        }

        pin_comic_layout(false); // click pin button, but don't show the notification
      }
    }
  });
});

function pin_pages_layout(alert_option) {
  var base_url = "<? echo base_url(); ?>";
  var post_data = {
    'page_display_order': [],
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  $('.page_list_item').each(function() {
    //post_data['page_display_order'].push($(this).attr('href'));
    var url = $(this).attr('href');
    post_data['page_display_order'].push(url.substr(url.lastIndexOf("/")+1));
  });

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/pinPages",
    data: post_data,
    success: function(result) { if(alert_option == true) result == true ? alert_bar('layout pinned', 's') : alert_bar('layout not pinned', 'w'); }
  });
}

function pin_comic_layout(alert_option) {
  var base_url = "<? echo base_url(); ?>";
  var post_data = {
    'comic_display_order': [],
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  $('.comic_list_item').each(function() {
    post_data['comic_display_order'].push($(this).attr('href'));
  });

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/pinComics",
    data: post_data,
    success: function(result) { if(alert_option == true) result == true ? alert_bar('layout pinned', 's') : alert_bar('layout not pinned', 'w'); }
  });
}

$('button#editpages').click(function() {
  var base_url = "<? echo base_url(); ?>";
  var comic_id = $('#comic_id').val();
  if(comic_id != 0) window.location.href=base_url + "comic/admin/" + comic_id;
});

$(document).on("click", 'a.del_page_list_item', function(event) {
  var base_url = "<? echo base_url(); ?>";
  var page_id = $(this).attr('href');

  // set data for the AJAX post
  var post_data = {
    'page_id': page_id,
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  // ajax post
  return $.ajax({
    type: 'POST',
    url: base_url + "comic/delPage",
    data: post_data,
    success: function(result) {
      if(result == true) {
        $(document).ajaxComplete(function() {
          $(".page_list_element_"+page_id).hide();
        });
        alert_bar('page deleted', 's');
      } else {
        alert_bar('page not deleted', 'w');
      }
    }
  });
});

$(document).on("click", 'a.del_comic_list_item', function(event) {
  var base_url = "<? echo base_url(); ?>";
  var comic_id = $(this).attr('href');

  // set data for the AJAX post
  var post_data = {
    'comic_id': comic_id,
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
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
        });
        alert_bar('comic deleted', 's');
      } else {
        alert_bar('comic not deleted', 'w');
      }
    }
  });
});

$('#pin_pages_list').click(function() {
  pin_pages_layout(true);
});

$('#pin_comic_list').click(function() {
  pin_comic_layout(true);
});

function alert_bar(message, type) {
  $('#alertarea').html('<div id="alert"></div>');
  $('#alertarea').addClass('notif_rules');
  if(type == 's') {
    $('#alert').addClass('alert alert-success fade in alert-dismissable inner_notif_rules');
  } else if (type == 'w') {
    $('#alert').addClass('alert alert-warning fade in alert-dismissable inner_notif_rules');
  } else if (type == 'i') {
    $('#alert').addClass('alert alert-info fade in alert-dismissable inner_notif_rules');
  } else if (type == 'd') {
    $('#alert').addClass('alert alert-danger fade in alert-dismissable inner_notif_rules');
  }

  $('#alert').addClass('alert alert-success fade in alert-dismissable');
  $('#alert').css({'margin-top': '18px'});
  $('#alert').html('<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>' + message);

  // auto close with fancy animation
  $("#alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#alert").slideUp(500);
  });

}

$(document).on("click", 'a.comic_list_item', function(event) {
  var base_url = "<? echo base_url(); ?>";
  var comic_id = $(this).attr('href');

  // set data for the AJAX post
  var post_data = {
    'comic_id': comic_id,
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
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
      $('#inputCover').val("");
      $('#inputTitle').val(data.title);
      $('#inputGenre').val(data.genre);
      $('#inputArtist').val(data.artist);
      $('#inputDescription').val(data.description);
      $('#update_add_comic').html('Update');
      $('#editpages').show();
    }
  });

});

</script>
