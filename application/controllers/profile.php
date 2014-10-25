<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		if (!$this->ion_auth->logged_in() )
	redirect(site_url('auth/login'),refresh);
	else if ($this->ion_auth->is_admin()){
	
	$data['me'] = $this->ion_auth->user()->row();
	$this->load->vars($data);
	
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/profile');
	$this->load->view('admin/footer');
	
	
	}

}

function profile_edit_panel_fnm() {
	
	$outstr = "";
	$outstr .= "<form method='post' id='fnm_form'><input type=text' id='first_name' name='first_name' placeholder='required' class='required input-xlarge'>
								<span class='help-block'>Please type your firstname</span><input type='submit' id='fnm_sub_btn' value='Go'/></form>";
	
	$outstr .= "<script> $('#fnm_sub_btn').click(function () {

if ($('#fnm_form').valid()) {
$.ajax({
            url     : '".site_url('profile/edit_fnm')."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#fnm_form').serialize(),
            success : function( data ) {
					$('#profile_edit_fnm').html(data);
					bootbox.alert('Updated!');
				},
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
	}
        return false;
        
}); </script>";
echo $outstr;
}
function edit_fnm() {
	
	$dta = array(
			'first_name' => $this->input->post('first_name')
				);		
	$id = $this->session->userdata('id');			
	if ($this->ion_auth->update($id, $dta))
	echo "<label class='control-label'>".$this->input->post('first_name')." &emsp;<a id='profile_fnm_change'>Change</a></label>";
	else echo "error";
}
function profile_edit_panel_lnm() {
	
	$outstr = "";
	$outstr .= "<form method='post' id='lnm_form'><input type=text' id='last_name' name='last_name' placeholder='required' class='required input-xlarge'>
								<span class='help-block'>Please type your lastname</span><input type='submit' id='lnm_sub_btn' value='Go'/></form>";
	
	$outstr .= "<script> $('#lnm_sub_btn').click(function () {

if ($('#lnm_form').valid()) {
$.ajax({
            url     : '".site_url('profile/edit_lnm')."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#lnm_form').serialize(),
            success : function( data ) {
					$('#profile_edit_lnm').html(data);
					// bootbox.alert('Updated!');
				},
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
	}
        return false;
        
}); </script>";
echo $outstr;
}
function edit_lnm() {
	
	$dta = array(
			'last_name' => $this->input->post('last_name')
				);		
	$id = $this->session->userdata('id');			
	if ($this->ion_auth->update($id, $dta))
	echo "<label class='control-label'>".$this->input->post('last_name')." &emsp;<a id='profile_lnm_change'>Change</a></label>";
	else echo "error";
}




}
