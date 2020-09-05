<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
		$this->load->helper('path');
    }
  public function product_list($productData){
    $this->db->select('products.*,categories.category_id, categories.name as cat_name');
    $this->db->from('products');
    $this->db->join('categories', 'products.cat_id = categories.category_id'); 
    $this->db->where('products.status', 1);
    if($productData['category']!=''){
      $this->db->where('categories.name', trim($productData['category']));
    }
    $query = $this->db->get();
    $products = $query->result_array();
    // echo $this->db->last_query(); die;
    $count = 0;
    foreach ($products as $list) {
      $data[$count]['product_id']     = $list['product_id'];
      $data[$count]['name']           = $list['name'];
      $data[$count]['price']          = $list['price'];
      $data[$count]['image']          = $list['image'] !=''?base_url().'uploads/product/'.$list['image']:'';
      $data[$count]['description']   = $list['description'];
      $data[$count]['category_id']    = $list['category_id'];
      $data[$count]['category']       = strtolower($list['cat_name']);
      $data[$count]['created_date']   = date("d-m-Y H:i:s", strtotime($list['created_at']));
      $count++;
    }
    return $data;
  }
}
