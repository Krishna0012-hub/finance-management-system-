<?php

namespace App\Controllers;
use App\Models\Dashboard_model;

class Dashboard_controller extends BaseController
{
	  protected $dsh_model;
   
    public function __construct()
    {
        // Load the Account_model in the 
	
       $this->dsh_model = new  Dashboard_model();
    }
   
   
    public function index()
    {
		 if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
	
	  $data = array();
	  //$data1 = array();
		
		//$accounts_data = $this->dsh_model->dsh_data();
		$total_fd = $this->dsh_model->get_account_total('FD');
		$pre_data = $this->dsh_model->pre_account_total('FD');
		$difference_data = $this->dsh_model->difference_account_total('FD');
		$single_data = $this->dsh_model->single_data('FD');
		 $data['total_fd'] = $total_fd;
		 $data['difference_data'] = $difference_data;
        $data['single_data'] = $single_data;
		$data['pre_data'] = $pre_data;
	 return view('kd_project/header_view') 
	       .view('kd_project/dashboard_view',$data);
		
    }
	
}
