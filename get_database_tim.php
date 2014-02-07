<?php

	class Get_database extends CI_Model{
	
		public function get_user_details($email){

			//$statement = "SELECT first_name, middle_name, last_name, email, password, student_number, degree_program, classification, sex, birth_date, employee_number FROM user WHERE email='$email'";

			//$query = $this->db->query($statement);
			$data = current($this->db->get_where('user',Array('email'=>$email))->result_array());
			return $data;
		}

		public function update_user_details($email,$data){
			$this->db->where('email',$email);
			if(!$this->db->update('user',$data)){
				return -1;
			}else{
				return 1;
			}
			
		}
	}

?>