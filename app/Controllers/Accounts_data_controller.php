<?php

namespace App\Controllers;
use App\Models\Accounts_data_model;
use App\Models\Import_model;

class Accounts_data_controller extends BaseController
{
    protected $acc_model;
   
    public function __construct()
    {
        // Load the Account_model in the constructor
       $this->acc_model = new Accounts_data_model();
         $this->import_model = new Import_model();
    }
   
    public function index()
    {
		 if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
		$data = array();
		$accounts_data = $this->acc_model->get_accounts_data();
		//echo 'accounts_data <pre>'; print_r($accounts_data); die;
		$data['accounts_data'] = $accounts_data;
		 return view('kd_project/header_view')
		        .view('kd_project/accounts_data_view',$data);
	}	
	
    public function save_accounts_data()
    {   
	     if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
		$accounts_data = $this->acc_model->set_accounts_data($_POST);
	}
	public function delete_accounts_data()
	{      
	          if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
	    	$accounts_data = $this->acc_model->delete_accounts_data($_POST);
	}
		
	public function get_fields_data()
	{
	        if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }	
			$accounts_data = $this->acc_model->get_accounts();
			//echo 'accounts_data <pre>'; print_r($accounts_data); 
            echo json_encode($accounts_data);
	}
	public function update_acc_data()
	{
		    if(empty(session('user_id'))){
			return redirect()->to('/login'); 	
	   }
			//echo "hello"; 
			$accounts_data = $this->acc_model->update_accounts();
			//echo 'accounts_data <pre>'; print_r($accounts_data);
			echo json_encode($accounts_data);
	}
	  public function csvPost()
    {
        // Check if the file was uploaded via form submission
        $file = $this->request->getFile('fileToUpload');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate the file type (ensure it's a CSV file)
            if ($file->getClientMimeType() === 'text/csv') {
                // Define the writable/uploads directory
                $targetDirectory = WRITEPATH . 'uploads/';  // WRITEPATH is the path to writable/ in CodeIgniter
                
                // Ensure the directory exists, if not, create it
                if (!is_dir($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                // Set the full path with a dynamic file name
                $fileName = $file->getRandomName();
                $filePath = $targetDirectory . $fileName;

                // Move the uploaded file to the target directory
                if ($file->move($targetDirectory, $fileName)) {
                    // File moved successfully, open it for reading
                    if (($handle = fopen($filePath, 'r')) !== FALSE) {
                        fgetcsv($handle); // Skip the header row

                        // Process each row of the CSV file
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $csvData = [
                                'account_name' => $data[0],
                                'account_number' => $data[1],
                                'as_on_date' => $data[2],
                                'fixed_amount' => str_replace(',', '', $data[3]), // Remove commas for numeric values
                                'veriable_amount' => str_replace(',', '', $data[4]),
                                'diff_amount' => str_replace(',', '', $data[5]),
                                'updated_by' => $data[6],
                                'updated_date' => $data[7]
                            ];

                            // Save the data into the database
							echo '<pre>';
							print_r($csvData['as_on_date']); 
                            $this->import_model->import_accounts_data($csvData);
                        }

                        fclose($handle);

                        // Redirect to the accounts page after processing
                        return redirect()->to('/accounts_data');
                    } else {
                        echo 'Error opening the file.';
                    }
                } else {
                    echo 'Failed to move the file.';
                }
            } else {
                echo 'Invalid file type. Please upload a CSV file.';
            }
        } else {
            echo 'File upload failed.';
        }
    }
}

