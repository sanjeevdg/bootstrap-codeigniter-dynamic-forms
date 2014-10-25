<script>
/* Make the control draggable */
  ///////////////////////////////////////////////////////////////start
  //,		connectToSortable: ".droppedFields"
  //stack: "div", 
	
   function makeDraggable() {
    $(".columnField").draggable({ 
		helper:"clone",
		connectToSortable: "#build",
		snap: true, 
		stack:"div",
		cursor: "move", 
		cancel: null,
		opacity: 0.7,
		});
	$(".selectorField").draggable({ 
		connectToSortable: ".column",
		snap: true, 
		cancel: null,
		stack:"div",
		opacity: 0.7,
		 stop: function( event, ui ) { $(this).css('z-index',9999);alert('changed'+$(this).attr('id'));}
		});	
		//helper: "clone",		cursor: "move", 
	$(".selectorField").draggable({ 
		helper:"clone",
		connectToSortable: ".column",
		snap: true, 
		cursor: "move", 
		stack:".component",
		cancel: null,
		opacity: 0.7,
		});	
  }
  
  
   $(document).ready(function() {
	   
	   
    console.log("document ready");
    $('#build').removeAttr('style');
    makeDraggable();
    
 		//.component
 		//hoverDroppable
 		// activeDroppable
 		//.component
 		//mponent
 		$(".component").droppable({
        activeClass: "activeDroppable",
        hoverClass: "hoverDroppable",
        accept: ":not(.ui-sortable-helper)",
	    
        drop: function( event, ui ) {
		alert('x');
	}
	});
//:not(.ui-sortable-helper):not(.ui-sortable-helper)
    $(".column").droppable({
		greedy: true,
        activeClass: "activeDroppable",
        hoverClass: "hoverDroppable",
        accept: ".component",
        tolerance: "fit",

	    
        drop: function( event, ui ) {
			
		         
			var draggable = ui.draggable;
			var dd = $(this).attr('id');
			$('#'+dd).css('height','100%');
					
			if (!draggable.attr('id')) {
	
	if (draggable.attr('tartype')=='checkbox') { 		
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_cbx_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
    //            $('#build').removeClass(); 
      //          $('#build').style();
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
	    
        }
	
	else if  (draggable.attr('tartype')=='textbox') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_tf_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#build').removeClass().addClass('container'); 
                alert('my div id is '+did);
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	else if  (draggable.attr('tartype')=='radio') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_rdo_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	else if  (draggable.attr('tartype')=='select') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_sl_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	else if  (draggable.attr('tartype')=='select-multiple') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_slm_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	else if  (draggable.attr('tartype')=='addcolumns') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_my_columns')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#build').removeClass().addClass('container'); 
               // $('#build').removeClass('ui-droppable'); 'droppedFields'
              //  $('#build').removeClass('ui-sortable'); 
                
                $('#build').append(data);
                
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	
	else if  (draggable.attr('tartype')=='date') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_dt_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
else if  (draggable.attr('tartype')=='mimage') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_mimage')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	else if  (draggable.attr('tartype')=='checkbox_vertical') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_cbx_field_new_vertical')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
else if  (draggable.attr('tartype')=='radio_vertical') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_rdo_field_new_vertical')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	      		
else if  (draggable.attr('tartype')=='numberinput') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_numberinput/regular')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}

else if  (draggable.attr('tartype')=='numberinput_percentage') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_numberinput/percentage')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}

else if  (draggable.attr('tartype')=='numberinput_currency') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_numberinput/currency')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}


          		else if  (draggable.attr('tartype')=='textarea') {
		var did = $(this).attr('id');
alert(did);		
        $.ajax({
            url     : '<?=site_url('create_form/add_ta_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	else if  (draggable.attr('tartype')=='paragraph') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_pt_field')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	else if  (draggable.attr('tartype')=='fileupload') {
		var did = $(this).attr('id');
		
        $.ajax({
            url     : '<?=site_url('create_form/add_fu_field_new')?>',
            type    : 'POST',
            dataType: 'html',
            data    : {'form_name':"<?=$my_form->form_name?>"},
            success : function( data ) {
                
                
                $('#'+did).append(data);
                
    
if(data=="")
window.location.assign("<?=site_url('admin/create_form')?>");
                         
            },
            beforeSend: function() {
			//	clearInterval(autoSave);
	$('#loading_div').css('background',"transparent url('<?=base_url()?>assets/img/ajax-loaders/loader.gif') no-repeat center center");	
    $('#loading_div').show();

  },
  complete: function(){
	//  autoSave = setInterval(callFunc, 10000);
	$('#loading_div').css('background',"");	
    $('#loading_div').hide();

  },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });  
	    makeDraggable();
		
		
	}
	
	
      } 
      $('#'+did).css("height", "100%");
      }
  
    });		
    /* Make the droppedFields sortable and connected with other droppedFields containers*/
    $( "#build .column" ).sortable({
                    cancel: null, // Cancel the default events on the controls
                    connectWith: ".column",
                    opacity : 0.35,
                    zIndex:2222,
                    revert:true
    }).disableSelection();
    
    
   

    
    
 });
</script>
