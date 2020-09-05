<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("Admin_model");
		$postJson = file_get_contents("php://input");
		if($this->Admin_model->checkjson($postJson)){
		     $_POST = json_decode(file_get_contents("php://input"), true);
			if ($_POST['from_app'] == "true") { 

			} else {
				$_POST = json_decode(file_get_contents("php://input"), true);
			}
		}
		/* Getting Access Token */
		//YzMxYjMyMzY0Y2UxOWNhOGZjZDE1MGE0MTdlY2NlNTg=
		$accessToken = base64_encode(md5("android"));
		$accessKey = $this->input->post("apiId");

		if (empty($accessKey)) {
			$response['success'] = 0;
			$response['message'] = "Failed to authenticate request.";
			echo json_encode($response);
			exit;
		} else {
			if ($accessKey != $accessToken) {
				$response['success'] = 0;
				$response['message'] = "Failed to authenticate request.";
				echo json_encode($response);
				exit;
			}
		}

		header("Access-Control-Allow-Headers: Authorization, Content-Type");
		header("Access-Control-Allow-Origin: *");
		header('content-type: application/json; charset=utf-8');
		
		date_default_timezone_set('Asia/Kolkata');
		$this->db->query('SET SESSION time_zone = "+05:30"');
		$this->db->query("SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'");
	}
	public function product_list(){
		$post = $this->input->post();
		if($post['page'] || !empty($post['page']) || $post['limit'] || !empty($post['limit'])){
			$curpage = $post['page'];
			$limit = $post['limit'];
			$search  = $post['q'];
		}else{
			$curpage = 1;
			$search  = $post['q'];
			$limit = 20;
		}

		$start      = ($curpage * $limit) - $limit;
		$users   	= $this->db->get('products');
		$totlerec   = $users->num_rows();
		$endpage    = ceil($totlerec/$limit);
		$startpage  = 1;
		$nextpage   = $curpage + 1;
		$prevpage   = $curpage - 1;

		if($search == ""){
			$DisplayLimit = " limit ".$start.",".$limit;
		}

		$cond = "";

		if($search != ""){
			$cond .= " and (name like '%".$search."%') ";
		}

		$products = $this->db->query("select SQL_CALC_FOUND_ROWS * from products where 1=1 ".$cond." order by product_id DESC".$DisplayLimit)->result_array();
			$query = $this->db->query('SELECT FOUND_ROWS() as myCounter');
			$iFilteredTotal = $query->row()->myCounter;

		$count = 0;
		if(!empty($products)){
			foreach($products as $product){
				$response['product'][$count]['product_id'] = ($product['product_id']) ? $product['product_id'] : "";
				$response['product'][$count]['title'] = ($product['name']) ? $product['name'] : "";
				$response['product'][$count]['image'] = $product['image'] ? base_url().'uploads/product/'.$product['image'] : '';
				$response['product'][$count]['price'] = $product['price'];
				$count++;
			}
			$response['count'] = $iFilteredTotal;
			$response['success'] = 1;
		}else{
			$response['message'] = "No product found";
			$response['success'] = 0;
		}
		
		echo json_encode($response);
	}
	public function product_details(){
		$post = $this->input->post();
		if(isset($post['product_id']) && $post['product_id']){
				$results = $this->Admin_model->getProductById($post['product_id']);
				if($results){
					$response['message'] = "";
					$response['success'] = 1;
					$response['product'] = $results;

				}
				else{
					$response['message'] = "No product found.";
					$response['success'] = 0;
				}
		}
			else{
			$response['message'] = "Product id can not be blank.";
			$response['success'] = 0;
		}

		echo json_encode($response);
	}
}
