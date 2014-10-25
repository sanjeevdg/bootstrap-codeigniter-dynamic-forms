<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->in_group('members'))
		redirect(site_url('auth/login'),'refresh');
	}

function dashboard() {
	
		$this->load->view('members/logged_in_header');
		$this->load->view('members/topbar');
		$this->load->view('members/sidebar');
		$this->load->view('members/dashboard');
		$this->load->view('members/footer');
	
}

function assigned_forms() {
	
	$user = $this->ion_auth->user()->row();
	$afm = $this->db->get_where('assigned_users',array('user_id'=>$user->id));
	$afm->next_row();
	$data['ass_form'] = $afm->result_object;
	$this->load->vars($data);
	
	$this->load->view('members/logged_in_header');
	$this->load->view('members/topbar');
	$this->load->view('members/sidebar');
	$this->load->view('members/assigned_forms');
	$this->load->view('members/footer');
}

function add_data() {
	
		$fid = $this->uri->segment(3);
		$user = $this->ion_auth->user()->row();
		$fmy = $this->db->get_where('assigned_users',array('user_id'=>$user->id,'form_id'=>$fid));
		$fmy->next_row();
			if (empty($fmy->result_object)){
				$fstr = "<div class='alert alert-error'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Oh snap!</strong> You dont have access to enter data for this form.
						</div>";
				$data['my_form']->form_text = $fstr;
				$data['my_form']->form_name = "";
				$this->load->vars($data);
				$this->load->view('members/logged_in_header');
				$this->load->view('members/topbar');
				$this->load->view('members/sidebar');
				$this->load->view('members/enter_data_for_form');
				$this->load->view('members/footer');
			}
	else {
		$data['my_form'] = $this->forms_model->get_form_by_id($fid);
		$this->load->vars($data);
		$this->load->view('members/logged_in_header');
		$this->load->view('members/topbar');
		$this->load->view('members/sidebar');
		$this->load->view('members/enter_data_for_form');
		$this->load->view('members/footer');
		}
}

function submit_form_data() {
	
	// echo $this->input->post('table_name');
	// parse_str($this->input->post('content'),$fmd);
	
		
	$mf = $this->forms_model->get_form_by_name($this->input->post('table_name'));
	
	$postarr = $this->input->post();
	$fldta = array();
	$mkeys = array();
	foreach ($postarr as $kk => $vv) {
	
	if (is_array($vv)) {
		
	$fldta[$kk] = implode("|",$vv);
	
	}
	else {
	$fldta[$kk] = $vv;
	}
	if (!((strpos($kk,'datetimeeditorjqxgrid_') !== false) || (strpos($kk,'dropdownlisteditorjqxgrid_') !== false) || (strpos($kk,'numbereditorjqxgrid_') !== false) || (strpos($kk,'gridpagerlistjqxgrid_') !== false) || (strpos($kk,'table_name') !== false))) {
	$mkeys[] = $kk;
	
	}
	
	
	
	}
	
	// print_r($fldta);
	
	


		if (base_url()=='http://localhost/xeroweb/')
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/xeroweb/uploads/'.$this->input->post('table_name');
		else	
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->input->post('table_name');
	$config['allowed_types'] = 'gif|jpg|png|txt|docx|xlsx|pdf|zip';
	$config['max_size']	= '5242880';
	$config['remove_spaces']  = TRUE;
	$this->load->library('upload', $config);

	$dta=array();
	$ak = '';
		if ($_FILES) {
				if (!is_dir($config['upload_path']))
					mkdir($config['upload_path'],0777,true);
			foreach($_FILES as $key => $val) {
				$ak = $key;
				if ( ! $this->upload->do_upload($key)) {
					echo $this->upload->display_errors();
				}
				else {
					$upd = $this->upload->data();
					$fldta[$ak] = base_url().'uploads/'.$this->input->post('table_name').'/'.$upd['file_name'];
				}	
			}
		}



try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$frmdta = Flintstone::load($mf['form_name']."_structure", $options);
	
	$mff = $frmdta->get($mf['form_name']);
	if (empty($mff)) {
	
	$mst = array(
			'form_name' => $mf['form_name'],
			'form_structure' => $mkeys
					);
					
	$frmdta->set($mf['form_name'], $mst);
	}
	
	
	
	$mff2 = $frmdta->get($mf['form_name']);
	$datarr = array();
	foreach ($mff2['form_structure'] as $k => $kn) {
		$datarr[$kn] = $this->input->post($kn); 
		
	}
	
	
	
	$frmdta2 = Flintstone::load($mf['form_name']."_data", $options);
	$fdt = array(
			'id' =>  time(),
			'content' => $datarr
				);
	
	
	$frmdta2->set(time(), $fdt);
	
	
	
	
}
catch (FlintstoneException $e) {
	echo 'An error occured: ' . $e->getMessage();
}

/*	
	for ($i=0;$i<count($fields);$i++) {
		if (!$i==0){
			$pos = strpos($fields[$i],"grid_");
			$posh = strpos($fields[$i],"jq_gd_");
			if (is_array($this->input->post($fields[$i])) && !array_key_exists($ak,$this->input->post($fields[$i]))) {
				$dta[$fields[$i]] = implode("|",$this->input->post($fields[$i])).'|';
			}
			else if ($pos !== false) {
				
				$dta[$fields[$i]] = $this->pack_grid_data_to_json();
			}
			else if ($posh !== false) {
				
				$dta[$fields[$i]] = $this->input->post($fields[$i]);
				//$this->input->post($fields[$i]);
		//		echo $this->input->post($fields[$i]);
			}
			else  if ($fields[$i] != $ak) {
				$dta[$fields[$i]] = $this->input->post($fields[$i]);
				//$this->input->post($fields[$i]);
			}
			// 
		}
	}
	
	 //$this->db->insert('dtbl_'.$this->input->post('table_name'),$dta);
	 // print_r($dta);
	
	//print_r($this->input->post());
	*/
	// echo 'sadsadas';
	$str = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Data entered</strong> successfully.
						</div>";
	$this->session->set_flashdata('message',$str);
	redirect(site_url('admin/my_forms'),'refresh');
}
function pack_grid_data_to_json() {
	// parse_str($this->input->post('content'),$fmd);
	
	$nrows = intval($this->input->post('num_grid_rows'));
	
	$ncols = intval($this->input->post('num_grid_cols'));
	
	
	$hdrs = $this->input->post('headers');
	$ostr = "";
	$gdata = array();
	for ($r=0;$r<$nrows;$r++) {
		$gdata[$r] = array();
			for ($c=0;$c<$ncols;$c++) {
				$elm2add='';
				if (is_array($this->input->post($c.'_'.$hdrs[$c].'_'.$r))) {
					$gdata[$r][$hdrs[$c]] = implode("|",$this->input->post($c.'_'.$hdrs[$c].'_'.$r)).'|';
					
				}
				else $gdata[$r][$hdrs[$c]] = $this->input->post($c.'_'.$hdrs[$c].'_'.$r);
	
	
	}
	$ostr .= json_encode($gdata[$r]);
	if ($r==($nrows-1))
	$ostr .= "";
	else $ostr .= ",";
	}
	return '{'.'"data"'.':['.$ostr.']}';
	//
	//return json_encode($gdata);
	
}
function view_data() {
	
	$fid = $this->uri->segment(3);
	$user = $this->ion_auth->user()->row();
	$fallow = $this->db->get_where('assigned_users',array('form_id'=>$fid,'user_id'=>$user->id));
	$fallow->next_row();
	$fallow = $fallow->result_object;
		if (!empty($fallow)) {
			$off = $this->uri->segment(4);
			$myf = $this->forms_model->get_form_by_id($fid);
			$tbl = 'dtbl_'.$myf->form_name;
			$data['form_fields'] = $this->db->list_fields($tbl);
			$data['form'] = $myf;
			
			$this->load->library('pagination');
			$config['base_url'] = site_url('members/view_data/'.$myf->id);
			$config['total_rows'] = $this->db->count_all($tbl);
			$config['per_page'] = 5; 
			$config['uri_segment'] = 4;
			
			$this->db->limit($config['per_page'],$off);
			$myd = $this->db->get($tbl);
			$myd->next_row();
			$data['form_data'] = $myd->result_object;
			
			$this->pagination->initialize($config); 
			$data['page_links'] = $this->pagination->create_links();
			
			$this->load->vars($data);
		
			$this->load->view('members/logged_in_header');
			$this->load->view('members/topbar');
			$this->load->view('members/sidebar');
			$this->load->view('members/form_data_view_tabular');
			$this->load->view('members/footer');
		}
	else {
			$this->session->set_flashdata('message','you do not have permission to view data for this form.');
			redirect(site_url('members/dashboard'));
	}
}

function view_form() {
	
	$fid  = $this->uri->segment(3);
	$dtid = $this->uri->segment(4);

	$data['my_form'] = $this->forms_model->get_form_by_id($fid);
	$data['form_fields'] = $this->db->list_fields('dtbl_'.$data['my_form']->form_name);
	$data['form_data'] = $this->forms_model->get_form_data_by_id($data['my_form'],$dtid);
	
	$this->load->vars($data);
	
	$this->load->view('members/logged_in_header');
	$this->load->view('members/topbar');
	$this->load->view('members/sidebar');
	$this->load->view('members/view_form');
	$this->load->view('members/footer');
}
function edit_form() {
	
	$fid  = $this->uri->segment(3);
	$dtid = $this->uri->segment(4);

	$data['my_form'] = $this->forms_model->get_form_by_name($fid);
	$data['form_fields'] = $this->forms_model->get_structure_for_form($fid);
	$data['form_data'] = $this->forms_model->get_form_data_by_id($fid,$dtid);
	
	// check model methods last two above
	
	$this->load->vars($data);
	
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('members/edit_data_for_form');
	$this->load->view('admin/footer');
	
}
function edit_form_data() {
	$fields = $this->db->list_fields('dtbl_'.$this->input->post('table_name'));
		if (base_url()=='http://localhost/maxsys/')
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/maxsys/uploads/'.$this->input->post('table_name');
		else	
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->input->post('table_name');
	$config['allowed_types'] = 'gif|jpg|png|txt|docx|xlsx|pdf|zip';
	$config['max_size']	= '5242880';
	$config['remove_spaces']  = TRUE;
	$this->load->library('upload', $config);

	$dta=array();
	$ak = '';
		if ($_FILES) {
				if (!is_dir($config['upload_path']))
					mkdir($config['upload_path'],0777,true);
			foreach($_FILES as $key => $val) {
				$ak = $key;
				if ( ! $this->upload->do_upload($key)) {
					echo $this->upload->display_errors();
				}
				else {
					$upd = $this->upload->data();
					$dta[$ak] = base_url().'uploads/'.$this->input->post('table_name').'/'.$upd['file_name'];
				}	
			}
		}
	
	for ($i=0;$i<count($fields);$i++) {
		if (!$i==0){
			$pos = strpos($fields[$i],"grid_");
			if (is_array($this->input->post($fields[$i])) && !array_key_exists($ak,$this->input->post($fields[$i]))) {
				$dta[$fields[$i]] = implode("|",$this->input->post($fields[$i])).'|';
			}
			else if ($pos !== false) {
				
				$dta[$fields[$i]] = $this->pack_grid_data_to_json();
			}
			else  if ($fields[$i] != $ak) {
				$dta[$fields[$i]] = $this->input->post($fields[$i]);
			}
			// 
		}
	}
	
	 $this->db->where('id',$this->input->post('form_dtbl_id'));	
	 $this->db->update('dtbl_'.$this->input->post('table_name'),$dta);
	
	//print_r($this->input->post());
	
	
	$str = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Data updated</strong> successfully.
						</div>";
	$this->session->set_flashdata('message',$str);
	redirect(site_url('members/assigned_forms'),'refresh');
	
	
	
}
function delete_row() {
	
	$fid = $this->uri->segment(3);
	$rid = $this->uri->segment(4);
	
	$myf = $this->forms_model->get_form_by_id($fid);
	
	$tbl = 'dtbl_'.$myf->form_name;
	$this->db->where('id',$rid);
	$this->db->delete($tbl);
	$str = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Data deleted</strong> successfully.
						</div>";
	$this->session->set_flashdata('message',$str);
	redirect(site_url('members/view_data/'.$myf->id));
}

function show_search_results() {
	
	$strm = $this->input->post('search');
	$myf = $this->forms_model->get_form_by_id($this->uri->segment(3));
	$fields = $this->db->field_data('dtbl_'.$myf->form_name);

	$farr = array();
		foreach ($fields as $field)	{
			if ($field->type=='varchar' || $field->type=='text')
				$farr[] = $field->name;
		}

	$fst = implode(',',$farr);
	$sql =	"SELECT * FROM dtbl_".$myf->form_name." WHERE MATCH (".$fst.") AGAINST (?  WITH QUERY EXPANSION)";
	$form_data = $this->db->query($sql,array($strm));
	$form_data->next_row();
	$form_data = $form_data->result_object;
	
	$outarr = array();
	$outstr = "";
		if (!empty($form_data)) {
			foreach ($form_data as $fo => $fd) { 
				$outstr .=	"<tr>";		
				foreach ($fields as $fi => $ffd) {
						$fdn = $ffd->name;
						$outstr .=	"<td class='center'>".$fd->$fdn."</td>";
				} 
			$outstr .=	"<td nowrap class='center'><a class='btn btn-success' href='".site_url('members/view_form/'.$myf->id.'/'.$fd->id)."'><i class='icon-zoom-in icon-white'></i>View</a>	
			<a class='btn btn-danger' href='".site_url('members/delete_row/'.$myf->id.'/'.$fd->id)."'><i class='icon-trash icon-white'></i>Delete Row</a></td>
							</tr>";
			} 	
	
		}

	$outarr['html'] = $outstr;
	$outarr['page_links'] = "";
	echo json_encode($outarr);
}

}
