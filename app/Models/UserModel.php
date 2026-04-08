<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Replace 'users' with the actual table name
    protected $primaryKey = 'id'; // Primary key of the users table
    protected $allowedFields = ['account_name', 'account_number','email','password']; 
	/* public function get_accounts_data()
    {
        $sql = "SELECT * FROM accounts";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }*/
	

}