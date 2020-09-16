<?php
require_once 'php/header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if($verified= "Not verified"):?>
				<div class="alert alert-danger alert-dismissible mt-2 m-0 text-center">
					Your E-mail is Not verified! we've sent you an E-mail verification link on your E-mail, check &verify now
					<button class="close " type="button" data-dimiss="alert" >&times</button>
				</div>
			<?php endif;?>
			<h4 class="text-center text-primary mt-2">Write Your Notes Here & Access Anytime Anywhere</h4>
		</div><!--lg-->
	</div><!--row-->
	<div class="card border-primary">
		<h5 class="card-header bg-primary d-flex justify-content-between">
			<span class="text-light lead align-self-center">All Notes</span>
			
			<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal">
				<i class="fa fa-plus-circle fa-lg"> </i>&nbsp Add New Note</a>
		</h5>
		<div class="card-body">
			<div  class="table-responsive" id="showNote">
			<!--table return from ajax-->
		    </div><!--table-->
		</div><!--card-body-->
	</div><!---card--->
</div><!--container-->
<!----------Add New Note modal---------->
<div class="modal fade" id="addNoteModal">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title text-center">Add New Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				
			</div><!---modal header--->
			<div class="modal-body">
					<form method="post" action="" class="px-3" id="add-note-form">
						<div class="form-group">
							<input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title">
						</div>
						<div class="form-group">
							<textarea class="form-control form-control-lg" name="note" placeholder="Enter Your Note Here ...." row="6" required=""></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="addNote" value="add Note" class="btn btn-success btn-block btn-lg " id="addNoteBtn">
						</div>
					</form>
				</div><!---modal body--->
		</div><!---modal content--->
	</div><!---model dialog--->
</div><!---modal fade--->


<!----------end Add New Note---------->

<!----------start edit Note modal---------->
<div class="modal fade" id="editNoteModal">
	<div class="modal-dialog  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-center">Edit Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				
			</div><!---modal header--->
			<div class="modal-body">
					<form method="post" action="" class="px-3" id="edit-note-form">
						<input type="hidden" name="id" id="EditId">
						<div class="form-group">
							<input type="text" name="title" id="EditTitle" class="form-control form-control-lg" placeholder="Enter Title">
						</div>
						<div class="form-group">

							<textarea class="form-control form-control-lg" name="note" placeholder="Enter Your Note Here ...." row="6" id="EditNote" required=""></textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="submitNote" value="Update Note" class="btn btn-info btn-block btn-lg " id="updatenote">
						</div>
					</form>
				</div><!---modal body--->
		</div><!---modal content--->
	</div><!---model dialog--->
</div><!---modal fade--->

<!----------end edit Note---------->
	<script src="design/js/jquery-3.3.1.min.js"></script>
	<script src="design/js/bootstrap.min.js"></script>
	<script src="design/js/control.js"></script>
	<script src="design/js/popper.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


	<script type="text/javascript">

	$(document).ready(function(){
//add ajax request
$("#addNoteBtn").click(function(e){
if ($("#add-note-form")[0].checkValidity()) {
e.preventDefault();
$("#addNoteBtn").val("please wait ......");
$.ajax({
	url:"php/process.php",
	method:"post",
	data:$("#add-note-form").serialize()+'&action=addNote',
	
	success:function(response){

		
			$("#addNoteBtn").val("addNote");
			$("#add-note-form")[0].reset();   
		    $("#addNoteModal").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#addNoteModal").hide();
		   Swal.fire({
              title:"Note Added Successfully !",
              type:"success"
		   });
		   displayAllNote();
	}//success
});//end of the ajax
}//end of the check validity
});//==========================================end of the addnotebtn

//start Edit note ajax
$("body").on("click", ".editBtn", function(e){
e.preventDefault();
edit_id = $(this).attr("id");
$.ajax({
    url:"php/process.php",
	method:"post",
	data:{edit_id: edit_id},
    success:function(response){
/*
$('#showNote').html(response);
//TABLE 
    $('#table_id').DataTable({
    	order: [0, 'desc']
    });
*/
data =JSON.parse(response);
$('#EditId').val(data.id);
$('#EditTitle').val(data.title);
$('#EditNote').val(data.note);

	}

});//end of the ajax request
}); //end of the edit-id

//============================================end of the Edit note

//==================================start update Note
$("#updatenote").click(function(e){

	if ($("#edit-note-form")[0].checkValidity) {
e.preventDefault()
$("#updatenote").val('please wait.....');
$.ajax({
url:"php/process.php",
method:'post',
data:$("#edit-note-form").serialize()+"&action=update",

success:function(response){
	if (response=='updated') {

		$("#updatenote").val('Update Note');
   
  $("#editNoteModal").removeClass("in");
  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
  $("#editNoteModal").hide();
		   Swal.fire({
              title:"Note Updated Successfully !",
              type:"success"
		   });
		   displayAllNote();
	}//end if the response equal updatyed

}//end of the request success
});//end of the ajax
}//end of check validity
});//en dof the click function

//==================================end update Note


//==================================start delete note
$('body').on('click', '.deleteBtn', function(e){
e.preventDefault();
delete_id= $(this).attr("id");
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
  	$.ajax({
	url:'php/process.php',
	method:'post',
	data: { delete_id: delete_id },
	success:function(response){
		
		if(response=='Delete'){
Swal.fire(
      'Deleted!',
      'Note Delete Successfully!',
      'success'
    )//end of the Swal.fire
displayAllNote();
		
		
		}//en dof the delete 
		
	}//end of the success
});//end of the ajax
    
  }//result.isConfirmed
})//then((result)

});//en dof the select elemenet
//==================================end delete note
//==================================start Display  note


$("body").on("click", ".infoBtn", function(e){
e.preventDefault();
view_id=$(this).attr('id');
$.ajax({


	url:"php/process.php",
	method:"post",
	data:{view_id: view_id},
	
	success:function(response){
data =JSON.parse(response);
Swal.fire({
title: "<strong> ID("+data.id+")</strong>",
type: 'info',
html:'<b> Title :</b>'+data.title+'<br><br><b>Note :</b>'+data.note+'<br><br> <b>Written on :</b>'+data.create_at+'<br><br> <b>Update on :</b>'+data.update_at,
showCloseButton:true,
});

}
    });//end of the ajax
});//end of the select elemnet
//==================================end Display  note
displayAllNote();

//Display all note
function displayAllNote(){

	$.ajax({


	url:"php/process.php",
	method:"post",
	data:{action: 'displayNote'},
	
	success:function(response){

$('#showNote').html(response);
//TABLE 
    $('#table_id').DataTable({
    	order: [0, 'desc']
    });


	}

});//end of the ajax request
}//end of the function display all note
});//END OF THE DOCUMENT .READY
	</script>




</body>

</html>