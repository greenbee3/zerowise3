<?
/*=============================================================================
  Program : Edit a Student Info. (Form)
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
<center><h3>Edit Student Information</h3></center>
<hr align="Center" width="750" size="3" noshade color="#DFDFDF">
<?
   	$sql = "select * from student where student_id='".$student_id."'" ;
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);
?>
<form action="student_edit.php" method="post" name="student_form" id="student_form" style="margin:0px;" onSubmit="return checkForm(this)">

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
      <td bgcolor="#EFEFEF"> <input name="family_name" type="text" value="<? echo $rs[family_name]; ?>" > 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8"><font color="#FF0000">*</font> Given Name</td>
      <td bgcolor="#EFEFEF"> <input name="given_name" type="text" value="<? echo $rs[given_name]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Full Name</td>
      <td bgcolor="#EFEFEF"> <input name="s_full_name" type="text" size="30" value="<? echo $rs[s_full_name]; ?>"  readonly> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Date of Birth</td>
      <td bgcolor="#EFEFEF"> <input name="birthday" type="text" size="10" value="<? echo $rs[birthday]; ?>" class=edit class=input onFocus="new CalenderFrame.Calender(this)"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Gender</td>
      <td bgcolor="#EFEFEF"> 
		<input name="gender" type="radio" value="M" <? if ($rs[gender]=="M") echo "checked"; ?>>Male
		<input name="gender" type="radio" value="F" <? if ($rs[gender]=="F") echo "checked"; ?>>Female 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Registration No</td>
      <td bgcolor="#EFEFEF"> <input name="reg_no" type="text" value="<? echo $rs[reg_no]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Country</td>
      <td bgcolor="#EFEFEF">
	  	    <Select name="country_code" size="1">
		  <?  
		     	$sql2 = "select * from code_country";
				$res2 = mysql_query($sql2);
				if ($res2)
					while ($rs2 = mysql_fetch_array($res2)) {
						$sel = "";
						if ($rs[country_code]==$rs2[country_code])
							$sel = " selected";
		                echo "<option value=".$rs2[country_code].$sel.">".$rs2[country_name]."</option>"; 
		  	    }
		  ?>
		 </Select>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Tuition Fee's Type</td>
      <td bgcolor="#EFEFEF"> 
	  	    <Select name="tuition_condition" size="1">
			<?
			if ( $rs[tuition_condition]=='100') {
                echo "<option value=100 selected>Private</option>"; }
			else {	
                echo "<option value=100>Private</option>"; } 
			if ( $rs[tuition_condition]=='110') {
                echo "<option value=110 selected>Government</option>"; }
			else {	
                echo "<option value=110>Government</option>"; } 
			if ( $rs[tuition_condition]=='120') {
                echo "<option value=120 selected>Government Loan</option>"; }
			else {	
                echo "<option value=120>Government Loan</option>"; } 
			if ( $rs[tuition_condition]=='130') {
                echo "<option value=130 selected>Government Organization</option>"; }
			else {	
                echo "<option value=130>Government Organization</option>"; } 

			?>
  		 </Select>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; School Year</td>
      <td bgcolor="#EFEFEF"> 
	  	    <Select name="school_year" size="1">
			<?
			if ( $rs[school_year]=='1') {
                echo "<option value=1 selected>1</option>"; }
			else {	
                echo "<option value=1>1</option>"; } 
			if ( $rs[school_year]=='2') {
                echo "<option value=2 selected>2</option>"; }
			else {	
                echo "<option value=2>2</option>"; } 
			if ( $rs[school_year]=='3') {
                echo "<option value=3 selected>3</option>"; }
			else {	
                echo "<option value=3>3</option>"; } 
			if ( $rs[school_year]=='4') {
                echo "<option value=4 selected>4</option>"; }
			else {	
                echo "<option value=4>4</option>"; } 

			?>
  		 </Select>
      </td>
    </tr>
	<tr><td>&nbsp;&nbsp;MAJOR DATA</td><td><hr></td></tr> <!-- Draw Line ------------------------->
    <!--
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Student's Major ID</td>
		  <?  
		     	$sql2 = "select * from student s, code_dept d where s.dept_code = d.dept_code";
				$res2 = mysql_query($sql2);
				if ($res2)
					$rs2 = mysql_fetch_array($res2) ;
		  ?>

      <td bgcolor="#EFEFEF"><? echo $rs2[major_code_e]; ?>
      </td>
    </tr>
	-->
	<tr> 
      <td bgcolor="#E8E8E8"><font color="#FF0000">*</font> Department</td>
      <td bgcolor="#EFEFEF">
	    <Select name="dept_code" size="1">
		  <?  
		     	$sql2 = "select * from code_dept";
				$res2 = mysql_query($sql2);
				if ($res2)
					while ($rs2 = mysql_fetch_array($res2)) {
						$sel = "";
						if ($rs[dept_code]==$rs2[dept_code])
							$sel = " selected";
		                echo "<option value=".$rs2[dept_code].$sel.">".$rs2[dept_name]."</option>"; 
		  	    }
		  ?>
		 </Select>
        </td>
    </tr>
	<tr><td>&nbsp;&nbsp;Address</td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Home Address</td>
      <td bgcolor="#EFEFEF"> <input name="home_address" type="text" size="30" value="<? echo $rs[home_address]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Home Phome</td>
      <td bgcolor="#EFEFEF"> <input name="home_phone" type="text" value="<? echo $rs[home_phone]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Mobile Phone</td>
      <td bgcolor="#EFEFEF"> <input name="mobile_phone" type="text" value="<? echo $rs[mobile_phone]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; E-mail</td>
      <td bgcolor="#EFEFEF"> <input name="email" type="text" size="30" value="<? echo $rs[email]; ?>"> 
      </td>
    </tr>
	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr height="25"><td></td><td></td></tr>
  </table>
  </td> <!--- End Left Side   -------->

  <td valign="Top"> <!--- Right Side   -------->
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1">
  	<tr><td >&nbsp;&nbsp;PHOTO</td><td width="200"><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr>
		<td bgcolor="#E8E8E8"  width="100">&nbsp;&nbsp; Photo</td>
		<td ><img src="../photo/student/<? echo $rs[student_id].'.jpg'; ?>" width="100" height="120"></td>
	</tr>
  	<tr><td >&nbsp;&nbsp;GRADE DATA</td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Current Level of Study</td>
      <td bgcolor="#EFEFEF">
		  <?  
		     	$sql2 = "select * from code_training_level 
				          where training_level_code = '$rs[current_level_of_study]'";
				$res2 = mysql_query($sql2);
				if ($res2) {
					$rs2 = mysql_fetch_array($res2) ;
		            echo $rs2[training_level_name]; 
		  	    }
		  ?>
      </td>
    </tr>
    <!--
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Administration Approval</td>
      <td bgcolor="#EFEFEF"> <input name="administration_approval" type="text" value="<? echo $rs[administration_approval]; ?>"> 
      </td>
    </tr>
	-->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Admission Date</td>
      <td bgcolor="#EFEFEF"> <input name="admission_date" type="text" value="<? echo $rs[admission_date]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Cumulative GPA</td>
      <td bgcolor="#EFEFEF">&nbsp;<? echo $rs[current_gpa]; ?> 
      </td>
    </tr>

	<tr><td>&nbsp;&nbsp;OTHER </td><td><hr></td></tr> <!-- Draw Line ---------------------------->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; High School Graduation Date</td>
      <td bgcolor="#EFEFEF"> <input name="h_school_grad_date" type="text" value="<? echo $rs[h_school_grad_date]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; High School Name</td>
      <td bgcolor="#EFEFEF"> <input name="h_school_name" type="text" value="<? echo $rs[h_school_name]; ?>"> 
      </td>
    </tr>
    <!--
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Hired during MIU Student</td>
      <td bgcolor="#EFEFEF">
		<input name="on_miu_hired_yn" type="radio" value="Y" <? if ($rs[on_miu_hired_yn]=="Y") echo "checked"; ?>>Yes
		<input name="on_miu_hired_yn" type="radio" value="N" <? if ($rs[on_miu_hired_yn]=="N") echo "checked"; ?>>No 
      </td>
    </tr>
	-->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Domitory Room No</td>
      <td bgcolor="#EFEFEF"> <input name="domitory_room_no" type="text" value="<? echo $rs[domitory_room_no]; ?>"> 
      </td>
    </tr>
	
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Transfer</td>
      <td bgcolor="#EFEFEF"> <input name="transfer" type="text" value="<? echo $rs[transfer]; ?>"> 
      </td>
    </tr>
    <?
      $sql2 = "select f_full_name as advisor_name_main from faculty where faculty_id = '$rs[professor_code]'";
   		$res2 = mysql_query($sql2);
			if ($res2) $rs2 = mysql_fetch_array($res2); 
		?>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; SCP (Current)</td>
  		<td bgcolor="#EFEFEF"><input name="prof_name" type="text" readonly value="<?=$rs2[advisor_name_main];?>">
    		<input type="button" name="select_professor" value="Select" onClick="call_select_prof()">
    		<input type="text" name="professor_code" readonly style="background:'#EFEFEF'; border:0" value="<? echo $rs[professor_code]; ?>"> 
      </td>
    </tr>
    <!--
	<?
      $sql2 = "select f_full_name as advisor_name_sub from faculty where faculty_id = '$rs[professor_code_2]'";
   		$res2 = mysql_query($sql2);
			if ($res2) $rs2 = mysql_fetch_array($res2); 
		?>
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Advisor (Sub)</td>
  		<td bgcolor="#EFEFEF"><input name="prof_name_2" type="text" readonly value="<?=$rs2[advisor_name_sub];?>">
    		<input type="button" name="select_professor_2" value="Select" onClick="call_select_prof_2()">
    		<input type="text" name="professor_code_2" readonly style="background:'#EFEFEF'; border:0" value="<? echo $rs[professor_code_2]; ?>"> 
      </td>
    </tr>
	-->
    <!--
	<tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Double Major Dept.</td>
      <td bgcolor="#EFEFEF">
	    <Select name="double_major_dept" size="1">
		<option value="0">&nbsp;</option>
		  <?  
		     	$sql2 = "select * from code_dept";
				$res2 = mysql_query($sql2);
				if ($res2)
					while ($rs2 = mysql_fetch_array($res2)) {
						$sel = "";
						if ($rs[double_major_dept]==$rs2[dept_code])
							$sel = " selected";
		                echo "<option value=".$rs2[dept_code].$sel.">".$rs2[dept_name]."</option>"; 
		  	    }
		  ?>
		 </Select>
      </td>
    </tr>
	-->
    <tr> 
      <td bgcolor="#E8E8E8">&nbsp;&nbsp; Registration Status</td>
      <td bgcolor="#EFEFEF">
	    <Select name="status" size="1">
		  <?  
		     	$sql2 = "select * from code_student_status";
				$res2 = mysql_query($sql2);
				if ($res2)
					while ($rs2 = mysql_fetch_array($res2)) {
						$sel = "";
						if ($rs[status]==$rs2[s_status_code])
							$sel = " selected";
		                echo "<option value=".$rs2[s_status_code].$sel.">".$rs2[s_status_name]."</option>"; 
		  	    }
		  ?>
		 </Select>
       </td>
    </tr>
	<tr><td colspan="2" height="2"><hr></td></tr> <!-- Draw Line ---------------------------->
	<tr>
      <td colspan="2" align="center">
	  		<!-- Print Button -->
			<img id="imgPrint" src="../.././common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onclick="PlanPrint();" />
				<script>
					function PlanPrint() {
						document.all.imgPrint.style.display = "none";
						window.print();
						document.all.imgPrint.style.display = "";
					}
				</script>
		<!-- Print Button End-->
			  <input type="button" name="More_info" value="More Info." onclick=call_more_info('<?=$student_id?>')>
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
function call_select_prof() {
	window.open('../../../common/lib/search_faculty_form.php?frm=student_form&fld1=professor_code&fld2=prof_name','', 'width=600,height=400,scrollbars=yes'  );
}
function call_select_prof_2() {
	window.open('../../../common/lib/search_faculty_form.php?frm=student_form&fld1=professor_code_2&fld2=prof_name_2','', 'width=600,height=400,scrollbars=yes'  );
}

function call_more_info(student_id) {
	var checkIdWin = window.open('student_ext_edit_form.php?student_id='+student_id,'','width=830,height=550,scrollbars=yes,left=20,top=0,resizable=yes');
	checkIdWin.focus();

}


function call_exit() {
	window.close();
}

</script>
</body>
</html>
