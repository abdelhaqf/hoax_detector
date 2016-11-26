<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Home extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['style'] = $this->load->view('Include/style',NULL,TRUE);
		$data['script'] = $this->load->view('Include/script',NULL,TRUE);
		$data['navbar'] = $this->load->view('Template/navbar',NULL,TRUE);
		$data['footer'] = $this->load->view('Template/footer',NULL,TRUE);
		$data['header'] = $this->load->view('Template/header',NULL,TRUE);

		$this->load->view('Page/home',$data);
	}
}
