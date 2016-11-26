<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Home extends CI_Controller {
	public function __construct()
    {
                parent::__construct();
                $this->load->model('Kurio_Model');
                $this->load->database();
				$this->load->library('session');
				
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
	public function article($id){
		$i=0;
		$link = "https://hack.kurio.co.id/v1/article/".$id; 
		$array_top  = $this->curl($link);

		$arrTitle[$i] = $array_top["title"];
		$arrText[$i] = $array_top["content"][1]["text"];
		
	

		$data['title'] = $arrTitle[0];
		$data['text'] = $arrText[0];
		$verif="unVerified";
		if($this->resultGoogle(substr($arrTitle[0],0,70) ))$verif="Verified";
		$data['verif'] = $verif;

		$data['style'] = $this->load->view('Include/style',NULL,TRUE);
		$data['script'] = $this->load->view('Include/script',NULL,TRUE);
		$data['navbar'] = $this->load->view('Template/navbar',NULL,TRUE);
		$data['footer'] = $this->load->view('Template/footer',NULL,TRUE);
		$data['header'] = $this->load->view('Template/header',NULL,TRUE);
		
		$this->load->view('Page/article',$data);
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
	function resultGoogle($url){
	
	require_once('simple_html_dom.php');
	$url_en = str_replace(' ','+',$url);

	$html = file_get_html('https://www.google.com/search?q=allintitle:'.$url_en.'&filter=0');


	// Find all images
	$result = $html->find('div[id="resultStats"]',0);
	$res = intval(filter_var($result->innertext,FILTER_SANITIZE_NUMBER_INT));
	echo $res;
	//die;
	if($res>=3)
		return True;
	else
		return False;
	}
	public function login()
	{
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');

		$query = $this->Kurio_Model->login($user,$pass);
		$rows = $query->row();

		$query2 = $this->Kurio_Model->getvote($rows->username);
		$rows2 = $query2->result();
		$help=array();
		$idx=0;
		foreach($rows2 as $r){
			$help[$idx++]=intval($r->article_id);
		} 

		$data = array(
			'username' => $rows->username,
			'verified_status' => $rows->verified_status,
			'points' => $rows->points,
			'job' => $rows->job,
			'votes'=>$help,
		);
		$this->session->set_userdata('logged_in',$data);

		redirect(base_url());
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function vote(){
		$sess = $this->session->userdata('logged_in');
		$x =  $this->uri->segment(3);
  		$voteType =  $this->uri->segment(4);

		$query = $this->Kurio_Model->checkvote($sess["username"],$x);
		if($query->num_rows()==0){
			$this->Kurio_Model->vote($sess["username"],$x,$voteType);

			$temp=$this->session->userdata('logged_in');
			array_push($temp['votes'], $x);
			$this->session->set_userdata('logged_in',$temp);
		}
		redirect(base_url());
	}
	public function test()
	{
		echo'aa';
	}


}

