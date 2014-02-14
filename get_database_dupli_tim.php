<?php

	class Get_database extends CI_Model{

		public function __construct(){

			$this->load->database();

		}

		public function search(){

			$search_query = $this->input->post('search_query');
			$filter = $this->input->post('filter');
			$sort = $this->input->post('sort');
			$format = $this->input->post('format');


			$pstmt = "SELECT title,publisher,accession_number FROM material";

			$pstmt = $pstmt." WHERE type='$format'";
					
			switch($filter){
					
				case "title":			$pstmt = $pstmt." AND title LIKE '% $search_query %' OR title LIKE '% $search_query' OR title LIKE '$search_query %' OR title='$search_query'";
										break;
				case "publisher":		$pstmt = $pstmt." AND publisher LIKE '% $search_query %' OR publisher LIKE '% $search_query' OR publisher LIKE '$search_query %' OR publisher='$search_query'";
										break;
				case "author":			$pstmt = $pstmt." AND author LIKE '% $search_query %' OR author LIKE '% $search_query' OR author LIKE '$search_query %' OR author='$search_query'";
										break;
				case "subject":			$pstmt = $pstmt." AND subject='$search_query'";
										break;
					
			}
					
			switch($sort){
					
				case "alphabetical":		$pstmt = $pstmt." ORDER BY title LIMIT 0,10";
											break;
				case "availability":		

											break;
					
			}

			$query = $this->db->query($pstmt);

			return $query->result();

		}

		public function search_by_page(){

			$search_query = $this->input->get('q');
			$filter = $this->input->get('f');
			$sort = $this->input->get('s');
			$format = $this->input->get('format');
			$page_number = $this->input->get('page_number');

			$start = ($page_number - 1) * 10 ;


			$pstmt = "SELECT title,publisher,accession_number FROM material";

			$pstmt = $pstmt." WHERE type='$format'";
					
			switch($filter){
					
				case "title":			$pstmt = $pstmt." AND title LIKE '% $search_query %' OR title LIKE '% $search_query' OR title LIKE '$search_query %'";
										break;
				case "publisher":		$pstmt = $pstmt." AND publisher LIKE '% $search_query %' OR publisher LIKE '% $search_query' OR publisher LIKE '$search_query %'";
										break;
				case "author":			$pstmt = $pstmt." AND author LIKE '% $search_query %' OR author LIKE '% $search_query' OR author LIKE '$search_query %'";
										break;
				case "subject":			$pstmt = $pstmt." AND subject='$search_query'";
										break;
					
			}
					
			switch($sort){
					
				case "alphabetical":		$pstmt = $pstmt." ORDER BY title LIMIT $start,10";
											break;
					
			}

			$query = $this->db->query($pstmt);

			return $query->result();

		}

		public function count_results(){

			if($this->input->post('search_query')){

				$search_query = $this->input->post('search_query');
				$filter = $this->input->post('filter');
				$sort = $this->input->post('sort');
				$format = $this->input->post('format');

			}

			else{

				$search_query = $this->input->get('q');
				$filter = $this->input->get('f');
				$sort = $this->input->get('s');
				$format = $this->input->get('format');

			}



			$pstmt = "SELECT COUNT(title) result_count FROM material";

			$pstmt = $pstmt." WHERE type='$format'";
					
			switch($filter){
					
				case "title":			$pstmt = $pstmt." AND title LIKE '% $search_query %' OR title LIKE '% $search_query' OR title LIKE '$search_query %'";
										break;
				case "publisher":		$pstmt = $pstmt." AND publisher LIKE '% $search_query %' OR publisher LIKE '% $search_query' OR publisher LIKE '$search_query %'";
										break;
				case "author":			$pstmt = $pstmt." AND author LIKE '% $search_query %' OR author LIKE '% $search_query' OR author LIKE '$search_query %'";
										break;
				case "subject":			$pstmt = $pstmt." AND subject='$search_query'";
										break;
					
			}

			$query = $this->db->query($pstmt);

			return $query->result();

		}
//Thea's code starts here
		public function get_book_details($accession_number){
			
			$statement = "SELECT accession_number, publisher, type, title, copyright_year FROM material where accession_number=\"$accession_number\" ";
			$query = $this->db->query($statement);

			return $query->result();
		}

		public function get_book_author($accession_number){
			
			$statement = "SELECT * FROM material_author where accession_number=\"$accession_number\"";
			$query = $this->db->query($statement);

			return $query->result();
		}

		public function update_book_model($accession_number,$data){  
	      $this->db->where('accession_number', $accession_number);
	      $this->db->update('material',$data);
	    }

	    public function update_book_author($accession_number,$data2){  
	      $this->db->where('accession_number', $accession_number);
	      $this->db->delete('material_author');
	      foreach ($data2 as $temp) {
	      	$statement =" INSERT into material_author values (\"$accession_number\", \"$temp\") ";
	      	$this->db->query($statement);
	      }
	    }
//Thea's code ends here

//Thea's codes as of 2/9/14
	    public function get_bookmarks($email){
	    	$statement ="SELECT accession_number,publisher, title from material where accession_number in (SELECT accession_number FROM bookmark where email=\"$email\")";
	    	$query = $this->db->query($statement);

	    	return $query->result();
	    }
	    public function get_author_for_bookmarks($email){
	    	$statement ="SELECT * from material_author where accession_number in (SELECT accession_number from bookmark where email=\"$email\")";
	    	$query = $this->db->query($statement);

	    	return $query->result();
	    }

	    public function add_bookmark($accession_number, $email){
			$this->db->select('accession_number');		//selects accession number
			$this->db->where(array('accession_number'=>$accession_number));		//checks if accession_number is equal to inputted accession_number
			$query = $this->db->get('bookmark');	//get values from bookmark
   			if($query->num_rows>0){			//gets the number of accession_number equal to the input in which num_rows>1 determines duplicate
   				echo 'Cannot be added! Book already exists.';	//notifies if there is duplicate
   			}
   			else{
				$statement ="INSERT into bookmark values (\"$email\", \"$accession_number\") ";		//if no duplicate, insert into database
   				$this->db->query($statement);
   				echo 'Book Added!';
   			}
	    }

	}

?>