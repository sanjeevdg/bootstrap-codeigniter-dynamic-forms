<?php $user = $this->ion_auth->user()->row(); ?>
        <div class="media user-media">
			<div class='col-md-1'></div>
          <a class="user-link" href="">
			  
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url()?>assets/images/user.gif">
            <span class="label label-danger user-label">16</span> 
          </a> 
        
          <div class="media-body">
		<div class='col-md-1'></div>	  
            <h5 class="media-heading"><?php echo $user->email?></h5>
            <ul class="list-unstyled user-info">
              <li> <a href="<?php echo site_url('user/profile')?>"><?php echo $user->username?>&nbsp;<?php //echo $user->last_name?></a>  </li>
              <li>Last Access :
                <br>
                <small>
                  <i class="fa fa-calendar"></i>&nbsp;<?php echo unix_to_human(mysql_to_unix($user->last_login))?></small> 
              </li>
            </ul>
          </div>
        </div>
