<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
//		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
	//	redirect(site_url('auth/login'),'refresh');
	
	
		
	}
	
	function dashboard() {
	
	
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/dashboard');
	$this->load->view('admin/footer');
	
	
	
}
	
	function create_form() {
		
	if (!$this->ion_auth->logged_in())
	redirect(site_url('auth/login'));
	else if ($this->ion_auth->is_admin()){
		
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/create_form');
	$this->load->view('admin/footer');
	
	}
}
	
	function prepare_grid_box() {
		
	$outstr = "<div class='control-group'>
							<label class='control-label' for='inputName'>Number of Columns</label>
							<div class='controls'>
								<select name='num_grid_cols' class='required' id='num_grid_cols' placeholder='required'>
								<option>Choose number of columns</option>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
								<option value='6'>6</option>
								<option value='7'>7</option>
								<option value='8'>8</option>
								</select>
							</div>
						</div>";
$outstr .= "<div class='control-group'>
							<div class='controls'>
								<button id='make_grid_btn' class='btn btn-primary'>Next</button>
							</div>
						</div>
						<div id='grid_options_box'></div>";						
// <input type='submit' id='make_grid_btn' name='submit' class='btn btn-primary' value='Next'/>						
						$outstr .= "<script>
	$('#make_grid_btn').click ( function() {       
if($('#field_form').valid()) {
	
	 $.ajax({
            url     : '".site_url('admin/populate_grid_box')."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#field_form').serialize(),
            success : function( data ) {
      
$('#grid_options_box').html(data);

            },
            error   : function( xhr, err ) {
                         alert('Error'+xhr.responseText);     
            }
        }); 
	}
	return false;


    });
    
    
</script>";
		echo $outstr;
		
	}
	function populate_ht_box() {
		
	
	$num_cols = intval($this->input->post('ht_num_cols'));
	
	//echo 'asas'.$num_cols;
	$outstr = "";
	//echo "adasdasdasdsa22222";
	for ($i=0;$i<$num_cols;$i++) {
		//echo "adasdasdasdsa111111";
		//margin-left:0px;padding-left:5px;padding-right:5px;
		//margin-left:0px;padding-left:5px;padding-right:5px;
		//margin-top:0;margin-left:125px;
	$outstr .= "<div class='form-group bgcolor' style=''>

									<label class='col-md-2 control-label' for='inputName'>Column ".$i." Header</label>
							<div class='col-md-3'>
								<input type='text' name='header_".$i."' class='required alphanumeric noSpace' id='header_".$i."' placeholder='required'/>
							
						</div>
						
								
							<label class='control-label col-md-2' for='inputMessage'>Field Type</label>
							<div class='col-md-3'>
							
				<select title='Please select field type' name='field_type_".$i."' id='field_type_".$i."' style='' class='required'>
				
				<option value='textbox'>Text</option>
				<option value='numberinput'>Numeric</option>
					<option value='numberinput_c2'>Numeric-currency</option>
					<option value='checkbox'>Checkbox</option>
				<option value='dropdownlist'>Drop Down List</option>
				<option value='datetimeinput'>Date</option>
								
				</select>
							
						</div> <div id='select_option_box_".$i."'></div>";
					
				//<option value='file'>FileUpload</option>	
		$outstr .= "<script>
	$('#field_type_".$i."').change ( function() {       

	if ( $(this).val()=='dropdownlist') {
	//alert('selected');
	 $.ajax({
            url     : '".site_url('admin/populate_option_box/select_options_'.$i)."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#field_form').serialize(),
            success : function( data ) {
       
$('#select_option_box_".$i."').html(data);

            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
		
}
	else { $('#select_option_box_".$i."').html('');	}
    });
    
    
</script></div><div style='clear:both;'></div>";
					
						
	}
	//$outstr .= "</div><hr/><div class='control-group'><label class='control-label' for='inputName'>Number of rows</label>
		//					<div class='controls'>
		//						<input type='text' name='gd_num_rows' class='required number' id='gd_num_rows' placeholder='required'/>
		//					</div>
		//				</div>";
	echo $outstr;
		
		
	}
	
	
	function populate_grid_box() {
		
	
	$num_cols = intval($this->input->post('gd_num_cols'));
	
	//echo 'asas'.$num_cols;
	$outstr = "";
	//echo "adasdasdasdsa22222";
	for ($i=0;$i<$num_cols;$i++) {
		//echo "adasdasdasdsa111111";
	$outstr .= "<div class='span2 bgcolor' style='margin-left:0px;padding-left:5px;padding-right:5px;'>
									<label class='control-label' for='inputName'>Column ".$i." Header</label>
							
								<input type='text' name='header_".$i."' class='required alphanumeric noSpace' id='header_".$i."' placeholder='required'/>
							
						</div>
								<div class='span2 bgcolor' style='margin-left:0px;padding-left:5px;padding-right:5px;'>
							<label class='control-label' for='inputMessage'>Select Field Type</label>
							
				<select title='Please select field type' name='field_type_".$i."' id='field_type_".$i."' class='required'>
				
				<option value='text'>Text</option>
				<option value='radio'>Radio</option>
				<option value='checkbox'>Checkbox</option>
				<option value='select'>Select List</option>
				<option value='select_multiple'>Select List Multiple</option>
				<option value='date'>Date</option>
				<option value='textarea'>TextArea</option>
				
				</select>
							
						</div> <div id='select_option_box_".$i."'></div>";
					
				//<option value='file'>FileUpload</option>	
		$outstr .= "<script>
	$('#field_type_".$i."').change ( function() {       

	if ( ($(this).val()=='select') || ($(this).val()=='select_multiple')) {
	//alert('selected');
	 $.ajax({
            url     : '".site_url('admin/populate_option_box/select_options_'.$i)."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#field_form').serialize(),
            success : function( data ) {
       
$('#select_option_box_".$i."').html(data);

            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
		
}
else if (($(this).val()=='radio') || ($(this).val()=='checkbox')) {
	 $.ajax({
            url     : '".site_url('admin/populate_radiocheck_box/select_options_'.$i)."',
            type    : 'POST',
            dataType: 'html',
            data    : $('#field_form').serialize(),
            success : function( data ) {
       
$('#select_option_box_".$i."').html(data);

            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        }); 
	
	
	}
	else { $('#select_option_box_".$i."').html('');	}
    });
    
    
</script><div style='clear:both;'>";
					
						
	}
	$outstr .= "</div><hr/>
	<div class='control-group'><label class='control-label' for='inputName'>Number of rows</label>
							<div class='controls'>
								<input type='text' name='gd_num_rows' class='required number' id='gd_num_rows' placeholder='required'/>
							</div>
						</div> ";
	echo $outstr;
		
		
	}
	
function my_test() {
	
	$this->load->view('admin/logged_in_header');
	$this->load->view('test');
	$this->load->view('admin/footer');
}
	
function extract_form_data() {
	
	$fstr = $this->input->post('content');
	$name = str_replace('hasDatepicker', '', $fstr);
	
	try {
		$options = array('dir' => $this->config->item('datadir'));
	$myforms = Flintstone::load('myforms', $options);
	$mf = $myforms->get($this->input->post('my_form_name'));
	
	$dt = array(
			'form_name' => $this->input->post('my_form_name'),
			'display_name' => $mf['display_name'],
			'form_text' => $name			
				);
	
	//$storage->remove($this->input->post('my_form_name'));			
	
	
	$myforms->set($this->input->post('my_form_name'),$dt);
	
	}
	catch(FlintstoneException $e) {
		
	}
	
	//$this->db->where('form_name',);
	//$this->db->update("my_forms",$dt);
	echo $fstr;
	
    }	
    
function extract_form_data2() {
	
	$fnm = $this->uri->segment(3);
	$mf =null;
	
	try {
		$options = array('dir' => $this->config->item('datadir'));
	$myforms = Flintstone::load('myforms', $options);
	$mf = $myforms->get($fnm);
	
	
	}
	catch(FlintstoneException $e) {
		
	}
	
	//$this->db->where('form_name',);
	//$this->db->update("my_forms",$dt);
	echo $mf['form_text'];
	
    }	

function my_forms() {
	
	$off = $this->uri->segment(3);
	if (!$off) $off=0;
	$users = $this->ion_auth->users(array('2'))->result();
	$data['my_users'] = $users;
	
	$this->load->library('pagination');
	$config['base_url'] = site_url('admin/my_forms');
	
	$config['per_page'] = 4; 
	$config['uri_segment'] = 3;
	$config['full_tag_open'] = "<ul class='pagination'>";
	$config['full_tag_close'] = "</ul>";
	$config['prev_link'] = "Prev";
	$config['prev_tag_open'] = "<li>";
	$config['prev_tag_close'] = "</li>";
	$config['next_link'] = "Next";
	$config['next_tag_open'] = "<li>";
	$config['next_tag_close'] = "</li>";
	$config['cur_tag_open'] = "<li class='active'><a href='#'>";
	$config['cur_tag_close'] = "</a></li>";
	$config['num_tag_open'] = "<li>";
	$config['num_tag_close'] = "</li>";
	
	///$this->db->limit($config['per_page'],$off);

	//$mfs = $this->db->get('my_forms');
	//$mfs->next_row();
	$mfs = array();
	try {
	$options = array('dir' => $this->config->item('datadir'));
	$myforms = Flintstone::load('myforms', $options);
	$keys = $myforms->getKeys();
	
		for ($x=0;$x<count($keys);$x++) {
			//print_r($myforms->get($fname));
			if ($x>=$off && $x<($off+4)) {
			$mfs[] = $myforms->get($keys[$x]);
			
		}
			
		} 
		//$myforms->flush();
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	$config['total_rows'] = count($keys);
	//print_r($storage->get(''));
	//$mfs->result_object;
	$data['my_forms'] = $mfs;
	//print_r($mfs);
	$this->pagination->initialize($config); 
	$data['page_links'] = $this->pagination->create_links();
	
	$this->load->vars($data);
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');	
	$this->load->view('admin/sidebar');
	$this->load->view('admin/my_forms');
	$this->load->view('admin/footer');
	
	}

function view_form() {
	
	$fid = $this->uri->segment(3);	
	$data['my_form'] = $this->forms_model->get_form_by_name($fid);

	$this->load->vars($data);
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/view_form');
	$this->load->view('admin/footer');
	
}

function create_new_form() {

	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/create_new_form');
	$this->load->view('admin/footer');
	
}

function create_my_form() {

	$name = $this->input->post('new_form_name');
	$name = str_replace(' ', '_', $name);
	
	$dispnm = $this->input->post('display_name');
	
	try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load('myforms', $options);
		$mye = $myforms->get($name);
	}
	catch (FlintstoneException $e)	 {
		echo 'An error occured: ' . $e->getMessage();
	}

	
	///$mye = $storage->get($name);
	
	//$mye = $this->db->get_where('my_forms',array('form_name'=>$name));
	//$mye->next_row();
	//$mye = $mye->result_object;
	
	if (isset($mye['form_name'])) {
		$stra = "<div class='alert alert-error'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Oh snap!</strong> A form of the same name already exists.
						</div>";
		$this->session->set_flashdata('message',$stra);
		redirect(site_url('admin/create_new_form/'));
	}
	
	else {
		//$sql = "insert into my_forms (form_name, display_name) values ('".$name."','".$dispnm."');";
		//$this->db->query($sql);
	//	$mdir = $this->config->item('local_file_path').$name;
	//	if (!is_dir($mdir))
	//		mkdir($mdir,0777,true);
					
		//$sql = "create table if not exists dtbl_".$name." (id int not null auto_increment, key(id)) CHARACTER SET tis620, COLLATE tis620_thai_ci";
		//$this->db->query($sql);
		$dta = array(
				'form_name' => $name,
				'display_name' => $dispnm,
				'form_text' => ''
					);
		try {			
		$myforms->set($name, $dta);
		//$myforms->flush();
	}
	catch(FlintstoneException $e)  {
		echo 'An error occured: ' . $e->getMessage();
	}
		//$mf = $storage->put($name,$dta);		
	//	$mdata = $name.'|'.$dispnm.'\n';

	//	if ( ! write_file($this->config->item('local_file_path').$name.'/'.$name, $mdata))	{
	//			echo 'file not written';
	//	}
	//	else
	///	{
	//		echo 'File written!';
	//		}

		$str = "<div class='alert alert-success' id='my_alert_div'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Form created </strong> successfully.
						</div><script> $('#my_alert_div').fadeOut(8000); </script>";
		$this->session->set_flashdata('message',$str);
	//	$this->session->set_userdata('my_form_name',$name);
	//	$this->session->set_userdata('my_form_id',$this->db->insert_id());
		
		redirect(site_url('create_form/edit_form/'.$name));
	}
	
}

function remove_form_data() {
		
	$sql = "alter table my_forms drop column ". $this->uri->segment(3);
	$this->db->query($sql);
	echo "success";
}	

function assign_user() {
	
	if ($this->input->post('assign_form_'.$this->input->post('form_id'))!='-1') {
	$user = $this->ion_auth->user($this->input->post('assign_form_'.$this->input->post('form_id')))->row();
		
	$myr = $this->db->get_where('assigned_users',array('user_id'=>$this->input->post('assign_form_'.$this->input->post('form_id')),'form_id'=>$this->input->post('form_id')));	
	$myr->next_row();
	
		if (empty($myr->result_object)){
		
			$dt = array(
				'user_id' => $this->input->post('assign_form_'.$this->input->post('form_id')),
				'form_id' => $this->input->post('form_id')
					);
			
			$this->db->insert('assigned_users',$dt);		
			echo $user->email."<a href='".site_url('admin/remove_assigned_user/'.$this->input->post('assign_form_'.$this->input->post('form_id')).'/'.$this->input->post('form_id'))."'>remove</a></br/>";
		}
		else echo "<div class='alert alert-error'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Oh snap!</strong> You've alreasy assigned this user.
						</div>";
	
		}
}	

function remove_assigned_user() {
		
		$uid = $this->uri->segment(3);
		$fid = $this->uri->segment(4);
		$this->db->where('user_id',$uid);
		$this->db->where('form_id',$fid);
		$this->db->delete('assigned_users');
		redirect(site_url('admin/my_forms'));
	}

function populate_option_box() {
		$fld = $this->uri->segment(3);
		
		echo "		<div class='span1 bgcolor'>
							<label class='control-label' for='inputName'>&emsp;&emsp;Enter options</label>
							
				<textarea name='".$fld."'  style='margin-left:20px;padding-left:5px;' class='required' id='".$fld."' rows='5'></textarea>
				</div>";
		
	}	
function populate_radiocheck_box() {
		$fld = $this->uri->segment(3);
		
		
		$outstr = "<div class='span1 bgcolor'>
							<label class='control-label' for='inputName'>&emsp;&emsp;Enter options</label>
							
				<textarea name='".$fld."'  style='margin-left:20px;padding-left:5px;' class='required' id='".$fld."' rows='5'></textarea>
				</div>";
				echo $outstr;
		//<div class='controls'>
		//</div>
		
	}	
function save_json() {
	
	echo json_encode($this->input->post('data'));
	
	
}
function change_table_cset() {

/*
	$sqla = "ALTER TABLE my_forms CHARACTER SET tis620, COLLATE tis620_thai_ci";
	$this->db->query($sqla);
	$sqlb = "alter table my_forms change column form_name form_name varchar(255) CHARACTER SET tis620, COLLATE tis620_thai_ci";
	$this->db->query($sqlb);
	$sqlc = "alter table my_forms change column form_text form_text mediumtext CHARACTER SET tis620, COLLATE tis620_thai_ci";
	$this->db->query($sqlc);
	**/
  
  
	$sql = "alter table my_forms add column display_name varchar(512) CHARACTER SET tis620 COLLATE tis620_thai_ci;";
	$this->db->query($sql);
echo 'done';

	
}
function test_debug() {
	
	$rtn=0;
	$sql = "update my_forms set display_name=? where id=?";
	///$sql = "select * from my_forms";
	
	$dta = array(
		'display_name' => 'sad sdsadas asdas'
			);
	$this->db->where('id',108);			
	$rtn = $this->db->update('my_forms',$dta);
	// $rtn = $this->db->query($sql,array('my update debug test 2',198));
	echo $this->db->affected_rows();
	
	
	
	
}

function enter_data_for_form() {
	
	$fid  = $this->uri->segment(3);
	$data['my_form'] = $this->forms_model->get_form_by_name($fid);
	$this->load->helper('dom');
	$html = str_get_html($data['my_form']['form_text']);
	
 //echo $html;
 
	$jqxs = $html->find('div[class=jqxgrid]',0);
	if (isset($jqxs))
	$data['my_jqxgrid_id'] = $jqxs->id;

 
 $fields = array();
foreach($html->find('input') as $input) {

	
 $fields[] =  $input->name.'<br />';
}
	$data['fields'] = $fields;

		$this->load->vars($data);
		$this->load->view('admin/logged_in_header');
		$this->load->view('admin/topbar');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/enter_data_for_form');
		$this->load->view('admin/footer');
	
}
function view_data_for_form() {
	
	$fid  = $this->uri->segment(3);
	$data['form'] = $this->forms_model->get_form_by_name($fid);
	$data['form_data'] = $this->forms_model->get_form_data_by_fname($fid);
	
	$this->load->vars($data);
			$this->load->view('admin/logged_in_header');
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/form_data_view_tabular');
			$this->load->view('admin/footer');
	
}

function dom_test() {


$this->load->helper('dom');
	
$fid = $this->uri->segment(3);	
	$mf = $this->forms_model->get_form_by_name($fid);
	
	$html  = $mf['form_text'] ;
	$html = str_get_html($html);
	
 //echo $html;
 $iar = array();
foreach($html->find('input') as $input) {
	
 $iar[] =  $input->name.'<br />';
}
	$data = array(
		'iar' => $iar,
		'html' => $html
			);
		
$this->load->vars($data);
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/view_form2');
	$this->load->view('admin/footer');
	
	
	
	
	

}
}
