<?
/*=============================================================================
  Program : Add a Tuition Fee List. (Form)
  Author  : Junho Yeo, Sam Han
  Date    : 2009.09.03, 2013.10.04	
  Comment : 
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon_finance.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");
if($open_year=="") $open_year=$_SESSION['c_year'];
?>


<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/common/css/global.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<center>
  <h3>  Add Advising</h3></center>
<hr align="Center" width="700" size="3" noshade color="#DFDFDF">

<form action="add_advising_list.php" method="post" name="advising_info_form" onSubmit='return check_f();' id="advising_info_form" style="margin:0px;">

<table border=0 cellpadding="5" cellspacing="5" align="center">
  <tr>
  <td> 
  <table width="600" border="0" align="center" cellpadding="5" cellspacing="1">
	<tr>
<!-- 	<td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Fee Name </td>
      <td bgcolor="#EFEFEF">
   <select name='fee_name' onChange="etc_selected(this.value);">
          <?		   
	   if ($_SESSION['office']=='01') // financial affairs
			print_fee_name(''); 
		else echo"<option value='ETC'>ETC</option>";
	   ?>
          </select>
  <input name="fee_name_etc" type="text" size=30 <? if($_SESSION['office']=='01') echo" disabled=true";?> > 
 </td>
</tr> -->
	<!-- <tr> 
	      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Fee Amount</td>
	      <td bgcolor="#EFEFEF"> <input name="fee_amount" type="text" <?if($_SESSION['office']!='14') echo" value='0' readonly";?> style='text-align:right'> 
	      </td>
	    </tr> -->
    <tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Open Year</td>
      <td bgcolor="#EFEFEF">
				<!--- Select Course year ---->
			<Select name="open_year" size="1">
				<? print_year($_SESSION[c_year],$open_year,-2,4);?>		
			</Select>
		</td>
    </tr>	
	
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Semester</td>
      <td bgcolor="#EFEFEF">
			<Select name="semester" size="1">
				<option value="" selected>All</option>
				<option value="1">Spring</option>
				<option value="2">Summer</option>
				<option value="3">Fall</option>
				<option value="4">Winter</option>
			</Select>
	  </td>
    </tr>
	
	<tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Department (Students)</td>
      <td bgcolor="#EFEFEF">
  			<Select name="dept_code" size="1">
				<? print_dept_name($dept_code); ?>
			</Select>
	  </td>
    </tr>
	<tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; School Year</td> 
	  <td bgcolor="#EFEFEF">
	  
			<Select name="school_year" size="1">
				<? print_school_year($school_year); ?>
			</Select>
	  </td>
	</tr>
	<!-- <tr>
	  <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; <b><font color=red>Must be paid before registration?</font></b></td> 
	  <td bgcolor="#EFEFEF">
	  
			<Select name="must_be_paid" size="1">
				<option value="0">No</option>
				<option value="1" <?if($_SESSION['office']!='14') echo "selected"?>>Yes</option>
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
      <td colspan="2" align="center"> <input type="submit" name="Submit" value="Submit"> 
 						<input type="button" name="exit" value="Exit" onclick=call_exit()> 
      </td>
	</tr>
  </table>
</form>
<br>

<script>
function call_exit() {
	window.close();
}

/*function etc_selected(v){
if(v=='ETC') document.advising_info_form.fee_name_etc.disabled=false;
else document.advising_info_form.fee_name_etc.disabled=true;
}*/


function check_f(){
	if(document.advising_info_form.fee_name.value=="") {
		alert("Select the fee name");
		return false;
	}
	else return true;
}

</script>
</body>
</html>