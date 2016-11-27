<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-static">
   <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://www.bootply.com" target="ext"><b>Kurio</b></a>
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
    </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">  
          <?php
              if(!$this->session->userdata('logged_in'))
              {
                echo'<li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>';
              }
              else
              {
                $sess_array = $this->session->userdata('logged_in');
                echo'<li><a href="#">Welcome '.$sess_array['username'].'</a></li>';
              }
          ?>
          
        </ul>
        <ul class="nav navbar-right navbar-nav">
          <li class="dropdown">
            <ul class="dropdown-menu" style="padding:12px;">
                <form class="form-inline">
     				<button type="submit" class="btn btn-default pull-right"><i class="glyphicon glyphicon-search"></i></button><input type="text" class="form-control pull-left" placeholder="Search">
                </form>
             </ul>
          </li>
          <li class="dropdown">
            <?php
              if($this->session->userdata('logged_in'))
              {
                echo'
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="'.base_url().'index.php/Home/logout">Logout</a></li>
              
                  </ul>
                ';
              }
            ?>
            
          </li>
        </ul>
      </div>
    </div>
</nav><!-- /.navbar -->