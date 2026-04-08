
//$(document).ready(function() {
    // Your code here
    console.log("The document is ready!");
	
	console.log('Script Started.');

	let string = "";
	let buttons = document.querySelectorAll('.button');

	console.log('buttons - ');
	console.log(buttons);

	Array.from(buttons).forEach((button)=>{
	 button.addEventListener('click', (e)=>{
		 
		 console.log('innerHTML - ');
		 console.log(e.target.innerHTML);
		 
	 if(e.target.innerHTML == '='){
		 
		  console.log('In IF - ');
		 
		string = eval(string);
		document.querySelector('input').value = string;
	 }
	 else if(e.target.innerHTML == 'C'){
		 
		 console.log('In else If - ');
		 
		string = " "
		document.querySelector('input').value = string;
	 }
	   else{
		   
			console.log('In else - ');
		   
		console.log(e.target)
		string = string + e.target.innerHTML;
		document.querySelector('input').value = string;
	   }
	 })
	})
	console.log('Script Ended.');
	
//});

