<?php
namespace App\Models;

use CodeIgniter\Model;

class Import_model extends Model
{
   
   protected $table = 'accounts_data'; 
  protected $allowedFields = ['account_number','as_on_date','fixed_amount','veriable_amount','diff_amount','updated_by','updated_date'];

public function import_accounts_data($data)
{
	$data['updated_date'] = date('Y-m-d H:i:s'); 
    $data['as_on_date'] = date('Y-m-d', strtotime($data['as_on_date']));

    return $this->insert([
        'account_number' => $data['account_number'],
        'as_on_date' => $data['as_on_date'],
        'fixed_amount' => $data['fixed_amount'],
        'veriable_amount' => $data['veriable_amount'],
        'diff_amount' => $data['diff_amount'],
        'updated_by' => $data['updated_by'],
        'updated_date' => $data['updated_date'],
    ]);
}

}
