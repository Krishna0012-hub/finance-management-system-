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

		$data = [
            'account_name' => $account_name,
            'account_number' => $account_number,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        // Insert the data into the database
        $userModel->insert($data);

        if (! $userModel->insertID()) {
            return redirect()->back()->with('error', 'Account could not be created.');
        }

        // Redirect with success message
        return redirect()->to('/login')->with('success', 'Account created successfully! You can now login.');
    }
}
