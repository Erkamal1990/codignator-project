<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
	parent::__construct();
		$this->load->model("Admin_model");
		date_default_timezone_set('Asia/Kolkata');
	}
		public function index()	{
		if($this->session->userdata('login_id')){
			redirect(base_url().'admin/dashboard','refresh');
		}else{
			$page['title'] = "Login";
			$page['page_name'] = "login";
			$page['page'] = "login";
			$this->load->view('admin/login', $page);
		}
	}
	public function dashboard(){
		if($this->session->userdata('login_id') == ""){
			redirect(base_url().'admin/login','refresh');
			}else {
			$page['title'] = "Dashboard";
			$page['page_name'] = "dashboard";
			$page['page'] = "dashboard";
			$this->load->view('admin/index',$page);
		}
	}
	public function login(){
		$post = $this->input->post();
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$adminVarify = $this->db->get_where('admin',array('email'=>$email,'password'=>$password));
		if($adminVarify->num_rows() == 1){
			$admin = $adminVarify->row_array();
			$this->session->set_userdata('admin_login',1);
			$this->session->set_userdata('login_id',$admin['userid']);
			$this->session->set_userdata('login_name',$admin['uname']);
			redirect(base_url().'admin/dashboard','refresh');
		} else {
			$this->session->set_flashdata('error','Sorry, Please enter correct email and password !!');
			redirect(base_url().'admin/index','refresh');
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'admin/','refresh');
	}
	// Catagory Module START
	public function category($action){
		if($this->session->userdata('login_id') == ""){
		redirect(base_url().'admin/login','refresh');
		}else {
			if($action == 'add'){
					$post = $this->input->post();
					if($post['name'] != ''){
						$data = array('name' =>$post['name'] , );
						$results = $this->Admin_model->add_category($data);
						$message = $results['message'];
				$this->session->set_flashdata('message', $message);
					}
				$page['title'] = "Add Category";
				$page['page_name'] = "category/add";
				$page['page'] = "category/add";
				$this->load->view('admin/index',$page);
			}else if($action == 'list'){
					$catList = $this->db->get_where('categories')->result_array();
					$page['title'] = "Category List";
				$page['page_name'] = "category/list";
				$page['page'] = "category/list";
				$page['categorylist'] = $catList;
				$this->load->view('admin/index',$page);
			}else if($action == 'edit'){
				$id = $this->uri->segment(4);
				$post = $this->input->post();
				if(!empty($id)){
					if($post['name'] != ''){
						$data = array('name' =>$post['name'],'status' =>$post['status'], 'category_id'=>$id);
						$results = $this->Admin_model->update_category($data);
						$message = $results['message'];
	$this->session->set_flashdata('message', $message);
					}
							$categoryData			  = $this->db->get_where("categories",array("category_id"=>$id))->row_array();
							$page['title'] 			= "Category Update";
				$page['page_name']  = "category/edit";
							$page['page'] 			= "category/edit";
							$page['data'] 			= $categoryData;
			$this->load->view('admin/index',$page);
			}else{
				redirect(base_url().'admin/category/list','refresh');
			}
			}else if($action == 'delete'){
						$id = $this->uri->segment(4);
						if(!empty($id)){
							$this->db->where('category_id', $id);
					$this->db->delete('categories');
					$this->session->set_flashdata('message', 'Category successfully deleted!');
					redirect(base_url().'admin/category/list','refresh');
						}else{
							redirect(base_url().'admin/category/list','refresh');
						}
			}else{
				redirect(base_url().'admin/dashboard','refresh');
			}
		}
	}
// Catagory Module END
// Product Module START
	public function product($action){
		if($this->session->userdata('login_id') == ""){
		redirect(base_url().'admin/login','refresh');
		}else {
			if($action == 'add'){
					$post = $this->input->post();
					if($post['name'] != ''){
							if($post['price']!=''){
								if($post['category']!=''){
									$targetfolder = FCPATH."uploads/product/";
									if($_FILES['product_img']['name']!=''){
									$imageName = time()."_".basename($_FILES['product_img']['name']);
									$fileTarget = $targetfolder.$imageName;
									move_uploaded_file($_FILES['product_img']['tmp_name'], $fileTarget);
									$imageFile = str_replace(" ", "_", $imageName);
									}else{
										$imageFile = '';
									}
									$data = array(
												'name'     				=>$post['name'],
											  'price'    				=>$post['price'],
										    'cat_id' 			    =>$post['category'],
										    'status' 			    =>$post['status'],
											   'image'    			=>$imageFile,
								  );
								$results = $this->Admin_model->add_product($data);
								$message = $results['message'];
							  $this->session->set_flashdata('message', $message);
							  redirect(base_url().'admin/product/list','refresh');
					   }
						}
					}
				$catList = $this->db->get_where('categories')->result_array();
				$page['title'] = "Add Product";
				$page['page_name'] = "product/add";
				$page['page'] = "product/add";
				$page['productlist'] = $catList;
				$this->load->view('admin/index',$page);
			}else if($action == 'list'){
					$productList = $this->db->get_where('products')->result_array();
					$page['title'] = "Product List";
					$page['page_name'] = "product/list";
					$page['page'] = "product/list";
					$page['productlist'] = $productList;
					$this->load->view('admin/index',$page);
			}else if($action == 'edit'){
				$id = $this->uri->segment(4);
				$post = $this->input->post();
				if(!empty($id)){
					if($post['name'] != ''){
							if($post['price']!=''){
								if($post['category']!=''){
									$data = array(
					                'product_id'     	=>$id,
								    'name'     			=>$post['name'],
						            'price'    			=>$post['price'],
							        'cat_id' 			=>$post['category'],
							        'status' 			=>$post['status'],
			                    );
									$targetfolder = FCPATH."uploads/product/";
									if($_FILES['product_img']['name']!=''){
									$imageName = time()."_".basename($_FILES['product_img']['name']);
									$fileTarget = $targetfolder.$imageName;
									move_uploaded_file($_FILES['product_img']['tmp_name'], $fileTarget);
									$imageFile = str_replace(" ", "_", $imageName);
									$data['image'] = $imageFile;
									}else{
										$data['image'] = '';
									}
							$results = $this->Admin_model->update_product($data);
							$message = $results['message'];
							$this->session->set_flashdata('message', $message);
							redirect(base_url().'admin/product/list','refresh');
							}
						}
					}
			$productData	 = $this->db->get_where("products",array("product_id"=>$id))->row_array();
					$page['title'] 	    = "Product Update";
				    $page['page_name']  = "product/edit";
					$page['page'] 	    = "product/edit";
					$page['data'] 	    = $productData;
					$page['catList'] 	= $this->db->get_where('categories')->result_array();
			        $this->load->view('admin/index',$page);
			}else{
				redirect(base_url().'admin/product/list','refresh');
			}
			}else if($action == 'delete'){
						$id = $this->uri->segment(4);
						if(!empty($id)){
							$this->db->where('product_id', $id);
							$this->db->delete('products');
							$this->session->set_flashdata('message', 'Product successfully deleted!');
							redirect(base_url().'admin/product/list','refresh');
						}else{
							redirect(base_url().'admin/product/list','refresh');
						}
			}else{
				redirect(base_url().'admin/dashboard','refresh');
			}
		}
	}
// Product Module END
// Catagory Module START
public function client($action){
		if($this->session->userdata('login_id') == ""){
		redirect(base_url().'admin/login','refresh');
		}else {
			if($action == 'add'){
					$post = $this->input->post();
					if($post['name'] != ''){
						$targetfolder = FCPATH."uploads/client/";
					if($_FILES['client_img']['name']!=''){
					$imageName = time()."_".basename($_FILES['client_img']['name']);
					$fileTarget = $targetfolder.$imageName;
					move_uploaded_file($_FILES['client_img']['tmp_name'], $fileTarget);
					$imageFile = str_replace(" ", "_", $imageName);
					}
						$data = array(
							'name' =>$post['name'],
							'image_url' =>$imageFile,
						);
						$results = $this->Admin_model->add_client($data);
						$message = $results['message'];
				$this->session->set_flashdata('message', $message);
				redirect(base_url().'admin/client/list','refresh');
					}
				$page['title'] = "Add Client";
				$page['page_name'] = "client/add";
				$page['page'] = "client/add";
				$this->load->view('admin/index',$page);
			}else if($action == 'list'){
					$clientList = $this->db->get_where('clients')->result_array();
					$page['title'] = "Client List";
				$page['page_name'] = "Client/list";
				$page['page'] = "client/list";
				$page['clientlist'] = $clientList;
				$this->load->view('admin/index',$page);
			}else if($action == 'edit'){
				$id = $this->uri->segment(4);
				$post = $this->input->post();
				if(!empty($id)){
					if($post['name'] != ''){
						$targetfolder = FCPATH."uploads/client/";
					if($_FILES['client_img']['name']!=''){
					$imageName = time()."_".basename($_FILES['client_img']['name']);
					$fileTarget = $targetfolder.$imageName;
					move_uploaded_file($_FILES['client_img']['tmp_name'], $fileTarget);
					$imageFile = str_replace(" ", "_", $imageName);
					}else{
						$imageFile = '';
					}
						$data = array(
							'name' =>$post['name'],
							'status' =>$post['status'],
							'img_id'=>$id,
							'image'=>$imageFile != "" ? $imageFile :'',
							);
						$results = $this->Admin_model->update_client($data);
						$message = $results['message'];
						$this->session->set_flashdata('message', $message);
					}
				$clientData = $this->db->get_where("clients",array("img_id"=>$id))->row_array();
				$page['title'] 			= "Client Update";
				$page['page_name']  = "client/edit";
				$page['page'] 			= "client/edit";
				$page['data'] 			= $clientData;
			$this->load->view('admin/index',$page);
			}else{
				redirect(base_url().'admin/client/list','refresh');
			}
			}else if($action == 'delete'){
						$id = $this->uri->segment(4);
						if(!empty($id)){
							$this->db->where('img_id', $id);
					$this->db->delete('clients');
					$this->session->set_flashdata('message', 'client successfully deleted!');
					redirect(base_url().'admin/client/list','refresh');
						}else{
							redirect(base_url().'admin/client/list','refresh');
						}
			}else{
				redirect(base_url().'admin/dashboard','refresh');
			}
		}
	}
// Catagory Module END
// Catagory Module START
public function setting($action){
		if($this->session->userdata('login_id') == ""){
		redirect(base_url().'admin/login','refresh');
		}else {
			if($action == 'add'){
					$post = $this->input->post();
					if($post['name'] != ''){
						$targetfolder = FCPATH."uploads/setting/";
					if($_FILES['setting_img']['name']!=''){
						$imageName = time()."_".basename($_FILES['setting_img']['name']);
						$fileTarget = $targetfolder.$imageName;
						move_uploaded_file($_FILES['setting_img']['tmp_name'], $fileTarget);
						$imageFile = str_replace(" ", "_", $imageName);
					}
						$data = array(
							'name' =>$post['name'],
							'value' =>$post['value'],
							'image' =>$imageFile,
						);
						$results = $this->Admin_model->add_setting($data);
						$message = $results['message'];
				        $this->session->set_flashdata('message', $message);
				        redirect(base_url().'admin/setting/list','refresh');
					}
				$page['title'] = "Add Setting";
				$page['page_name'] = "settings/add";
				$page['page'] = "settings/add";
				$this->load->view('admin/index',$page);
			}else if($action == 'list'){
					$settingList = $this->db->get_where('settings')->result_array();
					$page['title'] = "Setting List";
				$page['page_name'] = "settings/list";
				$page['page'] = "settings/list";
				$page['settinglist'] = $settingList;
				$this->load->view('admin/index',$page);
			}else if($action == 'edit'){
				$id = $this->uri->segment(4);
				$post = $this->input->post();
				if(!empty($id)){
					if($post['value'] != ''){
						$targetfolder = FCPATH."uploads/setting/";
					if($_FILES['setting_img']['name']!=''){
					$imageName = time()."_".basename($_FILES['setting_img']['name']);
					$fileTarget = $targetfolder.$imageName;
					move_uploaded_file($_FILES['setting_img']['tmp_name'], $fileTarget);
					$imageFile = str_replace(" ", "_", $imageName);
					}else{
						$imageFile = '';
					}
						$data = array(
							'value' =>$post['value'],
							'status' =>$post['status'],
							'id'=>$id,
							'image'=>$imageFile != "" ? $imageFile :'',
							);
						$results = $this->Admin_model->update_setting($data);
						$message = $results['message'];
						$this->session->set_flashdata('message', $message);
					}
				$settingData = $this->db->get_where("settings",array("id"=>$id))->row_array();
				$page['title'] 			= "Setting Update";
				$page['page_name']  = "settings/edit";
				$page['page'] 			= "settings/edit";
				$page['data'] 			= $settingData;
			$this->load->view('admin/index',$page);
			}else{
				redirect(base_url().'admin/setting/list','refresh');
			}
			}else if($action == 'delete'){
						$id = $this->uri->segment(4);
						if(!empty($id)){
							$this->db->where('id', $id);
					$this->db->delete('settings');
					$this->session->set_flashdata('message', 'setting successfully deleted!');
					redirect(base_url().'admin/setting/list','refresh');
						}else{
							redirect(base_url().'admin/setting/list','refresh');
						}
			}else{
				redirect(base_url().'admin/dashboard','refresh');
			}
		}
	}
// Catagory Module END
// Catagory Module END
	// Product Module START
public function slider($action){
		if($this->session->userdata('login_id') == ""){
		redirect(base_url().'admin/login','refresh');
		}else {
			if($action == 'add'){
					$post = $this->input->post();
					if(trim($post['description']) != ''){
									$targetfolder = FCPATH."uploads/setting/";
									if($_FILES['banner_img']['name']!=''){
										$imageName = time()."_".basename($_FILES['banner_img']['name']);
										$fileTarget = $targetfolder.$imageName;
										move_uploaded_file($_FILES['banner_img']['tmp_name'], $fileTarget);
										$imageFile = str_replace(" ", "_", $imageName);
									}else{
										$imageFile = '';
									}
					$data = array(
								'description' =>trim($post['description']),
								'url'         =>$post['url'],
								'image'    		=>$imageFile,
				  );
				  $results = $this->Admin_model->add_slider($data);
					$message = $results['message'];
					$this->session->set_flashdata('message', $message);
					redirect(base_url().'admin/slider/list','refresh');
					}
				$page['title'] = "Add Slider";
				$page['page_name'] = "slider/add";
				$page['page'] = "slider/add";
				$this->load->view('admin/index',$page);
			}else if($action == 'list'){
					$sliderList = $this->db->get_where('slider')->result_array();
					$page['title'] = "Slider List";
				$page['page_name'] = "slider/list";
				$page['page'] = "slider/list";
				$page['sliderlist'] = $sliderList;
				$this->load->view('admin/index',$page);
			}else if($action == 'edit'){
				$id = $this->uri->segment(4);
				$post = $this->input->post();
				if(!empty($id)){
					$targetfolder = FCPATH."uploads/setting/";
					if($_FILES['banner_img']['name']!=''){
					$imageName = time()."_".basename($_FILES['banner_img']['name']);
					$fileTarget = $targetfolder.$imageName;
					move_uploaded_file($_FILES['banner_img']['tmp_name'], $fileTarget);
					$imageFile = str_replace(" ", "_", $imageName);
					$data['image'] = $imageFile;
					}else{
						$data['image'] = '';
					}
					if(trim($post['description']) != ''){
							$data = array(
					       'slider_id'  =>$id,
								 'description' =>trim($post['description']),
								 'url'     	=>$post['url'],
							   'status' 		=>$post['status'],
							   'image' 		=>$imageFile != "" ? $imageFile :'',
			     );

						$results = $this->Admin_model->update_slider($data);
						$message = $results['message'];
					$this->session->set_flashdata('message', $message);
					redirect(base_url().'admin/slider/list','refresh');
					}
			$sliderData			  = $this->db->get_where("slider",array("slider_id"=>$id))->row_array();
					$page['title'] 	    = "Slider Update";
				$page['page_name']  = "slider/edit";
					$page['page'] 	    = "slider/edit";
					$page['data'] 	    = $sliderData;
			$this->load->view('admin/index',$page);
			}else{
				redirect(base_url().'admin/slider/list','refresh');
			}
			}else if($action == 'delete'){
						$id = $this->uri->segment(4);
						if(!empty($id)){
							$this->db->where('slider_id', $id);
					$this->db->delete('slider');
					$this->session->set_flashdata('message', 'Slider successfully deleted!');
					redirect(base_url().'admin/slider/list','refresh');
						}else{
							redirect(base_url().'admin/slider/list','refresh');
						}
			}else{
				redirect(base_url().'admin/dashboard','refresh');
			}
		}
	}
}