<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function Site(){

		parent::__construct();

		$this->load->model('get_database');

	}

	public function index(){
		$data['results'] = $this->get_database->get_user_details('test@gmail.com');	//user must be in session, change email, get email of user in session
		$this->load->view('user_update', $data);

	}
	
	public function update(){
		$input = $this->input->post();
		//print_r($input); die();
		$update = $this->get_database->update_user_details($input['email'],$input);
		if($update == 1){
			echo 'update successful!';
		}else{
			echo 'error occured';
		}
	}

}
