<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test</title>
	<meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body> 
	<div class="container">
		<h4 align="center" style="margin-top:55px;margin-bottom:23px;">Test</h4>
	
			<form id="test_form" method="post">
				@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="event_name">Event Name</label>
						<input type="text" id="event_name" name="event_name" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="event_description">Event Description</label>
						<textarea id="event_description" name="event_description" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="start_date">Start Date</label>
						<input type="text" id="start_date" name="start_date" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="end_date">End Date</label>
						<input type="text" id="end_date" name="end_date" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="organizer">Organizer</label>
						<input type="text" id="organizer" name="organizer" class="form-control">
					</div>
				</div>
				 
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<button type="button" id="add_new_ticket" class="btn btn-sm btn-info">Add New Ticket</button>
					</div>
				</div>
			</div>
				
			<div class="row" >
				<div class="col-md-3">
					<label for="id">id</label>
				</div>
				<div class="col-md-3">
					<label for="ticket_no">Ticket No.</label>
				</div>
				<div class="col-md-3">
					<label for="price">Price</label>
				</div>
				<div class="col-md-3">
					<label for="action">Action</label>
				</div>
			</div>
			<div class="row" id="div_to_show" style="display: none">
				<div class="col-md-3">
					<input type="number" id="enter_id" placeholder="Enter Id">
				</div>
				<div class="col-md-3">
					<input type="number" id="enter_ticket_no" placeholder="Enter Ticket No. eg.. 00003">
				</div>
				<div class="col-md-3">
					<input type="number" id="enter_price" placeholder="Enter Price ">
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-sm btn-success" id="save_btn">Save</button>
					{{-- <button type="button" class="btn btn-sm btn-info edit" style="display: none">Edit</button>
					<button type="button" class="btn btn-sm btn-danger delete" style="display:none">Delete</button> --}}
				</div>
			</div>
			<span id="div_to_show_save"></span>
			<button class="btn btn-sm btn-success" id="save_event" style="display: none">Save Event</div>

			</form>
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	  
	<script>
		$(document).ready(function(){

 
 			// $( "#start_date" ).datepicker({
 			// 	minDate:'0'
 			// });
 			// $( "#end_date" ).datepicker({

 			// });
 				$("#start_date").datepicker({
			    changeMonth: true, 
			    changeYear: true, 
			    dateFormat: 'yy-mm-dd',
			    minDate: 0, // 0 days offset = today
			    
			    onSelect: function(dateText) {
			        $sD = new Date(dateText);
			        $("#end_date").datepicker('option', 'minDate', $sD);
			    }
			});
 				$("#end_date").datepicker({ 
    dateFormat: 'yy-mm-dd',
    changeMonth: true
});
 			
 			$('#add_new_ticket').on('click',function(){
 				// e.preventDefault();
 				
 				var name = $('#event_name').val();
 			var desc = $('#event_description').val();
 			var start_date = $('#start_date').val();
 			var end_date = $('#end_date').val();
 			var organizer = $('#organizer').val();
 				if(name==''){
 					alert('Please Fill Out the Name field');
 				}
 				else if(desc==''){
 					alert('Please Fill Out the Description field');
 				}
 				else if(start_date==''){
 					alert('Please Fill Out the Start Date field');
 				}
 				else if(end_date==''){
 					alert('Please Fill Out the End Date field');
 				}
 				else if(organizer==''){
 					alert('Please Fill Out the Organizer field');
 				}  
 				else{
 					$('#div_to_show').show();
 				}
 				
 				// name:name,
 				// 	desc:desc,
 				// 	start_date:start_date,
 				// 	end_date:end_date,
 				// 	organizer:organizer 
 			}); 
				 
			$("#save_btn").on("click",function(e){
				e.preventDefault();
				var enter_id = $("#enter_id").val();
				var enter_ticket_no = $("#enter_ticket_no").val();
				var enter_price = $("#enter_price").val();
				if(enter_id==''){
					alert('Enter Id please');
				}
				else if(enter_ticket_no==''){
					alert('Enter ticket no. please');
				}
				else if(enter_price==''){
					alert('Enter price please');
				}
				else{
					$.ajax({
	                type: "POST",
	                url: "/create_save_row",
	                headers: {
	                    "X-CSRF-TOKEN": $("#csrf_token").attr("content")
	                },
	                data: {
	                    enter_id: enter_id,  
	                    enter_ticket_no: enter_ticket_no,  
	                    enter_price: enter_price,  
	                },  
	                success: function (res) {
	                    if (res.success) {		                    
	                    $("#enter_id").val('');
						$("#enter_ticket_no").val('');
						$("#enter_price").val('');     
	                        $("#div_to_show_save").append(res.data);
	                        $("#save_event").show();

	                    }else{
	                        $("#div_to_show_save").html("<h3>No Results</h3>");
	                    }
	                }
	        
	           	});
				}
				
				}); 
 			
 			$("#save_event").on('click',function(e){
 				e.preventDefault();
	 			var name = $('#event_name').val();
	 			var desc = $('#event_description').val();
	 			var start_date = $('#start_date').val();
	 			var end_date = $('#end_date').val();
	 			var organizer = $('#organizer').val();
	 			if(name==''){
 					alert('Please Fill Out the Name field');
 				}
 				else if(desc==''){
 					alert('Please Fill Out the Description field');
 				}
 				else if(start_date==''){
 					alert('Please Fill Out the Start Date field');
 				}
 				else if(end_date==''){
 					alert('Please Fill Out the End Date field');
 				}
 				else if(organizer==''){
 					alert('Please Fill Out the Organizer field');
 				}  
 				else if($('input[name="enter_price"]').val()==''){
 					alert('No Ticket(s) Created');
 				}
 				else{
 					var payload = $("#test_form").serialize();
 				$.ajax({
	                type: "POST",
	                url: "/submit_final_save",
	                headers: {
	                    "X-CSRF-TOKEN": $("#csrf_token").attr("content")
	                },
	                data: {
	                    payload: payload,
	                },  
	                success: function (res) {
	                    if (res.success) {	                   
	                    
	                    	alert('Everything Done Thanks!!!');
	                    	window.location.reload('true');
	                    } 
	                }
	        
	           	});
 				}
 				
 			});
 			



		});
	</script>
</body>
</html>