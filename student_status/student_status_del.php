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
		delete from student_status_change_history 
		where rid = '$rid'
";

$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {

	echo "
	<script>
	alert('[Success] data is deleted.');
	location.replace('student_status_chg_list_form.php');
	</script>
	";
} else {
	echo "
	<script>
	alert('[Fail] No record is added. Try again.');
	location.replace('student_status_chg_list_form.php');
	</script>
	";
}
?>