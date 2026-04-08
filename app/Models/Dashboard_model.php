<?php
namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model
{
	public function get_account_total($request)
	{
	$sql = "SELECT
    SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) AS total_saving_amount,
    SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) AS total_fd_amount,
    SUM(CASE WHEN accounts.account_type = 'MF' THEN accounts_data.fixed_amount ELSE 0 END) AS total_mf_amount,
    SUM(CASE WHEN accounts.account_type = 'ELESS ' THEN accounts_data.fixed_amount ELSE 0 END) AS total_eless_mf_amount,
    SUM(CASE WHEN accounts.account_type = 'Shares' THEN accounts_data.fixed_amount ELSE 0 END) AS total_stocks_amount,
    SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_nps_amount,
    SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) AS total_cash_in_reserve,
    SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) AS total_money_in_hand,
    SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END) AS variable_amount,
    
    -- Summing specific fields for total_with_variable
            (SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'ELESS' THEN accounts_data.fixed_amount ELSE 0 END)+
             SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END)) AS total_with_variable,
    
    SUM(accounts_data.fixed_amount) AS total_amount,
    MAX(accounts_data.as_on_date) AS as_on_date
FROM accounts
LEFT JOIN accounts_data ON accounts.account_number = accounts_data.account_number
WHERE accounts_data.as_on_date = (
    SELECT MAX(as_on_date) 
    FROM accounts_data 
   WHERE accounts_data.as_on_date IS NOT NULL
);";

				 
				$query = $this->db->query($sql); 
            	  return $query->getResultArray();
	}
	public function pre_account_total($request)
	{
	$sql = "SELECT
            SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) AS total_saving_amount,
            SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) AS total_fd_amount,
            SUM(CASE WHEN accounts.account_type = 'MF' THEN accounts_data.fixed_amount ELSE 0 END) AS total_mf_amount,
            SUM(CASE WHEN accounts.account_type = 'ELESS ' THEN accounts_data.fixed_amount ELSE 0 END) AS total_eless_mf_amount,
            SUM(CASE WHEN accounts.account_type = 'Shares' THEN accounts_data.fixed_amount ELSE 0 END) AS total_stocks_amount,
            SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_nps_amount,
            SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) AS total_cash_in_reserve,
            SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) AS total_money_in_hand,
            SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END) AS variable_amount,
            
            -- Summing specific fields for total_with_variable
            (SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'ELESS' THEN accounts_data.fixed_amount ELSE 0 END)+
             SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END)) AS total_with_variable,
    
            SUM(accounts_data.fixed_amount) AS total_amount,
            MAX(accounts_data.as_on_date) AS as_on_date
            FROM accounts
            LEFT JOIN accounts_data ON accounts.account_number = accounts_data.account_number
            WHERE accounts_data.as_on_date = (
            SELECT MAX(as_on_date)
            FROM accounts_data 
            WHERE as_on_date < (SELECT MAX(as_on_date) 
										FROM accounts_data)
);";
				//echo $sql; die;
				$query = $this->db->query($sql);
            	 return $query->getResultArray();
	}
public function difference_account_total($request)
	{
	$sql = "WITH latest_data AS (
    SELECT
        SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) AS total_saving_amount,
        SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) AS total_fd_amount,
        SUM(CASE WHEN accounts.account_type = 'MF' THEN accounts_data.fixed_amount ELSE 0 END) AS total_mf_amount,
        SUM(CASE WHEN accounts.account_type = 'ELESS ' THEN accounts_data.fixed_amount ELSE 0 END) AS total_eless_mf_amount,
        SUM(CASE WHEN accounts.account_type = 'Shares' THEN accounts_data.fixed_amount ELSE 0 END) AS total_stocks_amount,
        SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_nps_amount,
        SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) AS total_cash_in_reserve,
        SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) AS total_money_in_hand,
        SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END) AS variable_amount,
        (SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END)) AS total_with_variable,
        SUM(accounts_data.fixed_amount) AS total_amount,
        MAX(accounts_data.as_on_date) AS as_on_date
    FROM accounts
    LEFT JOIN accounts_data ON accounts.account_number = accounts_data.account_number
    WHERE accounts_data.as_on_date = (
        SELECT MAX(as_on_date) 
        FROM accounts_data 
        WHERE accounts_data.as_on_date IS NOT NULL
    )
),
previous_data AS (
    SELECT
        SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) AS total_saving_amount,
        SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) AS total_fd_amount,
        SUM(CASE WHEN accounts.account_type = 'MF' THEN accounts_data.fixed_amount ELSE 0 END) AS total_mf_amount,
        SUM(CASE WHEN accounts.account_type = 'ELESS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_eless_mf_amount,
        SUM(CASE WHEN accounts.account_type = 'Shares' THEN accounts_data.fixed_amount ELSE 0 END) AS total_stocks_amount,
        SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_nps_amount,
        SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) AS total_cash_in_reserve,
        SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) AS total_money_in_hand,
        SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END) AS variable_amount,
        (SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) +
         SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END)) AS total_with_variable,
        SUM(accounts_data.fixed_amount) AS total_amount,
        MAX(accounts_data.as_on_date) AS as_on_date
    FROM accounts
    LEFT JOIN accounts_data ON accounts.account_number = accounts_data.account_number
    WHERE accounts_data.as_on_date = (
        SELECT MAX(as_on_date) 
        FROM accounts_data
        WHERE as_on_date < (SELECT MAX(as_on_date) FROM accounts_data)
    )
)

-- Final result to show the difference
SELECT
    latest_data.total_saving_amount - previous_data.total_saving_amount AS saving_diff,
    latest_data.total_fd_amount - previous_data.total_fd_amount AS fd_diff,
    latest_data.total_mf_amount - previous_data.total_mf_amount AS mf_diff,
    latest_data.total_eless_mf_amount - previous_data.total_eless_mf_amount AS eless_mf_diff,
    latest_data.total_stocks_amount - previous_data.total_stocks_amount AS stocks_diff,
    latest_data.total_nps_amount - previous_data.total_nps_amount AS nps_diff,
    latest_data.total_cash_in_reserve - previous_data.total_cash_in_reserve AS cash_in_reserve_diff,
    latest_data.total_money_in_hand - previous_data.total_money_in_hand AS money_in_hand_diff,
    latest_data.variable_amount - previous_data.variable_amount AS variable_amount,
    latest_data.total_with_variable - previous_data.total_with_variable AS total_with_variable_diff,
    latest_data.total_amount - previous_data.total_amount AS total_diff
FROM latest_data, previous_data;

";			//	//echo $sql; die;
				$query = $this->db->query($sql);
            	 return $query->getResultArray();
	}
	 public function single_data($request)
	 {
		$sql = "SELECT
		account_name,
    SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) AS total_saving_amount,
    SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) AS total_fd_amount,
    SUM(CASE WHEN accounts.account_type = 'MF' THEN accounts_data.fixed_amount ELSE 0 END) AS total_mf_amount,
    SUM(CASE WHEN accounts.account_type = 'ELESS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_eless_mf_amount,
    SUM(CASE WHEN accounts.account_type = 'Shares' THEN accounts_data.fixed_amount ELSE 0 END) AS total_stocks_amount,
    SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) AS total_nps_amount,
    SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) AS total_cash_in_reserve,
    SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) AS total_money_in_hand,
    SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END) AS variable_amount,
    
    -- Summing specific fields for total_with_variable
            (SUM(CASE WHEN accounts.account_type = 'Saving' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'FD' THEN accounts_data.fixed_amount ELSE 0 END) +
              SUM(CASE WHEN accounts.account_type = 'ELESS' THEN accounts_data.fixed_amount ELSE 0 END)+
             SUM(CASE WHEN accounts.account_type = 'NPS' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Cash In Reserve' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type = 'Money In Hand' THEN accounts_data.fixed_amount ELSE 0 END) +
             SUM(CASE WHEN accounts.account_type IN ('MF', 'Shares') THEN accounts_data.veriable_amount ELSE 0 END)) AS total_with_variable,
    
    SUM(accounts_data.fixed_amount) AS total_amount,
    MAX(accounts_data.as_on_date) AS as_on_date
FROM accounts
LEFT JOIN accounts_data ON accounts.account_number = accounts_data.account_number
WHERE accounts_data.as_on_date = (
    SELECT MAX(as_on_date) 
    FROM accounts_data 
   WHERE accounts_data.as_on_date IS NOT NULL
)
GROUP BY accounts.account_name;
";
		//echo $sql; 
		$query = $this->db->query($sql);
        return $query->getResultArray();
	 }
}