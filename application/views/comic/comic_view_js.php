<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- ending javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- comic view specific code -->
<script type="text/javascript">

$(document).ready(function () {
  //alert("test");
});

$('#next, #next2, #next3').click(() => { next_page(); });
$('#prev, #prev2').click(() => { prev_page(); });
$('#first, #first2').click(() => { first(); });
$('#last, #last2').click(() => { last(); });
$('#rand, #rand2').click(() => { rand(); });

function next_page() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_total = parseInt($('#page_total').val());
  page_num = page_num + 1;

  if(page_num <= page_total) {
    $('#page_num').val(page_num);
    var page_id_list = $('#page_id_list').val(); //retrieve array
    page_id_list_parsed = JSON.parse(page_id_list);
    //alert(page_num + " - " + page_id_list_parsed[page_num] +" - " + page_id_list); // debug
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[page_num]);
  }
}

function prev_page() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_total = parseInt($('#page_total').val());
  page_num = page_num - 1;

  if(page_num >= 0) {
    $('#page_num').val(page_num);
    var page_id_list = $('#page_id_list').val(); //retrieve array
    page_id_list_parsed = JSON.parse(page_id_list);
    //alert(page_num + " - " + page_id_list_parsed[page_num] +" - " + page_id_list); // debug
    $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[page_num]);
  }
}

function first() {
  var base_url = "<? echo base_url(); ?>";
  $('#page_num').val(0);
  var page_id_list = $('#page_id_list').val(); //retrieve array
  page_id_list_parsed = JSON.parse(page_id_list);
  $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[0]);
}

function last() {
  var base_url = "<? echo base_url(); ?>";
  var page_id_list = $('#page_id_list').val(); //retrieve array
  page_id_list_parsed = JSON.parse(page_id_list);
  $('#page_num').val(page_id_list_parsed.length-1);
  $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[page_id_list_parsed.length-1]);
}

function rand() {
  var base_url = "<? echo base_url(); ?>";
  var page_num = parseInt($('#page_num').val());
  var page_id_list = $('#page_id_list').val(); //retrieve array
  page_id_list_parsed = JSON.parse(page_id_list);
  // don't pick the same page
  var flag = true; var randnum = "";
  while(flag) {
    var randnum = Math.floor(Math.random()*page_id_list_parsed.length);
    if(randnum != page_num) flag = false;
  }
  $('#page_num').val(randnum);
  $('#comic_page').attr("src", base_url + "uploads/" + page_id_list_parsed[randnum]);
}

</script>
