$(document).ready(function(e){

	//var base_url = "http://localhost:8000/";
	var base_url = "https://app.germeda.de/public/";

	$("#shiftTable").footable({});
	$("#teamTable").footable({});

	$(".select2").select2();

	$(".delete-team").click(function(e){
		var team_id = $(this).attr("team-id");
		$("#deleteTeamModal input[name='team_id']").val(team_id);
	});

	$(".edit-team").click(function(e){
		var team_id = $(this).attr("team-id");
		$("#editTeamModal input[name='team_id']").val(team_id);
		$.ajax({
			url : base_url + 'team/getById',
	        type : 'post',
	        dataType : 'json',
	        data: {team_id: team_id},
	        success: function(data){
	        	$("#editTeamModal input[name='name']").val(data['name']);
	        	var employees = JSON.parse(data['employee_id']);
	        	$("#editTeamModal select").val(employees).trigger('change');
	        }
		})
	});

	$(".delete-shift").click(function(e){
		var shift_id = $(this).attr("shift-id");
		$("#deleteShiftModal input[name='shift_id']").val(shift_id);
	});

	$(".edit-shift").click(function(e){
		var shift_id = $(this).attr("shift-id");
		$("#editShiftModal input[name='shift_id']").val(shift_id);
		$.ajax({
			url : base_url + 'shift/getById',
	        type : 'post',
	        dataType : 'json',
	        data: {shift_id: shift_id},
	        success: function(data){
	        	$("#editShiftModal input[name='name']").val(data['name']);
	        	$("#editShiftModal select").val(data['team_id']);
	        	$("#editShiftModal input[name='hours']").val(data['hours']);
	        	$("#editShiftModal select[name='color']").val(data['color']);
	        	$("#editShiftModal select").select2();

	        }
		})
	});

	$(".detail-roaster").click(function(e){
		window.location.href = $(this).attr('data-url');
	});
	
	$(".delete-roaster").click(function(e){
		var roaster_id = $(this).attr("roaster-id");
		$("#deleteRoasterModal input[name='roaster_id']").val(roaster_id);
	});

	$("input[name='show_month']").datepicker({format:'dd.mm.yyyy'});

	const monthNames = ["January", "February", "March", "April", "May", "June",
	  "July", "August", "September", "October", "November", "December"
	];

	var check_changed = 0;
	$("input[name='show_month']").change(function(e){
		check_changed++;
		$("input[name='month']").val($(this).val());
		var month = parseInt($(this).val().split(".")[1]);
		var year = $(this).val().split(".")[2];
		month = monthNames[month - 1];
		if(check_changed == 2){
			$(this).val(month + ', ' + year);
		} 
		if(check_changed == 3){
			var month = parseInt($("input[name='month']").val().split(".")[1]);
			var year = $("input[name='month']").val().split(".")[2];
			month = monthNames[month - 1];
			$(this).val(month + ', ' + year);
			check_changed = 0;
		}
	});

	$("input[name='roaster_type']").change(function(e){
		localStorage.setItem("roaster_type", $(this).val());
		window.location.reload();
	});

});