<?
/*=============================================================================
  Program : Display student's religion status list by department
  Author  : Junho Yeo
  Date    : 2010.11.10	
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
<link href="../../../common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>
<center><h3>Send Group Mail</h3></center>

<form action="../../../common/lib/group_mail_form.php" method="post" name="student_form" id="group_mail_form" style="margin:0px;">
	<table width ="900" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
		<tr align="center">
			<td colspan=3 >
				<!--- Select department ---->
				Department : 
				<Select name="department" size="1">
					<option value="all" <? if ($department == "" || $department == "all") echo "selected" ?>>All</option>
						<?  
			     			$sql = "select * from code_dept";
							$res = mysql_query($sql);
							if ($res)
							while ($rs = mysql_fetch_array($res)) {
								$sel = "";
								if ($department == $rs[dept_code]) $sel="selected";
								echo "<option value=".$rs[dept_code]." ".$sel.">".$rs[dept_name]."</option>"; 
			  				}
						?>
				</Select>

				<!--- Select School Year ---->
				&nbsp;&nbsp;School_year : 
				<Select name="school_year" size="1">
					<option value="all" <? if ($school_year == "" || $school_year == "all") echo "selected" ?>>All</option>
					<option value="1" <? if ($school_year == '1') echo "selected";?>>1</option>
					<option value="2" <? if ($school_year == '2') echo "selected";?>>2</option>
					<option value="3" <? if ($school_year == '3') echo "selected";?>>3</option>
					<option value="4" <? if ($school_year == '4') echo "selected";?>>4</option>
				</Select>
	
				<!--- Select Status ---->
				&nbsp;&nbsp;Status : 
				<Select name="status" size="1">
					<option value="all" <? if ($status == "" || $status == "all") echo "selected" ?>>All</option>
						<?  
			     			$sql = "select * from code_student_status";
							$res = mysql_query($sql);
							if ($res)
							while ($rs = mysql_fetch_array($res)) {
								$sel = "";
								if ($status == $rs[s_status_code]) $sel="selected";
								echo "<option value=".$rs[s_status_code]." ".$sel.">".$rs[s_status_name]."</option>"; 
			  				}
						?>
				</Select>

				&nbsp;&nbsp;<input type="button" name="Retrieve" value="Retrieve" onclick="call_replace()">
			
			</td>

		</tr>
		<tr align="center">
			<td align="center">	
				 <input type="button" name="select_all" value="Select All" onclick="call_select_all()"> &nbsp;&nbsp;
				 <input type="button" value="show total" onclick="call_show_total()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type="submit" name="send" value="Send Mail">

			</td>
			<td align="right">
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
			</td>
		</tr>
	</table>

<table class="datatable"  width ="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>

<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="Left" width='50'>Select</td>
	 <td align="Left" width='80'>Studnet ID</td>
	 <td align="Left" width='173'>Name</td>
	 <td align="Left" width='60'>Dept.</td>
	 <td align="Left" width='60'>S Year</td>
	 <td align="Left" width='80'>Status</td>
	 <td align="Left" width='80'>Religion</td>
  </tr>
</table>
  <table class="datatable" align="center" cellspacing="1" cellpadding="3"  bgcolor="#cdcdcd" >
<?  
   	$sql = "select s.student_id, s.family_name, s.given_name, d.abb_name, s.status, 
	               s.school_year, t.religion 
	        from student s, student_ext t, code_dept d
			where s.student_id = t.student_id and 
			      s.dept_code = d.dept_code and 
				  s.student_id <> ''   
	       ";
    
	if ($department != "all")
		$sql = $sql." and s.dept_code = '".$department."'" ;  

	if ($status != "all")
		$sql = $sql." and s.status = '".$status."'" ;  

	if ($student_id != "")
		$sql = $sql." and s.student_id = '".$student_id."'" ;  

	if ($student_name != "")
		$sql = $sql." and s.s_full_name like '%".$student_name."%'" ;  

	if ($school_year != "all")
		$sql = $sql." and s.school_year = '".$school_year."'" ;
		

	$sql = $sql." order by s.dept_code, s.student_id";

	$cnt = 0;
	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
            echo "<tr class='listitem'>";
            echo "<td width='50'><input type='checkbox' name='sel_$cnt' value='$i'></td>";
            echo "<td width='80'>".$rs[student_id]."</td>";
            echo "<td width='173'>".$rs[given_name]." ".$rs[family_name]."</td>";
            echo "<td width='60'>".$rs[abb_name]."</td>";
            echo "<td width='60'>".$rs[school_year]."</td>";
echo "<input type='hidden' name='stid[$cnt]' value = '$rs[student_id]'>";

			$sql_inner = "select s_status_name 
			              from code_student_status 
						  where (s_status_code = '$rs[status]')
						 ";
			$res_inner = mysql_query($sql_inner);
			if ($res_inner)
				$rs_inner = mysql_fetch_array($res_inner);
			$font_color = "color='black'";
			if ($rs[status] != '10')
				$font_color = "color='red'";
            echo "<td width='80'><font ".$font_color.">".$rs_inner[s_status_name]."</font></td>";

			// show religion info.
			$sql_r = "select r.religion_name 
			          from code_religion r
			          where r.religion_code = '$rs[religion]'
					 ";
			$res_r = mysql_query($sql_r);
			if ($res_r)
				$rs_r = mysql_fetch_array($res_r);

			echo "<td width='80'>".$rs_r[religion_name]."</font></td>";

            echo "</tr>";
			//echo "<tr><td colspan='6' height='1' bgcolor='#DFDFDF'></td></tr>";
			$cnt ++;
		}
?>
	<!--tr><td colspan='6' height='1' bgcolor='#000000'></td></tr -->
	<tr><td colspan='6' >Total : <?=$cnt?></td></tr>
	<?
echo "<input type='hidden' name='cnt' value = '$cnt'>";

	?>
</table>
</form>
</body>

<script>
	function call_select_all() {
		var cnt = document.student_form.cnt.value; 
		var i=0; 
		while (i<cnt)
		{	var elem = 'sel_'+i;
			document.forms['student_form'].elements[elem].checked = true;
			i++;
		}
	}

	function call_replace() {
		var dept = document.student_form.department.value ;
		var syear = document.student_form.school_year.value
		var stat = document.student_form.status.value

		location.replace("send_group_mail_form.php?department="+dept+"&school_year="+syear+"&status="+stat);
	}

	//Edited by JH YEO --10/11/10
	function call_show_total() {
		var checkIdWin = window.open('student_status_religion_total_form.php','','width=850,height=400,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
	//

</script>
</html>
