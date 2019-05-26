$(document).ready(function(e){
	var payroll_status = "basic";

	if($("input[name='payroll_type']").val() == '1'){
		payroll_status = "hourly";
	}
	//var base_url = "http://localhost:8000/";
	var base_url = "https://app.germeda.de/public/";

	$(".edit-employee").click(function(e){
		var emp_id = $(this).attr("employee-id");
		 $.ajax({
			url : base_url + 'user/getById',
	        type : 'post',
	        dataType : 'json',
	        data: {emp_id: emp_id},
	        success: function(data){
	        	console.log(data);
	        	$("#editUserModal input[name='user_id']").val(data['id']);
	        	$("#editUserModal input[name='name']").val(data['name']);
	        	$("#editUserModal input[name='address']").val(data['address']);
	        	$("#editUserModal input[name='zip']").val(data['zip']);
	        	$("#editUserModal input[name='city']").val(data['city']);
	        	$("#editUserModal input[name='mobile']").val(data['mobile']);
	        	$("#editUserModal input[name='email']").val(data['email']);
	        	$("#editUserModal input[name='birthday']").val(data['birthday']);
	        	$("#editUserModal input[name='rate_per_hour']").val(data['rate_per_hour']);
	        	$("#editUserModal input[name='base_salary']").val(data['base_salary']);
	        	$("#editUserModal input[name='extra_charge_night']").val(data['extra_charge_night']);
	        	$("#editUserModal input[name='extra_charge_saturday']").val(data['extra_charge_saturday']);
	        	$("#editUserModal input[name='extra_charge_sunday']").val(data['extra_charge_sunday']);
	        	$("#editUserModal input[name='extra_charge_feast']").val(data['extra_charge_feast']);
	        	$("#editUserModal input[name='custom_field1']").val(data['custom_field1']);
	        	$("#editUserModal input[name='custom_field2']").val(data['custom_field2']);
	        	$("#editUserModal input[name='custom_field3']").val(data['custom_field3']);
	        	$("#editUserModal input[name='custom_field4']").val(data['custom_field4']);
	        	$("#editUserModal input[name='custom_field5']").val(data['custom_field5']);	
	        }
		})
	});
	$(".delete-employee").click(function(e){
		var emp_id = $(this).attr("employee-id");
		$("#deleteUserModal input[name='user_id']").val(emp_id);
	});

	$("#employeeTable").footable({});
	$("#payrollTable").footable({});

	$("select[name='employee_id']").change(function(e){
		var emp_id = $(this).val();
		$.ajax({
			url : base_url + 'user/getById',
	        type : 'post',
	        dataType : 'json',
	        data: {emp_id: emp_id},
	        success: function(data){
	        	$("input[name='hourly_rate']").val(data['rate_per_hour']);
	        	$("input[name='night']").val(data['extra_charge_night']);
	        	$("input[name='saturday']").val(data['extra_charge_saturday']);
	        	$("input[name='sunday']").val(data['extra_charge_sunday']);
	        	$("input[name='feast']").val(data['extra_charge_feast']);
	        	$("input[name='base_salary']").val(data['base_salary']);
	        	calculateTotal();
	        }
		})
	});

	$("input[type='number']").change(function(e){
		calculateTotal();	
	});

	function calculateTotal(){
		var hourly_rate = $("input[name='hourly_rate']").val();
		var saturday_hours = $("input[name='saturday_hours']").val();
		var sunday_hours = $("input[name='sunday_hours']").val();
		var night_hours = $("input[name='night_hours']").val();
		var feast_hours = $("input[name='feast_hours']").val();

		var percent_night = Number($("input[name='night']").val()) / 100;
		var percent_saturday = Number($("input[name='saturday']").val()) / 100;
		var percent_sunday = Number($("input[name='sunday']").val()) / 100;
		var percent_feast = Number($("input[name='feast']").val()) / 100;
		if(payroll_status == 'hourly'){
			var working_hours = $("input[name='working_hours']").val();
			
			var total_hours = Number(working_hours) + Number(saturday_hours * percent_saturday) + Number(sunday_hours * percent_sunday) + Number(night_hours * percent_night) + Number(feast_hours * percent_feast);
			var total_amount = hourly_rate * total_hours;
			
		} else {
			var basic_salary = $("input[name='base_salary']").val();
			var extra_hours = Number(saturday_hours * percent_saturday) + Number(sunday_hours * percent_sunday) + Number(night_hours * percent_night) + Number(feast_hours * percent_feast);
			var total_amount = Number(hourly_rate * extra_hours) + Number(basic_salary.replace('.', '').replace(',', '.'));
		}
		
		
		total_amount = total_amount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		total_amount = total_amount.replace(".", "-");
    	total_amount = total_amount.replace(",", ".");
    	total_amount = total_amount.replace("-", ",");

		$(".total_amount").html(total_amount);
		$("input[name='total_amount']").val(total_amount);
	}

	check_askForChange();
	setInterval(function(){ check_askForChange(); }, 3000);

	function check_askForChange(){
		$.ajax({
			url : base_url + 'payroll/getAskingRequests',
	        type : 'get',
	        dataType : 'json',
	        success: function(data){
	        	if(data.length > 0){
	        		$(".exist_ask_request").css('display', 'block');
	        		var notification_item = "";
	        		for(var i = 0; i < data.length; i++){
	        			notification_item += "<div class='notification-item  clearfix'>";
	        			notification_item += "<div class='heading'>";
	        			notification_item += "<a href='"+base_url+"payroll/edit/"+data[i]['id']+"' class='text-danger pull-left'>";
	        			notification_item += "<i class='fa fa-exclamation-triangle m-r-10'></i>";
	        			notification_item += "<span class='bold'>" +data[i]['employee_name']+"</span>";
	        			notification_item += "<span class='fs-12 m-l-10'>"+data[i]['total_amount']+"€ </span>";
	        			notification_item += "</a>";
	        			notification_item += "</div>";
	        			notification_item += "</div>";
	        		}
	        		$(".notification-body").html(notification_item);
	        	}
	        }
		})
	}

	$(".status_btn").click(function(e){
		$("#confirmBilledModal input[name='payroll_id']").val($(this).attr("payroll-id"));
	});

	$("#payroll-status").change(function(e){
		e.preventDefault();
		$("#payrollTable").trigger("footable_filter", {filter: $(this).val()});
	});

	$(".detail_btn").click(function(e){
		$.ajax({
			url : base_url + 'payroll/getDetail',
	        type : 'post',
	        data: {payroll_id: $(this).attr('payroll-id')},
	        dataType : 'json',
	        success: function(data){
	        	$("#detailModal select[name='employee_id']").val(data['employee_id']);
	        	$("#detailModal input[name='month']").val(data['month']);
	        	$("#detailModal input[name='date']").val(data['date']);
	        	$("#detailModal input[name='working_hours']").val(data['working_hours']);
	        	$("#detailModal input[name='saturday_hours']").val(data['saturday_hours']);
	        	$("#detailModal input[name='sunday_hours']").val(data['sunday_hours']);
	        	$("#detailModal input[name='night_hours']").val(data['night_hours']);
	        	$("#detailModal input[name='feast_hours']").val(data['feast_hours']);
	        	$("#detailModal textarea[name='note']").html(data['note']);
	        	if(data['type'] == 0){
	        		payroll_status = "basic";
	        		$("#detailModal .hourly-part").css('display', 'none');
	        		$("#detailModal #detailyes").attr('checked', true);
	        		$("#detailModal #detailno").attr('checked', false);
	        		$("#detailModal #detailno").prop('disabled', true);

	        	} else {
	        		payroll_status = "hourly";
	        		$("#detailModal .hourly-part").css('display', 'block');
	        		$("#detailModal #detailno").attr('checked', true);
	        		$("#detailModal #detailyes").attr('checked', false);
	        		$("#detailModal #detailyes").prop('disabled', true);
	        	}
	        	
	        	$("#detailModal .total_amount").html(data['total_amount']);
	        }
		})
	});

	const monthNames = ["January", "February", "March", "April", "May", "June",
	  "July", "August", "September", "October", "November", "December"
	];

	function changeCurrencyFormat(amount){
		var total_amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    	total_amount = total_amount.replace(".", "-");
    	total_amount = total_amount.replace(",", ".");
    	total_amount = total_amount.replace("-", ",");
    	return total_amount;
	}

	$("input[name='birthday']").datepicker({format:'dd.mm.yyyy'});

	$("input[name='month']").datepicker({format:'dd.mm.yyyy'});

	$("input.filter_month").datepicker({format:'dd.mm.yyyy'});

	
	$('.filter_month').datepicker({
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
	});
	$(".filter_month").change(function(e){
		var date = $(this).val();
		date = date.split('.')[1] + '/' + date.split('.')[0] + '/' + date.split('.')[2];
		var date = new Date(date);
		var filter_month = monthNames[date.getMonth()] + ", " + date.getFullYear();
		$("#payrollTable").trigger("footable_filter", {filter: filter_month});
	});

	$(".reset-password").click(function(e){
		var user_id = $(this).attr('employee-id');
		$("#resetPasswordModal input[name='user_id']").val(user_id);
	});
	$(".reset-btn").click(function(e){
		var new_pwd = $("#resetPasswordModal input[name='new_password']").val();
		var confirm_pwd = $("#resetPasswordModal input[name='confirm_password']").val();
		var user_id = $("#resetPasswordModal input[name='user_id']").val();
		if(new_pwd != confirm_pwd){
			$("#resetPasswordModal .error").html("Please confirm new password");
		} else {
			$.ajax({
				url : base_url + 'user/resetPassword',
		        type : 'post',
		        data: {new_pwd: new_pwd, user_id: user_id},
		        dataType : 'json',
		        success: function(data){
		        	if(data['reset'] == "done"){
		        		window.location.href = base_url + "user";
		        	}
		        }
			})
		}
	});
	$(".accept_btn").click(function(e){
		$.ajax({
            url : base_url + 'payroll/setStatus',
            type : 'post',
            dataType : 'json',
            data: {status: 'Accepted', id: $(this).attr('payroll-id'), comment:""},
            success: function(data){
                window.location.href = base_url + "payroll/user";
            }
        });
	});
	$(".ask_btn").click(function(e){
		var payroll_id = $(this).attr('payroll-id');
		$("#askModal input[name='payroll_id']").val(payroll_id);
	});
	$(".ask_confirm_btn").click(function(e){
		var payroll_id = $("#askModal input[name='payroll_id']").val();
		var comment = $("#askModal textarea").val();
		$.ajax({
            url : base_url + 'payroll/setStatus',
            type : 'post',
            dataType : 'json',
            data: {status: 'Ask for change', id: payroll_id, comment:comment},
            success: function(data){
                window.location.href = base_url + "payroll/user";
            }
        });
	});

	$("input[name='type']").change(function(e){
		if($(this).val() == "1"){
			payroll_status = "hourly";
			$(".hourly-part").css('display', 'block');
			calculateTotal();
		} else {
			payroll_status = "basic";
			calculateTotal();
			$(".hourly-part").css('display', 'none');
		}
	});
});