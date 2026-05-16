<?php
namespace App\Models;

use CodeIgniter\Model;

class accounts_data_model extends Model
{
   
    /**
     * Get users by email using Raw SQL.
     *
     * @param string $email
     * @return array
     */
    public function get_accounts_data()
    {
         $sql = "SELECT AD.*, A.account_name, CONCAT(account_name,' ',bank_name,' ',account_type) account_holder 
		           FROM accounts_data AD 
					LEFT JOIN accounts A 
					ON AD.account_number = A.account_number";
		// echo $sql; die;  
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
	public function set_accounts_data($request)
    {
		$datetime = date("Y-m-d H:i:s");
		$diffAmount = $request['diff_amount'] ?? '';

		if (trim((string) $diffAmount) === '') {
			$diffAmount = $request['veriable_amount'] - $request['fixed_amount'];
		}

		$data = [
			'account_number' => $request['account_number'],
			'as_on_date' => $request['as_on_date'],
			'fixed_amount' => $request['fixed_amount'],
			'veriable_amount' => $request['veriable_amount'],
			'diff_amount' => $diffAmount,
		];

		if ((int) $request['id'] === 0) {
			$data['updated_by'] = 1;
			$data['updated_date'] = $datetime;

			$this->db->table('accounts_data')->insert($data);
		} else {
			$this->db->table('accounts_data')
				->where('id', (int) $request['id'])
				->update($data);
		}

        return true;
		}
	public function delete_accounts_data($request)
    {
		 $this->db->table('accounts_data')
			->where('id', (int) $request['id'])
			->delete();

         return true;
    }
	public function get_accounts()
	{
		$sql = "SELECT account_number,
        		CONCAT(account_name,' ',bank_name,' ',account_type,' ',account_number) 
		        account_holder
		        FROM accounts ORDER BY account_name LIMIT 0,1000";
		//echo $sql;
		$query = $this->db->query($sql);
		$result_data = $query->getResultArray();
		$result_arr = array();
		
		foreach($result_data as $key => $value){
			//echo 'key - '; print_r($key); echo '<br>';
			//echo 'key - '; print_r($value); echo '<br><br>';
			$result_arr[$value['account_number']] = $value['account_holder'];
		}
		
        return $result_arr;
	}
	public function update_accounts()
	{
		$sql = "SELECT account_number,
        		CONCAT(account_name,' ',bank_name,' ',account_type,' ',account_number) 
		        account_holder
		        FROM accounts 
		        ORDER BY account_name LIMIT 0,1000";
		//echo $sql;
		//echo "hello";
		$query = $this->db->query($sql);
		$result_data = $query->getResultArray();
		//return $result_data;
		$result_arr = array();
		
		foreach($result_data as $key => $value){
		   // echo 'key - '; print_r($key); echo '<br>';
		//	echo 'key - '; print_r($value); echo '<br><br>';
        $result_arr[$value['account_number']] = $value['account_holder'];
		}
		return $result_arr;
		
	}
	
}
