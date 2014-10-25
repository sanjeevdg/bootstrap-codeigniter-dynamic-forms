 <div id="top">

        <!-- .navbar -->
        <nav class="navbar navbar-inverse navbar-static-top">

          <!-- Brand and toggle get grouped for better mobile display -->
          <header class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
            </button>
            <a href="index.html" class="navbar-brand">
              <img src="<?php echo base_url()?>assets/images/logo.png" alt="">
            </a> 
          </header>
          <?php $user = $this->ion_auth->user()->row(); ?>
			  
          <div class="topnav">
			  
            <div class="btn-toolbar">
              <!--<div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Sidebar" data-toggle="tooltip" class="btn btn-success btn-sm" id="changeSidebarPos">
                  <i class="fa fa-expand"></i>
                </a> 
              </div>
              <div class="btn-group">
              <p class="text-info">Welcome <?php echo $user->email?>
              </div> -->
                  <div class="btn-group pull-right" style="margin-top:8px;">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Welcome, <?php echo $user->email?> <span class="caret"></span>
          </button>
          
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('auth/change_password')?>"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url('auth/logout')?>"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
          </ul>
        </div>

<!--              <div class="btn-group">
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-warning">5</span> 
                </a> 
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-comments"></i>
                  <span class="label label-danger">4</span> 
                </a> 
              </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Document" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-file"></i>
                </a> 
                <a data-toggle="modal" id="help_modal_btn" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                  <i class="fa fa-question"></i>
                </a> 
              </div>
              <div class="btn-group">
                <a href="<?php //echo site_url('auth/logout')?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                  <i class="fa fa-power-off"></i>
                </a> 
              </div> -->
            </div>
          </div><!-- /.topnav -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">

            <!-- .nav -->
            <ul class="nav navbar-nav">
              <li> <a href="<?php echo site_url('admin/dashboard')?>">Dashboard</a>  </li>
              <li> <a href="<?php echo site_url('admin/create_new_form')?>">New Form</a>  </li>
              <li> <a href="<?php echo site_url('admin/my_forms')?>">All Forms</a>  </li>
              <!-- <li> <a href="<?php //echo site_url('admin/my_users')?>">Users</a>  </li>
              
              <li class='dropdown '>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Form Elements
                  <b class="caret"></b>
                </a> 
                <ul class="dropdown-menu">
                  <li> <a href="form-general.html">General</a>  </li>
                  <li> <a href="form-validation.html">Validation</a>  </li>
                  <li> <a href="form-wysiwyg.html">WYSIWYG</a>  </li>
                  <li> <a href="form-wizard.html">Wizard &amp; File Upload</a>  </li>
                </ul>
              </li>--->
            </ul><!-- /.nav -->
          </div>
        </nav><!-- /.navbar -->

        <!-- header.head -->
        <header class="head">
          <div class="search-bar">
            <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
              <i class="fa fa-expand"></i>
            </a> 
            <form class="main-search">
              <div class="input-group">
                <input type="text" class="input-small form-control" placeholder="Live Search ...">
                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm text-muted" type="button"><i class="fa fa-search"></i></button>
                                </span> 
              </div>
            </form>
          </div>

          <!-- ."main-bar -->
          <div class="main-bar">
            <h3>
				<?php if ($this->uri->segment(2)=="edit_form") { ?>
				
				<h3>Add some columns and then drop elements onto the added columns</h3>
				<p style="color:white;">Please be sure to click the "Save" button occasionally to avoid losing your changes.
				
				<?php } else {?>
              <i class="fa fa-dashboard"></i>Dashboard</h3>
              <?php } ?>
          </div><!-- /.main-bar -->
        </header>

        <!-- end header.head -->
      </div><!-- /#top -->
