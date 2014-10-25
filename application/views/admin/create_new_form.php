<div id="content">
        <div class="outer">
          <div class="inner">
<?php if ($this->session->flashdata('message')) { 
						echo $this->session->flashdata('message');
						 } ?>

            &nbsp;			<h3><i class="icon-info-sign"></i> Type a unique identifier for your form</h3>
						
					
					
				<div class='col-md-9'> 
					<form method='post' id='new_form' class='form-horizontal' action='<?php echo site_url('admin/create_my_form')?>'>
							<div class='form-group'>
							<label class='control-label col-md-4' for='inputMessage'>Name</label>
							<div class='col-md-8'>
				
					<input type='text' name='new_form_name' class='required alphanumeric form-control'  id='new_form_name'/>
			<span class='help-block'>Letters, underscores and digits only - no spaces</span>
			</div></div>
			
							<div class='form-group'>
							<label class='control-label col-md-4' for='inputMessage'>Display Name</label>
							<div class='col-md-8'>
					<input type='text' name='display_name' class='required form-control'  id='display_name'/>
					<span class='help-block'>This field can accept any character</span>
			</div></div>
			
			
			<div class='col-md-12'>
							<div class='controls col-md-4'></div>
							<div class='controls col-md-4'>
													
					<input type='submit' class='btn btn-primary form-control' name='submit' value='Next'/>
					 
					 </div>
						</div>
						
					</form>
					<p>&nbsp;</p>
          </div>
						 
						 
						 
          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
      </div>
      </div>
