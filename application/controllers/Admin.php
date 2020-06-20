<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$params['heading'] = 'WELCOME TO PAUL\'s SALES MONITORING';
		$this->adminContainer('admin/index', $params);
	}

	public function usr_login(){
		$this->load->view('admin/login');
	}

	public function proceed_login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$errors = array();
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$errors['msg'] = 'failed';
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$q 				= $this->db->get_where('users', array('username' => $username, 'is_deleted' => 'f'));
			if (!empty($q->row())) {
				$database_password = $q->row()->password;
				$found = password_verify($password, $database_password) ? 'success' : 'failed';
				// store info in session
				$userdata = array(
					'username'  => $username,
					'users_id' => $q->row()->users_id
				);
				$this->session->set_userdata($userdata);
			} else {
				$found = 'failed';
			}
			$errors['msg'] = $found;
		}
		echo json_encode($errors);
	}

	public function destroy_sess(){
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	public function member_list(){
		$params['heading'] = 'CONSTITUENT LIST';
		$this->adminContainer('admin/constituent-list', $params);	
	}
	
	public function monthly_bills(){
		$params['heading'] = 'MONTHLY BILLS';
		$this->adminContainer('admin/monthly-bills', $params);	
	}

	public function control_token(){
		$params['heading'] 				 = 'CONTROL ACCESS TOKEN';
		$params['data'] 					 = $this->db->get('access_token')->row();
		$this->adminContainer('admin/token-ctrl-view', $params);	
	}

	public function show_gen_token(){
		$this->load->view('admin/crud/add-token');
	}

	public function generateToken(){
		$token                	= implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 16), 6));
		$encrpt_key 					 	= $this->AdminMod->encdec($token, 'e');
		// $hashed_key 					 	= password_hash($token, PASSWORD_BCRYPT);

		$params['token'] 		 		= $token;
		$params['encrypt_key'] 	= $encrpt_key;
		// $params['hashed_key'] 	= $hashed_key;

		echo json_encode($params);
	}

	public function saveToken(){
		$token 				 = $this->input->post('token');
		$secret_key		 = $this->input->post('secret-key');
		$hashed_key 	 = password_hash($token, PASSWORD_BCRYPT);

		$accessToken 	 = $this->db->get('access_token')->row();
		if ($accessToken) {
			$q = $this->db->update('access_token', array(
				'token' 		  => $token,
				'secret_key' 	=> $secret_key,
				'hashed_key'  => $hashed_key
			));
		} else {
			$q = $this->db->insert('access_token', array(
				'token' 		  => $token,
				'secret_key' 	=> $secret_key,
				'hashed_key'  => $hashed_key
			));
		}
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Token Successfully Updated!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}

	public function tbl_constituent_list(){
		$this->load->view('admin/crud/tbl-lgu-constituent');
	}
	
	public function tbl_monthly_bills(){
		$this->load->view('admin/crud/tbl-monthly-bills');
	}

	public function view_constituent_list(){
		$lgu_constituent_id 	 = $this->input->get('data');
		$params['data'] 			 = $this->AdminMod->getConstituentRecord($lgu_constituent_id); 
		$params['govtID'] 			 = $this->db->select('*')
																				->from('government_card g')
																				->join('card_type c', 'c.card_type_id = g.id_name', 'left')
																				->where('g.lgu_constituent_id', $lgu_constituent_id)
																				->get()
																				->result(); 
		$params['uploads'] 		 = $this->db->get_where('uploads', array('lgu_constituent_id' => $lgu_constituent_id))->row();
		$params['child'] 			 = $this->db->get_where('children', array('lgu_constituent_id' => $lgu_constituent_id))->result();
		$params['education'] 	 = function($id){ return $this->db->get_where('education', array('education_id' => $id))->row(); };
		$params['residential'] = function($id){ return $this->db->get_where('residential', array('residential_id' => $id))->row(); };
		$livingStatus 				 = $this->db->get('living_status')->result();
		$livingStatusArr 			 = array();
		foreach ($livingStatus as $row) {
			$livingStatusArr[$row->living_status_id] = $row->name;
		}
		$params['socialStatus'] = $this->db->get_where('constituent_living_status', array('lgu_constituent_id' => $lgu_constituent_id))->result();
		$params['livingStatus'] = $livingStatusArr;
		$this->load->view('admin/crud/view-constituent', $params);
	}

	public function server_tbl_lgu_constituent(){
		$result = $this->AdminMod->get_output_lgu_constituent();
		$res 		= array();
		$no 		= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$hashed_id = $this->encdec($row->lgu_constituent_id, 'e');
			$data = array();
			$no++;
			//<input type="checkbox" id="chk-const-list-tbl" value="'.$row->lgu_constituent_id.'" name="chk-const-list-tbl">
   		$data[] = '<input type="checkbox" id="chk-const-list-tbl" class="chk-const-list-tbl" value="'.$row->lgu_constituent_id.'" name="chk-const-list-tbl[]">';
   		$data[] = $row->lgu_constituent_id;
   		$data[] = strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name);
   		$data[] = strtoupper($row->residential_address);
   		$data[] = $row->age;
   		$data[] = date('F j, Y', strtotime($row->dob));
   		$data[] = $row->occupation;
   		$data[] = $row->email;
   		switch ($row->house_type) {
   			case 1:
   				$data[] = 'Home';
   				break;
   			case 2:
   				$data[] = 'Dormitory';
   				break;
   			default:
   				$data[] = 'Apartment';
   				break;
   		}
   		$data[] = '<a href="javascript:void(0);" id="loadPage" data-link="view-constituent" data-ind="'.$row->lgu_constituent_id.'" 
   								data-badge-head="'.strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name).'\'s INFO" data-cls="cont-view-member" data-placement="top" data-toggle="tooltip" title="View" data-id="'.$row->lgu_constituent_id.'">
   								<i class="fas fa-search"></i></a> | 
   							<a href="javascript:void(0);" id="loadPage" data-placement="top" data-toggle="tooltip" title="Edit" data-link="edit-constituent" 
   								data-ind="'.$row->lgu_constituent_id.'" data-cls="cont-edit-member" data-badge-head="EDIT '.strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name).'"><i class="fas fa-edit"></i></a> | 
   							<a href="javascript:void(0);" id="remove-lgu-const-list" data-placement="top" data-toggle="tooltip" title="Remove" data-id="'.$row->lgu_constituent_id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_lgu_constituent(),
			'recordsFiltered' => $this->AdminMod->count_filter_lgu_constituent(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_tbl_monthly_bills(){
		$result = $this->AdminMod->get_output_monthly_bills();
		$res 		= array();
		$no 		= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
			//<input type="checkbox" id="chk-const-list-tbl" value="'.$row->lgu_constituent_id.'" name="chk-const-list-tbl">
   		$data[] = $row->month;
   		$data[] = $row->date_applied;
   		$data[] = $row->plan;
   		$data[] = '<a href="javascript:void(0);" id="loadPage" data-placement="top" data-toggle="tooltip" title="Edit" data-link="edit-constituent" 
   								data-ind="'.$row->monthly_bills_id . '" data-cls="cont-edit-member" data-badge-head="EDIT"><i class="fas fa-edit"></i></a> | 
   							<a href="javascript:void(0);" id="remove-lgu-const-list" data-placement="top" data-toggle="tooltip" title="Remove"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_monthly_bills(),
			'recordsFiltered' => $this->AdminMod->count_filter_monthly_bills(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function add_constituent(){
		$params['gov_ids'] 			= $this->db->get_where('card_type')->result();
		$params['resdntl'] 			= $this->db->get_where('residential')->result();
		$params['educ'] 	 			= $this->db->get_where('education')->result();
		$params['livingStatus'] = $this->db->get_where('living_status')->result();
		$this->load->view('admin/crud/add-constituent', $params);	
	}	
	
	public function add_monthly_bills(){
		$params['member_list'] = $this->db->get_where('lgu_constituent')->result();
		$this->load->view('admin/crud/add_monthly_bills', $params);
	}

	public function save_monthly_bills(){
		if($this->input->post('has_update') != '') {
			$q = $this->db->update('monthly_bills', array(
				'month' 								=> $this->input->post('month'),
				'date_applied' 					=> $this->input->post('date_applied'),
				'plan' 									=> $this->input->post('plan'),
				'entry_date' 						=> date('Y-m-d'),
				'amount'								=> $this->input->post('amount'),
				'remarks'								=> $this->input->post('remarks'),
				'lgu_constituent_id'		=> $this->input->post('lgu_constituent_id')
			), 'monthly_bills_id', $this->input->post('has_update'));
		} else {
			$q = $this->db->insert('monthly_bills', array(
				'month' 								=> $this->input->post('month'),
				'date_applied' 					=> $this->input->post('date_applied'),
				'plan' 									=> $this->input->post('plan'),
				'entry_date' 						=> date('Y-m-d'),
				'amount'								=> $this->input->post('amount'),
				'remarks'								=> $this->input->post('remarks'),
				'lgu_constituent_id'		=> $this->input->post('lgu_constituent_id')
			));
		}
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Saved!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}

	public function edit_constituent(){
		$lgu_constituent_id 			 = $this->input->get('data');
		$params['uploads'] 				 = $this->db->get_where('uploads', array('lgu_constituent_id' => $lgu_constituent_id))->row();
		$params['lgu_constituent'] = $this->db->get_where('lgu_constituent', array('lgu_constituent_id' => $lgu_constituent_id))->row();
		$params['social_status']	 = explode('|', $params['lgu_constituent']->social_status);
		$params['resdntl'] 				 = $this->db->get('residential')->result();
		$params['gov_ids'] 				 = $this->db->get('card_type')->result();
		$params['government_card'] = $this->db->get_where('government_card', array('lgu_constituent_id' => $lgu_constituent_id))->result();
		$params['children'] 			 = $this->db->get_where('children', array('lgu_constituent_id' => $lgu_constituent_id))->result();
		$params['educ'] 			 		 = $this->db->get('education')->result();
		$params['livingStatus'] 	 = $this->db->get('living_status')->result();
		$conLivingStatus 					 = $this->db->get_where('constituent_living_status', array('lgu_constituent_id' => $lgu_constituent_id))->result();
		$socialStatusArr = array();
		$socialStatusIDArr = array();
		foreach ($conLivingStatus as $row) {
			$socialStatusArr[] = $row->status_id;
			$socialStatusIDArr[$row->status_id] = $row->id;
		}
		$params['social_status'] 	 		= $socialStatusArr;
		$params['socialStatusIDNum'] 	= $socialStatusIDArr;
		$this->load->view('admin/crud/edit-constituent', $params);
	}

	public function save_constituent(){
		$this->form_validation->set_rules('house_type', 'House Type', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('dob', 'Date of birth', 'required|date');
		$this->form_validation->set_rules('highest_educ_attmnt', 'Highest Educational Attainment', 'required');
		$this->form_validation->set_rules('residential_address', 'Residential Address', 'required');
		$this->form_validation->set_rules('citizenship', 'Citizenship', 'required');
		$this->form_validation->set_rules('birthplace', 'Birthplace', 'required');
		$this->form_validation->set_rules('other_name', 'Nick Name', 'required');
		$this->form_validation->set_rules('fathers_name', 'Fathers Name', 'required');
		$this->form_validation->set_rules('mothers_name', 'Mothers Name', 'required');
		$this->form_validation->set_rules('fathers_birth_place', 'Fathers Birth Place', 'required');
		$this->form_validation->set_rules('mothers_birth_place', 'Mothers Birth Place', 'required');
		// if (array_key_exists('pwd_id', $_POST)) {
		// 	$this->form_validation->set_rules('pwd_id', 'PWD ID', 'trim|required');
		// }
		if (array_key_exists('religion_desc', $_POST)) {
			$this->form_validation->set_rules('religion_desc', 'Other Religion', 'trim|required');
		}
		$errors 		 = array();
		$isForUpdate = false;
		$updateID 	 = '';
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
		} else {
			//save entry
			$dataField 						 = array();
			$dataFieldSocialStatus = array();
			$dataFieldSocialStatusID = array();
			$childrenNFieldData 	 = array();
			$childrenBPFieldData 	 = array();
			$govtNFieldData 			 = array();
			$govtNIDFieldData 		 = array();
			foreach ($this->input->post() as $key => $value) {
				
				switch ($key) {
					case 'social_status':
						$dataFieldSocialStatus[] = $value;
						break;
					case 'pwd_id':
						$dataFieldSocialStatusID[] = $value;
						break;
					case 'children_name':
						$childrenNFieldData[]  = $value;
						break;
					case 'children_birth_place':
						$childrenBPFieldData[] = $value;
						break;
					case 'govt_name':
						$govtNFieldData[] 		 = $value;
						break;
					case 'govt_id':
						$govtNIDFieldData[] 	 = $value;
						break;
					case 'is_update':
						//for udpate
						$isForUpdate					 = true;
						$updateID							 = $value;
						break;
					default:
						$dataField[$key] 			 = $value;
						break;
				}
			}
			$dataField['transaction_date'] = date('Y-m-d');
			// $dataField['social_status'] 	 = implode('|', $dataFieldSocialStatus[0]);
			$dataField['user_id'] 				 = $this->session->users_id;
			
			/**
				Save lgu_constituent table
			*/
			if ($isForUpdate) {
				$this->db->update('lgu_constituent', $dataField, array('lgu_constituent_id'=>$updateID));
			} else {
				$this->db->insert('lgu_constituent', $dataField);
			}
			
			//last insert id
			$lguConstituentID = $this->db->insert_id();
			
			/**
				Save Social Status Table
			*/
			$dataLivingStatus = array();
			if (!empty($dataFieldSocialStatus[0])) {
				for ($i=0; $i < count($dataFieldSocialStatus[0]); $i++) { 
					$dataLivingStatus[$i]['lgu_constituent_id'] = ($isForUpdate) ? $updateID : $lguConstituentID;
					$dataLivingStatus[$i]['status_id'] 					= $dataFieldSocialStatus[0][$i];
					$dataLivingStatus[$i]['id'] 								= $dataFieldSocialStatusID[0][$i];
				}

				if ($isForUpdate) {
					$this->db->delete('constituent_living_status', array('lgu_constituent_id'=>$updateID));
					$this->db->insert_batch('constituent_living_status', $dataLivingStatus);	
				} else {
					$this->db->insert_batch('constituent_living_status', $dataLivingStatus);
				}	
			} else {
				if ($isForUpdate) {
					$this->db->delete('constituent_living_status', array('lgu_constituent_id'=>$updateID));
				}
			}
			

			/**
				Save children Table
			*/
			$dataChildren = array();
			if (!empty($childrenNFieldData[0])) {
				for ($i=0; $i < count($childrenNFieldData[0]); $i++) { 
					$dataChildren[$i]['lgu_constituent_id'] = ($isForUpdate) ? $updateID : $lguConstituentID;
					$dataChildren[$i]['name'] 							= $childrenNFieldData[0][$i];
					$dataChildren[$i]['birthplace'] 				= $childrenBPFieldData[0][$i];
				}

				if ($isForUpdate) {
					$this->db->delete('children', array('lgu_constituent_id'=>$updateID));
					$this->db->insert_batch('children', $dataChildren);	
				} else {
					$this->db->insert_batch('children', $dataChildren);
				}
			} else {
				if ($isForUpdate) {
					$this->db->delete('children', array('lgu_constituent_id'=>$updateID));
				}
			}
			
			/**
				Insert government_card Table
			*/
			$dataGovtID = array();
			if (!empty($govtNFieldData[0])) {
				for ($i=0; $i < count($govtNFieldData[0]); $i++) { 
					$dataGovtID[$i]['lgu_constituent_id'] = ($isForUpdate) ? $updateID : $lguConstituentID;
					$dataGovtID[$i]['id_name'] 						= $govtNFieldData[0][$i];
					$dataGovtID[$i]['id_number'] 					= $govtNIDFieldData[0][$i];
				}
				if ($isForUpdate) {
					$this->db->delete('government_card', array('lgu_constituent_id'=>$updateID));
					$this->db->insert_batch('government_card', $dataGovtID);
				} else {
					$this->db->insert_batch('government_card', $dataGovtID);
				}
			} else {
				if ($isForUpdate) {
					$this->db->delete('government_card', array('lgu_constituent_id'=>$updateID));
				}
			}
			
			

		}
		echo json_encode($errors);
	}

	public function showID(){
		$params 						= array();
		$hashedID 					= $this->uri->segment(2);
		$lgu_constituent_id = $this->encdec($hashedID, 'd');
		$res 								= $this->db->get_where('lgu_constituent', array(
			'lgu_constituent_id' => $lgu_constituent_id
		))->row();
		$params['data'] 	  = $res;
		$arrUploads 				= array();
		$resUploads 				= $this->db->get('uploads')->result();
		foreach ($resUploads as $row) {
			$arrUploads[$row->lgu_constituent_id] = $row->image_name;
		}
		$params['dUploads'] = $arrUploads;
		
		$ht 		= $this->load->view('admin/reports/identification', $params, TRUE);
		$this->AdminMod->pdf($ht, 
													'download', 
													'L', 
													false,
													true,
													base_url() . 'assets/image/misc/id-template.png',
													false,
													'Identification',
													'',
													true,
													$hashedID, 
													'A6');
	}

	public function show_multiple_constituent(){
		$hashedID 					= $this->uri->segment(2);
		$dataIDs 						= $this->encdec($hashedID, 'd');
		$params['dataIDs'] 	= $dataIDs;
		$decIDs							= explode('|', $dataIDs);
		$this->db->where_in('lgu_constituent_id', $decIDs);
		$res 								= $this->db->get('lgu_constituent')->result();
		$arrUploads 				= array();
		$resUploads 				= $this->db->get('uploads')->result();
		foreach ($resUploads as $row) {
			$arrUploads[$row->lgu_constituent_id] = $row->image_name;
		}
		$params['dUploads'] = $arrUploads;
		$ht = array();
		foreach ($res as $row) {
			$params['data'] = $row;
			array_push($ht, $this->load->view('admin/reports/identification', $params, TRUE));
		}
		$this->AdminMod->pdf($ht, 
													'download', 
													'L', 
													false, 
													true, 
													base_url() . 'assets/image/misc/id-template.png', 
													false, 
													'Identification', 
													'', 
													true, 
													$hashedID, 
													'A6',
													$decIDs);
	}

	public function upload_const_dp(){
		$config['upload_path'] 		= './assets/image/uploads';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']  			= 0; // any size
		$config['remove_spaces']	= true;
		$id 											= $this->input->post('lgu-cons-id');
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
		if (!$this->upload->do_upload('upload-file-dp')) {
			$data['error']	 = array('error' => $this->upload->display_errors());
			$data['success'] = false;
		} else {
			$dImg = $this->upload->data();

			//resize image to fit
			$configer =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $dImg['full_path'],
        'maintain_ratio'  =>  TRUE,
        'width'           =>  1200,
        'height'          =>  1200,
        'x_axis'          =>  '0',
        'y_axis'          =>  '0'
      );

      $configer['quality'] = "100%";
			$configer['width'] = 176;
			$configer['height'] = 234;
			$dim = (intval($dImg["image_width"]) / intval($dImg["image_height"])) - ($configer['width'] / $configer['height']);
			$configer['master_dim'] = ($dim > 0)? "height" : "width";

      $this->image_lib->clear();
      $this->image_lib->initialize($configer);
      $this->image_lib->resize();

			$chkExisting    = $this->db->get_where('uploads', array('lgu_constituent_id' => $id))->result();
			if ($chkExisting) {
				$this->db->update('uploads', 
					array(
						'image_name' 			 => $dImg['file_name'],
						'image_path' 			 => $dImg['file_path'],
						'transaction_date' => date('Y-m-d')
					), 
					array('lgu_constituent_id' => $id)
				);
			} else {
				$this->db->insert('uploads', 
					array(
						'lgu_constituent_id' => $id,
						'image_name' 				 => $dImg['file_name'],
						'image_path' 				 => $dImg['file_path'],
						'transaction_date' 	 => date('Y-m-d')
					)
				);	
			}
			$data['file_name'] = $dImg['file_name'];
			$data['success'] = true;
		}
		echo json_encode($data);
	}

	public function show_multiple_ids(){
		$ids 		= implode('|', $this->input->post('ids'));
		$objIDs = $this->encdec($ids, 'e');
		echo json_encode(array('ids' => $objIDs));
	}

	public function fetch_indvl_details(){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		header("Content-type: application/json charset=UTF-8");

		$request_body = file_get_contents('php://input');
		$requestData 	= json_decode($request_body);
		
		$hashedID="";
		$token ="";
		if($requestData){
			$hashedID 		= $requestData->q;
			$token 				= $requestData->token;
		}

		$dbTokenHashed			= $this->db->get('access_token')->row()->hashed_key;
		if (password_verify($token, $dbTokenHashed)) {
			
			$lgu_constituent_id = $this->encdec($hashedID, 'd');

			$data 						 	= $this->AdminMod->getConstituentRecord($lgu_constituent_id); 
			$govtID 						= $this->db->select('*')
																					->from('government_card g')
																					->join('card_type c', 'c.card_type_id = g.id_name', 'left')
																					->where('g.lgu_constituent_id', $lgu_constituent_id)
																					->get()
																					->result(); 
			$uploads 		 				= $this->db->get_where('uploads', array('lgu_constituent_id' => $lgu_constituent_id))->row();
			$child 			 				= $this->db->get_where('children', array('lgu_constituent_id' => $lgu_constituent_id))->result();
			$livingStatus 			= $this->db->select('*')
																					->from('constituent_living_status g')
																					->join('living_status c', 'c.living_status_id = g.status_id', 'left')
																					->where('g.lgu_constituent_id', $lgu_constituent_id)
																					->get()
																					->result(); 
			$education 	 				= function($id){ return $this->db->get_where('education', array('education_id' => $id))->row(); };
			$residential 				= function($id){ return $this->db->get_where('residential', array('residential_id' => $id))->row(); };

			$jsonData = array();
			$jsonData['personalInfo'] = array(
				'is_house_owner' => $data[0]->is_house_owner == '1' ? 'Yes' : 'No' 
			);
			if ($uploads && @file_exists('assets/image/uploads/' . $uploads->image_name)){
				$jsonData['personalInfo']['picture'] = base_url('assets/image/uploads/') . $uploads->image_name;
			} else {
				$jsonData['personalInfo']['picture'] = base_url('assets/image/misc/default-user-member-image.png');
			}
			
			foreach ($livingStatus as $row) {
				$jsonData['personalInfo']['living_status'][$row->name] = $row->id;	
			}

			$jsonData['personalInfo']['full_name'] = strtoupper($data[0]->last_name . ', ' . $data[0]->first_name . ' ' . $data[0]->middle_name);
			$jsonData['personalInfo']['nick_name'] = strtoupper($data[0]->other_name);
			$jsonData['personalInfo']['gender'] = strtoupper($data[0]->gender);
			$jsonData['personalInfo']['age'] = strtoupper($data[0]->age);
			$jsonData['personalInfo']['dob'] = date('F j, Y', strtotime($data[0]->dob));
			$jsonData['personalInfo']['citizenship'] = strtoupper($data[0]->citizenship);
			$jsonData['personalInfo']['civil_status'] = strtoupper($data[0]->civil_status);
			$jsonData['personalInfo']['ofc_address'] = strtoupper($data[0]->ofc_address);
			$jsonData['personalInfo']['residential_type'] = strtoupper($residential($data[0]->house_type)->residential_type);

			$jsonData['contactDetails']['residential_address'] = strtoupper($data[0]->residential_address);
			$jsonData['contactDetails']['email'] = strtoupper($data[0]->email);
			$jsonData['contactDetails']['tel_no'] = strtoupper($data[0]->tel_no);
			$jsonData['contactDetails']['mobile'] = strtoupper($data[0]->mobile);
			
			if (!empty($govtID)) {
				foreach ($govtID as $row){
					if ($row->card_name !='') {
						$jsonData['contactDetails']['govt_id'][$row->card_name] = $row->id_number;
					}
				}
			}
			
			$jsonData['familyBackground']['fathers_name'] = strtoupper($data[0]->fathers_name);
			$jsonData['familyBackground']['fathers_birth_place'] = strtoupper($data[0]->fathers_birth_place);
			$jsonData['familyBackground']['mothers_name'] = strtoupper($data[0]->mothers_name);
			$jsonData['familyBackground']['mothers_birth_place'] = strtoupper($data[0]->mothers_birth_place);
			$jsonData['familyBackground']['spouse_name'] = strtoupper($data[0]->spouce_name);
			$jsonData['familyBackground']['spouse_birth_place'] = strtoupper($data[0]->spouce_birth_place);

			if (!empty($child)) {
				foreach ($child as $row){
					if ($row->name!='') {
						$jsonData['familyBackground']['child'][$row->name] = strtoupper($row->birthplace);
					}
				}
			}

			$jsonData['otherInformation']['educational_attainment'] = strtoupper($education($data[0]->highest_educ_attmnt)->education_name);
			$jsonData['otherInformation']['occupation'] = strtoupper($data[0]->occupation);

			$relT = '';
			switch ($data[0]->religion) {
				case '1':
					$relT = 'Catholic';
					break;
				case '2':
					$relT = 'Muslim';
					break;
				default:
					$relT = $data[0]->religion_desc;
					break;
			}

			$jsonData['otherInformation']['religion'] 				 = $relT;
			$jsonData['otherInformation']['height'] 					 = strtoupper($data[0]->height);
			$jsonData['otherInformation']['weight'] 					 = strtoupper($data[0]->weight);
			$jsonData['otherInformation']['identifying_marks'] = strtoupper($data[0]->identifying_marks);
			
			echo json_encode($jsonData, JSON_PRETTY_PRINT);

		} else {
			header("HTTP\ 1.0 401 Unauthorized");
			echo "You are not authorized.";
		}
	}

	public function deleteConstituent(){
		$lgu_constituent_id = $this->input->post('id');
		$this->db->update('lgu_constituent', array('is_deleted' => '1'), array('lgu_constituent_id' => $lgu_constituent_id));
	}

}
