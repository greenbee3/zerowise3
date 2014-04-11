<?
/*=============================================================================
  Program : Eit an Advising List. (Form)
  Author  : Seokwon Kong
  Date    : 2014.04.14	
  Comment : 
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");
//if($_POST[open_year]==null) $open_year=$_SESSION['c_year'];
?>

<?
if($_POST[operation]=="charge"){
	$arr=explode(";",$id_list);
	for($i=0;$i<sizeof($arr);$i++){
		;
	}
}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/common/css/global.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><br />
<center><h3>Edit a Advising List.</h3></center>
<hr align="Center" width="700" size="3" noshade color="#DFDFDF">

<!-- <form action="edit_tuition_fee_list.php" method="post" name="tuition_fee_info_form" id="tuition_fee_info_form" style="margin:0px;"> -->
<form action="edit_advising_list.php" method="post" onsubmit='return check_f();' name="advising_info_form" id="advising_info_form" style="margin:0px;">
<?

	// get the record from the info of existing tuition fee list by using history_id
	$sql = "select * from miudb.advising_reference 
			where reference_id='$reference_id'";
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);

?>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="1">
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Open Year</td>
      <td bgcolor="#EFEFEF">
      <? echo $rs['open_year']; ?>
		<!-- 	<Select name="open_year" size="1">
			<?// print_year($_SESSION['c_year'],$open_year,-3,4);?>				
		  			</Select> -->
		</td>
    </tr>	
	
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Semester</td>
      <td bgcolor="#EFEFEF">
      	<?php echo getSemName($rs[semester]);?>
		<!-- 	<Select name="semester" size="1">
			<option value="" <?//if($rs[semester]=="") echo(" selected");?>>All</option>
			<option value="1" <?//if($rs[semester]=="1") echo(" selected");?>>Spring</option>
			<option value="2" <?//if($rs[semester]=="2") echo(" selected");?>>Summer</option>
			<option value="3" <?//if($rs[semester]=="3") echo(" selected");?>>Fall</option>
			<option value="4" <?//if($rs[semester]=="4") echo(" selected");?>>Winter</option>
		</Select> -->
	  </td>
    </tr>
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Department</td>
      <td bgcolor="#EFEFEF">
  		<?php echo getDeptName($rs[dept_code]);?>	
  			<!-- <Select name="dept_code" size="1">
  							<? print_dept_name($rs[dept_code]); ?>
  						</Select> -->
	  </td>
    </tr>
	<tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; School Year</td> 
	  <td bgcolor="#EFEFEF">
	  	<?php echo $rs['school_year'];?>
			<!-- <Select name="school_year" size="1">
				<?//print_school_year($rs[school_year]);?>
			</Select> -->
	  </td>
	</tr>

	
	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
  </table>
  </td> 
  </tr> 
</table>

 <table border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
      <td colspan="2" align="center">&nbsp;&nbsp; Students' IDs to charge this fee:<br> 
      	<textarea  align="center" name='id_list' rows='4' cols='70'></textarea> 
		<br> 
		<input type="submit" name="Submit" value="Submit"> 
		<input type="hidden" name="operation" value="charge">
		<input type="hidden" name="reference_id" value="<?=$reference_id?>">
         <!-- <input type="submit" name="Submit" value="Submit" onClick='return(check_f());'>  -->
 		<input type="button" name="exit" value="Exit" onclick=call_exit()> 
	  </td>
	</tr>
  </table>
</form>
<!-- <br>
<form method='POST' name='form2' onsubmit='return check_f2();' action='edit_advising_list.php'>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="1">
	
</table>
</form> -->

<script>
function call_exit() {
	window.close();
}

/*function etc_selected(v){
if(v=='ETC') document.tuition_fee_info_form.fee_name_etc.disabled=false;
else document.tuition_fee_info_form.fee_name_etc.disabled=true;
}*/

function check_f(){
	if(document.advising_info_form.id_list.value=="") {
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