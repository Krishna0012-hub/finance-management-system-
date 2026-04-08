<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Login_controller extends BaseController{
	 protected $acc_model;
   
    public function __construct()
    {
       $this->acc_model = new UserModel();  
	    $this->session = session();  
    } 
    public function login():string
    {
        // echo "call login"; die;
		 return view('kd_project/login_view');
    }
	 public function loginPost()
    {	
		// $this->session->set('user_d','1');
		
		 
		 //echo 'login <pre>'; print_r($this->session); echo '<b>'; 
		 
		//  $user_id = $this->session->get('user_d');
		 
		 //echo 'user_id <pre>'; print_r($user_id); echo '<b>'; 
		 
		 //die;
		// echo 'login'; var_dump($this->session); echo '<b>'; die;
		
		 $validation = \Config\Services::validation();
		 
		  $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);
        $userModel = new UserModel();
		$result = $userModel->where('email',$this->request->getVar('email'))->
		where('password',$this->request->getVar('password'))->first();
		
		//echo '<pre>'; print_r($result); echo '<br>';
		 //session_start();
		//$session = session();	
		if($result){
				 $this->session->set([
                'user_id'   => $result['id'],
                'user_name' => $result['name'],
                'isLoggedIn' => true
            ]);

            // Print session data
          /*  echo 'Session Data: <pre>';
            print_r($this->session->get()); die;*/
			
			//print_r($data); die;
//die;
	          		
			 return redirect()->to('/accounts'); 	
		}
		else{
			echo "error";
			 return view('kd_project/login_view');
		}
    }
    public function logout()
    { 
       
        session()->destroy();
        return redirect()->to('/login');
        
	}
}
