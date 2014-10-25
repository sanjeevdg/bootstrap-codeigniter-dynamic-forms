<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_form extends CI_Controller {

function __construct() {
	parent::__construct();
//if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
	//	redirect(site_url('auth/login'),'refresh');	
}

function add_my_columns() {
	$rsa = random_string('alnum',8);
	$rsb = random_string('alnum',8);
	$rsc = random_string('alnum',8);
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf->form_text);
	
	//style='height: auto !important;height: 100%; min-height:100px;'
	//
	$outstr = "<div class='row'>
	<div id='".$rsa."'  class='col-md-4 well droppedFields'></div>
	<div id='".$rsb."'  class='col-md-4 well droppedFields'></div>
	<div id='".$rsc."'  class='col-md-4 well droppedFields'></div>
	</div>";
	///<script>$(document).ready(function() { $('.column').droppable(); });</script>
       // if ($myw==12) $outstr .= "</div>";
        
        $newftxt = $oldftxt."".$outstr;
        
        $dtu = array (
			'form_text' => $newftxt
					);
		$this->db->where('id',$mf->id);			
		$this->db->update('my_forms',$dtu);			

			echo $outstr;
	
	
}

function throw_field_exists_error() {
	$this->session->set_flashdata('message', "<div class='alert alert-error'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Oh snap!</strong> A field of the same name already exists.
						</div>");
	redirect(site_url('create_form/edit_form/'.$mf->id));
						
	}
	
function add_tf_field_new() {
	
	//$this->load->helper('textfield_helper');
	$rs = random_string('alnum',8);
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf['form_text']);
	
	$name = 'txt_'.$rs;
	// if (!$this->db->field_exists($name, 'dtbl_'.$fnm)) {
		// db
		//	$this->forms_model->add_varchar_field("",$name,$fnm);
		// file
				
			
	
	$outstr = make_textfield_xhtml(12,$rs,$name,'default_label','','','false',$fnm,'default placeholder');	
	
       // if ($myw==12) $outstr .= "</div>";
        
        $newftxt = $oldftxt."".$outstr;
        
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		
		//print_r($dtu);
			$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr; 
	
}
function add_myform_to_flint($fnm,$dtu) {

		try {

			$options = array('dir' => $this->config->item('datadir'));
			$myforms = Flintstone::load('myforms', $options);
			$myforms->set($fnm,$dtu);
		}
		catch(FlintstoneException $e){
			echo "error - ".$e->getMessage(); 
		}
				
	
}


function remove_field() {

	$dvid = $this->uri->segment(3);
	$flnm = $this->uri->segment(4);
	$fnm = $this->uri->segment(5);
	$mf = $this->forms_model->get_form_by_name($fnm);
		
		$this->load->helper('dom');
		
		$ftxt = str_get_html($mf['form_text']);
			
	
	if ($flnm !='') {
		
		/*
		$posh = strpos($flnm,"jq_gd_");
	if ($posh !== false) {
		
		$this->db->where('colid',$flnm);
		$this->db->delete('jqxgrid_definitions');
		
	}	
	*/
		// if ($this->db->field_exists($flnm,"dtbl_".$fnm)) {
	
		// $sql = "alter table dtbl_".$fnm." drop column ".$flnm;
		//	$this->db->query($sql);
			$ftxt_snip = $ftxt->find('div[id='.$dvid.']',0);
		
			$ftxt_snip->outertext = "";
			$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
	
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Element </strong> removed.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));

	}	
}

function edit_tf_field() {
	
	$fnm = $this->input->post('form_name');
	
	$rs = $this->uri->segment(3);
	$myw = intval($this->input->post('tf_col_width'));
	$name = 'txt_'.$rs;
	$label = $this->input->post('tf_label');
	$placeholder = $this->input->post('tf_placeholder');
	$ht = $this->input->post('tf_helptext');
	$required = $this->input->post('tf_required');
	$mf = $this->forms_model->get_form_by_name($fnm);
	
if (!($myw && $label)) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));				
        
	}

		if ($required) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";
		
		
		
		$this->load->helper('dom');
		
		$ftxt = str_get_html($mf['form_text']);
		$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
		// myw rs name label ht required chk fnm _options placeholder 
		$outstr = make_textfield_xhtml($myw, $rs, $name, $label, $ht, $required, $chk, $fnm, $placeholder);
		
		
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);		
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Element </strong> edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));

}

function add_cbx_field_new_vertical() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf['form_text']);
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'cbx_'.$rs;
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		$cbx_options = "Option1<br>Option2<br>Option3";
		

			// myw rs name label ht required chk fnm _options placeholder 
			
	$outstr = make_checkbox_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options);
	
	          if ($myw==12) $outstr .= "</div>";
	    
	    $newftxt = $oldftxt."".$outstr;
        
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
	
}

function add_numberinput() {
	
	$type = $this->uri->segment(3);
	
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf->form_text);
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'nip_'.$rs;
	$label = 'default label';
	
	
	$required = '';
		if ($required) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		// $cbx_options = 'Option1'.'\n'.'Option2'.'\n'.'Option3';
		

		if (!$this->db->field_exists($name, 'dtbl_'.$fnm)) {
	$this->forms_model->add_decimal_field($required,$name,$fnm);
			// myw rs name label ht required chk fnm _options placeholder 
			//, $cbx_options
	$outstr = make_nip_xhtml($myw,$rs, $name, $label, $required, $chk, $fnm,$type);
	
	          if ($myw==12) $outstr .= "</div>";
	    
	    $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_text' => $newftxt
					);
		$this->db->where('id',$mf->id);			
		$this->db->update('my_forms',$dtu);			
		echo $outstr;
}
else {
	echo "field exists error"; //$this->throw_field_exists_error();
	}
	
	
	
}
function edit_numberinput() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf->form_text);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
		
		$ftxt = str_get_html($mf->form_text);
		$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
		
	$myw = intval($this->input->post('nip_col_width'));
	$name = 'nip_'.$rs;
	$label = $this->input->post('nip_label');
	$required = $this->input->post('nip_required');
		if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	

		$outstr = make_nip_xhtml($myw,$rs, $name, $label, $required, $chk, $fnm);
		
	
		// change width or span class 
		// change label
		// change placeholder
		// change helptext
		// chpange required 
		// update 
		
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dta = array(
				'form_text' => $ftxt	
					);
		$this->db->where('id',$mf->id);
		$this->db->update('my_forms',$dta);			
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Numberinput </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf->id));
	
	
}


function add_cbx_field_new() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf['form_text']);
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'cbx_'.$rs;
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		$cbx_options = "Option1 <br> Option2 <br> Option3";
		

			// myw rs name label ht required chk fnm _options placeholder 
			
	$outstr = make_checkbox_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options);
	
	          if ($myw==12) $outstr .= "</div>";
	    
	    $newftxt = $oldftxt."".$outstr;
   $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
			echo $outstr;
}
function edit_cbx_field_vert() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf['form_text']);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
		
		$ftxt = str_get_html($mf['form_text']);
		$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
		
	$myw = intval($this->input->post('cbx_col_width'));
	$name = 'cbx_'.$rs;
	$label = $this->input->post('cbx_label');
	$ht = $this->input->post('cbx_helptext');
	$required = $this->input->post('cbx_required');
		if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	


if (!($myw && $label && $this->input->post('cbx_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));				
        
	}
	$cbx_options = '';
		foreach (explode("\n",trim($this->input->post('cbx_options'))) as $kk => $vv){
			$cbx_options .= $vv.'<br>';
		
	}	
		$outstr = make_checkbox_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options);
		
	
		// change width or span class 
		// change label
		// change placeholder
		// change helptext
		// change required 
		// update 
		
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Checkbox </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
	
}
function edit_cbx_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = trim($mf['form_text']);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
		
		$ftxt = str_get_html($mf['form_text']);
		$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
		
	$myw = intval($this->input->post('cbx_col_width'));
	$name = 'cbx_'.$rs;
	$label = $this->input->post('cbx_label');
	$ht = $this->input->post('cbx_helptext');
	$required = $this->input->post('cbx_required');
		if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	


if (!($myw && $label && $this->input->post('cbx_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}
	$cbx_options = '';
		foreach (explode("<br>",trim($this->input->post('cbx_options'))) as $kk => $vv){
			$cbx_options .= $vv.'<br>';
		
	}	
		$outstr = make_checkbox_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $cbx_options);
		
	
		// change width or span class 
		// change label
		// change placeholder
		// change helptext
		// change required 
		// update 
		
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
				$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Checkbox </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
	
}


function add_rdo_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
        
		$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'rdo_'.$rs;
	// $this->input->post('rdo_name');
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
			
			$rdo_options = "Option1<br>Option2<br>Option3";
	$outstr = make_radio_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options);
			
		              
	
        $newftxt = $oldftxt."".$outstr;
  $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
		
}

function add_rdo_field_new_vertical() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
        
		$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'rdo_'.$rs;
	// $this->input->post('rdo_name');
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		

			
			$rdo_options = 'Option1<br>Option2<br>Option3';
	$outstr = make_radio_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options);
			
			
                      
	
        $newftxt = $oldftxt."".$outstr;
   $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
				echo $outstr;
		
}

function edit_rdo_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
    
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('rdo_col_width'));
	$name = 'rdo_'.$rs;
	$label = $this->input->post('rdo_label');
	$ht = $this->input->post('rdo_helptext');
	$required = $this->input->post('rdo_required');
	if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	if (!($myw && $label && $this->input->post('rdo_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}

	$rdo_options = '';
		foreach (explode("<br>",trim($this->input->post('rdo_options'))) as $kk => $vv){
			$rdo_options .= $vv.'<br>';
		
	}	
	$outstr = make_radio_xhtml_horizontal($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options);
    
    	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
			$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Radio </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
}

function edit_rdo_field_vert() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
    
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('rdo_col_width'));
	$name = 'rdo_'.$rs;
	$label = $this->input->post('rdo_label');
	$ht = $this->input->post('rdo_helptext');
	$required = $this->input->post('rdo_required');
	if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	if (!($myw && $label && $this->input->post('rdo_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}

	$rdo_options = '';
		foreach (explode("<br>",trim($this->input->post('rdo_options'))) as $kk => $vv){
			$rdo_options .= $vv.'<br>';
		
	}	
	$outstr = make_radio_xhtml_vertical($myw,$rs, $name, $label, $ht, $required, $chk, $fnm, $rdo_options);
    
    	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Radio </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
}

function add_ta_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'txa_'.$rs;
	// $this->input->post('ta_name');
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		

	
	$outstr = make_textarea_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);
			
			
  
              
              
        $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
		
}

function edit_ta_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('ta_col_width'));
	$name = 'txa_'.$rs;
	$label = $this->input->post('ta_label');
	$ht = $this->input->post('ta_helptext');
	$required = $this->input->post('ta_required');
		if ($required) $required ="required" ; else $required ="";
		if (strlen($required)>1) $chk = "true"; else $chk="false";	
		
		if (!($myw && $label)) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}


	$outstr = make_textarea_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);
	
		
	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
			$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Textarea </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
	
}

function add_sl_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'sel_'.$rs;
	//$this->input->post('sl_name');
	$label = 'default label';
	$ht = '';
	$required = '';
		if (strlen($required)>1) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	


	$sl_options = "Option1<br>Option2<br>Option3";
	$outstr = make_select_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm,$sl_options);
			
	
        $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
}


function edit_sl_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
		
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('sl_col_width'));
	$name = 'sel_'.$rs;
	$label = $this->input->post('sl_label');
	$ht = $this->input->post('sl_helptext');
	$required = $this->input->post('sl_required');
		if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	if (!($myw && $label && $this->input->post('sl_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}
	$sl_options = '';
		foreach (explode("<br>",trim($this->input->post('sl_options'))) as $kk => $vv){
			$sl_options .= $vv.'<br>';
		
	}	

		$outstr = make_select_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm,$sl_options);
		
	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Select </strong>element added.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
}
function add_slm_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'slm_'.$rs;
	//$this->input->post('slm_name');
	$label = 'default label';
	$ht = '';
	$required = '';
	if (strlen($required)>1) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	$slm_options = "Option1<br>Option2<br>Option3";
	
	
	$outstr = make_select_multiple_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm,$slm_options);
		
		
            
        $newftxt = $oldftxt."".$outstr;
       $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
}

function edit_slm_field() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('slm_col_width'));
	$name = 'slm_'.$rs;
	$label = $this->input->post('slm_label');
	$ht = $this->input->post('slm_helptext');
	$required = $this->input->post('slm_required');
	if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	
	if (!($myw && $label && $this->input->post('slm_options'))) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}
	$slm_options = '';
		foreach (explode("<br>",trim($this->input->post('slm_options'))) as $kk => $vv){
			$slm_options .= $vv.'<br>';
		
	}	
	$outstr = make_select_multiple_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm,$slm_options);
	
	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
			$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Select multiple </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));
		
	  }
	  

function add_dt_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$rs = random_string('alnum', 8);
	$myw = 12;
	$name = 'dte_'.$rs;
	//$this->input->post('dt_name');
	$label = 'default label';
	$ht = '';
	$required = '';
	if (strlen($required)>1) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	
		$outstr = make_dt_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);
		
        $newftxt = $oldftxt."".$outstr;
        
       $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
	
}


function edit_dt_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	$myw = intval($this->input->post('dt_col_width'));
	$name = 'dte_'.$rs;
	//$this->input->post('dt_name');
	$label = $this->input->post('dt_label');
	$ht = $this->input->post('dt_helptext');
	$required = $this->input->post('dt_required');
	if ($required) $required = "required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	

if (!($myw && $label)) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}
	
	$outstr = make_dt_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);	
		
	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Date </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
	
	
}

function add_fu_field_new() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$rs = random_string('alnum',8);
	$myw = 12;
	$name = 'fup_'.$rs;
	//$this->input->post('fu_name');
	$label = 'default label';
	$ht = '';
	$required = '';
	if (strlen($required)>1) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	
	$outstr = make_fu_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);
            
            
        $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		echo $outstr;
		
}


function edit_fu_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
		
	$myw = intval($this->input->post('fu_col_width'));
	$name = 'fup_'.$rs;
	//$this->input->post('fu_name');
	$label = $this->input->post('fu_label');
	$ht = $this->input->post('fu_helptext');
	$required = $this->input->post('fu_required');
	if ($required) $required ="required" ; else $required ="";
	if (strlen($required)>1) $chk = "true"; else $chk="false";	
	
	if (!($myw && $label)) {
	
	$str = "<div class='alert alert-info' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Request lost.</strong> Please try again.
						</div><script> $('#my_alert_div').fadeOut(6000); </script>";
		
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));				
        
	}
	
	$outstr = make_fu_xhtml($myw,$rs, $name, $label, $ht, $required, $chk, $fnm);
	
	
	$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Fileupload </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
}

function add_pt_field() {
	
	$rs = random_string('alnum', 8);
	$myw = 6;
	//intval($this->input->post('pt_col_width'));
	// $ptext = $this->input->post('p_text');
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	
	$mkup = "<p class=lead>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>.<p> \
	Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, \
	sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. \
	<em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, \
	id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam \
	mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu. </small>";
	
	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField  bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$rs."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
              
							<a id='remove_element_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div>".$mkup;
	$outstr .= "<script>	$(document).ready(function(){
		
				$('#edit_field_".$rs."').click(function(e){
				e.preventDefault();
				
				$(':input[name=pt_col_width]').val(['".$myw."']);
				$('#p_text').val('".$mkup."');
				
				$('#pt_header').text('Edit Paragraph');
				$('#pt_sub_btn').val('Edit');
				$('#pt_form').attr('action','".site_url('create_form/edit_pt_field/'.$rs)."');
				$('#paragraph_modal').modal({show:true});
				
	}); $('#remove_element_".$rs."').click(function () {
	
bootbox.confirm('Are you sure?', function(result) {

if (result) {
	window.location.assign('".site_url('create_form/remove_field/'.$rs.'/'.$rs.'/'.$fnm)."');
		}	
	else { bootbox.hideAll(); return false; }
});
	
	});
	
	
	});	</script></div>";			
	    $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
		
		$this->add_myform_to_flint($fnm,$dtu);		
		echo $outstr;
}

function edit_pt_field() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	
	$myw = intval($this->input->post('pt_col_width'));
	$name = $rs;
	
	$ptext = $this->input->post('p_text');
	
	
	
	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$rs."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
              
							<a id='remove_element_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div>".$ptext;
	$outstr .= "<script> $('#edit_field_".$rs."').click(function(e){
				e.preventDefault();
				
				$(':input[name=pt_col_width]').val(['".$myw."']);
				$(':input[name=p_text]').val('".$ptext."');
				
				$('#pt_header').text('Edit Paragraph');
				$('#pt_sub_btn').val('Edit');
				$('#pt_form').attr('action','".site_url('create_form/edit_pt_field/'.$rs)."');
				$('#paragraph_modal').modal({show:true});
				
	}); $('#remove_element_".$rs."').click(function () {
		$('#".$rs."').remove();
		return false;
	});
		
		</script></div>";			
	
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Paragraph </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
}



function add_mimage() {
	$rs = random_string('alnum', 8);
	$myw = 4;
	//intval($this->input->post('pt_col_width'));
	// $ptext = $this->input->post('p_text');
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
	$impath = base_url()."assets/img/mimage.jpg";
	
	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$rs."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
              
							<a id='remove_element_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><img src='".$impath."' class='img-responsive img-rounded'>";
	$outstr .= "<script>	$(document).ready(function(){
		
				$('#edit_field_".$rs."').click(function(e){
				e.preventDefault();
				
				$(':input[name=im_col_width]').val(['".$myw."']);
				$('#im_path').val('".$impath."');
				
				$('#im_header').text('Edit Image');
				$('#im_sub_btn').val('Edit');
				$('#im_form').attr('action','".site_url('create_form/edit_mimage/'.$rs)."');
				$('#image_modal').modal({show:true});
				
	}); $('#remove_element_".$rs."').click(function () {
		
bootbox.confirm('Are you sure?', function(result) {

if (result) {
	window.location.assign('".site_url('create_form/remove_field/'.$rs.'/'.$rs.'/'.$fnm)."');
		}	
	else { bootbox.hideAll(); return false; }
});
	
	});
	
	});	</script></div>";			
	    $newftxt = $oldftxt."".$outstr;
        $dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $newftxt
					);
			$this->add_myform_to_flint($fnm,$dtu);
			echo $outstr;
}
function edit_mimage() {
	
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$rs = $this->uri->segment(3);
	
	$this->load->helper('dom');
	$ftxt = str_get_html($mf['form_text']);
	$ftxt_snip = $ftxt->find('div[id='.$rs.']',0);
	
	
	$myw = intval($this->input->post('im_col_width'));
	$name = $rs;
	
	$imstyle = $this->input->post('im_style');
	$impath = $this->input->post('im_path');
	
	
	$outstr = "<div class='col-md-".$myw." droppedField ui-draggable draggableField bgcolor' id='".$rs."' style='margin-left:0px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
<a id='edit_field_".$rs."'><img src='".base_url()."assets/img/sites-pencil-icon-small.gif' width='10px' height='10px'/></a>		
              
							<a id='remove_element_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><img src='".$impath."' class='img-responsive ".$imstyle."'>";
	$outstr .= "<script> $(document).ready(function(){ 
		$('#edit_field_".$rs."').click(function(e){
				e.preventDefault();
				
				$(':input[name=im_col_width]').val(['".$myw."']);
				$(':input[name=im_style]').val(['".$imstyle."']);
				$(':input[name=im_path]').val('".$impath."');
				
				$('#im_header').text('Edit Image');
				$('#im_sub_btn').val('Edit');
				$('#im_form').attr('action','".site_url('create_form/edit_mimage/'.$rs)."');
				$('#image_modal').modal({show:true});
				
	}); $('#remove_element_".$rs."').click(function () {
		
bootbox.confirm('Are you sure?', function(result) {

if (result) {
	window.location.assign('".site_url('create_form/remove_field/'.$rs.'/'.$rs.'/'.$fnm)."');
		}	
	else { bootbox.hideAll(); return false; }
	});
	});
		
		});
		</script></div>";			
	
		$ftxt_snip->outertext = $outstr;
		$ftxt = $ftxt->save();
		$dtu = array (
			'form_name' => $fnm,
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
					);
		$this->add_myform_to_flint($fnm,$dtu);
	$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Image </strong>element edited.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$fnm));
}

function add_rowspace() {
	$rs = random_string('alnum', 8);
	 //ui-widget-content ui-resizable
	$myw = intval($this->input->post('rs_col_width'));
	$outstr = "<div class='span".$myw." well bgcolor' id='".$rs."' style='margin-left:2px;margin-right:2px;padding-left:3px;padding-right:3px;padding-top:1px;padding-bottom:1px;'>
              <div class='box-icon' style='float:right;'>
							<a id='remove_element_".$rs."'><img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px'/></a>
						</div><p>&nbsp;</p>";
	$outstr .=  "<script>
		$('#remove_element_".$rs."').click(function () {
		$('#".$rs."').remove();
		return false;
	});
	//$('#".$rs."').draggable();
	
	
		</script>";														
		if ($myw==12) $outstr .= "</div>";
	echo $outstr;
}
function add_columns() {
	$mid = random_string('alnum', 8);
	$cols = intval($this->input->post('numcols'));
	$cls = $this->input->post('class');
	$fnm = $this->input->post('frmid');
	
	$outstr = "<div class='row' id='".$mid."'><div class='box-icon' style='float:right;'><a id='remove_field_".$mid."'>";
	$outstr .= "<img src='".base_url()."assets/img/cancel-on.png' width='10px' height='10px' style='position:absolute;top:5px;right:5px;'></a></div>";
	for ($k=0;$k<$cols;$k++) {	
		$rnd = random_string('alnum', 8);
		$outstr .="<div id='".$rnd."' class='".$cls." droppedFields ui-sortable ui-droppable activeDroppable'></div>";
	}
	$outstr .="<script>$(document).on('click', '#remove_field_".$mid."', function(e){ 
		e.preventDefault();	$('#".$mid."').remove(); }); </script>";

				$outstr .= "</div>";
	
	echo $outstr;
}

function edit_form() {

	$fid = $this->uri->segment(3);
	
		if (!$this->ion_auth->logged_in())
			redirect(site_url('auth/login'));
		else if ($this->ion_auth->is_admin()){	
			$mf = $this->forms_model->get_form_by_name($fid);
		//	$this->session->set_userdata('my_form_name',$mf->form_name);
		
		//print_r($mf);
		$data['my_form'] = $mf;
		$this->load->vars($data);
			$this->load->view('admin/logged_in_header');
			$this->load->view('admin/topbar');
			$this->load->view('admin/forms-sidebar');
			$this->load->view('admin/create_form_v2');
			$this->load->view('admin/footer');
		}
}

function form_done() {

// strip all the box-icon remove div tags from db field


//echo $this->input->post('my_form_name');
//input->post('my_form_name')
	$mf  = $this->forms_model->get_form_by_name($this->uri->segment(3));
	$fstr = $this->input->post('content');
	$name = str_replace('hasDatepicker', '', $fstr);
	
	$dtu = array (
			'form_name' => $mf['form_name'],
			'display_name' => $mf['display_name'],
			'form_text' => $name
					);
		$this->add_myform_to_flint($mf['form_name'],$dtu);
	
}

function delete_form() {

	$fid = $this->uri->segment(3);
	//TBD
		try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	$myforms = Flintstone::load('myforms', $options);
	$myforms->delete($fid);
	
}
catch(FlintstoneException $e){
	echo "error"; 
}

	
	
	redirect(site_url('admin/my_forms'));
	
}

function remove_grid_element() {
	
	$hash = $this->uri->segment(3);
	
$tbl_name = 'dtbl_'.$this->uri->segment(4);
$col_name = 'grid_'.$hash;
if ($this->db->field_exists($col_name,$tbl_name)) {
// $this->db->query("alter table ".$tbl_name." drop column ".$col_name);
echo "Field removed successfully!";
}
else {
	echo "An error occurred - named field does not exist in db!";
}
	
}
function remove_ht_grid_element() {
	
	$hash = $this->uri->segment(3);
	
$tbl_name = 'dtbl_'.$this->uri->segment(4);
$col_name = 'ht_gd_'.$hash;
if ($this->db->field_exists($col_name,$tbl_name)) {
$this->db->query("alter table ".$tbl_name." drop column ".$col_name);
echo "Field removed successfully!";
}
else {
	echo "An error occurred - named field does not exist in db!";
}
	
}

function add_knockout_field() {
	$fnm = $this->input->post('form_name');
	$mf = $this->forms_model->get_form_by_name($fnm);
	$oldftxt = $mf['form_text'];
	
$rs = random_string('alnum', 8);
	
	
		$ngc = intval($this->input->post('ht_num_cols'));
		
		$tbln = 'dtbl_'.$fnm;
		
		$coln = "col_jqxgrid_".$rs;
		
		
		
		
		
	//if (!$this->db->field_exists($coln,$tbln)) {
		// $this->forms_model->add_grid_field_col($coln,$fnm);
		
		
		
		  $src = "  var source =
            {
                localdata: data,
                datatype: 'json',
                updaterow: function (rowid, rowdata, commit) {
                    commit(true);
                },
                datafields:
                [";
                $width = 0;
                    for ($i=0;$i<$ngc;$i++) {
                    if (($this->input->post('field_type_'.$i)=='dropdownlist')) {
						
				$src .= "{ name: '".$this->input->post('header_'.$i)."', type: 'string' }";
				$width += 175;
			}
			else if ($this->input->post('field_type_'.$i)=='textbox') {
				$src .= "{ name: '".$this->input->post('header_'.$i)."', type: 'string' }";
				$width += 80;
			}
                 else if (($this->input->post('field_type_'.$i)=='numberinput')|| ($this->input->post('field_type_'.$i)=='numberinput_c2')) {
						
				$src .= "{ name: '".$this->input->post('header_'.$i)."', type: 'number' }";
				$width += 70;
			}
			else if (($this->input->post('field_type_'.$i)=='datetimeinput')) {
						
				$src .= "{ name: '".$this->input->post('header_'.$i)."', type: 'date' }";
				$width += 110;
			}
            else if (($this->input->post('field_type_'.$i)=='checkbox')) {
						
				$src .= "{ name: '".$this->input->post('header_'.$i)."', type: 'bool' }";
				$width += 70;
			}
			if ($i!=($ngc-1)) $src .= ",";
		}
		// if ($width <= 350) $width += 80;
			   $src .= "                         
                ]
            };
            var dataAdapter = new $.jqx.dataAdapter(source);";
            
            
            
            for ($i=0;$i<$ngc;$i++) {
                if (($this->input->post('field_type_'.$i)=='dropdownlist')) {
                $src .= "	var ddopts = [";
                $x=1;
                $numtoks = count(explode("\n",trim($this->input->post('select_options_'.$i))));
					foreach (explode("\n",trim($this->input->post('select_options_'.$i))) as $kk => $vv){
						
				$src .= "{ value: '".$vv."', label: '".$vv."' }";
				if ($x!=($numtoks)) $src .= ",";
				$x++;
              }
                             
                 $src .= "  ];
                 var ddsrc =
            {
                 datatype: 'array',
                 datafields: [
                     { name: 'label', type: 'string' },
                     { name: 'value', type: 'string' }
                 ],
                 localdata: ddopts
            };
            var ddAdapter = new $.jqx.dataAdapter(ddsrc, {
                autoBind: true
            });";
        
	}
			}
			$src .= "$('#jqxgrid_".$rs."').jqxGrid(
            {
                source: dataAdapter,
                editable: true,
                sortable: true,
                theme: getDemoTheme(),
                pagermode:'default',
                pageable: true,
                width: ".$width.",
                autoheight: true,
                selectionmode: 'checkbox',
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;
                },
                columns: [";
                
            
                
                    for ($i=0;$i<$ngc;$i++) {
						if (($this->input->post('field_type_'.$i)=='textbox')) {
					$src .= "{ text: '".$this->input->post('header_'.$i)."', columntype: 'textbox', datafield: '".$this->input->post('header_'.$i)."', width: 80 }";
							
                }
                else	if (($this->input->post('field_type_'.$i)=='dropdownlist')) {
				
        
            $src .= "{ text: '".$this->input->post('header_'.$i)."', datafield: '".$this->input->post('header_'.$i)."', displayfield: '".$this->input->post('header_'.$i)."', columntype: 'dropdownlist',width: 175,
                        createeditor: function (row, value, editor) {
                            editor.jqxDropDownList({ source: ddAdapter, displayMember: 'label', valueMember: 'value' });
						}}";
              
        
        
        
                  // $src .= "{ text: '".$this->input->post('header_'.$i)."', columntype: 'dropdownlist', datafield: '".$this->input->post('header_'.$i)."', width: 195 }";
                }
                  else	if (($this->input->post('field_type_'.$i)=='checkbox')) {
                  $src .= "{ text: '".$this->input->post('header_'.$i)."', datafield: '".$this->input->post('header_'.$i)."', columntype: 'checkbox', width: 67 }";
			  }
			      else	if (($this->input->post('field_type_'.$i)=='datetimeinput')) {
					  $src .= "{ text: '".$this->input->post('header_'.$i)."', datafield: 'date', columntype: 'datetimeinput', width: 110, align: 'right', cellsalign: 'right', cellsformat: 'd',
                  validation: function (cell, value) {
                          if (value == '')
                             return true;

                          var year = value.getFullYear();
                          if (year >= 2040) {
                              return { result: false, message: 'Date should be before 1/1/2040' };
                          }
                          return true;
                      } }";
			  }
			  
			      else	if (($this->input->post('field_type_'.$i)=='numberinput')) {
                  
                  $src .= "{text: '".$this->input->post('header_'.$i)."', datafield: '".$this->input->post('header_'.$i)."', width: 70, align: 'right', cellsalign: 'right', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 150) {
                              return { result: false, message: 'Quantity should be in the 0-150 interval' };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0, digits: 3 });
                      }
                  }";
			  }
                  else	if (($this->input->post('field_type_'.$i)=='numberinput_c2')) {
					
					$src .= "
                  { text: '".$this->input->post('header_'.$i)."', datafield: '".$this->input->post('header_'.$i)."', align: 'right', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 15) {
                              return { result: false, message: 'Price should be in the 0-15 interval' };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ digits: 3 });
                      }

                  }";  
				  }
				  if ($i!=($ngc-1)) $src .= ",";
			  }
				  $src .= "
			  
                ]
            });";

			
		
		// column id and source value
	$this->forms_model->add_jqxgrid_definition($coln,$src);
		
		
		
		$outstr = make_jqxgrid_xhtml($rs, $ngc,$fnm,$width);
		
    // if ($myw==12) $outstr .= "</div>";
            
        //$newftxt = $oldftxt."".$outstr;
        $this->load->helper('dom');
        	$ftxt = str_get_html($mf['form_text']);
		$ftxt_snip = $ftxt->find('div[class=droppedFields]',-1);
   //var numItems = $('.yourclass').length
   
   //<div id="xxJmo8sh" class="col-md-6 droppedFields ui-sortable ui-droppable" style="height: 100%; "></div>
        
        $ftxt_snip->innertext .= $outstr;
		$ftxt = $ftxt->save();
		
        
        $dtu = array (
			'form_name' => $mf['form_name'],
			'display_name' => $mf['display_name'],
			'form_text' => $ftxt
			
					);
		$this->add_myform_to_flint($mf['form_name'],$dtu);			
		
		
		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>x</button>
							<strong>Grid </strong>element added.
						</div><script> $('#my_alert_div').fadeOut(3000); </script>";
		$this->session->set_flashdata('message',$str);
		redirect(site_url('create_form/edit_form/'.$mf['form_name']));
	
}



}
