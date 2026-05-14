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
			return $this->insert_account($request);
		
		}else{
			return $this->update_account($request['id'], $request);
		}
    }
	public function delete_accounts_data($request)
    {
		return $this->delete_account($request['id']);
    }

	public function insert_account($data)
	{
		$datetime = date("Y-m-d H:i:s");

		$this->db->table('accounts')->insert([
			'account_name'   => $data['account_name'] ?? '',
			'account_number' => $data['account_number'] ?? '',
			'bank_name'      => $data['bank_name'] ?? '',
			'account_type'   => $data['account_type'] ?? '',
			'closure_date'   => $data['closure_date'] ?? '',
			'interest_rate'  => $data['interest_rate'] ?? '',
			'created_by'     => '1',
			'created_date'   => $datetime,
		]);

		return true;
	}

	public function update_account($id, $data)
	{
		$this->db->table('accounts')
			->where('id', $id)
			->update([
				'account_name'   => $data['account_name'] ?? '',
				'account_number' => $data['account_number'] ?? '',
				'bank_name'      => $data['bank_name'] ?? '',
				'account_type'   => $data['account_type'] ?? '',
				'closure_date'   => $data['closure_date'] ?? '',
				'interest_rate'  => $data['interest_rate'] ?? '',
			]);

		return true;
	}

	public function delete_account($id)
	{
		$this->db->table('accounts')
			->where('id', $id)
			->delete();

		return true;
	}
}
?>
