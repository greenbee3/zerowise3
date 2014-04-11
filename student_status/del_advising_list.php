<?
/*=============================================================================
  Program : Delete Tuition Fee List
  Author  : Junho Yeo
  Date    : 2009.09.13
  Comment : called from tuition_fee_list_form.php
  ===============================================================================*/
?>
<?// check login
//include_once("../../../../common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");

// find exactly matching tuition_reference record by using reference_id 
   	$sql = "delete from advising_reference  
			where reference_id = '$reference_id'
			";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[Success] Advising list record has been deleted.');
	opener.parent.body.location.replace('advising_list_form.php');
	window.close();
	</script>
	";
} else {
	echo "
	<script>
	alert('[Fail] Error is occured. Try again.');
	history.back();
	</script>
	";
}
?>
