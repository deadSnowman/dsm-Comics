<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- ending javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- comic view specific code -->
<script type="text/javascript">

$('#next, #next2, #next3').click(() => { next_page(); });
$('#prev, #prev2').click(() => { prev_page(); });
$('#first, #first2').click(() => { first(); });
$('#last, #last2').click(() => { last(); });
$('#rand, #rand2').click(() => { rand(); });

$(document).keydown((e) => {
  switch(e.which) {
    case 37: prev_page();
    break;
    case 39: next_page();
    break;
    default: return;
  }
  e.preventDefault();
});

function start_loader() {
  $('#loader').show();
  $('#img_panel').hide();
  $('#padthis').show();
}

$('#comic_page').on('load', function(){
  $('#loader').hide();
  $('#img_panel').show();
  $('#padthis').hide();
});

function next_page() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_total = parseInt($('#page_total').val());
  page_num = page_num + 1;

  if(page_num <= page_total) {
    start_loader();
    $('#page_num').val(page_num);
    var page_id_list = $('#page_id_list').val(); //retrieve array
    page_id_list_parsed = JSON.parse(page_id_list);
    //alert(page_num + " - " + page_id_list_parsed[page_num] +" - " + page_id_list); // debug
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[page_num]);
    window.history.pushState("details", "Title", base_url + 'comic/' + $('#comic_id').val() + '/' + page_num);
  }
}

function prev_page() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_total = parseInt($('#page_total').val());
  page_num = page_num - 1;

  if(page_num >= 0) {
    start_loader();
    $('#page_num').val(page_num);
    var page_id_list = $('#page_id_list').val();
    page_id_list_parsed = JSON.parse(page_id_list);
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[page_num]);
    window.history.pushState("details", "Title", base_url + 'comic/' + $('#comic_id').val() + '/' + page_num);
  }
}

function first() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  if(page_num != 0) {
    start_loader();
    $('#page_num').val(0);
    var page_id_list = $('#page_id_list').val();
    page_id_list_parsed = JSON.parse(page_id_list);
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[0]);
    window.history.pushState("details", "Title", base_url + 'comic/' + $('#comic_id').val() + '/' + 0);
  }
}

function last() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_id_list = $('#page_id_list').val();
  var page_id_list_parsed = JSON.parse(page_id_list);
  var lastpage = page_id_list_parsed.length-1;
  if(page_num != lastpage) {
    start_loader();
    $('#page_num').val(lastpage);
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[lastpage]);
    window.history.pushState("details", "Title", base_url + 'comic/' + $('#comic_id').val() + '/' + lastpage);
  }
}

function rand() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_id_list = $('#page_id_list').val();
  page_id_list_parsed = JSON.parse(page_id_list);

  // don't continually generate random numbers that aren't the same page if there's only one page
  if(page_id_list_parsed.length > 1) {
    // don't pick the same page
    var flag = true; var randnum = "";
    while(flag) {
      var randnum = Math.floor(Math.random()*page_id_list_parsed.length);
      if(randnum != page_num) flag = false;
    }
    start_loader();
    $('#page_num').val(randnum);
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[randnum]);
    window.history.pushState("details", "Title", base_url + 'comic/' + $('#comic_id').val() + '/' + randnum);
  }
}

</script>
