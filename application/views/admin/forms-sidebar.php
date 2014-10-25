<div id="left">
	
        <?php //$this->load->view('admin/user-panel');?>

        <!-- #menu -->
        <ul id="menu" class="collapse">
          <li class="nav-header">Drag and Drop <br/>Components</li>
          <li class="nav-divider"></li>
          <li style="color:white;">Add <button class="add_cols btn-primary" numcols="2">2</button>/<button class="add_cols btn-primary" numcols="3"> 3</button>/<button class="add_cols btn-primary" numcols="4"> 4</button>   Columns</li>




<div class='selectorField draggableField ajax-icon' tartype='textbox'>
          <div class="textbox well well-mini" title="Click and drag"><i class="glyphicon glyphicon-font"></i>Textfield</div>
          		</div>
          		<!--
          <div class='selectorField draggableField ajax-icon' tartype='numberinput'>
          <div class="textbox well well-mini" title="Click and drag"><i class="glyphicon glyphicon-pencil"></i>Number Input</div>
          		</div>

<div class='selectorField draggableField ajax-icon' tartype='numberinput_currency'>
          <div class="textbox well well-mini" title="Click and drag"><i class="glyphicon glyphicon-usd"></i>Currency Input</div>
          		</div>

<div class='selectorField draggableField ajax-icon' tartype='numberinput_percentage'>
          <div class="textbox well well-mini" title="Click and drag"><i class="glyphicon glyphicon-adjust"></i>Percentage Input</div>
          		</div>
-->
          <div class='selectorField draggableField' tartype='checkbox'>
          <div class="checkboxgroup well well-mini" title="Click and drag"><i class="glyphicon glyphicon-check"></i> Checkbox Horizontal</div>		
          </div>
				
		<div class='selectorField draggableField' tartype='checkbox_vertical'>
          <div class="checkboxgroup well well-mini" title="Click and drag"><i class="glyphicon glyphicon-check"></i> Checkbox Vertical</div>		
          </div>
          		
		<div class='selectorField draggableField' tartype='radio'>
          <div class="radiogroup well well-mini" title="Click and drag"><i class="glyphicon glyphicon-remove-circle"></i> Radio Horizontal</div>		
          </div>
          
          <div class='selectorField draggableField' tartype='radio_vertical'>
          <div class="radiogroup well well-mini" title="Click and drag"><i class="glyphicon glyphicon-remove-circle"></i> Radio Vertical</div>		
          </div>
          
          <div class='selectorField draggableField' tartype='select'>
          <div class="combobox well well-mini" title="Click and drag"><i class="glyphicon glyphicon-list"></i> Select List</div>		
          </div>
          
          <div class='selectorField draggableField' tartype='select-multiple'>
          <div class="selectmultiple well well-mini" title="Click and drag"><i class="glyphicon glyphicon-list-alt"></i> Select Multiple</div>		
          </div>
          
          <div class='selectorField draggableField' tartype='date'>
          <div class="displaydate well well-mini" title="Click and drag"><i class="glyphicon glyphicon-calendar"></i> Date</div>		
          </div>			
				
		  <div class='selectorField draggableField' tartype='textarea'>
          <div class="textarea well well-mini" title="Click and drag"><i class="glyphicon glyphicon-text-width"></i> Textarea</div>		
          </div>
		
		<div class='selectorField draggableField' tartype='paragraph'>
          <div class="textarea well well-mini" title="Click and drag"><i class="glyphicon glyphicon-align-left"></i> Paragraph</div>		
          </div>
          
        <div class='selectorField draggableField' tartype='mimage'>
          <div class="textarea well well-mini" title="Click and drag"><i class="glyphicon glyphicon-picture"></i> Image</div>		
          </div>
        
          <div class='selectorField draggableField' tartype='fileupload'>
          <div class="fileupload well well-mini" title="Click and drag"><i class="glyphicon glyphicon-upload"></i> Fileupload</div>		
          </div>		
				
          <div tartype='mygrid'>
			 <div class="well well-mini" title="Click">
			 <a data-toggle="modal" onClick="javascript:$('#ht_form')[0].reset();" href="#ht_modal" rel="tooltip" title="Click to continue">
				 <i class="glyphicon glyphicon-table"></i>Grid Wizard
			 </a>			
			 </div>
			 </div>
			 
			
          
          <li class="">
            <a href="<?php echo site_url('admin/dashboard')?>">
              <i class="fa fa-dashboard"></i>
              <span class="link-title">Dashboard</span> 
              <span class="fa arrow"></span> 
            </a> 
            
          </li>
          <li class="">
            <a href="<?php echo site_url('admin/create_new_form')?>">
              <i class="fa fa-tasks"></i>&nbsp;Create New Form
              <span class="fa arrow"></span> 
            </a> 
            
          </li>
          <li class="">
            <a href="<?php echo site_url('admin/my_forms')?>">
              <i class="fa fa-pencil"></i>&nbsp;All Forms
              <span class="fa arrow"></span> 
            </a> 
            
          </li>
          <li>
            <a href="<?php echo site_url('admin/my_users')?>">
              <i class="fa fa-table"></i>&nbsp; All Users</a> 
          </li>
          
        </ul><!-- /#menu -->
      </div><!-- /#left -->

