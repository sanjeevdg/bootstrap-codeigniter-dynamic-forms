<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_dt_xhtml')) {

function make_dt_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm) {
		$outstr = "<div class='col-md-".$myw."  droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
   <a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	                     
   <a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>
              <input type='text' name='".$name."' id='".$name."' class='form-control date ".$required."'/>    
              <span class='help-block'>".$ht."</span>";
            // if ($myw==12) $outstr .= "</div>";
          $outstr .= "</div><script>
				$('#createform').trigger('click');
              $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=dt_col_width]').val(['".$myw."']);
				$(':input[name=dt_label]').val('".$label."');
				$(':input[name=dt_helptext]').val('".$ht."');
				$(':input[name=dt_required]').prop('checked',".$chk.");
				$('#dt_header').text('Edit Date field');
				$('#dt_sub_btn').val('Edit');
				$('#dt_form').attr('action','".site_url('create_form/edit_dt_field/'.$rs)."');
				$('#date_modal').modal('show');
		
	});
  $(function() {
    $( '#".$name."' ).datepicker({dateFormat:'yy-mm-dd'});
  });";
            $outstr .= "$('#remove_field_".$name."').click(function (e) {
				e.preventDefault();
bootbox.confirm('Are you sure?', function(result) {
if (result) {
	window.location.assign('".site_url('create_form/remove_field/'.$rs.'/'.$name.'/'.$fnm)."');
	}	else { bootbox.hideAll(); return false; }
});
});
	
  </script></div>";
  return $outstr;
	
}
// end function
}
