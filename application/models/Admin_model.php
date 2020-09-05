<?php
Class Admin_model extends CI_Model {
	public function user_Details($email) {
		function __construct()
	    {
	        parent::__construct();
	    }
	}
	public function checkjson(&$json)
	   {
	      $json = json_decode($json);
	      return (json_last_error() === JSON_ERROR_NONE);
	   }
	public function getProductById($product_id){
      $product = $this->db->get_where("products", array("product_id" => $product_id))->row_array();
      if(!empty($product)){
         $result['product_id']   = $product_id;
         $result['title']        = $product['name'];
         $result['price']        = $product['price'];
         $result['image']        = $product['image'] ? base_url().'uploads/product/'.$product['image'] : '';
         return $result;
      }
      else{
         return false;
      }
  }
	public function add_category($data){
		$data['name'] = $data['name'];
		$chackName = $this->db->get_where('categories',array('name'=>$data['name']))->row_array();
	    if($chackName == 0){      
	      $data['timestamp'] = time();
	      $insert = $this->db->insert('categories',$data);
	      if($insert){
	        $response_data = array('success'=>1,'message'=>'Category successfully created!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }
	    }else{
	      $response_data = array('success'=>0,'message'=>'Category name already exist.');
	    }
	      return $response_data; 
	}
	public function update_category($data){
	    $chackName = $this->db->get_where('categories',array('name'=>$data['name']))->row_array();
	    if($chackName == 0){      
	      $set_data['name'] = $data['name'];
	    }else{
	      $response_data = array('success'=>0,'message'=>'Category name already exist.');
	    }   
	    $set_data['status']   = $data['status'];
	      $this->db->where('category_id', $data['category_id']);
	      $update = $this->db->update('categories', $set_data);
	      if($update){
	        $response_data = array('success'=>1,'message'=>'Category successfully updated!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }
	      return $response_data; 
	  }
	public function add_product($data){
		$chackName = $this->db->get_where('products',array('name'=>$data['name']))->row_array();
	    if($chackName == 0){      
	      $data['created_at'] = time();
	      $product_slug = strtolower($data['name']);
	      $insert = $this->db->insert('products',$data);
	      $insertid = $this->db->insert_id();
	      if($insert){
	        $response_data = array('success'=>1,'message'=>'Product successfully insert!','insert_id'=>$insertid);
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }
	    }else{
	      $response_data = array('success'=>0,'message'=>'Product name already exist.');
	    }
	      return $response_data; 
	}

	public function update_product($data){
		    $chackName = $this->db->get_where('products',array('name'=>$data['name']))->row_array();
		    if($chackName == 0){      
		      $set_data['name'] = $data['name'];
		    }else{
		      $response_data = array('success'=>0,'message'=>'Product name already exist.');
		    }   
		    if($data['image']!=''){
		    	$set_data['image']  = $data['image'];
		    	$imageName = $this->db->get_where("products",array("product_id"=>$data['product_id']))->row_array();
				$galleryfolder = FCPATH."uploads/product/";
				unlink($galleryfolder . $imageName['image']);
		    }
		    $set_data['price'] 		     = $data['price'];
		    $set_data['cat_id']     	 = $data['cat_id'];
		    $set_data['status'] 		 = $data['status'];
		    $this->db->where('product_id', $data['product_id']);
	      $update = $this->db->update('products', $set_data);
	      if($update){
	        $response_data = array('success'=>1,'message'=>'Product successfully updated!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }
	      return $response_data; 
	  }

	public function add_client($data){
	      $data['timestamp'] = time();
	      $insert = $this->db->insert('clients',$data);
	      if($insert){
	        $response_data = array('success'=>1,'message'=>'Client successfully insert!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }

	      return $response_data; 
	}
	public function update_client($data){   
		    if($data['image']!=''){
		    	$set_data['image_url']  = $data['image'];
		    	$imageName = $this->db->get_where("clients",array("img_id"=>$data['img_id']))->row_array();
				$galleryfolder = FCPATH."uploads/client/";
				unlink($galleryfolder . $imageName['image_url']);
		    }
		    $set_data['name'] 		 = $data['name'];
		    $set_data['status'] 		 = $data['status'];
		    $this->db->where('img_id', $data['img_id']);
	      $update = $this->db->update('clients', $set_data);
	      if($update){
	        $response_data = array('success'=>1,'message'=>'Client successfully updated!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }
	      return $response_data; 
	  }
	public function add_setting($data){
	      $data['timestamp'] = time();
	      $insert = $this->db->insert('settings',$data);
	      if($insert){
	        $response_data = array('success'=>1,'message'=>'setting successfully insert!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }

	      return $response_data; 
	}
	public function update_setting($data){   
	    if($data['image']!=''){
	    	$set_data['image']  = $data['image'];
	    	$imageName = $this->db->get_where("settings",array("id"=>$data['id']))->row_array();
			$galleryfolder = FCPATH."uploads/setting/";
			unlink($galleryfolder . $imageName['image']);
	    }
	    $set_data['value'] 		 = $data['value'];
	    $set_data['status'] 	 = $data['status'];
	    $this->db->where('id', $data['id']);
      $update = $this->db->update('settings', $set_data);
      if($update){
        $response_data = array('success'=>1,'message'=>'Settings successfully updated!');
      }else{
         $response_data = array('success'=>0,'message'=>'Please try again.');
      }
      return $response_data; 
  }
  public function add_slider($data){
  	//var_dump($data); die;
	      $insert = $this->db->insert('slider',$data);
	      if($insert){
	        $response_data = array('success'=>1,'message'=>'slider successfully insert!');
	      }else{
	         $response_data = array('success'=>0,'message'=>'Please try again.');
	      }

	      return $response_data; 
	}
	public function update_slider($data){   
	    if($data['image']!=''){
	    	$set_data['image']  = $data['image'];
	    	$imageName = $this->db->get_where("slider",array("slider_id"=>$data['slider_id']))->row_array();
			$galleryfolder = FCPATH."uploads/setting/";
			unlink($galleryfolder . $imageName['image']);
	    }
	    $set_data['description'] = $data['description'];
	    $set_data['url'] 		 = $data['url'];
	    $set_data['status'] 	 = $data['status'];
	    $this->db->where('slider_id', $data['slider_id']);
      $update = $this->db->update('slider', $set_data);
      if($update){
        $response_data = array('success'=>1,'message'=>'slider successfully updated!');
      }else{
         $response_data = array('success'=>0,'message'=>'Please try again.');
      }
      return $response_data; 
  }
}
?>