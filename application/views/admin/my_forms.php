<div id="content">
        <div class="outer">
          <div class="inner">
<?php if ($this->session->flashdata('message')) { 
						echo $this->session->flashdata('message');
						 } ?>

            &nbsp;
            <h2><i class="icon-info-sign"></i> List of forms</h2>
						<!-- 
						<div class="box-icon" style='float:right;margin-top:-30px;'>
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
						
					</div> -->
					<div class="box-content">

<table class="table table-striped">  
        <thead>  
          <tr>  
            
            <th>Name</th>  
            <th>Display Name</th>  
            
            
            <th>Actions</th>
            
            
          </tr>  
        </thead>  
        <tbody>  
          
          <?php foreach ($my_forms as $m => $mf) { ?>
          <tr>  
            
            <td><a href="<?php echo site_url('admin/view_form/'.$mf['form_name'])?>"><?php echo $mf['form_name']?></a></td>  
            <td><?php echo $mf['display_name']?></td>
            	<td nowrap>
				<a class="btn btn-info" href="<?php echo site_url('create_form/edit_form/'.$mf['form_name'])?>"><i class="icon-edit icon-white"></i>Edit</a>
				<a class="btn btn-primary" href="<?php echo site_url('admin/enter_data_for_form/'.$mf['form_name'])?>"><i class="icon-edit icon-white"></i>EnterData</a>
				<a class="btn btn-warning" href="<?php echo site_url('admin/view_data_for_form/'.$mf['form_name'])?>"><i class="icon-edit icon-white"></i>ViewData</a>
				<a class="btn btn-danger" href="<?php echo site_url('create_form/delete_form/'.$mf['form_name'])?>"><i class="icon-trash icon-white"></i>Delete</a>
				
			</td>
            </tr> 
          <?php  } ?>
          
           
           
           
           
           
        </tbody>  
        
      </table>  

<div class="dataTables_paginate paging_bootstrap">
	<?php echo $page_links?>
	</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			</div>
			
		
		




          </div>
						 
						 
						 
          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
      
