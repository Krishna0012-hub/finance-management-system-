<?php
namespace App\Models;

use CodeIgniter\Model;

class account_model extends Model
{
   
    /**
     * Get users by email using Raw SQL.
     *
     * @param string $email
     * @return array
     */
    public function get_accounts_data()
    {
        $sql = "SELECT * FROM accounts";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
	
	public function set_accounts_data($request)
    {
		$datetime = date("Y-m-d h:m:s");
		
		if($request['id'] == 0){
		
			$sql = "INSERT INTO `accounts` (`id`, `account_name`, `account_number`, `bank_name`, `account_type`, `closure_date`, `interest_rate`, `created_by`, `created_date`) VALUES (NULL, '".$request['account_name']."', '".$request['account_number']."', '".$request['bank_name']."', '".$request['account_type']."', '".$request['closure_date']."', '".$request['interest_rate']."', '1', '".$datetime."');";
		
		}else{
			
			$sql = "UPDATE `accounts` SET `account_name` 	= '".$request['account_name']."',
										  `account_number` 	= '".$request['account_number']."',
										  `bank_name` 		= '".$request['bank_name']."',
										  `account_type` 	= '".$request['account_type']."',
										  `closure_date` 	= '".$request['closure_date']."',
										  `interest_rate` 	=  '".$request['interest_rate']."'
					WHERE id = '".$request['id']."';";
		}
		
        $query = $this->db->query($sql);
		
        return true;
    }
	public function delete_accounts_data($request)
    {
		//$datetime = date("Y-m-d h:m:s");
		 $sql ="DELETE FROM accounts WHERE `id` = '".$request['id']."'";
		
		 $query = $this->db->query($sql);
         return true;
    }
}
?>