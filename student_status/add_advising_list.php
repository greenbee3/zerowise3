<?
/*=============================================================================
  Program : Create a new advising List
  Author  : Seokwon Kong
  Date    : 2014.04.10	
  Comment : called from add_advising_list_form.php
  ===============================================================================*/
?>
<?// check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");

// Check if the tuition fee info exists
$sql = "select count(*) as cnt from advising_reference 
        where 
		(open_year='$open_year') and
		(semester='$semester') and
		(dept_code='$dept_code') and
		(school_year='$school_year') 
		 ";
$res = mysql_query($sql);
$rs = mysql_fetch_array($res);
$already_registered_count = $rs[cnt];

if ($already_registered_count > 0) {
	echo "
	<script>
	alert('[Error] Tuition/Fee Info already exists.\\r\\n\\r\\n Insert again.');
	history.back();
	</script>
	";
	die;
} 

$sql = "
	insert into advising_reference (
		open_year, semester, dept_code, school_year
	) values (
		'$open_year', '$semester', 	'$dept_code', '$school_year'
	)";

$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[Success] New Advising Info was created.');
	opener.parent.body.location.replace('add_advising_list_form.php');
	history.back();
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
