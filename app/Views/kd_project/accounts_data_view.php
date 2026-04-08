<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <!--<script type="text/javascript" src="<?php echo base_url('js/jquery-3.7.1.min.js'); ?>"></script>-->
	<!-- for datepicker Library -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI CSS (for styling the datepicker) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <!-- jQuery UI Library (for datepicker functionality) -->
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('css/dash.css'); ?>">
	<!--- for using icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	 <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
</head>

<body>
	<div class="content">
        <div class="container-fluid" style="width: 100%;
    padding-right: 45px;
    padding-left: 1px;">
    <h3 class="mb-4 text-center">Accounts Data</h3>
    <form action="<?= base_url('/csvPost') ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload CSV" name="submit" class="btn btn-primary">
</form>
    <div class="row">
        <!-- Buttons in a row with responsive columns -->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <button type="submit" id="alert-button" class="btn btn-success" onclick="add_account_data()">ADD</button>
        </div>
    </div>

	 <br><br>
    <div class=" table-responsive">
        <table class="table table-bordered table-striped table-hover" id="account_data_table">
             <thead class="table-dark">
            <tr class="">
            <th>ID</th> 
            <th>Account Name</th>			
            <th>Account Number</th>			
            <th style="90px;">As on date</th> 
            <th>Fixed amount</th> 
            <th>Veriable amount</th> 
            <th>Different amount</th>
            <th>Updated by</th> 
            <th>Updated date</th> 
            <th>ACTION</th> 			
            </tr>
       </thead>
	   <?php  
	   
    	   //echo 'data of  - <pre>'; print_r($accounts_data); echo '<br>';
		    
	foreach($accounts_data as $acc_key => $acc_value){
				//echo 'key - '; echo $acc_key. ' - acc_value - '; print_r($acc_value['account_no']); echo '<br>';
				
				//echo 'acc_value - '.$acc_value['fixed_amount'].'<br>';
				
				/* foreach($acc_value as $arr_key => $arr_value){
					echo 'arr_key - '; echo $arr_key. ' - arr_value - '; print_r($arr_value); echo '<br>';
				} 
			}*/
				
				echo '<tr id="row_id_'.$acc_value['id'].'">
						<td>'.$acc_value['id'].'</td>  
                        <td>'.$acc_value['account_holder'].' </td>						
						<td>'.$acc_value['account_number'].'</td>  
						<td>'.$acc_value['as_on_date'].'</td>  
						<td>'.number_format($acc_value['fixed_amount'], 2).'</td> 
						<td>'.number_format($acc_value['veriable_amount'], 2).'</td>
						<td>'.number_format($acc_value['veriable_amount'] - $acc_value['fixed_amount'],2).'</td> 
						<td>'.$acc_value['updated_by'].'</td> 
						<td>'.$acc_value['updated_date'].'</td> 
						<td>
						<button type="button" class="" style="width:35px" onclick="delete_account('.$acc_value['id'].')">
                         <i class="fas fa-trash-alt"></i></button>
			            <button type="button" class="" style="width:35px" onclick="update_account('.$acc_value['id'].')">
                         <i class="fas fa-edit"></i>
						</td> 
					  </tr>';				
			}

			?>
			               
        <tbody>
            
        </tbody>
        </table>
		</div>
</div>
</body>
<script>
 $(document).ready(function() {
    var username = 'Accounts_Data'; // Example username. Replace with actual logic to get the username.

    $('#account_data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                titleAttr: 'Export the table data to Excel',
                className: 'btn btn-success', // Adds Bootstrap styling for the button
                filename: function() {
                    return username; // Custom filename based on the username
                }
            }
        ]
    });
});

</script>
	 <script type="text/javascript" src="<?php echo base_url('js/dash.js'); ?>"></script>          
<script type="text/javascript" src="<?php echo base_url('js/accounts_data.js'); ?>"></script>
</html>