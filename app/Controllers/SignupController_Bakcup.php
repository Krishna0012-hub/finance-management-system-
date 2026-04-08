<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class SignupController extends Controller
{
    public function index()
    {
        // Load the signup view
		//echo "signup";
        return view('kd_project/signup_view');
    }
public function signupPost()
    {
        // Load the User Model
        $userModel = new UserModel();

        // Get the input values from the form
        $account_name = $this->request->getPost('account_name');
        $account_number = $this->request->getPost('account_number');
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		echo $account_name; 
		echo $account_number; 
		echo $email;
		echo $password; 
		$data = [
    'account_name' => $account_name,
    'account_number' => $account_number,
    'email' => $email,
    'password' =>$password // Encrypt the password before storing
];
/*echo '<pre>';
print_r($data); // This will print the array in a human-readable format
echo '</pre>'; die;*/
//echo $data; die;

// Insert the data into the database
$userModel->insert($data);

// Optionally, you can check if the data was inserted successfully
if ($userModel->insertID()) {
    echo "Data inserted successfully!";
} else {
    echo "Failed to insert data.";
}

     // Redirect with success message
        return redirect()->to('/login')->with('success', 'Account created successfully! You can now login.');
    }
}