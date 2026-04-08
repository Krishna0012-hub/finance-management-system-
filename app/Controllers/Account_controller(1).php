<?php 
namespace App\Controllers;
use App\Models\Account_model;

class Account_controller extends BaseController{
   
   protected $acc_model;
   
    public function __construct()
    {
        // Load the Account_model in the constructor
       $this->acc_model = new Account_model();
    }
   
    public function index()
    {
		$data = array();
		
		$accounts_data = $this->acc_model->get_accounts_data();
		//echo 'accounts_data <pre>'; print_r($accounts_data); die;
		
        //$users = $userModel->findAll();

        /* foreach ($users as $user) {
            echo $user['name'] . '<br>';
        } */
		$data['accounts_data'] = $accounts_data;
		
	
        return view ('kd_project/header_view') 
              .view('kd_project/index',$data);
    }
	
	 public function save_account_data()
    {
		
		//echo 'hello'; //die;
		
		//return view('kd_project\index',$data);
		//echo 'accounts_data <pre>'; print_r($_POST); die;
		
		$accounts_data = $this->acc_model->set_accounts_data($_POST);
		//echo 'accounts_data <pre>'; print_r($accounts_data); die;
		
        //$users = $userModel->findAll();

        /* foreach ($users as $user) {
            echo $user['name'] . '<br>';
        } */
		//$data['accounts_data'] = $accounts_data;
		
		//$data = array();
		//$acc_model = new Account_model();
		//$accounts_data = $acc_model->get_accounts_data();
		//echo 'accounts_data <pre>'; print_r($accounts_data); die;
		
        //$users = $userModel->findAll();

        /* foreach ($users as $user) {
            echo $user['name'] . '<br>';
        } */
		//$data['accounts_data'] = $accounts_data;
		
	
        //return view('kd_project\index',$data);
    }
	
	public function customFunction()
    {
       /* // Example: Retrieve data from POST request
        $requestData = $this->request->getPost();

        // Example: Process data (e.g., save to database)
        // Example: Return a response (optional)
        return $this->response->setJSON(['status' => 'success', 'message' => 'Custom function called']);*/
    }
	public function delete_account_data()
	{     
	 
        	//	$accounts_data = $this->acc_model->set_accounts_data($_POST);
		//return view('kd_project\index');
			$accounts_data = $this->acc_model->delete_accounts_data($_POST);
	}
}
