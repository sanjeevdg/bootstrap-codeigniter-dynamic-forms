<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms_model extends CI_Model
{
public function get_form_by_id($fid) {

$this->db->limit(1);
$myf = $this->db->get_where('my_forms',array('id'=>$fid));
$myf->next_row();
return isset($myf->result_object[0])?$myf->result_object[0]:array();


}
public function get_form_data_by_fname($fnm) {
	
	$mf = $this->get_form_by_name($fnm);
	
try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myformdata = Flintstone::load($mf['form_name'].'_data', $options);
		$mfd = $myformdata->getKeys($fnm);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}

//$mf = $storage->get($fnm);
//print_r($mf);
return $mfd;
	
	
}
public function get_form_data_by_uid($fnm, $uid) {
	
try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myformd = Flintstone::load($fnm.'_data', $options);
		$mfd = $myformd->get($uid);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}

//$mf = $storage->get($fnm);
//print_r($mf);
return $mfd;
	
	
	
}
public function get_structure_for_form($fnm) {
	
try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load($fnm.'_structure', $options);
		$mf = $myforms->get($fnm);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	return $mf;
	
	
	
}
public function get_form_data_by_id($fnm,$id) {
	
try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load($fnm.'_data', $options);
		$mf = $myforms->get($id);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	return $mf;
	
	
	
	
}
public function get_form_by_name($fnm) {


try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load('myforms', $options);
		$mf = $myforms->get($fnm);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	return $mf;


}

function add_jqxgrid_definition($colid,$src) {
	
	$data = array(
			'source' => $src
				);

	
try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load('jqxgrid_definitions', $options);
		$mf = $myforms->set($colid, $data);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	// return $mf;
	
	
	
	
	
}
function get_jqxgrid_definition_by_colid($colid){

	try {

	// Set options
	$options = array('dir' => $this->config->item('datadir'));

	// Load the databases
	$myforms = Flintstone::load('jqxgrid_definitions', $options);
		$mf = $myforms->get($colid);
	}
	catch (FlintstoneException $e) {
		echo 'An error occured: ' . $e->getMessage();
	}
	return $mf;


	
}
function add_varchar_field($required,$name,$fnm) {
		if ($required == "required")
			$sql = "alter table dtbl_".$fnm." add column ".$name. " varchar(255) not null, CHARACTER SET tis620, COLLATE tis620_thai_ci";
		else $sql = "alter table dtbl_".$fnm." add column ".$name. " varchar(255) CHARACTER SET tis620, COLLATE tis620_thai_ci";
	$this->db->query($sql);
//	file_put_contents($this->config->item('local_file_path').$fnm.'/'.$fnm, $name, FILE_APPEND | LOCK_EX);
	}
	
function add_text_field($required,$name,$fnm) {
		if ($required == "required")
			$sql = "alter table dtbl_".$fnm." add column ".$name. " text not null, CHARACTER SET tis620, COLLATE tis620_thai_ci";
		else $sql = "alter table dtbl_".$fnm." add column ".$name. " text CHARACTER SET tis620, COLLATE tis620_thai_ci";
	$this->db->query($sql);
//	file_put_contents($this->config->item('local_file_path').$fnm.'/'.$fnm, $name, FILE_APPEND | LOCK_EX);
}

function add_grid_field_col($col_name,$fnm) {
		$sql = "alter table dtbl_".$fnm." add column ".$col_name. " text CHARACTER SET tis620, COLLATE tis620_thai_ci";
		$this->db->query($sql);
	//	file_put_contents($this->config->item('local_file_path').$fnm.'/'.$fnm, $col_name, FILE_APPEND | LOCK_EX);
}

function add_date_field($required,$name,$fnm){
		if ($required == "required")
			$sql = "alter table dtbl_".$fnm." add column ".$name. " date not null";
		else $sql = "alter table dtbl_".$fnm." add column ".$name. " date";
	$this->db->query($sql);
//	file_put_contents($this->config->item('local_file_path').$fnm.'/'.$fnm, $name, FILE_APPEND | LOCK_EX);
}

function add_decimal_field($required,$name,$fnm){
		if ($required == "required")
			$sql = "alter table dtbl_".$fnm." add column ".$name. " decimal(10,2) not null";
		else $sql = "alter table dtbl_".$fnm." add column ".$name. " decimal(10,2)";
	$this->db->query($sql);
//	file_put_contents($this->config->item('local_file_path').$fnm.'/'.$fnm, $name, FILE_APPEND | LOCK_EX);
}

}
