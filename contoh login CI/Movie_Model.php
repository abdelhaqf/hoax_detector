<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Movie_Model extends CI_Model 
{
	public function insert($title,$year,$director,$image_path)
	{
		$this->load->database();
		$data = array(
				'title' => $title,
				'year' => $year,
				'director' => $director,
				'image' => $image_path
				);
		$this->db->insert('movie_list',$data);
				
				
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



