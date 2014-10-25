<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_checkbox_xhtml_horizontal')) {
function make_checkbox_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options) {

	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:3px;margin-right:3px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	              
							<a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>";
                           
              
		foreach (explode("<br>",$cbx_options) as $kk => $vv){
			if($vv!='') {
		      $outstr .= "<label class='checkbox-inline'><input type='checkbox' name='".$name."[]' value='".$vv."' class='".$required."'/>";    
              $outstr .= $vv."</label>";
		  }
		
			//$cbx_options .= $vv.'\n';
		
	}	
              
    // }
    //$('textarea[id=cbx_options]').html('".$cbx_options."');
    $outstr .= "<p class='help-block'>".$ht."</p>";
    $outstr .= "<script> 
    $('#createform').trigger('click');
    $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=cbx_col_width]').val(['".$myw."']);
				$(':input[name=cbx_label]').val('".$label."');
				$(':input[name=cbx_helptext]').val('".$ht."');
				$('textarea[id=cbx_options]').html('".$cbx_options."');
				$(':input[name=cbx_required]').prop('checked',".$chk.");
				$('#cbx_header').text('Edit Checkbox');
				$('#cbx_sub_btn').val('Edit');
				$('#cbx_form').attr('action','".site_url('create_form/edit_cbx_field/'.$rs)."');
				$('#checkbox_modal').modal('show');
		
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
	
  </script></div></div>";         
    
    return $outstr;
}
// end function
}


if ( ! function_exists('make_checkbox_xhtml_vertical')) {
function make_checkbox_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options) {

	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField' id='".$rs."' style='margin-left:3px;margin-right:3px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	              
							<a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>";
                           
              
		foreach (explode("<br>",$cbx_options) as $kk => $vv){
			if($vv!='') {
		      $outstr .= "<div class='checkbox'><label class='uniform'><input type='checkbox' name='".$name."[]' value='".$vv."' class='".$required."'/>";    
              $outstr .= $vv."</label></div>";
		  }
		
			//$cbx_options .= $vv.'\n';
		
	}	
              
    // }
    //$('textarea[id=cbx_options]').html('".$cbx_options."');
    $outstr .= "<span class='help-block'>".$ht."</span>";
    $outstr .= "<script> 
    $('#createform').trigger('click');
    $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=cbx_col_width]').val(['".$myw."']);
				$(':input[name=cbx_label]').val('".$label."');
				$(':input[name=cbx_helptext]').val('".$ht."');
				$('textarea[id=cbx_options]').html('".$cbx_options."');
				$(':input[name=cbx_required]').prop('checked',".$chk.");
				$('#cbx_header').text('Edit Checkbox');
				$('#cbx_sub_btn').val('Edit');
				$('#cbx_form').attr('action','".site_url('create_form/edit_cbx_field_vert/'.$rs)."');
				$('#checkbox_modal').modal('show');
		
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
	
	
  </script></div></div>";         
    
    return $outstr;
}
// end function
}


