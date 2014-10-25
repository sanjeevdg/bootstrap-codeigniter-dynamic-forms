<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_users extends CI_Controller {

	public function index()
	{
		$off = $this->uri->segment(3);
		$this->load->library('pagination');
		$config['base_url'] = site_url('my_users/index');
		$config['total_rows'] = $this->db->count_all('users');
		$config['per_page'] = 5; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = "<ul>";
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
		$this->db->limit($config['per_page'],$off);

		$mfs = $this->db->get('users');
		$mfs->next_row();
		$data['my_users'] = $mfs->result_object;
		
		$this->pagination->initialize($config); 
	
		$data['page_links'] = $this->pagination->create_links();
		$this->load->vars($data);
		
		$this->load->view('admin/logged_in_header');
		$this->load->view('admin/topbar');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/my_users');
		$this->load->view('admin/footer');		
}

function register_new() {

	$username = $this->input->post('email');
	$email = $this->input->post('email');
	$password = $this->input->post('password');
	$group_name = array('2');
	$created_on = date("Y-m-d H:i:s",time());
	$additional_data = array('first_name' => $this->input->post('fname'),
							 'last_name' => $this->input->post('lname'),
							 'company' => $this->input->post('company'),
							 'phone' => $this->input->post('phone')
							);
	$this->load->library('ion_auth');
	$id = $this->ion_auth->register($username, $password, $email, $additional_data, $group_name);
		if ($id) { 
			$this->session->set_flashdata('message',"<div class='done-msg'>An email has been sent to you. Please check your email and click on activation link, please check your spam folder if you do not receive the email within a minute </div>");
			redirect(site_url('my_users'));
		}
}

function check_duplicate_email() {
	
	$em = $this->input->post('email');
		if ($em!="") {
			$v = $this->ion_auth->email_check($em);
			$b = "<div class='alert alert-success'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>You may register with this email</strong> successfully.
						</div>";
			$a = "<div class='alert alert-error'>
							<button type='button' class='close' data-dismiss='alert'>×</button>
							<strong>Oh snap!</strong> This email is already taken.
						</div>";
						
						
				if ($v) $data['isemdup'] = $a; 
					else $data['isemdup'] = $b;
						echo $data['isemdup'];
		}
}

function create_new_user() {
	
	$this->load->view('admin/logged_in_header');
	$this->load->view('admin/topbar');
	$this->load->view('admin/sidebar');
	$this->load->view('admin/new_user');
	$this->load->view('admin/footer');
}
	
}
