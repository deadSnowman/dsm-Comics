    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<? echo site_url(); ?>">dsm-Comics</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li <? if($page === "home") echo "class=\"active\""; ?>>
              <a href="<? echo site_url(); ?>">Home</a>
            </li>
            <li <? if($page === "admin") echo "class=\"active\""; ?>>
              <a href="<? echo site_url('comic/admin'); ?>" <? if($this->session->userdata('username') == "") echo 'class="shake hover"'; ?>>Admin</a>
            </li>
          </ul>
          <?
          if($this->session->userdata('username') != "") {?>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<? echo base_url(); ?>login/logout">Logout</a>
            </li>
          </ul>
          <?}?>
        </div>
      </div>
    </nav>
