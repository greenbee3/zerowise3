<?
/*=============================================================================
  Program : Update Tuition Fee List
  Author  : Junho Yeo
  Date    : 2009.09.19	
  Comment : called from edit_tuition_fee_list_form.php
  ===============================================================================*/
?>
<?// check login
include_once("../../../../common/login/check_login.php");
include_once("../../../../common/lib/dbcon.php");
include_once("../../../../common/lib/function.php");

if($_POST[operation]=="update") {
	/*$fee_amount=str_replace(",", "", $fee_amount);
	$fee_name=addslashes($fee_name);
	if($fee_name=="etc") $fee_name_etc="";*/
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
		alert('[Success] Advising info. has been updated.');
		opener.location.reload('edit_advising_list_form.php?reference_id='+".$reference_id.");
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
		$fee_amount=$rs[fee_amount];*/
		$open_year=$rs[open_year];
		$semester=$rs[open_year];
		/*$current_level_of_study=$rs[open_year];
		$country_name=$rs[country_name];*/
		$dept_code=$rs[dept_code];
		$school_year=$rs[school_year];
		/*$must_be_paid=$rs[must_be_paid];*/
		
		/*if($fee_name=='ETC')$fee_name.=" ($fee_name_etc)";*/
	}
	else die;
	
	$sid=array();
	$id_list=str_replace(" ","",$id_list);
	$id_list=str_replace("\t","",$id_list);
	$id_list=str_replace("\n","",$id_list);
	$id_list=str_replace("\r","",$id_list);
	$sid=explode(";",$id_list);
	$cnt=0;
	foreach($sid as $key => $value){       		
		$sql="select * from miudb.advising_history where student_id='$value'  and deleted<>1 order by history_id desc";
		$res1=mysql_query($sql);
		if($res1) {
			$rs1=mysql_fetch_array($res1);
		}

		/*$trest_amount=$rs1[rest_amount];
		$trest_amount+=$fee_amount;
		
		$sql="select sum(fee_amount) as sf, sum(pay_amount) as sp, sum(scholarship_amount) as ss from miu_finance.acc_tuition_fee_history 
			where student_id='$value' and open_year='$rs[open_year]' and deleted<>1";
		//echo($sql);

		$res2=mysql_query($sql);
		if($res2) $rs2=mysql_fetch_array($res2);

		$tfee_amount=$rs2[sf]+$fee_amount;
		$tpay_amount=$rs2[sp];
		$tscholarship_amount=$rs2[ss];

		if($tfee_amount==0) $tpaid_rate=0;
		else $tpaid_rate=($tfee_amount-$trest_amount)/$tfee_amount *100;*/
		
		$sql = "
			insert into miudb.advising_history 
			(   student_id,
				s_full_name,
				open_year,
				semester,
				dept_code,
				school_year,
				advising_condition,
				description,
				transaction_date,
				ctime,
				mtime,
				managing_office
			 )
			 values (
				'$value',
				'$s_full_name',
				'$open_year',
				'semester',
				'$dept_code',
				'$school_year',
				'0',
				'$description',
				CURDATE(),
				'',
				'',
				'$_SESSION[office]'
			 )";    
		

        if($value!='') {
        	mysql_query($sql);        
        	if(mysql_affected_rows()==1) echo("The fee was charged to $value. <br />");
        	else echo("<font color=red>$cnt. The fee was not charged to $value.</font> <br />");
		}
    } 
	echo("<br><center><input type=button value='Close' onclick='window.close();'></center>");
}

?>