<?
/*=============================================================================
  Program : Display student list by department
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
<link href="../../../common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>
<center><h3>Student Status Change</h3></center>

<form action="student_status_reg_form.php" method="post" name="student_list_form" id="student_list_form" style="margin:0px;">
	<table width ="560" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
		<tr align="left"><td>
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
		<tr>
		<td colspan=2>	Student ID : <input type="text" name="student_id" width="30">
			Student Name : <input type="Text" name="student_name" width="40">
			 <input type="submit" name="search_student" value="Search">
		</td>
		</tr>
	</table>
</form>
<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="Left" width='110'>Studnet ID</td>
	 <td align="Left" width='160'>Name</td>
	 <td align="Left" width='110'>Department</td>
	 <td align="Left" width='80'>Status</td>
	 <td align="Left" width='50'>&nbsp</td>
  </tr>
</table>
  <table class="datatable" align="center" cellspacing="1" cellpadding="3"  bgcolor="#cdcdcd" >
<?  
   	$sql = "select s.student_id, s.family_name, s.given_name, d.abb_name, s.status 
	        from student s, code_dept d
			where (s.dept_code = d.dept_code)
			";
    
	if ($department != "all")
		$sql = $sql." and s.dept_code = '".$department."'" ;  

	if ($student_id != "")
		$sql = $sql." and s.student_id = '".$student_id."'" ;  

	if ($student_name != "")
		$sql = $sql." and s.s_full_name like '%".$student_name."%'" ;  

	$sql = $sql." order by s.student_id";

	$cnt = 0;
	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
            echo "<tr class='listitem'>";
            echo "<td width='110'>".$rs[student_id]."</td>";
            echo "<td width='160'>".$rs[given_name]." ".$rs[family_name]."</td>";
            echo "<td width='110'>".$rs[abb_name]."</td>";

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

            echo "<td width='50'><input bgcolor='gray' type='button' value='Select' onclick=call_edit('".$rs[student_id]."')></td>";
            echo "</tr>";
			//echo "<tr><td colspan='6' height='1' bgcolor='#DFDFDF'></td></tr>";
			$cnt ++;
		}
?>
	<!--tr><td colspan='6' height='1' bgcolor='#000000'></td></tr -->
	<tr><td colspan='6' >Total : <?=$cnt?></td></tr>
</table>
</body>

<script>
	function call_edit(student_id) {
		var checkIdWin = window.open('student_status_add_form.php?student_id='+student_id,'','width=600,height=600,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
</script>
</html>
