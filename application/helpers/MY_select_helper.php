<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_select_xhtml')) {

function make_select_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm,$sl_options) {
	
	// $sl_options2='';
	$outstr = "<div class='col-md-".$myw."  droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	                     
              
							<a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>
              <select name='".$name."' id='".$name."' class='form-control ".$required."'> ";
              foreach (explode('<br>',trim($sl_options)) as $kk => $vv){
				  			if ($vv!='') {
				$outstr .= "  <option value='".$vv."'>".$vv."</option>";
			}
				// $sl_options2 .= $vv.'\n';
              }
              $outstr .= "</select>   
              <span class='help-block'>".$ht."</span>";
       $outstr .= "</div><script> 
				$('#createform').trigger('click');
              $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=sl_col_width]').val(['".$myw."']);
				$(':input[name=sl_label]').val('".$label."');
				$(':input[name=sl_helptext]').val('".$ht."');
				$(':input[name=sl_required]').prop('checked',".$chk.");
				$('textarea[id=sl_options]').html('".$sl_options."');
				$('#sl_header').text('Edit Select List');
				$('#sl_sub_btn').val('Edit');
				$('#sl_form').attr('action','".site_url('create_form/edit_sl_field/'.$rs)."');
				$('#select_modal').modal('show');
		
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
	
  </script></div>";                
  return $outstr;
}
// end function
}
