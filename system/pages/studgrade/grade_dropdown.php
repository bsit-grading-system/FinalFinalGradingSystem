<?php
	include "../connection.php";
	if(isset($_POST['sy_id'])){

		$sy_id = $_POST['sy_id'];
		$query = mysqli_query($con,"select *
									from tblclass 
									where schoolyearid = '$sy_id' ") or die('Error: ' . mysqli_error($con));
		$rowCount = mysqli_num_rows($query);

		if($rowCount > 0){
			echo '<option value="" disabled selected>-- Select Class -- </option>';
			while($row = mysqli_fetch_array($query))
			{
				echo '<option value="'.$row['id'].'">'.$row['classname'].'</option>';
			}
		}
		else {
			echo '<option value="" disabled selected>-- No Class yet for this school year --</option>';
		//	echo '<script>$("#subj_name").hide();document.getElementById("btn_add").disabled = true;</script>';
		}
	}

	if(isset($_POST['class_id'])){

		$class_id = $_POST['class_id'];
		$query = mysqli_query($con,"select *,s.id as studID
									from tblstudentclass sc
									left join tblstudent s on sc.studentid = s.id
									where sc.classid = '$class_id' ");
		$rowCount = mysqli_num_rows($query);

		if($rowCount > 0){
			echo '<option value="" disabled selected>-- Select Student -- </option>';
			while($row = mysqli_fetch_array($query))
			{
				echo '<option value="'.$row['studID'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>';
			}
		}
		else {
			echo '<option value="" disabled selected>-- No student for this class --</option>';
		}
	}

	if(isset($_POST['stud_id'])){

		$stud_id = $_POST['stud_id'];
		$query = mysqli_query($con,"select *,s.id as subjID
									from tblstudentclass sc
									left join tblsubjects s on sc.subjectid = s.id
									where sc.studentid = '$stud_id' ");
		$rowCount = mysqli_num_rows($query);

		if($rowCount > 0){
			echo '<option value="" disabled selected>-- Select Subject -- </option>';
			while($row = mysqli_fetch_array($query))
			{
				echo '<option value="'.$row['subjID'].'">'.$row['subjectname'].' - '.$row['description'].'</option>';
			}
		}
		else {
			echo '<option value="" disabled selected>-- No subject for this student --</option>';
		}
	}

	if(isset($_POST['subj_id'])){
		$sy_id = $_POST['sy_id1'];
		$class_id = $_POST['class_id1'];
		$stud_id = $_POST['stud_id1'];
		$subj_id = $_POST['subj_id1'];
	
		$query = mysqli_query($con, "SELECT *, sg.id as subjID
									FROM tblstudentgrade sg
									WHERE sg.schoolyearid = '$sy_id'
									AND sg.classid = '$class_id'
									AND sg.studentid = '$stud_id'
									AND sg.subjectid = '$subj_id' ");
		$rowCount = mysqli_num_rows($query);
	
		if ($rowCount > 0) {
			echo '1'; // This indicates that data is present for the specified conditions
		} else {
			echo '0'; // This indicates that no data is present for the specified conditions
		}
	}
?>