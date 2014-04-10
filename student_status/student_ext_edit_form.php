<?
/*=============================================================================
  Program : Edit a Student extend Info. (Form)
  Author  : Sejong Oh
  Date    : 2008.1.31	
  Comment : 
  ===============================================================================*/
?>
<? // check login
include_once("../../../common/login/check_login.php");
include_once("../../../common/lib/dbcon.php");
?>


<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../../../common/css/global.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>
<center><h3>Edit Student Information (Extend)</h3></center>
<hr align="Center" width="750" size="3" noshade color="#DFDFDF">
<?
   	$sql = "select * from student s, student_ext se 
	        where s.student_id = se.student_id 
			and se.student_id='".$student_id."'" ;
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);
?>
<form action="student_ext_edit.php" method="post" name="student_form" id="student_form" style="margin:0px;" onSubmit="return checkForm(this)">

<table border=0 cellpadding="5" cellspacing="5" align="center">
  <tr>
  <td> <!--- Left Side form -------->
  <table width="370" border="0" align="center" cellpadding="5" cellspacing="1">
  	<tr><td>&nbsp;&nbsp;PRIVATE INFO</td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td width="100" bgcolor="#E8E8E8"><font color="#FF0000">*</font> Student ID</td>
	  <input type="hidden" name="student_id" value="<? echo $rs[student_id];?>">
      <td bgcolor="#EFEFEF"><? echo $rs[student_id]; ?></td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Family Name </td>
      <td bgcolor="#EFEFEF"> <? echo $rs[family_name]; ?> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8"><font color="#FF0000">*</font>Given Name</td>
      <td bgcolor="#EFEFEF"><? echo $rs[given_name]; ?> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Date of Birth</td>
      <td bgcolor="#EFEFEF"> <? echo $rs[birthday]; ?> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Gender</td>
      <td bgcolor="#EFEFEF"><? if ($rs[gender]=="M") {echo "Male";} else {echo "Female";} ?>
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8"><font color="#FF0000">*</font> Department</td>
      <td bgcolor="#EFEFEF">
		  <?  
		     	$sql2 = "select * from code_dept where dept_code = $rs[dept_code]";
				$res2 = mysql_query($sql2);
				if ($res2) {
					$rs2 = mysql_fetch_array($res2); 
		                echo $rs2[dept_name]; 
		  	    }
		  ?>
        </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8"> Religion</td>
      <td bgcolor="#EFEFEF">
	  	 <select Name="religion">
	 <?
		$sql_a = "select * from code_religion";
		$res_a = mysql_query($sql_a);
		if ($res_a) 
			while ($rs_a = mysql_fetch_array($res_a)){
				$sel = "";
				if ($rs[religion]==$rs_a[religion_code])
					$sel = " selected";
				if ($rs[religion]== "" && $rs_a[religion_code] == '90')
					$sel = " selected";
				echo "<option value=".$rs_a[religion_code].$sel.">".$rs_a[religion_name]."</option>";
			}	
	 ?>
	 </select>		 
      </td>
    </tr>

	<tr><td>&nbsp;&nbsp;FAMILY INFO</td><td><hr></td></tr> <!-- Draw Line ------------------------->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Marry Y/N</td>
      <td bgcolor="#EFEFEF"> 
		<input name="marry_yn" type="radio" value="Y" <? if ($rs[marry_yn]=="Y") echo "checked"; ?>>Yes
		<input name="marry_yn" type="radio" value="N" <? if ($rs[marry_yn]=="N") echo "checked"; ?>>No 
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Father's Name</td>
      <td bgcolor="#EFEFEF"><input type="text" name="father_name" value="<?=$rs[father_name]?>">
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Father's Job</td>
      <td bgcolor="#EFEFEF"><input type="text" name="fathers_job" value="<?=$rs[fathers_job]?>">
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Mother's Name</td>
      <td bgcolor="#EFEFEF"><input type="text" name="mom_name" value="<?=$rs[mom_name]?>">
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Mother's Job</td>
      <td bgcolor="#EFEFEF"><input type="text" name="moms_job" value="<?=$rs[moms_job]?>">
      </td>
    </tr>
	
	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
  </table>
  </td> <!--- End Left Side   -------->


  <td valign="Top"> <!--- Right Side   -------->
  <table width="370" border="0" align="center" cellpadding="5" cellspacing="1">
  	<tr><td >&nbsp;&nbsp;LIVING STATUS</td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Passport No</td>
      <td bgcolor="#EFEFEF"> <input name="passport_no" type="text" value="<? echo $rs[passport_no]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Visa Issue Date</td>
      <td bgcolor="#EFEFEF"> <input name="visa_issue_date" type="text" value="<? echo $rs[visa_issue_date]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp;Visa Validity</td>
      <td bgcolor="#EFEFEF"> <input name="visa_validity" type="text" value="<? echo $rs[avisa_validity]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Visa Type</td>
      <td bgcolor="#EFEFEF"> <input name="visa_type" type="text" value="<? echo $rs[visa_type]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Living Permission</td>
      <td bgcolor="#EFEFEF"> <input name="living_permission" type="text" value="<? echo $rs[living_permission]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Passport Validity</td>
      <td bgcolor="#EFEFEF"> <input name="passport_validity" type="text" value="<? echo $rs[passport_validity]; ?>"> 
      </td>
    </tr>

	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
	<tr>
      <td colspan="2" align="center">
	  		<!-- Print Button -->
			<img id="imgPrint" src="../../../common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onclick="PlanPrint();" />
				<script>
					function PlanPrint() {
						document.all.imgPrint.style.display = "none";
						window.print();
						document.all.imgPrint.style.display = "";
					}
				</script>
		<!-- Print Button End-->
			  <?
					if ($session_userid == 'M2007021' || $session_userid == 'M2004018' || $session_userid == 'M2009104' || $session_userid == 'M2009107' || $session_userid == 'M2008030' || $session_userid == 'M2008004' || 
					$session_userid == 'S2010502')
						$use_button = " disabled";
					else $use_button = "";	
			  ?>
			  <!--<input type="submit" name="Submit" value="Submit" <?=$use_button?>>-->
 			<input type="button" name="exit" value="Exit" onclick=call_exit()> 
      </td>
	</tr>
  </table>
  </td>
  </tr> <!--- End Right Side   -------->
</table>

  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#DFDFDF" style="border:0px #333333 solid;border-bottom-width:1px;">
    <tr> 
    </tr>
  </table>
</form>
<br>

<!-- Calender -->
<div id="CalendarLayer" style="display:none; width:172px; height:250px">
	<iFrame name="CalenderFrame" src="lib.calender.js.html"
			width="172" height="176" border="0" frameborder="0" scrolling="no">
	</iFrame>
</div>

<script>
function checkForm(theForm) {
/*
	if (theForm.password.value!=theForm.password_re.value) {
		alert("Password is wrong.\r\n\r\n Insert again.");
		theForm.password.value="";
		theForm.password_re.value="";
		theForm.password.focus();//		return false;
	} else {
		return true;
	}
*/
	return true;
}

function call_del(userid) {
/*
	if (confirm("Are you really try to delete the user?") !=0) {
		self.location="delete.php?userid=" + userid	;
	}
*/
}

function call_exit() {
	window.close();
}

</script>
</body>
</html>
