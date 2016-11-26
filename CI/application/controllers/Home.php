<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Home extends CI_Controller {
	public function __construct()
    {
                parent::__construct();
                $this->load->model('Kurio_Model');
                $this->load->database();
    }
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
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{

		//AMBIL DARI EXPLORE
		$link = "https://hack.kurio.co.id/v1/explore"; 
		$array_topic  = $this->curl($link);
		$i = 0;

		//PARSING DARI JSON YANG UDAH DIDECODE
		foreach($array_topic as $data)
		{
			foreach($data as $values)
			{
				foreach($values as $value)
				{
					$arrTopicName[$i] = $value['name'];
					$arrTopicId[$i] = $value['id'];
					$i++;
				}
			}
		}
		
		$i=0;
		$link = "https://hack.kurio.co.id/v1/feed/top_stories"; 
		$array_top  = $this->curl($link);

		//PARSING DARI JSON YANG UDAH DIDECODE
		//var_dump($array_top);
		foreach($array_top["data"] as $value)
		{
			$arrTopId[$i] = $value["id"];
			$arrTopTitle[$i] = $value["title"];
			$arrTopExcerpt[$i] = $value["excerpt"];
			$arrTopImg[$i] = $value["thumbnail"]["url"];
			$i++;
		}

		if(empty($this->session->flashdata('feedId'))){
			$this->getDetails("127");
		}
		$data['TopicName'] = $arrTopicName;
		$data['TopicId'] = $arrTopicId;
		
		$data['topTopicId']=$arrTopId;
		$data['topTopicTitle']=$arrTopTitle;
		$data['topTopicExcerpt']=$arrTopExcerpt;
		$data['topTopicImg']=$arrTopImg;
		
		$data['style'] = $this->load->view('Include/style',NULL,TRUE);
		$data['script'] = $this->load->view('Include/script',NULL,TRUE);
		$data['navbar'] = $this->load->view('Template/navbar',NULL,TRUE);
		$data['footer'] = $this->load->view('Template/footer',NULL,TRUE);
		$data['header'] = $this->load->view('Template/header',NULL,TRUE);
		
		$this->load->view('Page/home',$data);
	}
	public function getDetails($id)
	{
		//AMBIL DARI FEED TOPIC ID

		$link = "https://hack.kurio.co.id/v1/feed/topic:".$id.""; 
		$array_details  = $this->curl($link);
		
		$i=0;
		foreach($array_details['data'] as $values)
		{
			$arrFeedId[$i] = $values['id'];
			$arrFeedTitle[$i] = $values['title'];
			$arrFeedExcerpt[$i] = $values['excerpt'];
			$arrFeedUrl[$i] = $values['url'];
			$arrFeedImg[$i] = $values['thumbnail']['url'];
			$i++;
		}
		$this->session->set_flashdata('feedId',$arrFeedId);
		$this->session->set_flashdata('feedTitle',$arrFeedTitle);
		$this->session->set_flashdata('feedExcerpt',$arrFeedExcerpt);
		$this->session->set_flashdata('feedUrl',$arrFeedUrl);
		$this->session->set_flashdata('feedImg',$arrFeedImg);

		redirect(base_url());
	} 
	public function curl($link)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,$link);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = [
    		'Accept:application/json',
			'X-Kurio-Client-ID:99',
			'X-Kurio-Client-Secret:S3VyaW9IYWNrYXRvbjIw',
			'X-OS:windows',
			'X-App-Version:1.0',
			'Content-Type:application/json',
			'Authorization:Bearer M1G6qRcD372I8aMfKzi2TLaBqNex6onKTXi6jIfM'
		];
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$json_string = curl_exec ($curl);
		$array = json_decode($json_string,true);
		curl_close($curl);
		return $array;
	}
	public function insert()
	{
		
		$username = $this->input->post('usernameRegister');
		$password = $this->input->post('passwordRegister');
		$firstname = $this->input->post('firstnameRegister');
		$lastname = $this->input->post('lastnameRegister');
		$job = $this->input->post('jobRegister');

		var_dump($username);
		var_dump($password);
		$this->Kurio_Model->insert($username,$password,$firstname,$lastname,$job);
			
		redirect(base_url());	
	
	}

}

