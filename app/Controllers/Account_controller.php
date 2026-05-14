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
	
		//If User not exist then redirect to login page
	   if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
	
		//$data_sessin = $this->session->get('user_id');
		//echo 'Accounts Session - '; print_r($data_sessin); echo '<pre>';
       // echo "index controller";	
	   
	   /* $user_id = $this->session->get('user_d');
		 
		 echo 'user_id <pre>'; print_r($user_id); echo '<b>'; 
	   
	    echo 'account <pre>'; print_r($this->session); echo '<b>'; die;*/
		
		$data = array();
		
		$accounts_data = $this->acc_model->get_accounts_data();
		$data['accounts_data'] = $accounts_data;
		
	
        return view ('kd_project/header_view')
		           .view ('kd_project/index',$data);
    }
	
	 public function sesson_data()
    {
	
		//$data_sessin = $this->session->get('user_id');
		//echo 'Accounts Session - '; print_r($data_sessin); echo '<pre>';
       // echo "index controller";	
	    if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
	    $user_id = $this->session->get('user_d');
		 
		 echo 'user_id <pre>'; print_r($user_id); echo '<b>'; 
	   
	    echo 'account <pre>'; print_r($this->session); echo '<b>'; die;
	}
	
	 public function save_account_data()
    {
		 if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
		$accounts_data = $this->acc_model->set_accounts_data($_POST);
    }
	
	public function delete_account_data()
	{    
 if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }	
       			$accounts_data = $this->acc_model->delete_accounts_data($_POST);
	}

	public function store()
	{
		$data = $this->request->getPost();
		$this->acc_model->insert_account($data);

		return $this->response->setJSON(['status' => 'success']);
	}

	public function update($id)
	{
		$data = $this->request->getRawInput();
		$this->acc_model->update_account($id, $data);

		return $this->response->setJSON(['status' => 'success']);
	}

	public function delete($id)
	{
		$this->acc_model->delete_account($id);

		return $this->response->setJSON(['status' => 'success']);
	}
}
