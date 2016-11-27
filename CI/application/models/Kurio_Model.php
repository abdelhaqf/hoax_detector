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
	
	public function login($username,$password)
	{
		//$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('users');
		return $query;
	}
	public function checkvote($username,$article)
	{
		//$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('article_id',$article);
		$query = $this->db->get('votes');
		return $query;
	}
	public function vote($username,$article,$type){
		$data = array(
				'username' => $username,
				'article_id' => $article,
				'vote_type' => $type,
				);
		$this->db->insert('votes',$data);
	}
	public function getVote($username){
		$this->db->select('article_id');
		$this->db->where('username',$username);
		$query = $this->db->get('votes');
		return $query;
	}
	public function selectHoax($id){
		$query = $this->db->query("SELECT 1 FROM votes WHERE article_id='$id' AND vote_type='N'");
		return $query;
	}
	public function selectNoHoax($id){
		$query = $this->db->query("SELECT 1 FROM votes WHERE article_id='$id' AND vote_type='Y'");
		return $query;
	}
	public function selectMaxPoints()
	{
		$query = $this->db->query("SELECT * FROM users ORDER BY points DESC LIMIT 3");
		return $query;

	}
}



