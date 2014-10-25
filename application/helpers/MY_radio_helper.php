<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('make_radio_xhtml_horizontal')) {

function make_radio_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options) {
	
	$outstr = "<div class='col-md-".$myw."  droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
                       <div class='box-icon' style='float:right;'>
	<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	
	<a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>";
						//span12 
					foreach (explode('<br>',trim($rdo_options)) as $kk => $vv){
						if ($vv!='') {
            $outstr .= "<label class='radio-inline'><input type='radio' name='".$name."' value='".$vv."' id='".$name."' class='".$required."'/>";
            $outstr .= $vv."</label>";
			}
            // $rdo_options .= $vv.'\n';
			} 
            $outstr .= "<span class='help-block'>".$ht."</span></div>";
      $outstr .= "<script> 
				$('#createform').trigger('click');
              $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=rdo_col_width]').val(['".$myw."']);
				$(':input[name=rdo_label]').val('".$label."');
				$(':input[name=rdo_helptext]').val('".$ht."');
				$('textarea[id=rdo_options]').html('".$rdo_options."');
				$(':input[name=rdo_required]').prop('checked',".$chk.");
				$('#rdo_header').text('Edit Radiogroup');
				$('#rdo_sub_btn').val('Edit');
				$('#rdo_form').attr('action','".site_url('create_form/edit_rdo_field/'.$rs)."');
				$('#radio_modal').modal('show');
		
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

if ( ! function_exists('make_radio_xhtml_vertical')) {

function make_radio_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options) {
	
	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
                       <div class='box-icon' style='float:right;'>
	<a id='edit_field_".$name."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>	
	<a id='remove_field_".$name."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><label class='control-label col-md-4'>".$label."</label><div class='col-md-8'>";
						//span12 
					foreach (explode('<br>',trim($rdo_options)) as $kk => $vv){
									if ($vv!='') {
            $outstr .= "<div class='checkbox'><label class='uniform'><input type='radio' name='".$name."' value='".$vv."' id='".$name."' class='".$required."'/>";
            $outstr .= $vv."</label></div>";
		}
            // $rdo_options .= $vv.'\n';
			} 
            $outstr .= "<span class='help-block'>".$ht."</span>";
      $outstr .= "<script> 
				$('#createform').trigger('click');
              $('#edit_field_".$name."').click(function(e){
				e.preventDefault();
				$(':input[name=rdo_col_width]').val(['".$myw."']);
				$(':input[name=rdo_label]').val('".$label."');
				$(':input[name=rdo_helptext]').val('".$ht."');
				$('textarea[id=rdo_options]').html('".$rdo_options."');
				$(':input[name=rdo_required]').prop('checked','".$chk."');
				$('#rdo_header').text('Edit Radiogroup');
				$('#rdo_sub_btn').val('Edit');
				$('#rdo_form').attr('action','".site_url('create_form/edit_rdo_field_vert/'.$rs)."');
				$('#radio_modal').modal('show');
		
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
