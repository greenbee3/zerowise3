<?
/*=============================================================================
  Program : Award or Warning Management
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
<link href="../../../common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>
<center><h3>Award or Warning</h3></center>

<form action="student_status_award_warning_form.php" method="post" name="student_list_form" id="student_list_form" style="margin:0px;">
	<table width ="900" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
		<tr align="center">
			<td>
				<!--- Select Award or Warning ---->
				<b>Select  Award  or  Warning :</b> 
				<Select name="special_event" size="1">
					<option value="All" <? if ($department == "" || $department == "All") echo "selected" ?>>All</option>
						<?  
		     			$sql = "select * from code_special_event";
							$res = mysql_query($sql);
							if ($res)
							while ($rs = mysql_fetch_array($res)) {
								$sel = "";
								if ($department == $rs[special_event_code]) $sel="selected";
								echo "<option value=".$rs[special_event_code]." ".$sel.">".$rs[special_event_name]."</option>"; 
			  				}
						?>
				</Select>
<!--
				<input type="radio" name="special_event_type" value="1"> Award &nbsp;
				<input type="radio" name="special_event_type" value="2"> Warning 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
-->				
			</td>
		</tr>
		<tr>
			<td>
 			<!--- Select Year ---->
			  <?  
		     	$sql2 = "select sys_value from miu_system.sys_variable where sys_var = 'curr_year'";
					$res2 = mysql_query($sql2);
					if ($res2)
					$rs2 = mysql_fetch_array($res2);
					
					$curr_year = $rs2[sys_value];
					if($open_year == "") $open_year = $curr_year;
			  ?>
				Year : 
				<Select name="open_year" size="1">
					<option value="<? echo $curr_year; ?>" <? if ($open_year == $curr_year) echo "selected" ?>><? echo $curr_year; ?></option>
					<option value="<? echo $curr_year-1; ?>" <? if ($open_year == ($curr_year-1)) echo "selected" ?>><? echo $curr_year-1; ?></option>
					<option value="<? echo $curr_year-2; ?>" <? if ($open_year == ($curr_year-2)) echo "selected" ?>><? echo $curr_year-2; ?></option>
					<option value="<? echo $curr_year-3; ?>" <? if ($open_year == ($curr_year-3)) echo "selected" ?>><? echo $curr_year-3; ?></option>
					<option value="<? echo $curr_year-4; ?>" <? if ($open_year == ($curr_year-4)) echo "selected" ?>><? echo $curr_year-4; ?></option>
					<option value="<? echo $curr_year-5; ?>" <? if ($open_year == ($curr_year-5)) echo "selected" ?>><? echo $curr_year-5; ?></option>
					<option value="<? echo $curr_year-6; ?>" <? if ($open_year == ($curr_year-6)) echo "selected" ?>><? echo $curr_year-6; ?></option>
					<option value="<? echo $curr_year-7; ?>" <? if ($open_year == ($curr_year-7)) echo "selected" ?>><? echo $curr_year-7; ?></option>
					<option value="<? echo $curr_year-8; ?>" <? if ($open_year == ($curr_year-8)) echo "selected" ?>><? echo $curr_year-8; ?></option>
					<option value="<? echo $curr_year-9; ?>" <? if ($open_year == ($curr_year-9)) echo "selected" ?>><? echo $curr_year-9; ?></option>
				</Select>&nbsp;

				<!--- Select Semester ---->
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
				
				<!--- Select department ---->
				Deaprtment : 
				<Select name="department" size="1">
					<option value="All" <? if ($department == "" || $department == "All") echo "selected" ?>>All</option>
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
				&nbsp;

				<!-- Select level --->
				Level : 
				<Select name="t_level" size="1">
					<option value="All" <? if ($t_level == 'All') echo "selected";?>>All</option>
					<option value="100" <? if ($t_level == '100') echo "selected";?>>Bachelor</option>
					<option value="200" <? if ($t_level == '200') echo "selected";?>>Master</option>
					<option value="300" <? if ($t_level == '300') echo "selected";?>>Doctor</option>
				</Select>
				&nbsp;
				
				<!-- School Year --->
				School Year :
				<Select name="school_year" size="1">
					<option value="1" <? if ($school_year == "1") echo "selected"; ?>>1</option>
					<option value="2" <? if ($school_year == "2") echo "selected"; ?>>2</option>
					<option value="3" <? if ($school_year == "3") echo "selected"; ?>>3</option>
					<option value="4" <? if ($school_year == "4") echo "selected"; ?>>4</option>
				</Select>

				<!-- Retrieve Button --->
				<input type="submit" name="Retrieve" value="Retrieve">
			</td>
		</tr>
	</table>
</form>

<table class="datatable"  width ="639" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>

<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="Left" width='40'>Dept.</td>
	 <td align="Left" width='60'>Level</td>
	 <td align="Left" width='50'>S Year</td>
	 <td align="Left" width='70'>Studnet ID</td>
	 <td align="Left" width='100'>Name</td>
	 <td align="Left" width='100'>Record</td>
	 <td align="Left" width='50'>Date</td>
	 <td align="Left" width='50'>Comment</td>
	 <td align="Left" width='50'>Student Info.</td>
  </tr>
</table>
  <table class="datatable" align="center" cellspacing="1" cellpadding="3"  bgcolor="#cdcdcd" >
		<?  
			$sql = "select r.comment, r.sys_date, r.special_event_code, e.special_event_name, s.student_id,
			              s.given_name, s.family_name, s.school_year, s.current_level_of_study, 
			              d.abb_name, r.sys_date
							from special_event_record r, code_special_event e, student s, code_dept d
							where (r.special_event_code = e.special_event_code) and (s.student_id = r.student_id) and
							      (d.dept_code = s.dept_code)
							";
    	
			$sql = $sql." order by r.student_id";

			if ($department != "All")
				$sql = $sql." and s.dept_code = '".$department."'" ;  
		
			if ($t_level != "All")
				$sql = $sql." and s.current_level_of_study = '".$t_level."'" ;  
		
			$cnt = 0;
			$res = mysql_query($sql);
			if ($res)
				while ($rs = mysql_fetch_array($res)) {
          echo "<tr class='listitem'>";
          echo "<td width='40'>".$rs[abb_name]."</td>";
          echo "<td width='60'>".$rs[current_level_of_study]."</td>";
          echo "<td width='50'>".$rs[school_year]."</td>";
          echo "<td width='70'>".$rs[student_id]."</td>";
          echo "<td width='100'>".$rs[given_name]." ".$rs[family_name]."</td>";
          echo "<td width='100'>".$rs[special_event_name]."</td>";
          echo "<td width='50'>".$rs[sys_date]."</td>";
          echo "<td width='50'>".$rs[a]."</td>";
          echo "<td width='50'>".$rs[a]."</td>";
					$cnt ++;
				}
?>
	<tr><td colspan='4' align="left">Total : <?=$cnt?></td>
		<td colspan='9' align="right">
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
				<input type="Button" name="Add_Award" value="Add Award" onclick="call_add1()" <?=$use_button?>> 
				<input type="Button" name="Add_Warning" value="Add Warning" onclick="call_add2()" <?=$use_button?>> 
		</td>
	</tr>
</table>
</body>

<script>
	function call_add1() {
		var checkIdWin = window.open('student_status_award_add_form.php','','width=550,height=550,scrollbars=yes,left=20,top=0,resizable=yes');
			checkIdWin.focus();
	}
	function call_add2() {
		var checkIdWin = window.open('student_status_award_warning_add_form.php','','width=550,height=550,scrollbars=yes,left=20,top=0,resizable=yes');
			checkIdWin.focus();
	}

</script>
</html>
