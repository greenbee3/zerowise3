<?
/*=============================================================================
  Program : Add a Student status Change (Form)
  Author  : Sejong Oh
  Date    : 2008.4.22	
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
<center><h3>Add a Student Status Change Data</h3></center>
<hr align="Center" width="750" size="3" noshade color="#DFDFDF">
<?
   	$sql = "select * from student where student_id='".$student_id."'" ;
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);
?>
<form action="student_status_add.php" method="post" name="student_form" id="student_form" style="margin:0px;" onSubmit="return checkForm(this)">

<table border=0 cellpadding="5" cellspacing="5" align="center">
  <tr>
  <td> <!--- Left Side form -------->
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
  	<tr><td>&nbsp;&nbsp;PRIVATE INFO</td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td width="100" bgcolor="#E8E8E8"><font color="#FF0000">*</font> Student ID</td>
	  <input type="hidden" name="student_id" value="<? echo $rs[student_id];?>">
      <td bgcolor="#EFEFEF"><? echo $rs[student_id]; ?></td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Full Name</td>
      <td bgcolor="#EFEFEF"><? echo $rs[s_full_name]; ?> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Gender</td>
      <td bgcolor="#EFEFEF"> 
		<? if ($rs[gender]=="M") echo "Male"; ?>
        <? if ($rs[gender]=="F") echo "Female"; ?> 
      </td>
    </tr>
	<tr> 
      <td bgcolor="#E8E8E8"><font color="#FF0000">*</font> Department</td>
      <td bgcolor="#EFEFEF">
		  <?  
		     	$sql2 = "select * from code_dept where dept_code='".$rs[dept_code]."'";
				$res2 = mysql_query($sql2);
				if ($res2)
					$rs2 = mysql_fetch_array($res2); 
		        echo $rs2[dept_name]; 
		  ?>
        </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Registration Status</td>
      <td bgcolor="#EFEFEF">
		  <?  
		     	$sql2 = "select * from code_student_status where s_status_code='".$rs[status]."'";
				$res2 = mysql_query($sql2);
				if ($res2)
					$rs2 = mysql_fetch_array($res2) ;
		        echo $rs2[s_status_name] ; 
		  ?>
       </td>
    </tr>

	<tr><td>&nbsp;&nbsp;STATUS CHANGE</td><td><hr></td></tr> <!-- Draw Line ------------------------->
   <tr> 
	  <?  
		  $curr_year = date("Y");
	  ?>
       <td bgcolor="#E8E8E8">&nbsp;&nbsp; Apply Year (From -To)</td>
      <td bgcolor="#EFEFEF">
	  <input type="text" name="change_year_from" value="<?=$curr_year?>">
	  <input type="text" name="change_year_to" value="<?=($curr_year+1)?>">
      </td>
    </tr>
	<tr> 
	  <?  
	     	$sql2 = "select sys_value from miu_system.sys_variable where sys_var = 'curr_semester'";
			$res2 = mysql_query($sql2);
			if ($res2)
				$rs2 = mysql_fetch_array($res2) ;
	  ?>
      <td bgcolor="#E8E8E8"><font color="#FF0000"> </font>&nbsp;&nbsp; Apply Semester (From  - To)</td>
      <td bgcolor="#EFEFEF">
	    <Select name="semester_from" size="1">
			<option value="1" <? if ($rs2[sys_value]=="1") echo " selected"; ?>>Spring</option> 
			<option value="2" <? if ($rs2[sys_value]=="2") echo " selected"; ?>>Summer</option> 
			<option value="3" <? if ($rs2[sys_value]=="3") echo " selected"; ?>>Fall</option> 
			<option value="4" <? if ($rs2[sys_value]=="4") echo " selected"; ?>>Winter</option> 
		 </Select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <Select name="semester_to" size="1">
			<option value="1" <? if ($rs2[sys_value]=="1") echo " selected"; ?>>Spring</option> 
			<option value="2" <? if ($rs2[sys_value]=="2") echo " selected"; ?>>Summer</option> 
			<option value="3" <? if ($rs2[sys_value]=="3") echo " selected"; ?>>Fall</option> 
			<option value="4" <? if ($rs2[sys_value]=="4") echo " selected"; ?>>Winter</option> 
		 </Select>

        </td>
    </tr>

    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Reg. Date (Today)</td>
      <td bgcolor="#EFEFEF"><input type="text" name="change_date" value="<? echo date("Y-m-d", time(0)); ?>">
      </td>
    </tr>
  <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Status Change Code</td>
      <td bgcolor="#EFEFEF">
	    <Select name="status_change_code" size="1">
			<option value="">Select</option> 
		  <?  
		     	$sql2 = "select * from code_student_status_change";
				$res2 = mysql_query($sql2);
				if ($res2)
					while ($rs2 = mysql_fetch_array($res2)) {
		                echo "<option value=".$rs2[s_status_chg_code].$sel.">".$rs2[s_status_chg_name]."</option>"; 
		  	    }
		  ?>
		 </Select>
       </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Change Reason</td>
      <td bgcolor="#EFEFEF"><textarea name="change_reason" rows="3" cols="35" value= ></textarea>
	  </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Etc.</td>
      <td bgcolor="#EFEFEF"><input type="text" name="comment" size="45">
	  </td>
    </tr>

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
				if ($session_userid == 'M2010102' || $session_userid == 'M2004018' || $session_userid == 'M2009104' || $session_userid == 'M2009107' || $session_userid == 'M2004021' || $session_userid == 'M2007006')
					$use_button = " disabled";
				else $use_button = "";
			  ?>
			  <input type="submit" name="Submit" value="Submit" <?=$use_button?>>
 			<input type="button" name="exit" value="Exit" onclick=call_exit()> 
      </td>
	</tr>

	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr height="25"><td></td><td></td></tr>
  </table>
  </td> <!--- End Left Side   -------->
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
