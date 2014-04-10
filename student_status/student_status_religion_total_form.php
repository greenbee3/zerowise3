<?
/*=============================================================================
  Program : Display student's religion Total list
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
<center><h3>Total List</h3></center>

<form action="student_status_religion_total_form.php" method="post" name="student_status_religion_total_form" id="student_status_religion_total_form" style="margin:0px;">
	<table width ="800" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
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
				&nbsp;&nbsp;<input type="submit" name="Retrieve" value="Retrieve">
				
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
<table class="datatable"  width ="800" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>

<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="Left" width='60'>Dept.</td>
	 <td align="Left" width='60'>S Year</td>
	 <td align="Left" width='80'>Status</td>
	 <td align="Left" width='80'>Christianity</td>
	 <td align="Left" width='80'>Catholicism</td>
	 <td align="Left" width='80'>Buddhism</td>
	 <td align="Left" width='80'>Islam</td>
	 <td align="Left" width='80'>None</td>
	 <td align="Left" width='80'>etc</td>
	 <td align="Left" width='50'>&nbsp</td>
  </tr>
</table>
  <table class="datatable" align="center" cellspacing="1" cellpadding="3"  bgcolor="#cdcdcd" >
<?  
   	$im_christianity_1 = 0; $im_catholicism_1 = 0; $im_buddhism_1 = 0; $im_islam_1 = 0; $im_none_1 = 0; $im_etc_1 = 0;
	$im_christianity_2 = 0; $im_catholicism_2 = 0; $im_buddhism_2 = 0; $im_islam_2 = 0; $im_none_2 = 0; $im_etc_2 = 0;
	$im_christianity_3 = 0; $im_catholicism_3 = 0; $im_buddhism_3 = 0; $im_islam_3 = 0; $im_none_3 = 0; $im_etc_3 = 0;
	$im_christianity_4 = 0; $im_catholicism_4 = 0; $im_buddhism_4 = 0; $im_islam_4 = 0; $im_none_4 = 0; $im_etc_4 = 0;
	$im_1 = 0; $im_2 = 0; $im_3 = 0; $im_4 = 0;

	$it_christianity_1 = 0; $it_catholicism_1 = 0; $it_buddhism_1 = 0; $it_islam_1 = 0; $it_none_1 = 0; $it_etc_1 = 0;
	$it_christianity_2 = 0; $it_catholicism_2 = 0; $it_buddhism_2 = 0; $it_islam_2 = 0; $it_none_2 = 0; $it_etc_2 = 0;
	$it_christianity_3 = 0; $it_catholicism_3 = 0; $it_buddhism_3 = 0; $it_islam_3 = 0; $it_none_3 = 0; $it_etc_3 = 0;
	$it_christianity_4 = 0; $it_catholicism_4 = 0; $it_buddhism_4 = 0; $it_islam_4 = 0; $it_none_4 = 0; $it_etc_4 = 0;
	$it_1 = 0; $it_2 = 0; $it_3 = 0; $it_4 = 0;

	$ee_christianity_1 = 0; $ee_catholicism_1 = 0; $ee_buddhism_1 = 0; $ee_islam_1 = 0; $ee_none_1 = 0; $ee_etc_1 = 0;
	$ee_christianity_2 = 0; $ee_catholicism_2 = 0; $ee_buddhism_2 = 0; $ee_islam_2 = 0; $ee_none_2 = 0; $ee_etc_2 = 0;
	$ee_christianity_3 = 0; $ee_catholicism_3 = 0; $ee_buddhism_3 = 0; $ee_islam_3 = 0; $ee_none_3 = 0; $ee_etc_3 = 0;
	$ee_christianity_4 = 0; $ee_catholicism_4 = 0; $ee_buddhism_4 = 0; $ee_islam_4 = 0; $ee_none_4 = 0; $ee_etc_4 = 0;
	$ee_1 = 0; $ee_2 = 0; $ee_3 = 0; $ee_4 = 0;

	$bt_christianity_1 = 0; $bt_catholicism_1 = 0; $bt_buddhism_1 = 0; $bt_islam_1 = 0; $bt_none_1 = 0; $bt_etc_1 = 0;
	$bt_christianity_2 = 0; $bt_catholicism_2 = 0; $bt_buddhism_2 = 0; $bt_islam_2 = 0; $bt_none_2 = 0; $bt_etc_2 = 0;
	$bt_christianity_3 = 0; $bt_catholicism_3 = 0; $bt_buddhism_3 = 0; $bt_islam_3 = 0; $bt_none_3 = 0; $bt_etc_3 = 0;
	$bt_christianity_4 = 0; $bt_catholicism_4 = 0; $bt_buddhism_4 = 0; $bt_islam_4 = 0; $bt_none_4 = 0; $bt_etc_4 = 0;
	$bt_1 = 0; $bt_2 = 0; $bt_3 = 0; $bt_4 = 0;

	$fd_christianity_1 = 0; $fd_catholicism_1 = 0; $fd_buddhism_1 = 0; $fd_islam_1 = 0; $fd_none_1 = 0; $fd_etc_1 = 0;
	$fd_christianity_2 = 0; $fd_catholicism_2 = 0; $fd_buddhism_2 = 0; $fd_islam_2 = 0; $fd_none_2 = 0; $fd_etc_2 = 0;
	$fd_christianity_3 = 0; $fd_catholicism_3 = 0; $fd_buddhism_3 = 0; $fd_islam_3 = 0; $fd_none_3 = 0; $fd_etc_3 = 0;
	$fd_christianity_4 = 0; $fd_catholicism_4 = 0; $fd_buddhism_4 = 0; $fd_islam_4 = 0; $fd_none_4 = 0; $fd_etc_4 = 0;
	$fd_1 = 0; $fd_2 = 0; $fd_3 = 0; $fd_4 = 0;

	$sql = "select d.abb_name, s.school_year, t.religion 
	        from student s, student_ext t, code_dept d
			where s.student_id = t.student_id and 
			      s.dept_code = d.dept_code and 
				  s.student_id <> ''   
	       ";
    
	if ($department != "all")
		$sql = $sql." and s.dept_code = '".$department."'" ;  

	if ($status != "all")
		$sql = $sql." and s.status = '".$status."'" ;  

	if ($school_year != "all")
		$sql = $sql." and s.school_year = '".$school_year."'" ;
		
	$sql = $sql." order by s.dept_code, s.student_id";

	$cnt = 0;
	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
            
			if ($rs[abb_name] == "IM") {

				if ($rs[school_year] == 1) {
					if ($rs[religion] == 10) 
						$im_christianity_1++;
					else if ($rs[religion] == 20) 
						$im_catholicism_1++;
					else if ($rs[religion] == 30)
						$im_buddhism_1++;
				    else if ($rs[religion] == 40)
						$im_islam_1++;
					else if ($rs[religion] == 90)
						$im_none_1++;
					else if ($rs[religion] == 99)
						$im_etc_1++;
					
					$im_1++;

				} else if ($rs[school_year] == 2) {
					if ($rs[religion] == 10) 
						$im_christianity_2++;
					else if ($rs[religion] == 20) 
						$im_catholicism_2++;
					else if ($rs[religion] == 30)
						$im_buddhism_2++;
				    else if ($rs[religion] == 40)
						$im_islam_2++;
					else if ($rs[religion] == 90)
						$im_none_2++;
					else if ($rs[religion] == 99)
						$im_etc_2++;

					$im_2++;

				} else if ($rs[school_year] == 3) {
					if ($rs[religion] == 10) 
						$im_christianity_3++;
					else if ($rs[religion] == 20) 
						$im_catholicism_3++;
					else if ($rs[religion] == 30)
						$im_buddhism_3++;
				    else if ($rs[religion] == 40)
						$im_islam_3++;
					else if ($rs[religion] == 90)
						$im_none_3++;
					else if ($rs[religion] == 99)
						$im_etc_3++;
					
					$im_3++;

				} else if ($rs[school_year] == 4) {
					if ($rs[religion] == 10) 
						$im_christianity_4++;
					else if ($rs[religion] == 20) 
						$im_catholicism_4++;
					else if ($rs[religion] == 30)
						$im_buddhism_4++;
				    else if ($rs[religion] == 40)
						$im_islam_4++;
					else if ($rs[religion] == 90)
						$im_none_4++;
					else if ($rs[religion] == 99)
						$im_etc_4++;

					$im_4++;
				}

			} else if ($rs[abb_name] == "IT") {
				if ($rs[school_year] == 1) {
					if ($rs[religion] == 10) 
						$it_christianity_1++;
					else if ($rs[religion] == 20) 
						$it_catholicism_1++;
					else if ($rs[religion] == 30)
						$it_buddhism_1++;
				    else if ($rs[religion] == 40)
						$it_islam_1++;
					else if ($rs[religion] == 90)
						$it_none_1++;
					else if ($rs[religion] == 99)
						$it_etc_1++;
					
					$it_1++;

				} else if ($rs[school_year] == 2) {
					if ($rs[religion] == 10) 
						$it_christianity_2++;
					else if ($rs[religion] == 20) 
						$it_catholicism_2++;
					else if ($rs[religion] == 30)
						$it_buddhism_2++;
				    else if ($rs[religion] == 40)
						$it_islam_2++;
					else if ($rs[religion] == 90)
						$it_none_2++;
					else if ($rs[religion] == 99)
						$it_etc_2++;

					$it_2++;

				} else if ($rs[school_year] == 3) {
					if ($rs[religion] == 10) 
						$it_christianity_3++;
					else if ($rs[religion] == 20) 
						$it_catholicism_3++;
					else if ($rs[religion] == 30)
						$it_buddhism_3++;
				    else if ($rs[religion] == 40)
						$it_islam_3++;
					else if ($rs[religion] == 90)
						$it_none_3++;
					else if ($rs[religion] == 99)
						$it_etc_3++;

					$it_3++;

				} else if ($rs[school_year] == 4) {
					if ($rs[religion] == 10) 
						$it_christianity_4++;
					else if ($rs[religion] == 20) 
						$it_catholicism_4++;
					else if ($rs[religion] == 30)
						$it_buddhism_4++;
				    else if ($rs[religion] == 40)
						$it_islam_4++;
					else if ($rs[religion] == 90)
						$it_none_4++;
					else if ($rs[religion] == 99)
						$it_etc_4++;

					$it_4++;
				}

			} else if ($rs[abb_name] == "EE") {
				if ($rs[school_year] == 1) {
					if ($rs[religion] == 10) 
						$ee_christianity_1++;
					else if ($rs[religion] == 20) 
						$ee_catholicism_1++;
					else if ($rs[religion] == 30)
						$ee_buddhism_1++;
				    else if ($rs[religion] == 40)
						$ee_islam_1++;
					else if ($rs[religion] == 90)
						$ee_none_1++;
					else if ($rs[religion] == 99)
						$ee_etc_1++;

					$ee_1++;
					
				} else if ($rs[school_year] == 2) {
					if ($rs[religion] == 10) 
						$ee_christianity_2++;
					else if ($rs[religion] == 20) 
						$ee_catholicism_2++;
					else if ($rs[religion] == 30)
						$ee_buddhism_2++;
				    else if ($rs[religion] == 40)
						$ee_islam_2++;
					else if ($rs[religion] == 90)
						$ee_none_2++;
					else if ($rs[religion] == 99)
						$ee_etc_2++;

					$ee_2++;

				} else if ($rs[school_year] == 3) {
					if ($rs[religion] == 10) 
						$ee_christianity_3++;
					else if ($rs[religion] == 20) 
						$ee_catholicism_3++;
					else if ($rs[religion] == 30)
						$ee_buddhism_3++;
				    else if ($rs[religion] == 40)
						$ee_islam_3++;
					else if ($rs[religion] == 90)
						$ee_none_3++;
					else if ($rs[religion] == 99)
						$ee_etc_3++;

					$ee_3++;

				} else if ($rs[school_year] == 4) {
					if ($rs[religion] == 10) 
						$ee_christianity_4++;
					else if ($rs[religion] == 20) 
						$ee_catholicism_4++;
					else if ($rs[religion] == 30)
						$ee_buddhism_4++;
				    else if ($rs[religion] == 40)
						$ee_islam_4++;
					else if ($rs[religion] == 90)
						$ee_none_4++;
					else if ($rs[religion] == 99)
						$ee_etc_4++;

					$ee_4++;
				}

			} else if ($rs[abb_name] == "BT") {
				if ($rs[school_year] == 1) {
					if ($rs[religion] == 10) 
						$bt_christianity_1++;
					else if ($rs[religion] == 20) 
						$bt_catholicism_1++;
					else if ($rs[religion] == 30)
						$bt_buddhism_1++;
				    else if ($rs[religion] == 40)
						$bt_islam_1++;
					else if ($rs[religion] == 90)
						$bt_none_1++;
					else if ($rs[religion] == 99)
						$bt_etc_1++;

					$bt_1++;
					
				} else if ($rs[school_year] == 2) {
					if ($rs[religion] == 10) 
						$it_christianity_2++;
					else if ($rs[religion] == 20) 
						$bt_catholicism_2++;
					else if ($rs[religion] == 30)
						$bt_buddhism_2++;
				    else if ($rs[religion] == 40)
						$bt_islam_2++;
					else if ($rs[religion] == 90)
						$bt_none_2++;
					else if ($rs[religion] == 99)
						$bt_etc_2++;

				} else if ($rs[school_year] == 3) {
					if ($rs[religion] == 10) 
						$bt_christianity_3++;
					else if ($rs[religion] == 20) 
						$bt_catholicism_3++;
					else if ($rs[religion] == 30)
						$bt_buddhism_3++;
				    else if ($rs[religion] == 40)
						$bt_islam_3++;
					else if ($rs[religion] == 90)
						$bt_none_3++;
					else if ($rs[religion] == 99)
						$bt_etc_3++;

				} else if ($rs[school_year] == 4) {
					if ($rs[religion] == 10) 
						$bt_christianity_4++;
					else if ($rs[religion] == 20) 
						$bt_catholicism_4++;
					else if ($rs[religion] == 30)
						$bt_buddhism_4++;
				    else if ($rs[religion] == 40)
						$bt_islam_4++;
					else if ($rs[religion] == 90)
						$bt_none_4++;
					else if ($rs[religion] == 99)
						$bt_etc_4++;
				}

			} else if ($rs[abb_name] == "FD") {
				if ($rs[school_year] == 1) {
					if ($rs[religion] == 10) 
						$fd_christianity_1++;
					else if ($rs[religion] == 20) 
						$fd_catholicism_1++;
					else if ($rs[religion] == 30)
						$fd_buddhism_1++;
				    else if ($rs[religion] == 40)
						$fd_islam_1++;
					else if ($rs[religion] == 90)
						$fd_none_1++;
					else if ($rs[religion] == 99)
						$fd_etc_1++;
					
				} else if ($rs[school_year] == 2) {
					if ($rs[religion] == 10) 
						$fd_christianity_2++;
					else if ($rs[religion] == 20) 
						$fd_catholicism_2++;
					else if ($rs[religion] == 30)
						$fd_buddhism_2++;
				    else if ($rs[religion] == 40)
						$fd_islam_2++;
					else if ($rs[religion] == 90)
						$fd_none_2++;
					else if ($rs[religion] == 99)
						$fd_etc_2++;

				} else if ($rs[school_year] == 3) {
					if ($rs[religion] == 10) 
						$fd_christianity_3++;
					else if ($rs[religion] == 20) 
						$fd_catholicism_3++;
					else if ($rs[religion] == 30)
						$fd_buddhism_3++;
				    else if ($rs[religion] == 40)
						$fd_islam_3++;
					else if ($rs[religion] == 90)
						$fd_none_3++;
					else if ($rs[religion] == 99)
						$fd_etc_3++;

				} else if ($rs[school_year] == 4) {
					if ($rs[religion] == 10) 
						$fd_christianity_4++;
					else if ($rs[religion] == 20) 
						$fd_catholicism_4++;
					else if ($rs[religion] == 30)
						$fd_buddhism_4++;
				    else if ($rs[religion] == 40)
						$fd_islam_4++;
					else if ($rs[religion] == 90)
						$fd_none_4++;
					else if ($rs[religion] == 99)
						$fd_etc_4++;
				}
			}
			
			for ($i=1; $i<5; $i++) {
				echo "<tr class='listitem'>";
				echo "<td width='60'>IM</td>";
				echo "<td width='60'>".$i."</td>";
				echo "<td width='80'>Normal</td>";
				
				echo "<td width='80'>".$im_christianity."_".$i." "."</td>";

				echo "<td width='80'></td>";

				echo "<td width='80'></td>";

				echo "<td width='80'></td>";

				echo "<td width='80'></td>";

				echo "<td width='80'></td>";

			}
			
			echo "<tr class='listitem'>";
			echo "<td width='60'>IM</td>";
			echo "<td width='60'>All</td>";
			echo "<td width='80'>Normal</td>";


			
            echo "<td width='173'>".$rs[given_name]." ".$rs[family_name]."</td>";
            echo "<td width='60'>".$rs[abb_name]."</td>";
            echo "<td width='60'>".$rs[school_year]."</td>";

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

            echo "<td width='50'><input bgcolor='gray' type='button' value=' Edit ' onclick=call_edit('".$rs[student_id]."')></td>";
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
		var checkIdWin = window.open('student_edit_form.php?student_id='+student_id,'','width=830,height=700,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
	function call_add() {
		var checkIdWin = window.open('student_add_form.php','','width=830,height=700,scrollbars=yes,left=20,top=0,resizable=yes');
			checkIdWin.focus();
	}

	//Edited by JH YEO --10/11/10
	function call_show_total() {
		var checkIdWin = window.open('student_status_religion_total_form.php','','width=900,height=400,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
	//

</script>
</html>
