<?
/*=============================================================================
Program : Show Detailed Info. of Advising 
Author : Sejong Oh
Date : 2008.4.22
Comment :
===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/student_info_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");

// Only authorized users from financial affairs can use the buttons
$use_button=" disabled";
$auth_list=array("F2009003","S2008003","S2008002","leiadmin","S2007015");

if(in_array ($_SESSION[uid],$auth_list)==true) {
	$use_button="";
}

if($operation=='delete') {	
	$sql="update advising_history set deleted=1 where history_id='$history_id'";
	mysql_query($sql);
	if(mysql_affected_rows()>=1) echo("<script>alert('Deletion was successful!');</script>");
	else echo("<script>alert('Deletion failed!');</script>");	
}
else if($operation=='must_change') {	
	if($must=='y') $must=1;
	else $must=0;
	$sql="update advising_history set must_paid='$must_checked' where history_id='$history_id'";
	mysql_query($sql);
	if(mysql_affected_rows()>=1) echo("<script>alert('Must information was successfully updated!');</script>");
	else echo("<script>alert('Change failed!');</script>");	
}
?>

<html>
<head>

	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<link href="/common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<br>
	<center><h3>Detailed Info. of Advising History</h3></center>
	<!--- Select Course year ---->
	<br>
	<form action="advising_detail.php" method="post" name="advising_form" id="advising_form" style="margin:0px;">
		<table width ="700" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >

			<tr align="left"><td>
				<?
				$s= new student($student_id);
				$dept_code=$s->dept_code;	
				?>&nbsp;&nbsp;
				<?
				echo "Level : <b>".getTLevelName($s->level)."</b>";

				?>
				&nbsp;&nbsp;&nbsp; Department:
				<?
				echo "<b>".getDeptAbb($s->dept_code)."</b>";
				?>
				&nbsp;&nbsp;&nbsp; Country:
				<?
				echo "<b>".getCountryName($s->country_code)."</b>";
				?>
			</td>
			<td align="Right" >
				<!-- Print Button -->
				<img id="imgPrint" src="/common/images/print_button.jpg" border="0" align="absbottom" style="cursor:hand;" onClick="PlanPrint();" />
				<script>
				function PlanPrint() {
					document.all.imgPrint.style.display = "none";
					window.print();
					document.all.imgPrint.style.display = "";
				}
				</script>
				<!-- Print Button End-->
			</td>
		</tr>
		<tr>
			<td align="left"> Student ID : <b><?=$student_id?></b>&nbsp;&nbsp;
				Student Name : <b><?=$s->name?></b>
			</td>
			<td align="Right" >

				<?
				$auth_list=array("F2009003","S2008003","S2008002","leiadmin","S2007015");

				if(in_array ($_SESSION[uid],$auth_list)==true) {
					$use_button="";
				}
				else $use_button=" disabled";
				?>
				<?	if($use_button!=" disabled")
				echo"<input bgcolor='gray' type='button' value='Add Advising' onclick=call_add_advising('$student_id','$open_year') >";
				?>
				<?
				$auth_list=array("S2007015","S2007013","S2007012","leiadmin");
				if(in_array ($_SESSION[uid],$auth_list)==true) {
					$use_button="";
				}
				else $use_button=" disabled";
				?>
				<?	if($use_button!=" disabled")
				echo"<input bgcolor='gray' type='button' value='Add Charge' onclick=call_add_charge('$student_id','$open_year') >";
				?>
			</td>
		</tr>
	</table>

	<input type="hidden" name="open_year" value="<?=$open_year?>">
	<input type="hidden" name="semester" value="<?=$semester?>">
	<input type="hidden" name="student_id" value="<?=$student_id?>">

	<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
		<tr class="header">
			<!-- <td align="center" width='80'>Fee Name</td> -->
			<td align="center" width='50'>Open Year</td>
			<td align="center" width='50'>Semester</td>
			<td align="center" width='50'>Advising Condition</td>
			<td align="center" width='70'>Checked Date</td>
			<td align="center" width='100'>Description</td>
		<!--<td align="center" width='50'><font color=red><b>"MUST"</b></font> paid?</td> -->
			<td align="center" width='50'>&nbsp;</td>
		</tr>

<?
$num = 0;
	$sql = "select count(history_id) as cnt from advising_history r
			where r.student_id = '$student_id' and deleted=0";
	$res=mysql_query($sql);
	if($res) {
	$rs=mysql_fetch_array($res);
	$num=$rs[cnt];
	}

	$sql = "select * from advising_history r
			where r.student_id = '$student_id' order by r.history_id";

	$res = mysql_query($sql);
	$tf=$sc=$pa=0;
	$cnt=0;
	$check_cnt=0;
	if ($res)
	while ($rs = mysql_fetch_array($res)) {
		/*if($rs[deleted]==0){
			$cnt++;

			$tf+=$rs[fee_amount];
			$sc+=$rs[scholarship_amount];
			$pa+=$rs[pay_amount];

			$rs[fee_amount]=number_format($rs[fee_amount]);
			$rs[pay_amount]=number_format($rs[pay_amount]);
			$rs[scholarship_amount]=number_format($rs[scholarship_amount]);
			$rs[rest_amount]=number_format($rs[rest_amount]);

		}
		else if($rs[deleted]==1){
			$rs[fee_amount]=number_format($rs[fee_amount]);
			$rs[pay_amount]=number_format($rs[pay_amount]);
			$rs[scholarship_amount]=number_format($rs[scholarship_amount]);
			$rs[rest_amount]=number_format($rs[rest_amount]);

			foreach($rs as $key => $val) {	
				if($key!="history_id" && $key!="deleted") $rs[$key]="<span style='text-decoration: line-through;'>".$val."</span>";
			}
		}	*/

		echo "<tr class='listitem'>";	
		if($rs[open_year]==$open_year) $fontcolor="red";	
		else $fontcolor="black";
// echo "<td align=left><font color='$fontcolor'>".$rs[fee_name]."</font></td>";
		echo "<td align=center><font color='$fontcolor'>".$rs[open_year]."</font></td>";
		if ($rs[semester] == '1') {
			$sem_name = "Spring";
		} else if ($rs[semester] == '2') {
			$sem_name = "Summer";
		} else if ($rs[semester] == '3') {
			$sem_name = "Fall";
		} else if ($rs[semester] == '4') {
			$sem_name = "Winter";
		}	

		echo "<td align=left>".$sem_name."</td>";

// tuition_fee
		echo "<td align=right>".$rs[open_year]."</td>";
		echo "<td align=right>".$rs[semester]."</td>";
		echo "<td align=center>".$rs[transaction_date]."</td>";
		echo "<td align=left>".$rs[description]."</td>";
		if($rs[must_paid]==1)$check=" checked";
		else $check=" ";

		if($rs[fee_amount]>-1 && $rs[must_be_paid]=='1'){
			if($_SESSION['office']!=$rs[managing_office]) $check_enabled=' disabled';
			else $check_enabled='';

			if($_SESSION[uid]!='leiadmin') echo "<td align=center>
			<input type=checkbox name='must' value='1' $check onchange='call_must($rs[history_id],$check_cnt);' $check_enabled></td>";
			else {
				echo"<td align=center>";
				if($rs[must_paid]==1) echo ("Paid");
				else echo ("Not Paid");
				echo" </td>";	
			}
			$check_cnt++;
		}
		else echo "<td align=left> &nbsp;</td>";
		if((in_array ($_SESSION[uid],$auth_list)==true) && ($cnt==$num)) $use_button=""; else $use_button=" disabled";

		if (/*$session_userid == 'F2009002' || */$session_userid == 'F2009003') {
//echo "<td><input bgcolor='gray' type='button' value=' Edit ' onclick=call_edit('".$rs[history_id]."','".$rs[student_id]."','".$open_year."','".$semester."') disabled>";

			if($rs[deleted]==0) echo "<td><input bgcolor='gray' type='button' value='Delete' onclick=call_del('".$rs[history_id]."') $use_button></td>";
			else echo "<td align=center> </td>";
		}
		else {
//echo "<td><input bgcolor='gray' type='button' value=' Edit ' onclick=call_edit('".$rs[history_id]."','".$rs[student_id]."','".$open_year."','".$semester."')>";
			if($rs[deleted]==0 && $use_button!=" disabled") echo "<td><input bgcolor='gray' type='button' value='Delete' onclick=call_del('".$rs[history_id]."') $use_button></td>";
			else if($rs[deleted]==0 && $_SESSION[office]==$rs[managing_office]) echo "<td><input bgcolor='gray' type='button' value='Delete' onclick=call_del('".$rs[history_id]."')></td>";
			else echo "<td> </td>";
		}
		echo "</tr>";	
	}
	?>
<!-- <tr>
<td colspan='1' >Total : <?=$cnt?></td>
<td colspan='3' >Tuition/Fee : <?//=number_format($tf)?></td>
   <td colspan='3' >Paid Amount : <?//=number_format($pa)?></td>
<td colspan='2' >Scholarship : <?//=number_format($sc)?></td>
   <td colspan='1' >&nbsp;</td>
</tr> -->
</table>
<br>
<center><input type="button" value= "Close" onClick="call_exit()"></center>
<input type=hidden name='history_id'>
<input type=hidden name='operation'>
<input type=hidden name='must_checked'>
<input type='hidden' name='student_id' value='<?=$student_id?>'>
<input type='hidden' name='open_year' value='<?=$open_year?>'>

</form>

</body>

<script>
function call_add_advising(student_id,open_year) {
	var checkIdWin = window.open('add_advising_form.php?student_id='+student_id+'&open_year='+open_year,'','width=830,height=600,scrollbars=yes,left=50,top=30,resizable=yes,location=no,address=no');
	checkIdWin.focus();
}

function call_add_charge(student_id,open_year) {
	var checkIdWin = window.open('add_charge_form.php?student_id='+student_id+'&open_year='+open_year,'','width=830,height=600,scrollbars=yes,left=50,top=30,resizable=yes,location=no,address=no');
	checkIdWin.focus();

}

function call_exit() {
	window.close();
}

function call_del(hid) {
	document.advising_form.operation.value='delete';
	if(confirm("Would you like to delete this record?")){
		document.advising_form.history_id.value=hid;
		document.advising_form.submit();
	}
}

function call_must(hid,idx){
	document.advising_form.operation.value='must_change';
	document.advising_form.history_id.value=hid;
	<?
	if($check_cnt==1) echo"if(document.advising_form.must.checked==true) document.advising_form.must_checked.value='1';
	else document.advising_form.must_checked.value='0';
	";
	else echo "
		if(document.advising_form.must[idx].checked==true) document.advising_form.must_checked.value='1';
	else document.advising_form.must_checked.value='0';
	";
	?>
	alert("If it is checked and if there is any fee, you must add a payment to clear this sanction.");
	document.advising_form.submit();
}
</script>

</html>