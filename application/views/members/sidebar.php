<div id="left">
        		<?php $this->load->view('members/user-panel');?>

        <!-- #menu -->
        <ul id="menu" class="collapse">
          <li class="nav-header">Menu</li>
          <li class="nav-divider"></li>
          <li class="">
            <a href="<?php echo site_url('members/dashboard')?>">
              <i class="fa fa-dashboard"></i>
              <span class="link-title">Dashboard</span> 
              <span class="fa arrow"></span> 
            </a> 
            
          </li>
          <li class="">
            <a href="<?php echo site_url('members/assigned_forms')?>">
              <i class="fa fa-tasks"></i>&nbsp;Assigned Forms
              <span class="fa arrow"></span> 
            </a> 
            
          </li>
          
          
        </ul><!-- /#menu -->
      </div><!-- /#left -->
