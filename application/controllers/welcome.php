<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		echo site_url();
		echo site_url('admin/login');
		
		
	}
	public function test_exec() {
		echo "i am:".exec('whoami');
	}
	public function test_new_form() {
		
		
	//	$data['rs'] = random_string('alnum',8);
	//	$data['name'] = 'txt_'.$data['rs'];
	//	$this->load->vars($data);
		
		$this->load->view('admin/logged_in_header');
		$this->load->view('admin/topbar');
		$this->load->view('admin/my_new_form');
		$this->load->view('admin/footer');
		
		
		
	}
	public function setup_ionauth() {
		/*
		$sql = "CREATE TABLE if not exists `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);";

$sql = "INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1,'admin','Administrator'),
	(2,'members','General User');";
	$this->db->query($sql);
	
	
	$g = $this->db->get('groups');
	$g->next_row();
	print_r($g->result_object);
	
	
DROP TABLE IF EXISTS `users`;

$sql = "CREATE TABLE if not exists `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
);";
 

$sql = "INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	('1',0x7f000001,'administrator','59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4','9462e8eee0','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator','ADMIN','0');";
	


$sql = "CREATE TABLE if not exists  `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);";



$sql = "INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1,1,1),
	(2,1,2);";

DROP TABLE IF EXISTS `login_attempts`;

#
# Table structure for table 'login_attempts'
#
	CREATE TABLE if not exists `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
); ";



$sql = "CREATE TABLE IF NOT EXISTS `my_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) DEFAULT NULL,
  `form_text` text,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
*/


$sql = "CREATE TABLE IF NOT EXISTS `assigned_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

$this->db->query($sql);

echo 'sada';
		
		
		
		
		
	}
	
	public function create_ci_session_table() {
		
		$sql = "CREATE TABLE IF NOT EXISTS  ci_sessions (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY last_activity_idx (last_activity)
);";
		
		$this->db->query($sql);
		echo "suc";
		
		
	}
	
	public function clean_db() {
		
		$this->db->where('id',1);
	$this->db->delete('my_forms');
	redirect(site_url('admin/my_forms'));
		
		
	}
	
	function test_fllat() {
		
		//$this->load->library('fllat');
		
	//	$pie = new Fllat("pie");
	//	$yum = array("name" => "pepperoni", "size" => "large", "price" => "12.99");
	//	$pie -> add($yum);

		//print_r($pie -> select(array()));	
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
