function login()
  {
	 console.log('start');
	  
	   $("#signupForm").validate({
			  
        rules: {
			 password: {
                required: true,
                minlength: 2
            },
          email: {
                required: true,
                email: true
            },
           messages: {
			    password: {
                required: " Please enter a password",
                minlength:
                    " Your password must be consist of at least 2 characters"
            },
		},
		}
	   });
		console.log('mid');
    /*
	var email = $('#email').val();
	var password = $('#password').val();
	//console.log('Sign is called.');
	//alert(email);
	if(email=="")
	{
		//alert('please enter email_id ');
		$("#mail").html("Please enter email!").css({
    "color": "red",
    "font-size": "14px",
    "font-weight": "bold",
    "padding": "10px",
    "border": "1px solid red",
    "background-color": "#fdd"
});	
		console.log('mail');
		return false;
	}
	if(password=="")
	{
		//alert('please enter sign_password');
		$("#psd").html("Please enter password!").css({
    "color": "red",
    "font-size": "14px",
    "font-weight": "bold",
    "padding": "10px",
    "border": "1px solid red",
    "background-color": "#fdd"
});	
		return false;
	}*/
	
	  }