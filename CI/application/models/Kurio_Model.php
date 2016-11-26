<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Kurio_Model extends CI_Model 
{
	public function insert($username,$password,$firstname,$lastname,$job)
	{
		$this->load->database();
		$data = array(
				'username' => $username,
				'password' => $password,
				'firstname' => $firstname,
				'lastname' => $lastname,
				'job' => $job,
				'verified_status' => 'n',
				'points'=>'0'

				);
		$this->db->insert('users',$data);
				
				
	}
	public function edit($id,$title,$year,$director,$image_name)
	{
		
		$this->load->database();
		$data = array(
				'title' => $title,
				'year' => $year,
				'director' => $director,
				'image' => $image_name
				);
		$this->db->where('id',$id);
		$this->db->update('movie_list',$data);
				
				
	}
}



