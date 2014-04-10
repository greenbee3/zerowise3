<?
/*=============================================================================
  Program : Show Detailed Info. of Tuition Fee Payment for student
  Author  : Junho Yeo
  Date    : 2008.11.21	
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
<center><h3>Detailed Info. of Tuition Fee Payment History</h3></center>
			<!--- Select Course year ---->
<br>
<form action="tuition_status_form.php" method="post" name="tuition_status_form" id="tuition_status_form" style="margin:0px;">
	<table width ="970" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
		<!--
		<tr align="left">
			<td colspan=3>
				<!--- Select department ---->
				<!--Department : 
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
		-->
				<!--- Select Level ---->
				<!-- &nbsp;&nbsp;Level : 
				<Select name="t_level" size="1">
					<option value="100" <? if ($t_level == '100') echo "selected";?>>Bachelor</option>
					<option value="200" <? if ($t_level == '200') echo "selected";?>>Master</option>
					<option value="300" <? if ($t_level == '300') echo "selected";?>>Doctor</option>
					<option value="all" <? if ($t_level == 'all') echo "selected";?>>All</option>
				</Select>
	
				<!--- Select Status ---->
				<!-- &nbsp;&nbsp;Status : 
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
			</td>
		</tr>
		-->
		
		<!--- Select Course year ---->
		<?
			// get current year
			$sql = "select sys_value from miu_system.sys_variable 
					where sys_var='next_year'";
			$res = mysql_query($sql);
			if ($res) $rs = mysql_fetch_array($res);
			$this_year = $rs[sys_value];

			// get current semester
			$sql = "select sys_value from miu_system.sys_variable 
					where sys_var='next_semester'";
			$res = mysql_query($sql);
			if ($res) $rs = mysql_fetch_array($res);
			$this_semester = $rs[sys_value];
			if (!$semester) $semester = $this_semester;	

			// get tuition-paid year
			$sql = "select sys_value from miu_system.sys_variable 
					where sys_var='reg_year'";
			$res = mysql_query($sql);
			if ($res) $rs = mysql_fetch_array($res);
			$reg_year = $rs[sys_value];

			// get tuition-paid semester
			$sql = "select sys_value from miu_system.sys_variable 
					where sys_var='reg_semester'";
			$res = mysql_query($sql);
			if ($res) $rs = mysql_fetch_array($res);
			$reg_semester = $rs[sys_value];
		?>

		<tr>
			<td align="center">	Student ID : <input type="text" name="student_id" width="30">
				 <input type="submit" name="search_student" value="Search">
			</td>
			<td align="Right" >
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

<table class="datatable"  width ="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>

<input type="hidden" name="open_year"  value="<?=$reg_year?>">
<input type="hidden" name="semester"   value="<?=$reg_semester?>">
<!--<input type="hidden" name="student_id" value="<?=$student_id?>">-->
</form>

<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
     <td align="Left" width='60'>Student ID</td>
	 <td align="Left" width='60'>Open Year</td>
	 <td align="Left" width='60'>Semester</td>
	 <td align="Left" width='80'>Tuition Fee</td>
	 <td align="Left" width='80'>Paid amount</td>
	 <td align="Left" width='80'>scholarship amount</td>
	 <td align="Left" width='80'>Rest amount</td>
	 <td align="Left" width='50'>Payment Condition</td>
	 <td align="Left" width='80'>Paid Date</td>
	 <td align="Left" width='100'>Description</td>
  </tr>

<?

	$b_year = intval($reg_year) - 1;
	$e_year = $reg_year;

   	$sql = "select * 
	        from miu_finance.acc_tuition_history r
			where (r.open_year >= '$b_year') and
			      (r.open_year <= '$e_year')
			
			";

	if ($student_id != "")
		$sql = $sql." and (r.student_id = '".$student_id."')" ; 

	$sql = $sql." order by r.student_id, r.history_id";

	$cnt = 0;
	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
            echo "<tr class='listitem'>";
            
			echo "<td>".$rs[student_id]."</td>";
			echo "<td>".$rs[open_year]."</td>";

				if ($rs[semester] == '1') {
					$sem_name = "Spring";
				} else if ($rs[semester] == '2') {
					$sem_name = "Summer"; 
				} else if ($rs[semester] == '3') {
					$sem_name = "Fall"; 
				} else if ($rs[semester] == '4') {
					$sem_name = "Winter"; 
				}			

            echo "<td>".$sem_name."</td>";
			
			// tuition_fee
            echo "<td>".number_format($rs[tuition_fee])."</td>";
            echo "<td>".number_format($rs[paid_amount])."</td>";
            echo "<td>".number_format($rs[scholarship_amount])."</td>";
            echo "<td>".number_format($rs[rest_amount])."</td>";
			echo "<td>".$rs[tuition_condition]." %</td>";
            echo "<td>".$rs[pay_date]."</td>";
            echo "<td>".$rs[pay_description]."</td>";
            echo "</tr>";
			$cnt ++;
		}


		// check the tuition fee status of student
		$sql_history_id = "select MAX(history_id) as recently_id
							from miu_finance.acc_tuition_history r 
							where r.open_year = '$reg_year'
							and r.semester = '$reg_semester'
							and r.student_id = '$session_userid'
						  ";

		$res_history_id = mysql_query($sql_history_id);
		if ($res_history_id)
			$rs_history_id = mysql_fetch_array($res_history_id);

		$sql_recently_history = "select * from miu_finance.acc_tuition_history r 
								 where r.history_id = '$rs_history_id[recently_id]'
								 ";

		$res_recently_history = mysql_query($sql_recently_history);
		if ($res_recently_history)
			$rs_recently_history = mysql_fetch_array($res_recently_history);
		//
		
		// if the tuition condition is not 100%, show the due date to student
		$due_date = "";
		if ($rs_recently_history[tuition_condition] != 100) {
			
			// show the due date for default or personal
			// check default due date
			$sql_x = "select sys_value from miu_system.sys_variable where sys_var = 'due_date_to_pay_tuition_to'";
			$res_x = mysql_query($sql_x);
			if ($res_x) $rs_x = mysql_fetch_array($res_x);

			// check personal due date
			$sql_y = "select count(*) as count_check from miu_finance.code_acc_tuition_cal_status 
							 where student_id = '$session_userid'";
			$res_y = mysql_query($sql_y);
			if ($res_y) $rs_y = mysql_fetch_array($res_y);
		
			// if personal due date is set
			if ($rs_y[count_check] > 0) {
				
				$sql_z = "select due_date_to_pay_tuition_to from miu_finance.code_acc_tuition_cal_status 
								 where student_id = '$session_userid'";
				$res_z = mysql_query($sql_z);
				if ($res_z) {
					$rs_z = mysql_fetch_array($res_z);
					$due_date = "Due Date : ".$rs_z[due_date_to_pay_tuition_to];
				}
			}
			else $due_date = "Due Date : ".$rs_x[sys_value];
		}

?>
	<tr>
		<td colspan='6' >Total : <?=$cnt?></td>
		<td colspan='6' ><?=$due_date?></td>
	</tr> &nbsp; 
</table>
<br>
</body>
</html>
