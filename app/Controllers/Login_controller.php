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
       //$data = [ 'name' => 'Test' ,'username'=>'krishna Dubey'];
       //$this->session->set($data);
	   
	  // $this->session->setFlashdata('item', 'value');
		 return view('kd_project/login_view');
    }
	 public function loginPost()
    {	
		 
	//	 echo $this->session->getFlashdata('item');
       // echo session('username'); 
		 
		  
        $userModel = new UserModel();
		$result = $userModel->where('email',$this->request->getVar('email'))->
		where('password',$this->request->getVar('password'))->first();
		
		
             if($result){
				 $this->session->set([
                'user_id'   => $result['id'],
                'User_name' => $result['name'],
                'isLoggedIn' => true
            ]);
            // Print session data
            //echo '<pre>';
        //print_r($this->session->get('User_name')); 
         //echo '</pre>'; 
			
			echo 'login post - '.session('user_id'); echo '<br>'; //die;
			
			 return redirect()->to('/accounts'); 	
		}
		else{
			echo "error";
			 return view('kd_project/login_view');
		}
    }
	public function displaySession() {
        $session = \Config\Services::session();
		$mySession = [
		'name'=>'krishna',
		'surname' => 'Dubey',
		'city' => 'agra'
		];
		$session->set($mySession);
		var_dump($session);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
		/*$session = \Config\Services::session();
		if($session->has(key:'name')){
			echo 'session exist';
		}
		else{
			echo 'session not exist.';
		}*/
		
	}
}
