<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

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
		$this->load->database();
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('movie_list')
			 ->columns('title','year','director','image')
			 ->set_field_upload('image','uploads')
			 ->unset_delete()
			 ;
		$output = $crud->render();
		$data['crud']=get_object_vars($output);
		$query = $this->db->query("select id,title,year,director from movie_list");
				
		$data['query']=$query;
		$data['style']=$this->load->view('include/style',$data,TRUE);
		$data['script'] = $this->load->view('include/script',$data,TRUE);
		$data['navbar'] = $this->load->view('template/navbar_movie',NULL,TRUE);
		$data['footer'] = $this->load->view('template/footer_movie',NULL,TRUE); 
		$this->load->helper('url');
		$this->load->view('movie/index', $data);
	}
	public function insert()
	{
		$this->load->database();
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('movie_list')
			 ->columns('title','year','director','image')
			 ->set_field_upload('image','uploads')
			 ->unset_delete()
			 ;
		$output = $crud->render();
		$data['crud']=get_object_vars($output);
		$query = $this->db->query("select id,title,year,director from movie_list");
		$data['style']=$this->load->view('include/style',$data,TRUE);
		$data['script'] = $this->load->view('include/script',$data,TRUE);
		$data['navbar'] = $this->load->view('template/navbar_movie',NULL,TRUE);
		$data['footer'] = $this->load->view('template/footer_movie',NULL,TRUE); 
		$this->load->helper('url');
		$this->load->view('movie/insert', $data);
	
	}
	public function view($id)
	{
		
		$this->load->database();
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('movie_list')
			 ->columns('title','year','director','image')
			 ->set_field_upload('image','uploads')
			 ->unset_delete()
			 ;
		$output = $crud->render();
		$data['crud']=get_object_vars($output);
		$this->db->select('title,year,director,image');
		$this->db->where('id',$id);
		$query = $this->db->get('movie_list');	
		$data['query']= $query;
		$data['id']= $id;
		$data['style']=$this->load->view('include/style',$data,TRUE);
		$data['script'] = $this->load->view('include/script',$data,TRUE);
		$data['navbar'] = $this->load->view('template/navbar_movie',NULL,TRUE);
		$data['footer'] = $this->load->view('template/footer_movie',NULL,TRUE); 
		$this->load->helper('url');
		$this->load->view('movie/view', $data);
	
	}
	public function edit($id)
	{
		
		$this->load->database();
		$this->db->select('id,title,year,director,image');
		$this->db->where('id',$id);
		$query =  $this->db->get('movie_list');
		$data['query'] = $query;
		$data['style']=$this->load->view('include/style',NULL,TRUE);
		$data['script'] = $this->load->view('include/script',NULL,TRUE);
		$data['navbar'] = $this->load->view('template/navbar_movie',NULL,TRUE);
		$data['footer'] = $this->load->view('template/footer_movie',NULL,TRUE); 
		$this->load->helper('url');
		$this->load->view('movie/edit', $data);
	
	}
	public function add_movie()
	{
		
		$title = $this->input->post('title');
		$year = $this->input->post('year');
		$director = $this->input->post('director');
		$config['upload_path']="./uploads/";
		$config['allowed_types']= 'gif|jpg|png';
		$config['max_size'] ='3000';
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$success = $this->upload->do_upload('poster');
		if(!$success)
		{
			print_r($this->upload->display_errors());
		}
		else
		{
			$image = $this->upload->data();
			$image_name = $image[file_name];
			$this->load->model('Movie_Model');
			$this->Movie_Model->insert($title,$year,$director,$image_name);
			
			redirect('/Movie/index/');	
		}
		
	
		
	}
	public function edit_movie()
	{
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$year = $this->input->post('year');
		$director = $this->input->post('director');
		$config['upload_path']="./uploads/";
		$config['allowed_types']= 'gif|jpg|png';
		$config['max_size'] ='3000';
		$this->load->helper('file');
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$success = $this->upload->do_upload('poster');
		if(!$success)
		{
			print_r($this->upload->display_errors());
		}
		else
		{
			$image = $this->upload->data();
			$image_name = $image[file_name];
			
			
			//$this->load->model('Movie_Model');
			$this->Movie_Model->edit($id,$title,$year,$director,$image_name);
			
			redirect('/Movie/index/');	
		}
		
	
		
	}
}
