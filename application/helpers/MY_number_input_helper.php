<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_nip_xhtml')) {




function make_nip_xhtml($myw, $rs, $name, $label, $required, $chk, $fnm, $type) {
// $myw, $rs, $name, $label, $ht, $required, $chk, $fnm, $placeholder
	$outstr = "<div class='col-md-".$myw."  droppedField ui-draggable draggableField droppedField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
		         <div class='box-icon' style='float:right;'>
		         
<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
							<a id='remove_field_".$name."'>
							
							<img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
							
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>
						
  <div id='jqxwidget'>
        <div id='".$name."'></div>";
        
        
        // <span class='help-block'>".$ht."</span>
              
              
       $outstr .= "	<link rel='stylesheet' href='".base_url()."assets/css/jqx.base.css' type='text/css' />
       <script type='text/javascript' src='".base_url()."assets/js/jqxcore.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxnumberinput.js'></script>
    <script type='text/javascript' src='".base_url()."assets/js/jqxbuttons.js'></script> 
    
    
</div><script> 
	$('#createform').trigger('click');
	$(document).ready(function(){";
		
		$outstr .= "$(':input[name=".$name."]').attr('id','".$name."');
		    $('#".$name."').attr('type','text');
		    $('#".$name."').css('height','22px');
		    $('#".$name."').css('margin-top','10px');
  
		    $('#".$name."').addClass('".$required."');";
		    
		if ($type == 'percentage') {
			
$outstr .= "$('#".$name."').jqxNumberInput({ digits: 3, symbolPosition: 'right', symbol: '%', spinButtons: true  ,height:'35px'});";
		}
		else if ($type == 'currency') {
			$outstr .= "$('#".$name."').jqxNumberInput({ symbol: '$', spinButtons: true  ,height:'35px'});";
			
		}
		else {
			
			$outstr .= "$('#".$name."').jqxNumberInput({ spinButtons: true ,height:'35px'});";
		}
		
		
		
		$outstr .= "$('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				
				$(':input[name=nip_col_width]').val(['".$myw."']);
				$(':input[name=nip_label]').val('".$label."');
				$(':input[name=nip_required]').prop('checked',".$chk.");
				$('#nip_header').text('Edit Numberinput Field');
				$('#nip_sub_btn').val('Edit');
				$('#nip_form').attr('action','".site_url('create_form/edit_numberinput/'.$rs)."');
				$('#numberinput_modal').modal({show:true});
				
	});

	$('#remove_field_".$name."').click(function (e) {
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
// end function
}
