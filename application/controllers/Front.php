<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
	function __construct() {
	   parent::__construct();
		 $this->load->model("Front_model");
		 date_default_timezone_set('Asia/Kolkata');
	}
	public function index()	{
		$page['title'] 		   = "Home";
		$page['page_name']   = "home";
		$page['page']        = "home";
		$filter = array(
          'category' =>'',
          'action' =>'',
         );
		$page['Allproducts'] = $this->Front_model->product_list($filter);
		$this->load->view('front/index', $page);
	}
}
