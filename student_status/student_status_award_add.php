<?
/*=============================================================================
  Program : Create a new faculty
  Author  : Sejong Oh, SY Lee
  Date    : 2008.7.22	
  Comment : called from student_status_award_add_form.php
  ===============================================================================*/
?>
<?// check login
include_once("../../../common/login/check_login.php");
include_once("../../../common/lib/dbcon.php");


$student_code = trim($student_id);  // delete space
$faculty_name = trim($student_name);
/*
// Check if same record exists
$sql = "select count(*) from code_special_event_record
				where student_id='$student_id', year='$year', semester='$semester', special_event_code='$special_event_code' ";
$res = mysql_query($sql);
$rs = mysql_fetch_row($res);
$already_registered_count = $rs[0];
if ($already_registered_count>0) {
	echo "
	<script>
	alert('[Error] Same award record already exists.\\r\\n\\r\\n.');
	history.back();
	</script>
	";
	die;
} 
*/
// Save to databas
$sql = "
	insert into special_event_record (
	  student_id,
	  year,
	  semester,
	  special_event_code,
	  special_event_type,
	  comment,
	  sys_date
 		) 
 	values (
 		'$student_id',
 		'$year',
 		'$semester',
 		'$special_event_code',
 		'$special_event_type',
 		'$comment',
 		now()
 		)";

$res = mysql_query($sql);

$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[Success] New award record is created.');
	history.back();
	</script>
	";
} else {
	echo "
	<script>
	alert('[Fail] Error exists! Try again.');
	history.back();
	</script>
	";
}
?>