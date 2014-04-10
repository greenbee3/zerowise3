<?
/*=============================================================================
  Program : Edit a Student Information
  Author  : Sejong Oh
  Date    : 2008.1.31	
  Comment : Called from edit_form.php 
  ===============================================================================*/
?>
<?
include_once("../../../common/login/check_login.php");
include_once("../../../common/lib/dbcon.php");


//데이터베이스에 등록합니다.
	$sql = "
		insert into student_status_change_history 
		(student_id,
		 change_year_from,
		 semester_from,
		 change_year_to,
		 semester_to,
		 change_date,
		 status_change_code,
		 change_reason,
		 etc
		 )
		values 
		('$student_id',
		 '$change_year_from',
		 '$semester_from',
		 '$change_year_to',
		 '$semester_to',
		 '$change_date',
		 '$status_change_code',
		 '$change_reason',
		 '$comment'
		 )
		 ";

$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();

if ($affected_rows>0) {
/*
	$curr_status = "";
	switch (intval($status_change_code)) {
		case(20): //Exchange To (begin)   
			$curr_status = '20';
			break;
		case(25): //Exchange To (End)
			$curr_status = '10';
			break;
		case(30): //Exchange From (begin)
			$curr_status = '30';
			break;
		case(35): //Exchange From (End)
			$curr_status = '35';
			break;
		case(40): //Temporal Absence (begin)
			$curr_status = '40';
			break;
		case(45): //Temporal Absence (End)
			$curr_status = '10';
			break;
		case(50): //Withdrawal
			$curr_status = '50';
			break;
		case(60): //Expulsion
			$curr_status = '60';
			break;
		case(70): //Auditor
			$curr_status = '70';
			break;
		case(99): //Graduation
			$curr_status = '99';
			break;
	}

	// Change student status
	$sql2 = "
		update student set status = '$curr_status' 
		where student_id = '$student_id'
			";
	$res2 = mysql_query($sql2);
*/
	echo "
	<script>
	alert('[Success] New Student Status Change data is created.');
	location.replace('student_status_add_form.php?student_id=".$student_id."');
	</script>
	";
} else {
	echo "
	<script>
	alert('[Fail] No record is added. Try again.');
	location.replace('student_status_add_form.php?student_id=".$student_id."');
	</script>
	";
}
?>