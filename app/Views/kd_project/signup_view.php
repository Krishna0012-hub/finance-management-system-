<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>
 <?php
 /*
 foreach($accounts_data as $acc_key => $acc_value){
				//echo 'key - '; echo $acc_key. ' - acc_value - '; print_r($acc_value['account_no']); echo '<br>';
				
				echo 'acc_value - '.$acc_value['account_name'].'<br>';
				echo 'acc_value - '.$acc_value['account_number'].'<br>';
			}*/
			?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-container">
                <h1>Sign Up</h1>	
				<?php $session = session(); ?>
	<h1>Welcome, <?php echo $session->get('user');?></h1>
                <!-- Form -->
				 <form action="<?php echo base_url();?>/SignupController/signupPost" method="post" id="signupForm">
                    <div class="form-group">
                        <label for="email">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter name" required>
                    </div>
					 <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
						<div class="message" id="mail"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
						<div class="message" id="psd"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Account Number</label>
                        <input type="password" class="form-control" id="account_number" name="account_number" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Signup</button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?php echo base_url();?>/login">Already have an account? Login</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 4 JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
</body>
</html>
