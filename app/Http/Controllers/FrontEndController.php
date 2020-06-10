<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use App\Ticket;

class FrontEndController extends Controller
{
    //
    public function submit_final_save(Request $request){
//      array:9 [
//   "_token" => "mRjWc9idjZy2NDNaPahCv5NqQNdncE38Wxadon3A"
//   "event_name" => "asdas"
//   "event_description" => "dasdas"
//   "start_date" => "06/11/2020"
//   "end_date" => "06/18/2020"
//   "organizer" => "asdasdsa"
//   "enter_id" => array:2 [
//     0 => ""
//     1 => "1231"
//   ]
//   "enter_ticket_no" => array:2 [
//     0 => ""
//     1 => "213211"
//   ]
//   "enter_price" => array:2 [
//     0 => ""
//     1 => "12311"
//   ]
// ]
    	 $box = $request->all();  
    	 $myValue=  array();
    		parse_str($box['payload'], $myValue);
 		$user_info = new UserInfo;
    	$user_info->name = $myValue['event_name'];
    	$user_info->desc = $myValue['event_description'];
    	$user_info->start_date = $myValue['start_date'];
    	$user_info->end_date = $myValue['end_date'];
    	$user_info->organizer = $myValue['organizer'];
    	$user_info->save();
 		$i =0 ;	
 		foreach($myValue['enter_id'] as $k){
 			$ticket = new Ticket;
 			$ticket->row_id = $k;
 			$ticket->ticket_id = $myValue['enter_ticket_no'][$i];
 			$ticket->price = $myValue['enter_price'][$i];
 			$ticket->user_info_id= $user_info->id;
 			$ticket->save();
 		}

 		return response(['success'=>true]);

    }
    public function create_save_row(Request $request){
    	 
  		// enter_id
		// enter_ticket_no
		// enter_price
    	$data='';
    	$time = now();
    	$data.=' 
    		<div class="row" id="row'.$request->enter_id.'">
				<div class="col-md-3">
					<input type="number" value="'.$request->enter_id.'" readonly name="enter_id[]" id="enter_id'.$request->enter_id.'" placeholder="Enter Id">
				</div>
				<div class="col-md-3">
					<input type="number"  value="'.$request->enter_ticket_no.'" readonly name="enter_ticket_no[]"  id="enter_ticket_no'.$request->enter_id.'" placeholder="Enter Ticket No. eg.. 00003">
				</div>
				<div class="col-md-3">
					<input type="number"  value="'.$request->enter_price.'" readonly name="enter_price[]" id="enter_price'.$request->enter_id.'" placeholder="Enter Price ">
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-sm btn-success save" id="save_btn'.$request->enter_id.'" style="display:none" enter_id="'.$request->enter_id.'">Save</button>
					<button type="button" class="btn btn-sm btn-info edit" id="edit_btn'.$request->enter_id.'" enter_id="'.$request->enter_id.'" >Edit</button>
					<button type="button" enter_id="'.$request->enter_id.'" class="btn btn-sm btn-danger delete" id="delete_btn'.$request->enter_id.'" >Delete</button>
				</div>
			</div>
			<script>
			$(".delete").on("click",function(e){
				var enter_id = $(this).attr("enter_id");
				$("#row"+enter_id).remove();
				});
			$(".edit").on("click",function(e){
			var enter_id = $(this).attr("enter_id");
				e.preventDefault();
				
				$("#save_btn"+enter_id).show();
				$("#enter_id"+enter_id).removeAttr("readonly");
				$("#enter_ticket_no"+enter_id).removeAttr("readonly");
				$("#enter_price"+enter_id).removeAttr("readonly"); 
				$("#edit_btn"+enter_id).hide();
				$("#delete_btn"+enter_id).hide();


				});
				$(".save").on("click",function(e){
					e.preventDefault();
					var enter_id = $(this).attr("enter_id");
					var new_id_val = $("#enter_id"+enter_id).val();
					var new_ticket_no_val = $("#enter_ticket_no"+enter_id).val();
					var new_price_val = $("#enter_price"+enter_id).val();
					if(new_id_val==""){
						alert("Id is required");
					}
					if(new_ticket_no_val==""){
						alert("ticket no is required");
					}
					if(new_price_val==""){
						alert("price is required");
					}

					$("#enter_id"+enter_id).val(new_id_val);
					$("#enter_ticket_no"+enter_id).val(new_ticket_no_val);
					$("#enter_price"+enter_id).val(new_price_val);
					$(this).hide();
					$("#edit_btn"+enter_id).show();
					$("#delete_btn"+enter_id).show(); 
					$("#enter_id"+enter_id).attr("readonly",true);
					$("#enter_ticket_no"+enter_id).attr("readonly",true);
					$("#enter_price"+enter_id).attr("readonly",true);
					
					});
			</script>
			';
    	return response(['success'=>true,'data'=>$data]);
    }

    public function second_time_save(Request $request){
    	$data='';
    	$data.='<div class="row'.$request->enter_id.'">
				<div class="col-md-3">
					<input type="number" value="'.$request->enter_id.'" readonly name="enter_id[]" id="enter_id'.$request->enter_id.'" placeholder="Enter Id">
				</div>
				<div class="col-md-3">
					<input type="number"  value="'.$request->enter_ticket_no.'" readonly name="enter_ticket_no[]"  id="enter_ticket_no'.$request->enter_id.'" placeholder="Enter Ticket No. eg.. 00003">
				</div>
				<div class="col-md-3">
					<input type="number"  value="'.$request->enter_price.'" readonly name="enter_price[]" id="enter_price'.$request->enter_id.'" placeholder="Enter Price ">
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-sm btn-success save" id="save_btn'.$request->enter_id.'" style="display:none" enter_id="'.$request->enter_id.'">Save</button>
					<button type="button" class="btn btn-sm btn-info edit" id="edit_btn'.$request->enter_id.'" enter_id="'.$request->enter_id.'" >Edit</button>
					<button type="button" enter_id="'.$request->enter_id.'" class="btn btn-sm btn-danger delete" id="delete_btn'.$request->enter_id.'" >Delete</button>
				</div>
			</div>';
			return response(['success'=>true,'data'=>$data]);
    }
}
// $.ajax({
// 		                type: "POST",
// 		                url: "/second_time_save",
// 		                headers: {
// 		                    "X-CSRF-TOKEN": $("#csrf_token").attr("content")
// 		                },
// 		                data: {
// 		                    new_id_val: new_id_val,  
// 		                    new_ticket_no_val: new_ticket_no_val,  
// 		                    new_price_val: new_price_val,  
// 		                    enter_id: enter_id,  
// 		                },  
// 		                success: function (restwo) {
// 		                    if (restwo.success) {		                         
// 		                        $("#row"+new_id_val).html(restwo.data);
// 		                    }		                    
// 		                }		        
// 		           	});



