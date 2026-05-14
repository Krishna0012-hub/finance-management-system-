function add_account_data(){
  console.log('add data');
  	const account_list_json = get_fields_data();
	console.log('account_list_json - ');
	console.log(account_list_json);
	
	var account_list_arr = JSON.parse(account_list_json);
	
	console.log('account_list_arr - ');
	console.log(account_list_arr);
	
	let message = "";
	 $.each(account_list_arr, function(key, value) {
                   // message += key + ": " + value + "\n";
				    message += '<option value="' +key+ '">' +value+ '</option>';
					//console.log('key is -'+ key);
					//console.log('value is -'+ value);
                });
				console.log(message);
	
       $('#account_data_table').prepend('<tr id="row_id_0"><td></td>\
										<td><select id="account_number"  style="width:80px">\''
                                         + message +
                                         '</select>\
                                         </td>\
										 <td></td>\
                                        <td><input type="text" id="as_on_date" class="datepicker" autocomplete="off" style="width:80px"/></td>\
                                        <td><input type="text" id="fixed_amount" style="width:80px"/></td>\
                                        <td><input type="text" id="veriable_amount" style="width:80px"/></td>\
                                        <td><input type="text" id="diff_amount" style="width:80px" readonly/></td>\
                                        <td></td>\
	                                    <td></td>\
									<td><button type="button" id="save_acc_data" style="width:35px" onclick="save_acc_data(0)" /><i class="fas fa-save"></i></button>\
									<button type="button" id="cancel_button"  style="width:35px" onclick="cancel_row(0)" /><i class="fas fa-times"></i></button></td>\
                                    <tr>');
									
	initializeDatePickers();
    }
	$(document).ready(function () {
      initializeDatePickers();
    });
 function initializeDatePickers() {
      $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd" // Set the date format
      });
    }
	
function save_acc_data(id){    
 if($('#account_number').val() == ''){
  alert('Please Enter Account Number');	
  return false;
  }
  if($('#as_on_date').val() == ''){
  alert('Please Enter your Date');	
  return false;
  }
  if($('#fixed_amount').val() == ''){
  alert('Please Enter Fixed amount');	
  return false;
  }
        var data_arr = {};
        
         // Iterate over the users array and append rows to the table body
            $('#row_id_'+id).find('td input, td select').each (function() {
                console.log(this.value);
                console.log(this);
                 console.log($(this).attr('id'));
             //    data_arr.$(this).attr('id') = this.value;
                 data_arr[$(this).attr('id')] = this.value;
              
            });  
        data_arr['id'] = id;
        console.log('data_arr - '); 
        console.log(data_arr);
        
        // Send Ajax request
         $.ajax({
            type: 'POST',
            url: '/codeigniter/public/accounts_data/save_accounts_data', // Adjust URL as per your routing
            data: data_arr, // Convert to JSON string
            success: function(response) {
                console.log(response); // Log the response from backend
                alert('User data saved successfully!');
                window.location.href = '/codeigniter/public/accounts_data';
                // Optionally clear form fields or perform other actions upon success
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Error saving user data!');
            }
        });
    }	
 
function get_fields_data(id)
{
	console.log('call get field data');
		  
		var data = '';  
		  
		   $.ajax({
            type: 'POST',
            url: '/codeigniter/public/accounts_data/get_fields_data', // Adjust URL as per your routing
            data: id, // Convert to JSON string
			async: false, 
            success: function(response) {
                console.log('response comes'+response); // Log the response from backend
               // alert('User data saved successfully!');
               // window.location.href = '/codeigniter/public/accounts_data';
                // Optionally clear form fields or perform other actions upon success
				data = response;
				return response;
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Error saving user data!');
            }
        });
		  return data;   
}           
function update_account(id){
	const account_list_json = update_acc_data();
	console.log('account_list_json - ');
	console.log(account_list_json);
	
	var account_list_arr = JSON.parse(account_list_json);
	
	console.log('account_list_arr - ');
	console.log(account_list_arr);
	
	 var sel_account_no =  $("#row_id_"+id).find('td:nth-child(3)').text();

    console.log('sel_account_no - ' + sel_account_no);

	let message = "";
	 $.each(account_list_arr, function(key, value) {
                   // message += key + ": " + value + "\n";
                   if(sel_account_no == key){
                        message += '<option value="' +key+ '" selected>' +value+ '</option>';
                   }else{
                        message += '<option value="' +key+ '">' +value+ '</option>';
                   }					
                });
	console.log('message '+ message);
	console.log('are you want to edit');
	var html = $("#row_id_"+id).html();
	
	//console.log('html');
	console.log('html ' +html);
	var i=1;
	var html = '';
	$("#row_id_"+id).find('td').each (function() {
		//console.log(this.value);
		var td_val = $(this).html();
		console.log('td_val '+td_val);	
		if(i==2){
			html += '<td><select id="account_number"  style="width:100px">\''
                                         + message +
                                         '</select>\</td>';
		}else if(i==3){
			html += '<td></td>';
		}else if(i==4){
			html += '<td><input type="text" id="as_on_date" class="datepicker" style="width:80px" value= "'+td_val+'"/></td>';
		}else if(i==5){
            var unformattedValue = td_val.replace(/,/g, '');
            html += '<td><input type="text" id="fixed_amount" style="width:80px" value= "'+unformattedValue+'"/></td>';
	
	}else if(i==6){
	     var unformattedValue = td_val.replace(/,/g, '');
			html += '<td><input type="text" id="veriable_amount" style="width:80px" value= "'+unformattedValue+'"/></td>';
		}else if(i==7){
			html += '<td><input type="text" id="diff_amount" style="width:80px" value= "'+td_val+'" readonly/></td>';
		}else if(i==8){
			html += '<td></td>';
		}else if(i==9){
			html += '<td></td>';
		}else if(i==10){
			html += '<td><button type="button" id="save_acc_data"  style="width:35px" onclick="save_acc_data('+id+')" /><i class="fas fa-save"></i></button>\
						<button type="button" id="cancel_button"  style="width:35px" onclick="cancel_row('+id+')" /><i class="fas fa-times"></i></button></td>';
		}else{
			html += '<td></td>';
		}
		i++;
	});  
	//console.log('all html comes by id');
	$("#row_id_"+id).html(html);
	initializeDatePickers();
}
function update_acc_data(id){
		   $.ajax({
            type: 'POST',
            url: '/finance-management-system-/public/accounts_data/update_acc_data', // Adjust URL as per your routing
            data: id, // Convert to JSON string
			async: false, 
            success: function(response) {
                console.log(response); // Log the response from backend
               // alert('ajax called!');
				data = response;
				return response;
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Error saving user data!');
            }
        });
		   return data;
}
	function delete_account(id){
	
	//var value_id = $(this).closest('tr').find('#value_id').text();
	console.log('delete function is called  '  + id);
	alert(' id value is called   '  +  id);
if (confirm('Are you sure you want to delete')) {
    $.ajax({
        type: 'POST',
        url: '/finance-management-system-/public/accounts_data/delete_accounts_data', // Adjust URL as per your routing
        data: {'id':id} , // Convert to JSON string
        success: function(response) {
            console.log(response); // Log the response from backend
            //alert('User data deleted successfully!');
		   window.location.href = '/finance-management-system-/public/accounts_data';
            // Optionally clear form fields or perform other actions upon success
        },
        error: function(error) {
            console.error('Error:', error);
            alert('Error delete user data!');
        }
	});
}
   else {
  console.log('Thing was not saved to the database.');
}
}
  function cancel_row(id){
	console.log('cancel row is called');
	$("#row_id_"+id).remove();
}



