<?
/*=============================================================================
  Program : Add Award or Warning Record. (Form)
  Author  : Sejong Oh, SY Lee
  Date    : 2008.7.22	
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
<center><h3>Add Award or Warning Record</h3></center>
<hr align="Center" width="750" size="3" noshade color="#DFDFDF">
<form action="student_status_award_warning_add_form.php" method="post" name="student_status_award_warning_add_form" id="student_status_award_warning_add_form" style="margin:0px;" onSubmit="return checkForm(this)">

<table border=0 cellpadding="5" cellspacing="5" align="center">
  <tr>
  <td valign="Top"> <!--- Left Side form -------->
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
				<!--- Select Award or Warning ---->
  	<tr>
  		<td align="center">
				<input type="radio" name="special_event_type" value="1"> Award &nbsp;
		    <Select name="award_code" size="1">
					<option>Select</option>
				  <?  
	  	  	$sql2 = "select * from code_special_event";
					$res2 = mysql_query($sql2);
					if ($res2)
							while ($rs2 = mysql_fetch_array($res2)) {
	            	if ($rs2[special_event_code] < 500)
	            		echo "<option value=".$rs2[spacial_event_code].">".$rs2[special_event_name]."</option>"; 
	  	    		}
	  			?>
				</Select>
				<input type="radio" name="special_event_type" value="2"> Warning 
		    <Select name="warning_code" size="1">
					<option>Select</option>
				  <?  
	  	  	$sql2 = "select * from code_special_event";
					$res2 = mysql_query($sql2);
					if ($res2)
							while ($rs2 = mysql_fetch_array($res2)) {
	            	if ($rs2[special_event_code] >= 500)
	            		echo "<option value=".$rs2[spacial_event_code].">".$rs2[special_event_name]."</option>"; 
	  	    		}
	  			?>
			 </Select>
  		</td>
  	</tr> <!-- Draw Line ---------------------------->
		<tr>
			<td>
			  <?  
		     	$sql2 = "select sys_value from miu_system.sys_variable where sys_var = 'curr_year'";
					$res2 = mysql_query($sql2);
					if ($res2)
						$rs2 = mysql_fetch_array($res2) ;
			  ?>
				Year : <input type="text" name="year" size="4" value="<?=$rs2[sys_value]?>">
				&nbsp;&nbsp;&nbsp;&nbsp;
			  <?  
		     	$sql2 = "select sys_value from miu_system.sys_variable where sys_var = 'curr_semester'";
					$res2 = mysql_query($sql2);
					if ($res2)
						$rs2 = mysql_fetch_array($res2) ;
			  ?>
	 			Semester : 
			    <Select name="semester" size="1">
				  <option value="1" <? if ($rs2[sys_value]=="1") echo " selected"; ?>>Spring</option> 
				  <option value="2" <? if ($rs2[sys_value]=="2") echo " selected"; ?>>Summer</option> 
				  <option value="3" <? if ($rs2[sys_value]=="3") echo " selected"; ?>>Fall</option> 
				  <option value="4" <? if ($rs2[sys_value]=="4") echo " selected"; ?>>Winter</option> 
				</Select>
				&nbsp;
			</td>
		</tr>
    <tr> 
			<td>Student ID : 
				<input type="text" name="student_id" readonly style="background:'#EFEFEF'; border:0" value="<?=$rs[student_id]?>">
				<input type="button" name="select_student" border:0" value="Select" onClick="call_select_student()">
      </td>
    </tr>
    <tr>
			<td>Student Name : 
				<input type="text" name="student_name" readonly style="background:'#EFEFEF'; border:0" value="">
      </td>
        </tr>

    <tr> 
    	<td>
      	School Year : 
			  <?  
/*  	  	$sql2 = "select d.abb_name, s.current_level_of_study, s.school_year
  	  					from code_dept d, student s 
  	  					where (s.student_id=$rs[student_id], s.dept_code = d.dept_code)";
				$res2 = mysql_query($sql2);
				if ($res2) {
					$rs2 = mysql_fetch_array($res2); */
					echo $rs[school_year];
//					echo "<input type='text' name='school_year' readonly style='background:"."'#EFEFEF'"."; border:0 value=".$rs[school_year].">";
//					}
  			?>
			  
      </td>
    </tr>

		<tr> 
      <td>
	      Department :
	      <? 
				if ($res2)
					$school_year = $rs2[school_year];
  			?>
			  <input type="text" name="dept_name" readonly style="background:'#EFEFEF'; border:0" value="<? echo $rs2[abb_name]; ?>">
      </td>
    </tr>
    <tr>
    	<td> 
		    Current Level of Study : 
			  <input type="text" name="current_level_of_study" readonly style="background:'#EFEFEF'; border:0" value="<? echo $rs2[current_level_of_study]; ?>">
      </td>
    </tr>
</table>


	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
	<tr>
      <td colspan="2" align="center">
	  		<!-- Print Button -->
			<img id="imgPrint" src="../../../common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onclick="PlanPrint();" />
				<script>
					function PlanPrint) {
						document.all.imgPrint.style.display = "none";
						window.print();
						document.all.imgPrint.style.display = "";
					}
				</script>
		<!-- Print Button End-->
	  
			  <input type="submit" name="Submit" value="Submit">
 			<input type="button" name="exit" value="Exit" onclick=call_exit()> 
      </td>
	</tr>

  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#DFDFDF" style="border:0px #333333 solid;border-bottom-width:1px;">
    <tr> 
    </tr>
  </table>

</form>

<br>

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

function call_select_student() {
	window.open('../../../common/lib/search_student_form.php?frm=student_status_award_warning_add_form&fld1=student_id&fld2=student_name','', 'width=600,height=400,scrollbars=yes'  );
}

function call_exit() {
	window.close();
}

</script>
</body>
</html>
