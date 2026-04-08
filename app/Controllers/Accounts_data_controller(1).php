<?php

namespace App\Controllers;
use App\Models\Accounts_data_model;

class Accounts_data_controller extends BaseController
{
    protected $acc_model;
   
    public function __construct()
    {
        // Load the Account_model in the constructor
       $this->acc_model = new Accounts_data_model();
    }
   
    public function index()
    {
		$data = array();
	//	$accounts_data = "";
		$accounts_data = $this->acc_model->get_accounts_data();
		//echo 'accounts_data <pre>'; print_r($accounts_data); die;
		$data['accounts_data'] = $accounts_data;
		 return view ('kd_project/header_view')
		       .view('kd_project/accounts_data_view',$data);
	}	
	
         public function save_accounts_data()
    {
		
		$accounts_data = $this->acc_model->set_accounts_data($_POST);
	
    }
	public function delete_accounts_data()
	{     
	  
	    /* echo "hello"; 
		 print_r($_POST); die;*/
        	//	$accounts_data = $this->acc_model->set_accounts_data($_POST);
		//return view('kd_project\index');
			$accounts_data = $this->acc_model->delete_accounts_data($_POST);
	}
	public function get_fields_data()
	{
			$accounts_data = $this->acc_model->get_accounts();
			//echo 'accounts_data <pre>'; print_r($accounts_data); 
            echo json_encode($accounts_data);
	}
	public function update_acc_data()
	{
			//echo "hello"; 
			$accounts_data = $this->acc_model->update_accounts();
			//echo 'accounts_data <pre>'; print_r($accounts_data);
			echo json_encode($accounts_data);
	}
		
}
