<?php
require_once 'session.php';
if (isset($_POST['action'])&&$_POST['action']=='addNote') {
	$title=$cuser->testInput($_POST['title']);
	$note=$cuser->testInput($_POST['note']);

$addNote=$cuser->addNote($cid,$title,$note);
if ($addNote==true) {
	echo "good";
}
}//end of the post

if (isset($_POST['action'])&&$_POST['action']=='displayNote') {
	$output="";
	$getNote=$cuser->getNote($cid);
	if($getNote){
		$output.='<table class="table table-striped  text-center display" id="table_id">
				
				
					<thead class="thead-dark">
						<tr>
						<th>#</th>
						<th>Title</th>
						<th>Note</th>
						<th>Action</th>
						</tr>
					</thead>
				
				
					<tbody>';
					foreach ($getNote as $row) {
						$output.='<tr>
						<td>'.$row['id'].'</td>
						<td>'.$row['title'].'</td>
						<td>'.substr($row['note'], 0, 70).'</td>
						<td><a href="#" id="'.$row['id'].'" title="View details" class="text-success infoBtn">
							<i class="fa fa-info-circle fa-lg">&nbsp</i></a>
                             <a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn" data-target="#editNoteModal" data-toggle="modal">
							<i class="fa fa-edit fa-lg">&nbsp</i></a>
							<a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn">
							<i class="fa fa-trash fa-lg"></i></a>
						</td>
						</tr>';
					}//end of the foreach
					$output.='</tbody></table>';
					echo $output;

	}//end of the if $getNote
	else{
		echo"<h3 class='text-center text-secondary'>:(You Have Not Written any Note Yet
		Write Your First Note Now!</h3>";
	}
}//end of the if set 


//start edit note
if (isset($_POST['edit_id'])) {
$id=$_POST['edit_id'];
$getEditNote=$cuser->getEditNote($id);
echo json_encode($getEditNote);
}//end of the isset edit_id

//start update note
if (isset($_POST['action'])&&$_POST['action']=='update') {
	$id=$cuser->testInput($_POST['id']);
	$title=$cuser->testInput($_POST['title']);
	$note=$cuser->testInput($_POST['note']);
	$update_note=$cuser->editNote($title, $note, $id);
	if ($update_note) {
		echo "updated";
	}
}//end of the isset updat

if (isset($_POST['delete_id'])) {
	$id=$_POST['delete_id'];

	
	$delete=$cuser->deleteNote($id);
	if($delete){
		echo"Delete";
	}
}
//start of view details
if (isset($_POST['view_id'])) {
	$id=$_POST['view_id'];
$view=$cuser->getEditNote($id);
echo json_encode($view);
}
//end of view details

?>