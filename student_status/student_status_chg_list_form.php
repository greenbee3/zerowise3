<?
/*=============================================================================
  Program : Display Student Status Change list by department
  Author  : Sejong Oh
  Date    : 2008.21.1	
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
<center><h3>Student Status Change List</h3></center>

<form action="student_status_chg_list_form.php" method="post" name="prereq_list_form" id="prereq_list_form" style="margin:0px;">
	<table width ="850" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
		<tr align="left">
		<td>
		  <?  
	     	$sql2 = "select sys_value from miu_system.sys_variable where sys_var = 'curr_year'";
			$res2 = mysql_query($sql2);
			if ($res2)
				$rs2 = mysql_fetch_array($res2) ;
		  ?>

			Year : <input type="text" name="chg_year" size="5" value="<?=$rs2[sys_value]?>">
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


			<!--- Select department ---->
			Deaprtment : 
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
			<!-- End select department --->
			<input type="submit" name="Retrive" value="Retrieve">
		</td>
		<td align="Right">
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
</form>

<table class="datatable"  width ="850" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>
<table align="center" cellspacing="1" cellpadding="3" class="datasheet" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="Left" width='40'>Dept.</td>
	 <td align="Left" width='60'>Student ID</td>
	 <td align="Left" width='150'>Name</td>
	 <td align="Left" width='150'>Change Status</td>
	 <td align="Left" width='90'>Reg. Date</td>
	 <td align="Left" width='90'>[From] Apply Year/Semester</td>
	 <td align="Left" width='90'>[To] Apply Year/Semester</td>
	 <td align="Left" width='150'>Change reason</td>
	 <td align="Left" width='90'>etc</td>
	 <td align="Left" width='60'>&nbsp</td>
  </tr>
</table>
  <table align="center" cellspacing="1" cellpadding="3" class="datasheet" bgcolor="#cdcdcd">
<? 
   	$sql = "select * 
	        from student_status_change_history h, student s, code_dept d
			where (h.student_id  = s.student_id) and
				  (s.dept_code = d.dept_code) and
				  (h.change_year_from   = '$chg_year') and
				  (h.semester_from = '$semester')
			";
    
	if ($department != "all")
		$sql = $sql." and s.dept_code = '".$department."'" ;  

	$sql = $sql." order by s.dept_code, h.status_change_code";

	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
            echo "<tr class='itemlist'>";
            echo "<td width='40'>".$rs[abb_name]."</td>";
            echo "<td width='60'>".$rs[student_id]."</td>";
            echo "<td width='150'>".$rs[s_full_name]."</td>";

   	$sql2 = "select * 
	        from code_student_status_change
			where s_status_chg_code = '$rs[status_change_code]'
			";
	$res2 = mysql_query($sql2);
	if ($res2)
		$rs2 = mysql_fetch_array($res2);
  
            echo "<td width='150'>".$rs2[s_status_chg_name]."</td>";
            echo "<td width='90'>".$rs[change_date]."</td>";
			echo "<td width='90'>".$rs[change_year_from]."/".semester_name($rs[semester_from])."</td>";
			echo "<td width='90'>".$rs[change_year_to]."/".semester_name($rs[semester_to])."</td>";
            echo "<td width='150'>".$rs[change_reason]."</td>";
            echo "<td width='90'>".$rs[etc]."</td>";


			if ($session_userid == 'M2010102' || $session_userid == 'M2004018' || $session_userid == 'M2009104' || $session_userid == 'M2009107' || $session_userid == 'M2004021' || $session_userid == 'M2007006')
				$use_button = " disabled";
			else $use_button = "";

            echo "<td width='60'>
					<input type='button' value='Delete' onclick=call_del('".$rs[rid]."') ".$use_button.">
				</td>";
            echo "</tr>";
		} 

?>
</table>
</body>

<script>
	function call_del(rid) {
		if (confirm("Are you really try to delete the Data?") !=0) {
			self.location="student_status_del.php?rid=" + rid ;
		}

	}

//	function call_search() {
//		var checkIdWin = window.open('search_subject_form.php','','width=650,height=440');
//			checkIdWin.focus();
//	}

</script>
</html>
<?
	function semester_name($sem_num) {
		if ($sem_num=='1') $semester_name = "Spring" ;
			else if ($sem_num=='2') $semester_name = "Summer" ;
			else if ($sem_num=='3') $semester_name = "Fall" ;
			else if ($sem_num=='4') $semester_name = "Winter" ;		
		return $semester_name ;
	}
?>