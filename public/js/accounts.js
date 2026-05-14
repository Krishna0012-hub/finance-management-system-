
function add_account(){

	console.log('call add account data');
	$('#account_table').prepend('<tr id="row_id_0"><td></td>\
    <td><input type="text" id="account_name" style="width:100px"/></td>\
    <td><input type="text" id="account_number" autocomplete="off" style="width:100px" /></td>\
	 <td><select id="bank_name"  style="width:100px">\
	        <option value="BOB">BOB</option>\
			<option value="CAN">CAN</option>\
            <option value="HDFC">HDFC</option>\
			<option value="KOTAK">KOTAK</option>\
			<option value="PNB">PNB</option>\
			<option value="RENT">RENT</option>\
            <option value="SBI">SBI</option>\
			<option value="SBI MF">SBI MF</option>\
			<option value="UPSTOX">UPSTOX</option>\
			<option value="UPSTOX MF">UPSTOX MF</option>\
			<option value="Zeroda Stocks">Zeroda Stocks</option>\
			<option value="Zeroda MF">Zeroda MF</option>\
			<option value="Zeroda Wallet">Zeroda Wallet</option>\
			<option value="Cash In Reserve">Cash In Reserve</option>\
			<option value="NPS">NPS</option>\
			<option value="ELESS">ELESS</option>\
        </select>\
    </td>\
	 <td><select id="account_type">\
            <option value="Saving">Saving</option>\
            <option value="FD">FD</option>\
			<option value="Shares">Shares</option>\
		    <option value="MF">MF</option>\
			<option value="Wallet">Wallet</option>\
			<option value="Cash In Reserve">Cash In Reserve</option>\
			<option value="NPS">NPS</option>\
			<option value="ELESS">ELESS</option>\
        </select>\
    </td>\
    <td><input type="text" id="closure_date" class="datepicker" autocomplete="off" style="width:100px"/></td>\
    <td><input type="text" id="interest_rate" style="width:100px"/></td>\
    <td></td>\
	 <td></td>\
    <td><button type="button"  id="save_acc_data" style="width:52px"  onclick="save_acc_data(0)" /> <i class="fas fa-save"></i></button>\
    <button type="button" id="cancel_button" style="width:52px"  onclick="cancel_row(0)" /><i class="fas fa-times"></i></button></td>\
<tr>');
//console.log('now call a datepicker function');
 initializeDatePickers();
 console.log('call datepicker function');
}
$(document).ready(function () {
	console.log('declare datepicker function');
      initializeDatePickers();
    });
 function initializeDatePickers() {
	 console.log('Define datepicker function');
      $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd" // Set the date format
      });
    }
	

function save_acc_data(id){
 if($('#account_name').val() == ''){

  alert('Please Enter Account Name');	
return false;
}
 if($('#account_number').val() == ''){

  alert('Please Enter Account Number');	
return false;
}
if($('#bank_name').val() == ''){

  alert('Please Enter Bank name');	
return false;
}

	
	var data_arr = {};
	
	 // Iterate over the users array and append rows to the table body
        $('#row_id_'+id).find('td input, td select').each (function() {
			console.log(this.value);
			//console.log(this);
			 console.log($(this).attr('id'));
			 //data_arr.$(this).attr('id') = this.value;
			 data_arr[$(this).attr('id')] = this.value;
		  
		});  
	
		data_arr['id'] = id;
	console.log('data_arr - '); 
	console.log(data_arr);
	var method = id == 0 ? 'POST' : 'PUT';
	var url = id == 0
		? '/finance-management-system-/public/accounts'
		: '/finance-management-system-/public/accounts/' + id;
	
	// Send Ajax request
    $.ajax({
        type: method,
        url: url,
        data: data_arr, // Convert to JSON string
        success: function(response) {
            console.log(response); // Log the response from backend
            alert('User data saved successfully!');
			window.location.href = '/finance-management-system-/public/accounts';
            // Optionally clear form fields or perform other actions upon success
        },
        error: function(error) {
            console.error('Error:', error);
            alert('Error saving user data!');
        }
	});
}

function delete_account(id){
	
	//var value_id = $(this).closest('tr').find('#value_id').text();
	console.log('delete function is called  '  + id);
	alert(' id value is called   '  +  id);
//	alert(value_id);

// Send Ajax request
if (confirm('Are you sure you want to delete')) {
    $.ajax({
        type: 'DELETE',
        url: '/finance-management-system-/public/accounts/' + id,
        success: function(response) {
            console.log(response); // Log the response from backend
           // alert('User data deleted successfully!');
		   window.location.href = '/finance-management-system-/public/accounts';
            // Optionally clear form fields or perform other actions upon success
        },
        error: function(error) {
            console.error('Error:', error);
            alert('Error delete user data!');
        }
	});
}
   else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
}
	
}
function update_account(id){
	//alert('are you want to edit');
	console.log('are you want to edit');
	var html = $("#row_id_"+id).html();
	
	//console.log('html');
	console.log(html);
	var i=1;
	var html = '';
	$("#row_id_"+id).find('td').each (function() {
		//console.log(this.value);
		var td_val = $(this).html();
		console.log(td_val);
		
		if(i==2){
			html += '<td><input type="text" id="account_name" style="width:100px" value= "'+td_val+'"/></td>';
		}else if(i==3){
			html += '<td><input type="text" id="account_number" style="width:100px" value= "'+td_val+'"/></td>';
		}else if(i==4){
          html += '<td><select id="bank_name" style="width:100px">\
		        <option value="BOB"' + (td_val === 'BOB' ? ' selected' : '') + '>BOB</option>\
				 <option value="CAN"' + (td_val === 'CAN' ? ' selected' : '') + '>CAN</option>\
                <option value="HDFC"' + (td_val === 'HDFC' ? ' selected' : '') + '>HDFC</option>\
                <option value="KOTAK"' + (td_val === 'KOTAK' ? ' selected' : '') + '>KOTAK</option>\
                <option value="PNB"' + (td_val === 'PNB' ? ' selected' : '') + '>PNB</option>\
				<option value="RENT"' + (td_val === 'RENT' ? ' selected' : '') + '>RENT</option>\
				<option value="SBI"' + (td_val === 'SBI' ? ' selected' : '') + '>SBI</option>\
				<option value="SBI MF"' + (td_val === 'SBI MF' ? ' selected' : '') + '>SBI MF</option>\
				<option value="UPSTOX"' + (td_val === 'UPSTOX' ? ' selected' : '') + '>UPSTOX</option>\
			    <option value="UPSTOX MF"' + (td_val === 'UPSTOX MF' ? ' selected' : '') + '>UPSTOX MF</option>\
			    <option value="Zeroda Stocks"' + (td_val === 'Zeroda Stocks' ? ' selected' : '') + '>Zeroda Stocks</option>\
				<option value="Zeroda MF"' + (td_val === 'Zeroda MF' ? ' selected' : '') + '>Zeroda MF</option>\
				<option value="Zeroda Wallet"' + (td_val === 'Zeroda Wallet' ? ' selected' : '') + '>Zeroda Wallet</option>\
				<option value="Case In Reserve"' + (td_val === 'Case In Reserve' ? ' selected' : '') + '>Case In Reserve</option>\
				<option value="NPS"' + (td_val === 'NPS' ? ' selected' : '') + '>NPS</option>\
				<option value="ELESS"' + (td_val === 'ELESS' ? ' selected' : '') + '>NPS</option>\
		   </select></td>';
        } else if (i == 5) {
            html += '<td><select id="account_type" style="width:100px">\
                <option value="Saving"' + (td_val === 'Saving' ? ' selected' : '') + '>Saving</option>\
                <option value="Shares"' + (td_val === 'Shares' ? ' selected' : '') + '>Shares</option>\
				<option value="MF"' + (td_val === 'MF' ? ' selected' : '') + '>MF</option>\
				<option value="FD"' + (td_val === 'FD' ? ' selected' : '') + '>FD</option>\
				<option value="Wallet"' + (td_val === 'Wallet' ? ' selected' : '') + '>Wallet</option>\
				<option value="Case In Reserve"' + (td_val === 'Case In Reserve' ? ' selected' : '') + '>Case In Reserve</option>\
				<option value="NPS"' + (td_val === 'NPS' ? ' selected' : '') + '>NPS</option>\
				<option value="ELESS"' + (td_val === 'ELESS' ? ' selected' : '') + '>NPS</option>\
            </select></td>';
		}else if(i==6){
			html += '<td><input type="text" id="closure_date" class="datepicker" style="width:100px" value= "'+td_val+'"/></td>';
		}else if(i==7){
			html += '<td><input type="text" id="interest_rate" style="width:100px" value= "'+td_val+'"/></td>';
		}else if(i==8){
			html += '<td></td>';
		}else if(i==9){
			html += '<td></td>';
		}else if(i==10){
			html += '<td><button type="button" id="save_acc_data" style="width:52px" onclick="save_acc_data('+id+')" /><i class="fas fa-save"></i></button>\
						<button type="button"  id="cancel_button"  style="width:52px" onclick="cancel_row('+id+')" /><i class="fas fa-times"></i></button></td>';
		}else{
			html += '<td></td>';
		}
		
		i++;
		//var input = $('<input type="text" class="editInput"/>');
		  //input.val(html);
		  //$(this).html(input);
		 //console.log($(this).attr('id'));
		 //data_arr.$(this).attr('id') = this.value;
		 //data_arr[$(this).attr('id')] = this.value;
	  
	});  
	
	$("#row_id_"+id).html(html);
	
	 initializeDatePickers();
	
}

function cancel_row(id){
	console.log('cancel row is called');
	window.location.href = '/finance-management-system-/public/accounts';
	//$("#row_id_"+id).stop();

}
	




