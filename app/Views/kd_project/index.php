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
</head>
<body>
<div class="content">
        <div class="container-fluid" >
    <h3 class="mb-4 text-center">ACCOUNTS</h3>
    <div class="row">
        <!-- Buttons in a row with responsive columns -->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <button type="submit" id="alert-button" class="btn btn-success" onclick="add_account()">ADD</button>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 ms-auto text-end">
			 <!--<a href="<?php echo base_url();?>/logout" class="btn btn-primary">Logout</a>-->
        </div>
    </div>
    <br><br>

    <!-- Responsive grid for the table -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover display" id="account_table">
			  <!-- <table id="example" class="display" style="width:100%">-->
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Account Type</th>
                            <th>Closure Date</th>
                            <th>Interest Rate</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						//echo die;
                        foreach($accounts_data as $acc_key => $acc_value){
                            echo '<tr id="row_id_'.$acc_value['id'].'">
                                    <td>'.$acc_value['id'].'</td>
                                    <td>'.$acc_value['account_name'].'</td>
                                    <td>'.$acc_value['account_number'].'</td>
                                    <td>'.$acc_value['bank_name'].'</td>
                                    <td>'.$acc_value['account_type'].'</td>
                                    <td>'.$acc_value['closure_date'].'</td>
                                    <td>'.$acc_value['interest_rate'].'</td>
                                    <td>'.$acc_value['created_by'].'</td>
                                    <td>'.$acc_value['created_date'].'</td>
                                    <td style="width:180px">
									
										<button type="button" class="" style="width:55px" onclick="delete_account('.$acc_value['id'].')">
                                        <i class="fas fa-trash-alt"></i>
                                        </button>
										<button type="button" class="" style="width:55px" onclick="update_account('.$acc_value['id'].')">
                                        <i class="fas fa-edit"></i>
                                    </td>
                                  </tr>';
						}
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('#account_table').DataTable({
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100]
        });
		//alert('datatable');
    });
</script>

<script type="text/javascript" src="<?php echo base_url('js/dash.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/accounts.js'); ?>"></script>
</html>
