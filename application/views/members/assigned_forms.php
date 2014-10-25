<div id="content">
        <div class="outer">
          <div class="inner">
			
	<? if ($this->session->flashdata('message')) { 
				
				echo $this->session->flashdata('message');
				
			}
				?>		
			<h2>Assigned Forms</h2>
					<div class="box-content">
<table class="table table-striped">  
        <thead>  
          <tr>  
            <th>Form-ID</th>  
            <th>Form Name</th>  
            <th>Actions</th>  
          </tr>  
        </thead>  
        <tbody>  

						<? foreach ($ass_form as $af => $as) { 

							$myf = $this->forms_model->get_form_by_id($as->form_id);


					
	echo "<tr><td>".$myf->id."</td><td>".$myf->form_name."</td><td class='center'><a class='btn btn-info' href='".site_url('members/add_data/'.$myf->id)."'><i class='icon-edit icon-white'></i>Add Data</a>&emsp;";
	echo "<a class='btn btn-success' href='".site_url('members/view_data/'.$myf->id)."'><i class='icon-zoom-in icon-white'></i>View Data</a></td></tr>";
	

							 } ?>
</tbody>
</table>
			
						<div class="clearfix"></div>
						
					</div>
					
				</div>
				
			</div>
			</div>

				
