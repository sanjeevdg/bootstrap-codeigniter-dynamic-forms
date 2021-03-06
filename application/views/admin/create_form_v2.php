  <style>
	.edit  .demo .drag { position: absolute; top: 0;right: 0; cursor: pointer; }
.edit .demo .drag i {color:#000; text-shadow:0 1px 0 #ddd;}

.edit .ui-sortable-placeholder { outline: 1px dashed #ddd;visibility: visible!Important; border-radius: 4px;height:60px;}

.edit .demo .row:before {
	background-color: #F5F5F5;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "Row";
	font-size: 12px;
	font-weight: bold;
	left: -1px;
	line-height:2;
	padding: 3px 7px;
	position: absolute;
	top: -1px;
}
.edit .demo .row {
	background-color: #F5F5F5;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	-webkit-box-shadow: inset 0 1px 13px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: inset 0 1px 13px rgba(0, 0, 0, 0.1);
	box-shadow: inset 0 1px 13px rgba(0, 0, 0, 0.1);
	border: 1px solid #DDDDDD;
	border-radius: 4px 4px 4px 4px;
	margin: 15px 0;
	position: relative;
	padding: 25px  14px 0;
}
  
	.edit  .demo .droppedFields:after {
	background-color: #FfFfFf;
	border: 1px solid #DDDDDD;
	border-radius: 4px 0 4px 0;
	color: #9DA0A4;
	content: "Column";
	font-size: 12px;
	font-weight: bold;
	left: -1px;
	padding: 3px 7px;
	position: absolute;
	top: -1px;
	z-index:0;
}
 .edit .demo .droppedFields {
	/*background-color: #FFFFFF; f5f5f5*/
	border: 1px solid #DDDDDD;
	border-radius: 4px 4px 4px 4px;
	margin: 15px 0;
	padding: 39px 19px 24px;
	
	
}

    .modal-backdrop {
		z-index: 40;
	}
    .activeDroppable {
      background-color: #eeffee;
    }
    .hoverDroppable {
      background-color: lightgreen;
    }

    .draggableField {
      /* float: left; */
      padding-left:5px;      
    }
    .draggableField > input,select, button, .checkboxgroup, .selectmultiple, .radiogroup {
      margin-top: 10px;
      margin-right: 10px;
      margin-bottom: 10px;
    }
     .draggableField:hover{
      background-color: #ccffcc;
    } 
    .control-label {
      width: 100px;
    }
    .selectorField .textbox b, .selectorField .password b, .selectorField .combobox b, .selectorField .radiogroup b, .selectorField .checkboxgroup b, .selectorField .selectmultiple b,
    .selectorField .displaydate b, .selectorField .displaytext b {
      position:relative; top:3px; left: 0px; width: 18px; height: 16px; display: inline-block; background-image: url("img/sprite.png"); background-repeat: no-repeat; 
    }
    .selectorField .textbox b, .selectorField .password b, .selectorField .displaytext b {
      background-position: -10px -549px;
    }
    .selectorField .combobox b {
      background-position: -10px -722px;
    }
    .selectorField .radiogroup b {
      background-position: -10px -619px;
    }
    .selectorField .checkboxgroup b {
      background-position: -10px -688px;
    }
    .selectorField .selectmultiple b {
      background-position: -10px -1082px;
    }
    .selectorField .displaydate b {
      background-position: -10px -975px;
    }
    
    .well-mini {
      margin: 4px;
      padding: 2px;
      border-radius: 6px;
      width: 160px;
      cursor: pointer;
    }
/*    .draggableField:hover .well-mini {
      background-color: #ccffcc;
    }
    */
  </style>
  <style id="content-styles">
    /* Styles that are also copied for Preview */
   
    .control-label {
      display: inline-block !important;
      padding-top: 5px;
      text-align: right;
      vertical-align: baseline;
      padding-right: 10px;
    }
    .droppedField {
      padding-left:5px;
    }
    .droppedField > input,select, button, .checkboxgroup, .selectmultiple, .radiogroup {
      margin-top: 10px;
      margin-right: 10px;
      margin-bottom: 10px;
    }
    .action-bar .droppedField {
      float: left;
      padding-left:5px;
    }
  </style>
  
<script>
	function makeDraggable() {
		$(".selectorField").draggable({helper: "clone",stack: ".droppedField",cursor: "move", cancel: null});

	}

	var _ctrl_index = 1001;
function docReady() {
		console.log("document ready");
		
		makeDraggable();
		
		
		$( ".droppedFields" ).droppable({
			  activeClass: "activeDroppable",
			  hoverClass: "hoverDroppable",
			  accept: ":not(.ui-sortable-helper)",
			  drop: function( event, ui ) {
				var draggable = ui.draggable;				
				draggable = draggable.clone();
				draggable.removeClass("selectorField");
				draggable.addClass("droppedField");
			$(this).css("height", "100%");		
		
		
		if (!draggable.attr('id')) {
		
				
				if  (draggable.attr('tartype')=='textbox') {
					var did = $(this).attr('id');
		
		    
        $.ajax({
            url     : '<?php echo site_url('create_form/add_tf_field_new')?>',
            type    : 'POST',
            async	: false,
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
        //        alert(data);
                $('#'+did).append(data);
                makeDraggable();
    		             
            },
            beforeSend: function() {
			
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();
    
  },
            error   : function( xhr, err ) {
    
            }
        });  
	   
		
		
	}
				
				
		else if  (draggable.attr('tartype')=='addcolumns') {
			
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_my_columns')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
		$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	 
		
		
	}
	else if (draggable.attr('tartype')=='checkbox') { 		
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_cbx_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
    
            }
        });  
	    
	    
        }
	
			else if  (draggable.attr('tartype')=='radio') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_rdo_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
    
            }
        });  
	    
		
		
	}
	
	else if  (draggable.attr('tartype')=='select') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_sl_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	else if  (draggable.attr('tartype')=='select-multiple') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_slm_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	else if  (draggable.attr('tartype')=='addcolumns') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_my_columns')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#build').removeClass().addClass('container'); 
                
                $('#build').append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	
	else if  (draggable.attr('tartype')=='date') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_dt_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
                         
            },
            beforeSend: function() {
	
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
else if  (draggable.attr('tartype')=='mimage') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_mimage')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
    
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	else if  (draggable.attr('tartype')=='checkbox_vertical') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_cbx_field_new_vertical')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
else if  (draggable.attr('tartype')=='radio_vertical') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_rdo_field_new_vertical')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	      		
else if  (draggable.attr('tartype')=='numberinput') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_numberinput/regular')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}

else if  (draggable.attr('tartype')=='numberinput_percentage') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_numberinput/percentage')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}

else if  (draggable.attr('tartype')=='numberinput_currency') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_numberinput/currency')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
			
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}


          		else if  (draggable.attr('tartype')=='textarea') {
		var did = $(this).attr('id');
	
        $.ajax({
            url     : '<?php echo site_url('create_form/add_ta_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	else if  (draggable.attr('tartype')=='paragraph') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_pt_field')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	else if  (draggable.attr('tartype')=='fileupload') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?php echo site_url('create_form/add_fu_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?php echo $my_form['form_name']?>"},
            success : function( data ) {
                
                $('#'+did).append(data);
                makeDraggable();
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
            }
        });  
	    
		
		
	}
	
	
      } 
				
			}
		});		

		/* Make the droppedFields sortable and connected with other droppedFields containers*/
		$( ".droppedFields" ).sortable({
										cancel: null, // Cancel the default events on the controls
										connectWith: ".droppedFields"
									}).disableSelection();
	}

</script>
		
		
	<div id="content">
        <div class="outer">
          <div class="inner">



	<?php if ($this->session->flashdata('message')) {
		
		echo $this->session->flashdata('message');
		
		} ?>
  

    <h2><?php echo $my_form['display_name']?></h2>
    <hr>
   	  <div id='loading_div' style="width:130px;height:30px;float:center;"></div>
   
<div id="build" class="demo col-md-12" style="height: auto !important;height: 100%; min-height:100px;">


<?php echo isset($my_form['form_text'])?$my_form['form_text']:''?>

  </div>

<div style="clear:both;"></div>


<div class="form-actions">

<p class="pull-right"><button type="submit" class="btn btn-primary" id="createform">Save</button> 
  <button type="submit" class="btn btn-primary" id="form_done">Done</button> 
  
</div></div>
 </div> 


</div></div></div>

	
  <!-- textfield modal start -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="textfield_modal">
		<div class="modal-dialog">
      <div class="modal-content">
		  
		  
		  <div class="modal-header">
			<button type="button" id="close_textfield_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="tf_header">Add Textfield</h3>
		</div>
		
		
		
		<div class="modal-body">
						
		
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_tf_field')?>" id='tf_form' method='POST'>
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio0" class="required" value="12" name="tf_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="9" name="tf_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="tf_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="tf_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="tf_col_width"/>
              Fourth        </label>
	</div> </div> 
	
							<div class='form-group'>
							<label class='control-label col-md-4' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='tf_label' id='tf_label' class='required' placeholder='required'/>
							</div>
						</div>
						 <div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Placeholder</label>
							<div class='col-md-8'>
				<input type='text' id='tf_placeholder' name='tf_placeholder' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='tf_helptext' name='tf_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='tf_required' name='tf_required'/>
							</div>
						</div> 
			<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
			</div>
		
				<div class='modal-footer'>
							<div class='col-md-8'>
								<input type='submit' id='tf_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
		
					</form>
				</div> <!-- end modal content -->
			</div>
				
				</div>
<!-- textfield modal end -->



<!-- number input field modal start -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="numberinput_modal">
		<div class="modal-dialog">
      <div class="modal-content">
		  
		  
		  <div class="modal-header">
			<button type="button" id="close_textfield_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="nip_header">Add NumberInput</h3>
		</div>
		
		
		
		<div class="modal-body">
						
		
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_numberinput')?>" id='nip_form' method='POST'>
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio0" class="required" value="12" name="nip_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="9" name="nip_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="nip_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="nip_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="nip_col_width"/>
              Fourth        </label>
	</div> </div> 
	
							<div class='form-group'>
							<label class='control-label col-md-4' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='nip_label' id='nip_label' class='required' placeholder='required'/>
							</div>
						</div>
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='nip_required' name='nip_required'/>
							</div>
						</div> 
			<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
			</div>
		
				<div class='modal-footer'>
							<div class='col-md-8'>
								<input type='submit' id='nip_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
		
					</form>
				</div> <!-- end modal content -->
			</div>
				
				</div>
<!-- number input field modal end -->

	<!-- checkbox modal start -->
<div class="modal fade" id="checkbox_modal">
	
		<div class="modal-dialog">
      <div class="modal-content">
	
		<div class="modal-header">
			<button type="button" id="close_checkbox_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="cbx_header">Add Checkboxes</h3>
		</div>
		
		<div class="modal-body">
		
					<form class='form-horizontal' accept-charset='UTF-8' action='<?php echo site_url('create_form/add_cbx_field')?>' id='cbx_form' method='POST'>
	
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="cbx_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="cbx_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="cbx_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="cbx_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="cbx_col_width"/>
              Fourth        </label>
	</div> </div>  
	
						<div class='form-group'>
							<label class='control-label col-md-4' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='cbx_label' id='cbx_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='cbx_helptext' name='cbx_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='cbx_required' name='cbx_required'/>
							</div>
						</div> 
			
			<div class='form-group'>
							<label class='col-md-4 control-label' for='inputName'>&emsp;&emsp;Enter option one by one</label>
							<div class='col-md-8'>
				<textarea name="cbx_options" class='required' id="cbx_options" rows='5'></textarea>
				</div></div>
			<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
			</div>
			<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-8'>
								<input type='submit' id='cbx_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
						
						
					</form>
				</div>
				
			</div>
				</div>
			</div>
	
<!-- end checkbox modal -->

<!-- start radio modal -->
<div class="modal fade" id="radio_modal">
	
	  <div class="modal-dialog">
        <div class="modal-content">
			
		<div class="modal-header">
			<button type="button" id="close_radio_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="rdo_header">Add Radio Buttons</h3>
		</div>
		
		<div class="modal-body">
		
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_rdo_field')?>" id='rdo_form' method='POST'>
	
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="rdo_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="rdo_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="rdo_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="rdo_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="rdo_col_width"/>
              Fourth        </label>
	</div> </div> 
	
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='rdo_label' id='rdo_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='rdo_helptext' name='rdo_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='rdo_required' name='rdo_required'/>
							</div>
						</div> 
			
			<div class='form-group'>
							<label class='col-md-4 control-label' for='inputName'>&emsp;&emsp;Enter option one by one</label>
							<div class='col-md-8'>
				<textarea name="rdo_options" class='required' id="rdo_options" rows='5'></textarea>
				</div></div>
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
</div>
<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-8'>
								<input type='submit' id='rdo_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
						</div>
						
						
						
					</form>
				</div>
			</div>
		</div>
		
	
<!-- end radio modal -->


<!-- textarea modal start -->
<div class="modal fade" id="textarea_modal">
	  <div class="modal-dialog">
        <div class="modal-content">
			
		<div class="modal-header">
			<button type="button" id="close_textarea_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="ta_header">Add Textarea</h3>
		</div>
		
		<div class="modal-body">
		
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_ta_field')?>" id='ta_form' method='POST'>
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="ta_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="ta_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="ta_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="ta_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="ta_col_width"/>
              Fourth        </label>
	</div> </div> 
	
			<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='ta_label' id='ta_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='ta_helptext' name='ta_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='ta_required' name='ta_required'/>
							</div>
						</div> 
						
						</div>
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-12'>
								<input type='submit' id='ta_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
						</form>
						</div>
		
				</div>
			</div>
		</div>
		
<!-- textarea modal end  -->

<!-- select list modal start -->
<div class="modal fade" id="select_modal">
	  <div class="modal-dialog">
        <div class="modal-content">
	
		<div class="modal-header">
			<button type="button" id="close_select_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="sl_header">Add Select List</h3>
		</div>
		<div class="modal-body">
			
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_sl_field')?>" id='sl_form' method='POST'>
	
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="sl_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="sl_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="sl_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="sl_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="sl_col_width"/>
              Fourth        </label>
	</div> </div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='sl_label' id='sl_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='sl_helptext' name='sl_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='sl_required' name='sl_required'/>
							</div>
						</div> 
			
			<div class='form-group'>
							<label class='col-md-4 control-label' for='inputName'>&emsp;&emsp;Enter option one by one</label>
							<div class='col-md-8'>
				<textarea name="sl_options" class='required' id="sl_options" rows='5'></textarea>
				</div></div>
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
</div>
<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-12'>
								<input type='submit' id='sl_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
						
						
					</form>
				</div>
	
			</div>
		</div>
		
	</div>
<!-- select list modal end -->
<!-- select list multiple modal start -->
<div class="modal fade" id="select_multiple_modal">
	  <div class="modal-dialog">
        <div class="modal-content">
			
		<div class="modal-header">
			<button type="button" id="close_select_multiple_modal" class="close" data-dismiss="modal">&times;</button>
			<h3>Add Select List</h3>
		</div>
		
		<div class="modal-body">
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_slm_field')?>" id='slm_form' method='POST'>
	
	<div class='form-group'>
		 <label class='col-md-4 control-label'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="slm_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="slm_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="slm_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="slm_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="slm_col_width"/>
              Fourth        </label>
	</div> </div> 
	
		
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='slm_label' id='slm_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='slm_helptext' name='slm_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='slm_required' name='slm_required'/>
							</div>
						</div> 
			
			<div class='form-group'>
							<label class='col-md-4 control-label' for='inputName'>&emsp;&emsp;Enter option one by one</label>
							<div class='col-md-8'>
				<textarea name="slm_options" class='required' id="slm_options" rows='5'></textarea>
				</div></div>
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
</div>
<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-8'>
								<input type='submit' id='slm_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
						
						
					</form>
				</div>
				
			</div>
		</div>
		
	</div>
<!-- select list modal end -->

<!-- date modal start -->
<div class="modal fade" id="date_modal">
	  <div class="modal-dialog">
        <div class="modal-content">
			
		<div class="modal-header">
			<button type="button" id="close_date_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="dt_header">Add Date</h3>
		</div>
		
		<div class="modal-body">
		
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_dt_field')?>" id='dt_form' method='POST'>
	<div class='form-group'>
		 <label class='col-md-4 control-label'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="dt_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="dt_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="dt_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="dt_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="dt_col_width"/>
              Fourth        </label>
	</div> </div> 
	
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='dt_label' id='dt_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='dt_helptext' name='dt_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='dt_required' name='dt_required'/>
							</div>
						</div> 
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
</div>
<div class="modal-footer">
				<div class='form-group'>
							<div class='col-md-12'>
								<input type='submit' id='dt_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
					</form>
					
				</div>
				
		
			</div>
		</div>
		
	</div>

<!-- date modal end -->

<!-- file upload modal start -->

<div class="modal fade" id="fileupload_modal">
	  <div class="modal-dialog">
        <div class="modal-content">
			
		<div class="modal-header">
			<button type="button" id="close_fileupload_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="fu_header">Add File Upload</h3>
		</div>
		<div class="modal-body">
			
					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_fu_field')?>" id='fu_form' method='POST'>
	<div class='form-group'>
		 <label class='col-md-4 control-label'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="fu_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="fu_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="fu_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="fu_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="fu_col_width"/>
              Fourth        </label>
	</div> </div> 
	
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputEmail'>Label</label>
							<div class='col-md-8'>
								<input type='text' name='fu_label' id='fu_label' class='required' placeholder='required'/>
							</div>
						</div>
						 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Help Text</label>
							<div class='col-md-8'>
				<input type='text' id='fu_helptext' name='fu_helptext' placeholder='optional'/>
							</div>
						</div> 
						<div class='form-group'>
							<label class='col-md-4 control-label' for='inputMessage'>Required Field</label>
							<div class='col-md-8'>
				<input type='checkbox' id='fu_required' name='fu_required'/>
							</div>
						</div> 
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
</div>
<div class="modal-footer">

				<div class='form-group'>
							<div class='col-md-12'>
								<input type='submit' id='fu_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
		
	</div>


<!-- file upload modal end -->


<!-- handsontable modal --->
<div class="modal fade" id="ht_modal">
		<div class="modal-dialog">
      <div class="modal-content col-md-12">

		  <div class="modal-header">
			<button type="button" id="close_ht_modal" class="close" data-dismiss="modal">&times;</button>
			<h3>Please make up your grid</h3>
		</div>

		<div class="modal-body">

					<form class='form-horizontal' accept-charset='UTF-8' action="<?php echo site_url('create_form/add_knockout_field')?>" id='ht_form' method='POST'>
	<div class='form-group'>
		 <label class='col-md-4 control-label'>
              Num Cols	      </label>
	<div class='col-md-8'>
		<label class='radio inline'>
              <select name="ht_num_cols" id="ht_num_cols" class="required">
				  <option value=''>Choose number of columns</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              <option value="4">Four</option>
              
              <option value="5">Five</option>
              <option value="6">Six</option>
              <option value="7">Seven</option>
              <option value="8">Eight</option>
              
              <option value="9">Nine</option>
              <option value="10">Ten</option>
              <option value="11">Eleven</option>
              <option value="12">Twelve</option>
              
              </select>
              
	</div> </div> 
	<div id="my_ht_options"></div>
				<div style="clear:both;"></div>
				</div>
				<div class="modal-footer">
<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
				<div class='form-group'>
							<div class='col-md-12'>
								<input type='submit' id='ht_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
					</form>
				</div>
					
	</div>
	</div>
		
	</div>
<!-- grid modal end -->

<!-- paragraph modal start -->
<div class="modal fade" id="paragraph_modal">
		<div class="modal-dialog">
      <div class="modal-content col-md-12">

<div class="modal-header">
			<button type="button" id="close_paragraph_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="pt_header">Add Paragraph Text</h3>
		</div>
		<div class="modal-body">

					<form class='form-horizontal' accept-charset='UTF-8' action='#' id='pt_form' method='POST'>
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio0" class="required" value="12" name="pt_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="9" name="pt_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="pt_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="pt_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="pt_col_width"/>
              Fourth        </label>
	</div> </div> 
	
		<div class='form-group'>
							<label class='control-label col-md-4' for='inputName'>Text</label>
							<div class='col-md-8'>

				<textarea name='p_text' class='required' id="p_text" cols='50' rows='15' placeholder='Enter your text here'></textarea>  

							</div>
						</div>
			</div>
			<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
			<div class='modal-footer'>
				<div class='form-group form-actions'>
							<div class='col-md-12'>
								<input type='submit' id='pt_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- paragraph modal end -->
<!-- image modal start -->
<div class="modal fade col-md-12" id="image_modal">
	<div class="modal-dialog">
      <div class="modal-content">

		<div class="modal-header">
			<button type="button" id="close_image_modal" class="close" data-dismiss="modal">&times;</button>
			<h3 id="im_header">Add Picture</h3>
		</div>
		<div class="modal-body">
			
					<form class='form-horizontal' accept-charset='UTF-8' action='#' id='im_form' method='POST'>
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="12" name="im_col_width"/>
              Full	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio1" class="required" value="8" name="im_col_width"/>
              75%	      </label>
              <label class='radio inline'>
              <input type="radio" id="radio2" class="required" value="6" name="im_col_width"/>
              Half         </label>
              <label class='radio inline'>
              <input type="radio" id="radio3" class="required" value="4" name="im_col_width"/>
              Third        </label>
              <label class='radio inline'>
            <input type="radio" id="radio4" class="required" value="3" name="im_col_width"/>
              Fourth        </label>
	</div> </div> 
	<div class='form-group'>
		 <label class='control-label col-md-4'>
              Width	      </label>
	<div class='col-md-8'>
            <label class='radio inline'>
              <input type="radio" class="required" checked value="img-rounded" name="im_style"/>
              Rounded	      </label>
              <label class='radio inline'>
              <input type="radio" class="required" value="img-circle" name="im_style"/>
              Circle	      </label>
              <label class='radio inline'>
              <input type="radio" class="required" value="img-thumbnail" name="im_style"/>
              Thumbnail         </label>
    </div> </div> 
		<div class='form-group'>
							<label class='control-label col-md-4' for='inputName'>Image path</label>
							<div class='col-md-8'>

				
			<input type='text' name='im_path' class='required' id='im_path' placeholder='http://'/>
				
							</div>
						</div>
			</div>
			<div class="modal-footer">
			<input type='hidden' name='form_name' value="<?php echo $my_form['form_name']?>"/>
				<div class='control-group form-actions'>
							<div class='col-md-12'>
								<input type='submit' id='im_sub_btn' name='submit' class='btn btn-primary' value='Add'/>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		










<!-- image modal end -->

<script type="text/javascript">

	$("#gd_num_cols").change(function () {
		$.ajax({
            url     : '<?php echo site_url('admin/populate_grid_box')?>/',
            type    : 'POST',
            dataType: 'html',
            data    : $('#gd_form').serialize(),
            success : function( data ) {
				$("#my_grid_options").html(data);
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
        return false;

});
$("#ht_num_cols").change(function () {
		$.ajax({
            url     : '<?php echo site_url('admin/populate_ht_box')?>/',
            type    : 'POST',
            dataType: 'html',
            data    : $('#ht_form').serialize(),
            success : function( data ) {
				$("#my_ht_options").html(data);
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
        return false;

});	

	$("#createform").click(function () {
		
		$.ajax({
            url     : '<?php echo site_url('admin/extract_form_data')?>/',
            type    : 'POST',
            dataType: 'html',
            timeout : 10000,
            data    : {'content' : $("#build").html(),'my_form_name':'<?php echo isset($my_form['form_name'])?$my_form['form_name']:''?>'},
            success : function( data ) {
				$("#build").html(data);
			window.location.assign("<?php echo site_url('create_form/edit_form/'.$my_form['form_name'])?>");
            },
beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center right");	
    $('#loading_div').html("<p>Auto-saving ...");
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         
            }
        }); 
        return false;

});


	$('#tf_form').validate({
		errorClass: 'customerr'
	});
	$('#cbx_form').validate({
		errorClass: 'customerr'
	});
	$('#rdo_form').validate({
		errorClass: 'customerr'
	});
	$('#ta_form').validate({
		errorClass: 'customerr'
	});
	$('#dt_form').validate({
		errorClass: 'customerr'
	});
	$('#tf_form').validate({
		errorClass: 'customerr'
	});
	$('#sl_form').validate({
		errorClass: 'customerr'
	});
	$('#slm_form').validate({
		errorClass: 'customerr'
	});
	$('#fu_form').validate({
		errorClass: 'customerr'
	});
	$('#ht_form').validate({
		errorClass: 'customerr'
	});
		$('#field_form2').validate({
		errorClass: 'customerr'
	});
	$('#tf_sub_btn').click ( function() {       
		    
        if($("#tf_form").valid()) {
  
		 $('#textfield_modal').modal('hide');	
				$('#tf_form').submit();
		}
        
    });		
	$('#cbx_sub_btn').click ( function() {       
	    if($("#cbx_form").valid()) {
			$('#checkbox_modal').modal('hide');	
			$("#cbx_form").submit();
         }
    });

		$('#rd_sub_btn').click ( function() {       
	    if($("#rdo_form").valid()) {
		$('#radio_modal').modal('hide');	
        }
      });

$('#nip_sub_btn').click ( function() {       
		     
        if($("#nip_form").valid()) {
  
		 $('#numberinput_modal').modal('hide');	
           
	}
    });


$('#ta_sub_btn').click ( function() {       
	   if($("#ta_form").valid()) {
		$('#textarea_modal').modal('hide');	
        $('#ta_form').submit();
		}
     
    });
$('#sl_sub_btn').click ( function() {       
		if($("#sl_form").valid()) {
		$('#select_modal').modal('hide');	
        $("#sl_form").submit();
		}
      
    });

$('#slm_sub_btn').click ( function() {       
	   if($("#slm_form").valid()) {
			$('#select_multiple_modal').modal('hide');	
			$('#slm_form').submit();
         }
      });

$('#dt_sub_btn').click ( function() {       
		  if($("#dt_form").valid()) {
				$('#date_modal').modal('hide');	
        $("#dt_form").submit();
			}
         });
$('#fu_sub_btn').click ( function() {       
		  if($("#fu_form").valid()) {
			$('#fileupload_modal').modal('hide');	
        $("#fu_form").submit();
         }
       });

$('#gd_sub_btn').click ( function() {       
	    if($("#gd_form").valid()) {
		$('#grid_modal').modal('hide');	
        $("#gd_form").submit();
        }
     });
$('#ht_sub_btn').click ( function() {       
	     if($("#ht_form").valid()) {
		$('#ht_modal').modal('hide');	
         $("#ht_form").submit();
        }
     });
$('#pt_sub_btn').click ( function() {       
	      if($("#pt_form").valid()) {
			$('#paragraph_modal').modal('hide');	
		 $("#pt_form").submit();
     }    
    });

$('#im_sub_btn').click ( function() {       
	    if($("#im_form").valid()) {
			$('#image_modal').modal('hide');	
		}  
     });

$('#rs_sub_btn').click ( function() {       
	      if($("#rs_form").valid()) {
				$('#rowspace_modal').modal('hide');	
         $.ajax({
            url     : '<?php echo site_url('create_form/add_columns')?>',
            type    : 'POST',
            dataType: 'html',
            data    : $('#rs_form').serialize(),
            success : function( data ) {
			$("#build").append(data);
				bootbox.alert("Added Row Space!");
	if(data=="")
window.location.assign("<?php echo site_url('admin/create_form')?>");
            },
            beforeSend: function() {
			$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
			$('#loading_div').show();
  },
  complete: function(){
	 $('#loading_div').css('background',"");	
    $('#loading_div').hide();
  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });    
	}
        return false;
    });

$('#add_line_break').click ( function() {       
$("#build").append("<div style='clear:both;'></div>");
$('#createform').trigger('click');
 bootbox.alert("Added Line Break!");
return false;
    });

$('.add_cols').click ( function() {       

if ($(this).attr('numcols')==2) { var cls='col-md-6'; var cnt=2;}
if ($(this).attr('numcols')==3) { var cls='col-md-4';var cnt=3;}
if ($(this).attr('numcols')==4) { var cls='col-md-3';var cnt=4;}

var fid = "<?php echo $my_form['form_name']?>";

$.ajax({
            url     : '<?php echo site_url('create_form/add_columns')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'frmid':fid,'class':cls,'numcols': cnt},
            success : function( data ) {
                          
$("#build").append(data);
$('#createform').trigger('click');
            },
            beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();
},
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();
  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });    
		return false;
    });
$(document).ready(function()
{

docReady();	
	
$("#form_done").click(function()
{
var dataString = "";

var dd = "<?php echo site_url('create_form/form_done/'.$my_form['form_name'])?>";
alert(dd);
$.ajax
({
type: "POST",
dataType: 'html',
url: "<?php echo site_url('create_form/form_done/'.$my_form['form_name'])?>/",
data    : {'content' : $("#build").html(),'my_form_name':'<?php echo $my_form['form_name']?>'},
cache: false,
success: function(html)
{
	window.location.assign('<?php echo site_url('admin/my_forms')?>');
},
beforeSend: function() {
	$('#loading_div').css('background',"transparent url('<?php echo base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  }
});

});

});
</script>
