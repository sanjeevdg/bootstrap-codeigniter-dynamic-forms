<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_textfield_xhtml')) {

function make_textfield_xhtml($myw, $rs, $name, $label, $ht, $required, $chk, $fnm, $placeholder) {

	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:5px;padding-right:5px;padding-top:1px;padding-bottom:1px;'>
		         <div class='box-icon' style='float:right;'>
		         
<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
							<a id='remove_field_".$name."'>
							
							<img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>

              <input type='text' name='".$name."' id='".$name."' class=form-control '".$required."' placeholder='".$placeholder."'>    

              <span class='help-block'>".$ht."</span>";
       $outstr .= "<script> 
       $('#createform').trigger('click');
	$(document).ready(function(){
		
		
		$(document).on('click', '#edit_field_".$name."', function(e){ 
   e.preventDefault();
				$(':input[name=tf_placeholder]').val('".$placeholder."');
				$(':input[name=tf_col_width]').val(['".$myw."']);
				$(':input[name=tf_label]').val('".$label."');
				$(':input[name=tf_helptext]').val('".$ht."');
				$(':input[name=tf_required]').prop('checked',".$chk.");
				$('#tf_header').text('Edit Textfield');
				$('#tf_sub_btn').val('Edit');
				$('#tf_form').attr('action','".site_url('create_form/edit_tf_field/'.$rs)."');
				$('#textfield_modal').modal({show:true});
});
		
	$(document).on('click', '#remove_field_".$name."', function(e){ 
			e.preventDefault();
bootbox.confirm('Are you sure?', function(result) {

if (result) {
	window.location.assign('".site_url('create_form/remove_field/'.$rs.'/'.$name.'/'.$fnm)."');
		}	
	else { bootbox.hideAll(); return false; }
});

});
	
	
});	
  </script></div></div>";                
  
  
  
  
  
  return $outstr;
  
  
}
//, zIndex:1001
// end function
}
