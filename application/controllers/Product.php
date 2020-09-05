<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
	public function __construct(){
     parent::__construct();
     $this->load->model("Front_model");
  	}
public function index(){
    $page['title'] = "Product List";
    $page['page_name'] = "list";
    $page['page'] = "list";
    $filter = array(
      'category' =>'',
      'action' =>'',
       );
    $page['Allproducts'] = $this->Front_model->product_list($filter);
    $this->load->view('front/index', $page);
  }
}
