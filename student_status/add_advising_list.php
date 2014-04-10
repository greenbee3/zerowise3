<?
/*=============================================================================
  Program : Update Tuition Fee List
  Author  : Junho Yeo
  Date    : 2009.09.19	
  Comment : called from edit_tuition_fee_list_form.php
  ===============================================================================*/
?>
<?// check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon_finance.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/function.php");

if($_POST[operation]=="update") {
	$fee_amount=str_replace(",", "", $fee_amount);
	$fee_name=addslashes($fee_name);
	if($fee_name=="etc") $fee_name_etc="";
	$sql = "update miudb.advising_reference 
			set open_year = '$open_year',
				semester = '$semester',
				dept_code = '$dept_code',
				school_year = '$school_year',
			where reference_id = '$reference_id'
			";

	mysql_query($sql);
	$affected_rows = mysql_affected_rows();
	if ($affected_rows>0) {
		echo "
		<script>
		alert('[Success] Fee info. has been updated.');
		opener.location.reload('edit_tuition_fee_list_form.php?reference_id='+".$reference_id.");
		window.close();
		</script>
		";
	} else {
		echo "
		<script>
		alert('No record was changed.');
		history.back();
		</script>
		";
	}
}
else if($_POST[operation]=="charge") {
	$sql = "select * from miudb.advising_reference 
		where reference_id='$reference_id'";

	$res = mysql_query($sql);
	if ($res) {
		$rs = mysql_fetch_array($res);
		/*$fee_name=$rs[fee_name];
		$fee_name_etc=$rs[fee_name_etc];
		$fee_amount=$rs[fee_amount];
		$current_level_of_study=$rs[open_year];
		$country_name=$rs[country_name];
		$must_be_paid=$rs[must_be_paid];
		*/
		$open_year=$rs[open_year];
		$semester=$rs[open_year];		
		$dept_code=$rs[dept_code];
		$school_year=$rs[school_year];
	}
	else die;
	
	$sid=array();
	$id_list=str_replace(" ","",$id_list);
	$id_list=str_replace("\t","",$id_list);
	$id_list=str_replace("\n","",$id_list);
	$id_list=str_replace("\r","",$id_list);
	$sid=explode(";",$id_list);
	foreach($sid as $key => $value){       		
		$sql="select * from miudb.advising_history where student_id='$value'  and deleted<>1 order by history_id desc";
		$res1=mysql_query($sql);
		if($res1) {
			$rs1=mysql_fetch_array($res1);
		}

		$sql = "
			insert into miudb.advising_history 
			(   history_id,
				student_id,
				open_year,
				semester,
				dept_code,
				school_year,
				advising_condition,
				description,
				check_date,
				ctime,
				mtime,
				managing_office
			 )
			 values (
				''
				'$value',
				'$open_year',
				'semester',
				'$dept_code',
				'$school_year',
				'$advising_condition',
				'$description',
				CURDATE(),
				'',
				'',
				'$managing_office'     
			 )";    
		

        if($value!='') {
        	mysql_query($sql);        
        	if(mysql_affected_rows()==1) echo("The fee was charged to $value. <br />");
        	else echo("<font color=red>The fee was not charged to $value.</font> <br />");
		}
    } 
	echo("<br><center><input type=button value='Close' onclick='window.close();'></center>");
}

?>