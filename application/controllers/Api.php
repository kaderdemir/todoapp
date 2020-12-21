<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public $data = [];

	public $working_time = 45;

	public $providers = [

		[
			"provider_name" => "Provider 1",
			"url" => "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa",
			"defines" => array("title" => "id","time" => "sure","difficulty" => "zorluk")
		],

		[
			"provider_name" => "Provider 2",
			"url" => "https://run.mocky.io/v3/815f2d5c-a253-47bb-8819-9535f82baf34",
			"defines" => array("title" => "title","time" => "estimated_duration","difficulty" => "level")
		],

//        [
//        "provider_name" => "Provider 3",
//        "url" => "https://next.json-generator.com/api/json/get/VJHAErvhY?indent=2",
//        "defines" => array("title" => "task_name","time" => "estimated_duration","difficulty" => "level")
//        ]
	];    

	function __construct()
	{ 
		parent::__construct();

		$this->load->model("todo","todo"); 

		$function = $_GET["func"];
		$this->$function(); 
	}

	public function index()
	{

	}

	public function insertProvider($data) {
		try { 
			@$this->todo->insertProvider($data);
			echo true;
		}
		catch (Exception $e){
			$pdo->rollback();
			throw $e;
		} 
	}

	public function getDevelopers()
	{
		$dev = $_GET["dev"];

		$result = $this->todo->getDeveloper($dev);

		if (empty($result)) {
			echo "false";
			exit();
		}

		$works = [];
		$work = [];
		$start = 0; 
		$sum = 0;
		$max = 45;

		foreach ($result as $key => $res) {
			$sum += $res->time;

			if ($sum <= $max) {

				array_push($work, $res); 

			}
			else {
				$works[$start] = $work;
				$work = [];
				$sum=0;
				$start++;
			} 
		}

		echo json_encode($works); 
	}

	public function calcDev()
	{
		$developers = $_GET["data"];
		$this->getDevelopers($developers);
	}

	public function getDevelop()
	{
		$developers = $this->todo->getDevelopers();
		echo json_encode($developers);
	}

	public function getProviders()
	{
		$providers = $this->todo->getProviders();
		echo json_encode($providers);
	}



	public function calcTime()
	{
		$task_total = 0;
		$developer_total = 0;
		$div = 0;

		$data = $_GET["data"];
		$providers = $this->todo->getProvidersData($data); 

		if (empty($providers)) {
			echo "false";
			exit();
		}

		$developers = $this->todo->getDevelopers();
		foreach ($providers as $key => $provider) {
			$task_total += $provider->difficulty*$provider->time;
		}
		 
		foreach ($developers as $key => $developer) {
			$developer_total += $developer->time * $developer->difficulty;
		}

		echo json_encode(array("total_hour" => $task_total / $developer_total,"total_week" => $task_total / $developer_total / $this->working_time));
		
	}

	public function getProvider($provider)
	{ 
		$providers = $this->todo->getProviders();
		print_r($providers);die();
	}

	public function curl($provider_url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $provider_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch); 
		curl_close($ch);

		return json_decode($response);
	}	

	public function getApiData() {
		try {
			foreach ($this->providers as $key => $provider) {
				$response = ($this->curl($provider["url"])); 

				foreach ($response as $key => $res) { 

					$difficulty = $provider["defines"]["difficulty"];
					$time = $provider["defines"]["time"];
					$title = $provider["defines"]["title"]; 

					$api_data = array(
						"difficulty" => $res->$difficulty,
						"title" => $res->$title,
						"time" => $res->$time,
						"provider_name" => $provider["provider_name"]);

					array_push($this->data, $api_data); 

				}
			}
			$this->insertProvider($this->data);  
		} catch (Exception $e) {
			echo "API ERRROR : $e";
			exit();
		}
	}
}
