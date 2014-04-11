<?
/*=============================================================================
  Program : Eit a Tuition Fee List. (Form)
  Author  : Junho Yeo
  Date    : 2009.09.14	
  Comment : 
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");
if($_POST[open_year]==null) $open_year=$_SESSION[c_year];
?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/common/css/global.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><br />
<center><h3>Edit a Tuition Fee List.</h3></center>
<hr align="Center" width="700" size="3" noshade color="#DFDFDF">

<!-- <form action="edit_tuition_fee_list.php" method="post" name="tuition_fee_info_form" id="tuition_fee_info_form" style="margin:0px;"> -->
<form action="add_advising_list.php" method="post" name="advising_info_form" id="advising_info_form" style="margin:0px;">
<?

	// get the record from the info of existing tuition fee list by using history_id
	$sql = "select * from miudb.advising_reference 
			where reference_id='$reference_id'";
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);

?>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="1">
	<!-- <tr>
	<td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Fee Name </td>
      <td bgcolor="#EFEFEF">
		<select name='fee_name' onChange="etc_selected(this.value);">
				  <?//print_fee_name($rs[fee_name]);?>
		</select>		
	  <input name="fee_name_etc" value="<?//echo($rs[fee_name_etc]);?>" <?  //if($rs[fee_name_etc]=="") echo(" disabled=true"); ?> type="text" size=30> 
	 </td>
	</tr>
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Fee Amount</td>
      <td bgcolor="#EFEFEF"> <input name="fee_amount" type="text" value="<?//echo($rs[fee_amount]);?>"> 
      </td>
    </tr> -->
    <tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Open Year</td>
      <td bgcolor="#EFEFEF">
			<Select name="open_year" size="1">
				<? print_year($_SESSION[c_year],$open_year,-1,2);?>				
  			</Select>
		</td>
    </tr>	
	
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Semester</td>
      <td bgcolor="#EFEFEF">
			<Select name="semester" size="1">
				<option value="" <?if($rs[semester]=="") echo(" selected");?>>All</option>
				<option value="1" <?if($rs[semester]=="1") echo(" selected");?>>Spring</option>
				<option value="2" <?if($rs[semester]=="2") echo(" selected");?>>Summer</option>
				<option value="3" <?if($rs[semester]=="3") echo(" selected");?>>Fall</option>
				<option value="4" <?if($rs[semester]=="4") echo(" selected");?>>Winter</option>
			</Select>
	  </td>
    </tr>
	
<!-- 	<tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Level</td> 
	  <td bgcolor="#EFEFEF">
			<Select name="t_level" size="1">
				<?//print_t_level($rs[current_level_of_study]);?>					
			</Select>
	  </td>
	</tr>
	<tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Country</td>
	  <td bgcolor="#EFEFEF">
			<input type=text name="country_name" size="40" value="<?//=$rs[country_name]?>"> (eg, Mongolia, Russia, Korea, etc)
	  </td>
	</tr> -->
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Department</td>
      <td bgcolor="#EFEFEF">
  			<Select name="dept_code" size="1">
				<? print_dept_name($rs[dept_code]); ?>
			</Select>
	  </td>
    </tr>
	<tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; School Year</td> 
	  <td bgcolor="#EFEFEF">
	  
			<Select name="school_year" size="1">
				<?print_school_year($rs[school_year]);?>
			</Select>
	  </td>
	</tr>
	<!-- <tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Must be paid before registration?</td> 
	  <td bgcolor="#EFEFEF">
	  
			<Select name="must_be_paid" size="1">
				<option value="0"<?//if($rs[must_be_paid]=='0') echo(" selected");?>>No</option>
				<option value="1"<?//if($rs[must_be_paid]=='1') echo(" selected");?>>Yes</option>
			</Select>
	  </td>
	</tr> -->
	
	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
  </table>
  </td> 
  </tr> 
</table>

 <table border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
      <td colspan="2" align="center"> 
						<input type="hidden" name="reference_id" value="<?=$reference_id?>">
                        <input type="submit" name="Submit" value="Submit" onClick='return(check_f());'> 
 						<input type="button" name="exit" value="Exit" onclick=call_exit()> 
						<input type="hidden" name="operation" value="update">
      </td>
	</tr>
  </table>
</form>
<br>
<form method='POST' name='form2' onsubmit='return check_f2();' action='edit_advising_list.php'>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="1">
	<tr>
	<td bgcolor="#F8F8F8" align=center>&nbsp;&nbsp; Students' IDs to charge this fee:<br>
		<textarea name='id_list' rows='4' cols='70'></textarea> 
		<br> 
		<input type="submit" name="Submit" value="Submit"> 
		<input type="button" name="exit" value="Exit" onclick=call_exit()> 
		<!-- <input type="hidden" name="reference_id" value="<?=$reference_id?>"> -->
		<input type="hidden" name="operation" value="charge">
	</td>
	</tr>
</table>
</form>
<?
if($_POST[operation]=="charge"){
	$arr=explode(";",$id_list);
	for($i=0;$i<sizeof($arr);$i++){
		;
	}
}
?>
<script>
function call_exit() {
	window.close();
}

/*function etc_selected(v){
if(v=='ETC') document.tuition_fee_info_form.fee_name_etc.disabled=false;
else document.tuition_fee_info_form.fee_name_etc.disabled=true;
}*/

function check_f(){
	if(document.advising_info_form.fee_name.value=="") {
		alert("Select the fee name");
		return false;
	}
	else {
		return true;
	}
}

function check_f2(){
	if(document.form2.id_list.value=="") {
		alert("Insert the student IDs");
		return false;
	}
	else {
		return true;	
	}
}
</script>
</body>
</html>