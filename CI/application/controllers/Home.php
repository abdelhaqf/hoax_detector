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

		//AMBIL DARI EXPLORE 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"https://hack.kurio.co.id/v1/explore");
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
		$array_topic = json_decode($json_string,true);

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
		
		$data['TopicName'] = $arrTopicName;
		$data['TopicId'] = $arrTopicId;
		

		$this->load->view('Page/home',$data);
	}
}
