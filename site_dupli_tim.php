<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function Site(){

		parent::__construct();

		$this->load->model('get_database');
		$this->load->helper('url');
		$this->load->helper('form');

	}

	public function index(){

		$this->home();

	}

	public function home(){

		$this->load->view('home_view');

	}

	public function search(){

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('format', 'Format', 'required');
		$this->form_validation->set_rules('search_query', 'Search_query', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('home_view');
		}
		else
		{
			$data['search'] = $this->get_database->search();
			$data['result_count'] = $this->get_database->count_results();
			$this->load->view('search_view',$data);
		}

	}

	public function search_page(){

		$data['search'] = $this->get_database->search_by_page();
		$data['result_count'] = $this->get_database->count_results();
		$this->load->view('search_view',$data);

	}
//Thea's code starts here
	public function update(){
		$accession_number= $this->input->post('accession_number');
		$data['results'] = $this->get_database->get_book_details($accession_number);
		$data['results2'] = $this->get_database->get_book_author($accession_number);
		//echo $accession_number;
		$this->load->view('edit_book_details', $data);

	}

	public function update_book_database(){
			$data2= $this->input->post('inputAuthor');
			echo $data2[0];
			$accession_number = $this->input->post('accession_number');
			$data = array(
			 'accession_number' => $this->input->post('accession_number'),        
			 'publisher' => $this->input->post('inputPublisher'),  
			 'copyright_year' => $this->input->post('inputYear'),
			 'title' => $this->input->post('inputTitle'),
			 'type' => $this->input->post('inputType')
			);
			$this->get_database->update_book_model($accession_number,$data);
			$this->get_database->update_book_author($accession_number,$data2);
			echo "Update Succesful :)";
			$this->load->view('home_view');		
	}

	public function delete_author(){
			$accession_number = $this->input->post('accession_number');
			$author = $this->input->post('author');

			$this->get_database->update_book_author($accession_number,$author);
	}
//Thea's codes ends here

//Thea's code as of 2/9/14
	public function get_my_library_data(){
		$email= "tempmail@gmail.com";//$this->input->session('email');
		$data['results']=$this->get_database->get_bookmarks($email);
		$data['results2']=$this->get_database->get_author_for_bookmarks($email);
		$this->load->view('my_library', $data);
	}

	public function bookmark(){
		$accession_number= $this->input->post('accession_number');
		$email= $this->input->post('email');
		$this->get_database->add_bookmark($accession_number,$email);
//			echo "Book added";												//I commented this out because checking and notifying duplicates are in function add_bookmark()
		$this->load->view('home_view');
	}
//End of Thea's code as of 2/9/14
}
