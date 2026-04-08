<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('css/dash.css'); ?>">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<style>
.custom-width {
    max-width: 20% !important;
}
</style>
</head>
<body>

	<div class="content">
        <div class="container-fluid" style="padding-right: 50px;">
            <h1 class="mt-4">Dashboard</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6 custom-width">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
						<?php foreach($total_fd as $acc_key => $acc_value) : ?>
                            <h5 class="card-title">Total Savings</h5>
                            <p class="card-text">₹ <?php echo number_format($acc_value['total_saving_amount'], 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 custom-width">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total FD</h5>
                            <p class="card-text">₹ <?php echo number_format($acc_value['total_fd_amount'], 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 custom-width">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Total MF</h5>
                            <p class="card-text">₹ <?php echo number_format($acc_value['total_mf_amount'], 2); ?></p>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 custom-width">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Stocks</h5>
                            <p class="card-text">₹ <?php echo number_format($acc_value['total_stocks_amount'], 2); ?></p>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-3 col-md-6 custom-width">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total With Variable Amount</h5>
                            <p class="card-text">₹ <?php echo number_format($acc_value['total_with_variable'], 2); ?></p>
                        </div>
						
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
			<div class="card">
                <div class="card-header">
                    Account Overview
                </div>
  
  <div class="card-body">
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover" id="dash">
            <thead class="table-dark">
                <tr>
                    <th style="width:100px">As on Date</th>
                    <th>Total Saving </th>
                    <th>Total FD </th>
                    <th>Total Money In ELESS MF</th>
                    <th>Total Money In MF</th>
                    <th>Total Money In Stocks</th>
                    <th>NPS</th>
                    <th>Cash In Reserve</th>
                    <th>Total Variable</th>
                    <th>Total With Variable Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($total_fd as $acc_key => $acc_value) {
                    echo '<tr>
                        <td>'.$acc_value['as_on_date'].'</td>
                        <td>'.number_format($acc_value['total_saving_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_fd_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_eless_mf_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_mf_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_stocks_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_nps_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_cash_in_reserve'], 2).'</td>
                        <td>'.number_format($acc_value['variable_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_with_variable'], 2).'</td>
                        <td>'.number_format($acc_value['total_amount'], 2).'</td>
                    </tr>';
                }

                foreach($pre_data as $acc_key => $acc_value) {
                    echo '<tr>
                        <td>'.$acc_value['as_on_date'].'</td>
                        <td>'.number_format($acc_value['total_saving_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_fd_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_eless_mf_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_mf_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_stocks_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_nps_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_cash_in_reserve'], 2).'</td> 
                        <td>'.number_format($acc_value['variable_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_with_variable'], 2).'</td>
                        <td>'.number_format($acc_value['total_amount'], 2).'</td>
                    </tr>';
                }
				foreach($difference_data as $acc_key => $acc_value) {
    echo '<tr>
        <td>DIFF</td>';
    echo '<td style="color: ' . ($acc_value['saving_diff'] > 0 ? 'green' : ($acc_value['saving_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['saving_diff'], 2) . '</td>';
    echo '<td style="color: ' . ($acc_value['fd_diff'] > 0 ? 'green' : ($acc_value['fd_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['fd_diff'], 2) . '</td>';
        echo '<td style="color: ' . ($acc_value['eless_mf_diff'] > 0 ? 'green' : ($acc_value['eless_mf_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['eless_mf_diff'], 2) . '</td>';
    
    echo '<td style="color: ' . ($acc_value['mf_diff'] > 0 ? 'green' : ($acc_value['mf_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['mf_diff'], 2) . '</td>';
    echo '<td style="color: ' . ($acc_value['stocks_diff'] > 0 ? 'green' : ($acc_value['stocks_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['stocks_diff'], 2) . '</td>';
    echo '<td style="color: ' . ($acc_value['nps_diff'] > 0 ? 'green' : ($acc_value['nps_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['nps_diff'], 2) . '</td>';
	echo '<td style="color: ' . ($acc_value['cash_in_reserve_diff'] > 0 ? 'green' : ($acc_value['cash_in_reserve_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['cash_in_reserve_diff'], 2) . '</td>';
    echo '<td style="color: ' . ($acc_value['variable_amount'] > 0 ? 'green' : ($acc_value['variable_amount'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['variable_amount'], 2) . '</td>';
        echo '<td style="color: ' . ($acc_value['total_with_variable_diff'] > 0 ? 'green' : ($acc_value['total_with_variable_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['total_with_variable_diff'], 2) . '</td>';
    echo '<td style="color: ' . ($acc_value['total_diff'] > 0 ? 'green' : ($acc_value['total_diff'] < 0 ? 'red' : 'black')) . ';">' 
        . number_format($acc_value['total_diff'], 2) . '</td>';
    echo '</tr>';
}

                ?>
            </tbody>
        </table>
    </div>

    <h3 class="mb-4 text-center">Single Person Data</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="single_data">
            <thead class="table-dark">
                <tr>
                    <th>Owner</th>
                    <th>Total Saving </th>
                    <th>Total FD </th>
                    <th>Total In ELESS MF</th>
                    <th>Total  In MF</th>
                    <th>Total In Stocks</th>
                    <th>NPS</th>
                    <th>Cash In Reserve</th>
                    <th>Variable Amount</th>
                      <th>Total With Variable Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($single_data as $acc_key => $acc_value) {
                    echo '<tr>
                        <td>'.$acc_value['account_name'].'</td>
                        <td>'.number_format($acc_value['total_saving_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_fd_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_eless_mf_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_mf_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_stocks_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_nps_amount'], 2).'</td> 
                        <td>'.number_format($acc_value['total_cash_in_reserve'], 2).'</td> 
                        <td>'.number_format($acc_value['variable_amount'], 2).'</td>
                        <td>'.number_format($acc_value['total_with_variable'], 2).'</td>
                        <td>'.number_format($acc_value['total_amount'], 2).'</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    console.log('dashboard datatable');
    // Initialize DataTables for both tables
    //$('#dash').DataTable();
    $('#single_data').DataTable();
    console.log('call dashboard');
    console.log('call datatable');
});
</script>
<script src="<?php echo base_url('js/bootstrap.bundle.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dash.js'); ?>"></script>

</body>
</html>
