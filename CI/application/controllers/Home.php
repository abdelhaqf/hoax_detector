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
					$this->load->model('Compare_Model');
				
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

			$persentage = $this->getPersentage($arrTopId[$i]);
			if($persentage>50) $arrTopPersentage[$i] ="<font color='green'>".$persentage."%</font>";
			else $arrTopPersentage[$i] ="<font color='red'>".$persentage."%</font>";

			$i++;
		}
		for($j=0;$j<$i;$j++){
				for($k=1;$k<$i;$k++)
				{
					$arrTopCompare[$j]="<font color='green'>Dicurigai tidak memiliki kesamaan gambar dengan artikel lain</font>";
					if($j!=$k)
					{
						$cla = new $this->Compare_Model;
						$number = $cla->compare($arrTopImg[$j],$arrTopImg[$k]);
						if($number>20){$arrTopCompare[$j]="<font color='red'>Dicurigai memiliki kesamaan gambar dengan artikel lain</font>";
						break;}
					}
				}
		}
		if(empty($this->session->flashdata('feedId'))){
			$this->getDetails("127");
		}
		$query = $this->Kurio_Model->selectMaxPoints();
		$result = $query->result();
		$ctr = 0 ;
		foreach($result as $line)
		{
			$arrVerifiedUser[$ctr++] = $line->username;
			$arrVerifiedVote[$ctr++] = $line->vote;
		}



		$data['VerifiedUser'] = $arrVerifiedUser;
		$data['TopicName'] = $arrTopicName;
		$data['TopicId'] = $arrTopicId;
		
		$data['topTopicId']=$arrTopId;
		$data['topTopicTitle']=$arrTopTitle;
		$data['topTopicExcerpt']=$arrTopExcerpt;
		$data['topTopicImg']=$arrTopImg;
		$data['topPersentage']=$arrTopPersentage;
		$data['topTopicCompare']=$arrTopCompare;

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
			$persentage = $this->getPersentage($arrFeedId[$i]);
			if($persentage>50) $arrFeedPersentage[$i] ="<font color='green'>".$persentage."%</font>";
			else $arrFeedPersentage[$i] ="<font color='red'>".$persentage."%</font>";
			
			$i++;
		}
		$this->session->set_flashdata('feedId',$arrFeedId);
		$this->session->set_flashdata('feedTitle',$arrFeedTitle);
		$this->session->set_flashdata('feedExcerpt',$arrFeedExcerpt);
		$this->session->set_flashdata('feedUrl',$arrFeedUrl);
		$this->session->set_flashdata('feedImg',$arrFeedImg);
		$this->session->set_flashdata('feedPersentage',$arrFeedPersentage);

		redirect(base_url());
	} 
	public function getPersentage($id){
			$noHoax = $this->Kurio_Model->selectNoHoax($id);
			$rowsNoHoax = $noHoax->num_rows();
	//		foreach ($rowsNoHoax as $row) {
	//			if($row!=null)$totalNoHoax = $row;
	//			else $totalNoHoax = 0;
	//		}
			$hoax = $this->Kurio_Model->selectHoax($id);
			$rowsHoax = $hoax->num_rows();
	//		foreach ($rowsHoax as $row) {
	//			if($row!=null)$totalHoax = $row;
	//			else $totalHoax = 0;
	//		}
			$total = 0;
			$totalIntHoax = 0 ;
			$totalIntNoHoax = 0;
		//	$totalIntNoHoax = intval($totalNoHoax);
		//	$totalIntHoax = intval($totalHoax);
		//	$total = $totalIntNoHoax + $totalIntHoax;
			$total = $rowsHoax + $rowsNoHoax;
			if($total!=0)$persentage = ($rowsNoHoax / $total)*100;
			else $persentage=0;
			return $persentage;
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
	/*	$i=0;
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
		
		$this->load->view('Page/article',$data);*/
		$i=0;
		$link = "https://hack.kurio.co.id/v1/article/".$id; 
		$array_top  = $this->curl($link);

		$arrTitle[$i] = $array_top["title"];
		$arrText[$i] = $array_top["content"][1]["text"];
		
	

		$data['title'] = $arrTitle[0];
		$data['text'] = $arrText[0];
		$verif="<font color='red'>unVerified</font>";
		$titleFull = substr($arrTitle[0],0,70);
		$realTitle="";

		if((substr($titleFull,66,1))!=" "){
			$arrTitle = explode(" ",substr($titleFull,0,66));
			$realTitle = $arrTitle[0];
			$count = count($arrTitle)-1;
			for($i = 1 ; $i < $count ;$i++)
			{
				$realTitle=$realTitle.' '.$arrTitle[$i];
			}
			if($this->resultGoogle($realTitle))$verif="<font color='green'>Verified</font>";
		}
		else if($this->resultGoogle(substr($arrTitle[0],0,70)))$verif="<font color='green'>Verified</font>";
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
		//redirect(base_url());

			$persentage = $this->getPersentage($x);
			if($persentage>50) echo "<font color='green'>".$persentage."%</font>";
			else echo "<font color='red'>".$persentage."%</font>";
		return "ok";
	}
	public function test()
	{
		echo'aa';
	}


}

