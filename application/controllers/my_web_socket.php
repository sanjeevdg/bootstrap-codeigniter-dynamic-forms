<?php 
require_once(APPPATH.'libraries/Server.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_web_socket extends CI_Controller {

function __construct() {

	// $CI = & get_instance();
	


	parent::__construct();
	}
	
	
function show_client() {	

$this->load->library('client');
$this->load->view('client_ui');
	
	
	}
	
function start_server() {
	
	// $this->load->library('client');
	//$this->load->library('server');
	
	set_time_limit(0);

// variables
$address = 'localhost';
$port = 5002;
$verboseMode = true;

$server = new Server($address, $port, $verboseMode);
$server->run();

	
	
}	
	
	}
