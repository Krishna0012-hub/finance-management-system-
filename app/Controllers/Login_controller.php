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
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$result = $userModel->where('email', $email)->first();
		
		
             if($result && $this->isValidPassword($password, $result['password'])){
				 if (! password_get_info($result['password'])['algo']) {
					$userModel->update($result['id'], [
						'password' => password_hash($password, PASSWORD_DEFAULT),
					]);
				 }
				 $this->session->set([
                'user_id'   => $result['id'],
                'User_name' => $result['account_name'] ?? ($result['name'] ?? ''),
                'isLoggedIn' => true
            ]);

			 if ($this->request->isAJAX()) {
				 return $this->response->setJSON([
					 'status' => 'success',
					 'redirect' => base_url('accounts'),
				 ]);
			 }

			 return redirect()->to('/accounts'); 	
		}
		else{
			 if ($this->request->isAJAX()) {
				 return $this->response
					 ->setStatusCode(401)
					 ->setJSON([
						 'status' => 'error',
						 'message' => 'Invalid email or password.',
					 ]);
			 }

			 return redirect()->back()->with('error', 'Invalid email or password.');
		}
    }

	private function isValidPassword(string $plainPassword, string $storedPassword): bool
	{
		if (password_verify($plainPassword, $storedPassword)) {
			return true;
		}

		// Temporary fallback for old plain-text records already stored in the database.
		return hash_equals($storedPassword, $plainPassword);
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
