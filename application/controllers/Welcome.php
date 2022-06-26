<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// Specific values
	public $product_image_path = 'assets/uploads/products/';
	private $table_product_images = 'product_images';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('string');
	}
	public function index()
	{
		$data['products'] = $this->db->query("SELECT p.id, p.product_name, p.product_price, p.product_desccription, GROUP_CONCAT(COALESCE(i.product_image) ORDER BY i.id) image FROM product p INNER JOIN product_images i ON i.product_id=p.id GROUP BY p.id, p.product_name")->result_array();
		// echo '<pre>';print_r($data['product']);die;
		// $data['products'] = $this->Model_common->getAllData('product');
		// $data['product_images'] = $this->Model_common->getAllData('product_images');
		// $this->load->view('product_showcase', $data);
		// echo function_to_tital(__FUNCTION__);die;
		$data['page_tital'] = (__FUNCTION__ === 'index' ? 'Home Page' : function_to_tital(__FUNCTION__));
		$data['html_file'] = 'product_showcase';
        $this->load->view('template', $data);
	}

	public function add_new_product_form_data()
	{
		try{
			if($this->form_validation->run('add_new_product_form_data') == FALSE){
				$errors = validation_errors();
				$res['error'] = $errors; 
				echo json_encode($res);
				// echo json_encode(['error'=>$errors]);
			}elseif(!empty($this->input->post('product_id'))){
				$tableName = 'product';				
				$id = $this->input->post('product_id');
				$arrayData = array(
					'product_name'         => $this->input->post('product_name'),   
					'product_price'        => $this->input->post('product_price'),    
					'product_desccription' => $this->input->post('product_desccription')
				);

				$result = $this->Model_common->updateData($tableName, $arrayData, array('id'=>$id));
				// $id = $this->db->insert_id();
				if($result === true){
					// Multipal product image uplaod
					if(!empty($_FILES['product_image']['name'][0])){
						for($i=0; $i < count($_FILES['product_image']['name']); $i++){
							$doc_type = 'product_image';
							// Get file data
							$_FILES['file']['name']     = $doc_type.'_'.date('YmdHis').$_FILES['product_image']['name'][$i];
							$_FILES['file']['type']     = $_FILES['product_image']['type'][$i]; 
							$_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i]; 
							$_FILES['file']['error']    = $_FILES['product_image']['error'][$i]; 
							$_FILES['file']['size']     = $_FILES['product_image']['size'][$i]; 
	
							$image = $_FILES['file'];
							$fileSubName = 'file';
							$uploadPath = 'assets/uploads/products/';
							$allowedTypes = 'gif|jpg|jpeg|png|pdf';
							// Upload Image on folder							
							// $doc_name = documentUploadWithNameHelper($image,$uploadPath,$allowedTypes,$fileSubName);
							$this->load->library(array('image_lib', 'upload'));
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = $allowedTypes;
							$this->upload->initialize($config);
							if ($this->upload->do_upload($fileSubName)) {
								$imageName = $this->upload->data();									
							} else {
								echo $this->upload->display_errors();
							}
							// documentUploadWithNameHelper($document, $uploadPath, $allowedTypes, $documentName)
							// array data to insert on recipe iamge table
							$doc_data = array(
								'product_id' => $id,
								'product_image' => $imageName['file_name']
							);
							$this->Model_common->insertData('product_images',$doc_data);
						}
					}

					$this->session->set_flashdata('success','Product details updated successfully.');
					$res['redirect'] = 'welcome';
					echo json_encode($res);
				}else{
					$this->session->set_flashdata('error','Something worng. Try again');
					$res['redirect'] = 'welcome';
					echo json_encode($res);
				}
			}else{
				$tableName = 'product';				

				$arrayData = array(
					'product_name'         => $this->input->post('product_name'),   
					'product_price'        => $this->input->post('product_price'),    
					'product_desccription' => $this->input->post('product_desccription')
				);

				$result = $this->Model_common->insertData($tableName, $arrayData);
				$id = $this->db->insert_id();
				if($result === true){
					// Multipal product image uplaod
					if(!empty($_FILES['product_image']['name'][0])){
						for($i=0; $i < count($_FILES['product_image']['name']); $i++){
							$doc_type = 'product_image';
							// Get file data
							$_FILES['file']['name']     = $doc_type.'_'.date('YmdHis').$_FILES['product_image']['name'][$i];
							$_FILES['file']['type']     = $_FILES['product_image']['type'][$i]; 
							$_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i]; 
							$_FILES['file']['error']    = $_FILES['product_image']['error'][$i]; 
							$_FILES['file']['size']     = $_FILES['product_image']['size'][$i]; 
	
							$image = $_FILES['file'];
							$fileSubName = 'file';
							$uploadPath = 'assets/uploads/products/';
							$allowedTypes = 'gif|jpg|jpeg|png|pdf';
							// Upload Image on folder							
							// $doc_name = documentUploadWithNameHelper($image,$uploadPath,$allowedTypes,$fileSubName);
							$this->load->library(array('image_lib', 'upload'));
							$config['upload_path'] = $uploadPath;
							$config['allowed_types'] = $allowedTypes;
							$this->upload->initialize($config);
							if ($this->upload->do_upload($fileSubName)) {
								$imageName = $this->upload->data();									
							} else {
								echo $this->upload->display_errors();
							}
							// documentUploadWithNameHelper($document, $uploadPath, $allowedTypes, $documentName)
							// array data to insert on recipe iamge table
							$doc_data = array(
								'product_id' => $id,
								'product_image' => $imageName['file_name']
							);
							$this->Model_common->insertData('product_images',$doc_data);
						}
					}

					$this->session->set_flashdata('success','New product added successfully.');
					$res['redirect'] = 'welcome';
					echo json_encode($res);
				}else{
					$this->session->set_flashdata('error','Something worng. Try again');
					$res['redirect'] = 'welcome';
					echo json_encode($res);
				}
			}
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
	}

	public function edit_product_form_data()
	{
		if(!empty($this->input->post('product_id'))){
			$product_id = $this->input->post('product_id');
			$data['products'] = $this->db->query("SELECT p.id, p.product_name, p.product_price, p.product_desccription, GROUP_CONCAT(i.product_image) image FROM product p INNER JOIN product_images i ON i.product_id=p.id WHERE p.id=$product_id")->result_array();			
			// echo '<pre>';print_r($data['products']);
			// $data['modal_product'] = $this->db->query("SELECT p.id, p.product_name, p.product_price, p.product_desccription, i.id as image_id, i.product_image FROM product p LEFT JOIN product_images i ON i.product_id=p.id WHERE i.product_id=$product_id")->result_array();
			echo json_encode($data);
		}
	}

	public function delete_image($product_id = NULL, $imageName = NULL)
	{

		if(!empty($this->input->post('product_id')) && !empty($this->input->post('images'))){
			$product_id = $this->input->post('product_id');
			$product_image = $this->input->post('images');
			// var_dump(is_file($this->product_image_path.$product_image));
			// echo $this->product_image_path.$product_image;
			// Delete Image | Delete table data
			if(is_file($this->product_image_path.$product_image) === TRUE){
				unlink($this->product_image_path.$product_image);
			}

			$whereData = array(
				'product_id' => $this->input->post('product_id'),
				'product_image' => $this->input->post('images'),
			);
			$result = $this->Model_common->deleteData('product_images',$whereData);
			if($result === TRUE){
				$response['images'] = $this->Model_common->getWhereContiondata($this->table_product_images, array('product_id'=>$product_id));
				$response['success'] = 'Single Image deleted successfully';
				echo json_encode($response);
			}			
		}elseif($product_id !== NULL && $imageName !== NULL){

			// Delete Image | Delete table data
			if(is_file($this->product_image_path.$imageName === TRUE)){
				unlink($this->product_image_path.$imageName);
			}

			$whereData = array(
				'product_id' => $product_id,
				'product_image' => $imageName,
			);
			$result = $this->Model_common->deleteData('product_images',$whereData);
			if($result === TRUE){
				$response['success'] = 'Image deleted successfully';
				echo json_encode($response);
			}			
		}else{
			$response['error'] = 'Something wrong with image. Try again.';
			echo json_encode($response);
		}
	}

	public function db()
	{
		// echo '<pre>'; print_r(get_class_methods('Welcome'));die;
		$this->db->query("CREATE TABLE IF NOT EXISTS product_images(
			id int(5) not null auto_increment primary key,
			product_id int(5) not null,
			product_image varchar(500) not null
		)");

		$this->db->query("CREATE TABLE IF NOT EXISTS product(
			id int(5) not null auto_increment primary key,
			product_name varchar(100) not null,
			product_price int(10) not null,
			product_desccription varchar(500) not null,
			product_image varchar(500) not null
		)");

	}

	public function checkApiData()
	{
		$arrayData = array(
			'id'=> $_GET['id'],
		);
		
		$data_string = json_encode($arrayData);
            $ch = curl_init('http://localhost/product_showcase_project/item/my_index?');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string)
                )
            );
            curl_exec($ch);
            curl_close($ch);
		$result = 'http://localhost/product_showcase_project/item/my_index?id=3';
	}

}
