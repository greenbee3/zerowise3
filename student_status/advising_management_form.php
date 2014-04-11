<?
/*=============================================================================
  Program : Tuition Fee Management Form
  Author  : Sejong Oh, Sam Han
  Date    : 2012.05.09, 2013.10.02	
  Comment :  LEI was added by Sam Han
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/function.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");

// Only authorized users from Academic Affairs and academic affairs can see the fee detail
$use_button=" disabled";
$auth_list=array("S2008002","S2007006","S2007015","S2007103","S2010501","stafftemp","A2011201");
if(in_array ($_SESSION[uid],$auth_list)==true) {
	$use_button="";
}
?>

<?php
if($operation=='must_change') {	
		//"reqAdvising ---> " . $reqAdvising;
	
		$sql="update miudb.advising_history a set a.advising_condition='$reqAdvising' where a.student_id='$sid'";
		echo $sql;
		mysql_query($sql);
		if(mysql_affected_rows()>=1) echo("<script>alert('Must information was successfully updated!'); </script>");
		else echo("<script>alert('Change failed!');</script>");	
	}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/common/css/table.css" rel="stylesheet" type="text/css">
<style type="text/css">
.style1 {
	color: #FF0000;
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<center><h3>Advising Management </h3></center>
<!--- Select Course year ---->
<?
$c_year=$_SESSION['c_year'];
if($open_year=="") $open_year=$c_year;
?>
			
<form action="advising_management_form.php" method="post" name="advising_management_form" id="advising_management_form" style="margin:0px;">
	<table width ="920" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" onSubmit="return checkForm(this)">

		<tr align="center"><td colspan='3'>
  			<!--- Select Year ---->
  			<!-- <b>Year :
  			<Select name="open_year" size="1">
  							<? print_year($_SESSION[c_year],$open_year,-3,7);?>		
  			</Select>		 -->
			<!--- Select department ---->
			&nbsp;Department : 
			<Select name="department" size="1">
						<option value="all" <? if ($department == "" || $department == "all") echo "selected" ?>>All</option>
							<?  
				     			$sql = "select * from miudb.code_dept";
								$res = mysql_query($sql);
								if ($res)
								while ($rs = mysql_fetch_array($res)) {
									$sel = "";
									if ($department == $rs[dept_code]) $sel="selected";
									echo "<option value=".$rs[dept_code]." ".$sel.">".$rs[abb_name]."</option>"; 
				  				}
							?>
			</Select>
			<?echo($department);?> 
			<!--- Select Status ---->
			&nbsp;Status : 
			<Select name="status" size="1">		
				<option value="current" <? if($status == "" || $status =="current") echo "selected"; ?>>Current</option>			
					<?  						
		     			$sql = "select * from miudb.view_student_status order by s_status_code";
						$res = mysql_query($sql);
						if ($res)
							while ($rs = mysql_fetch_array($res)) {
								$sel = "";
								if ($status == $rs[s_status_code]) $sel="selected";
								echo "<option value=".$rs[s_status_code]." ".$sel.">".$rs[s_status_name]."</option>"; 
							}						
					?>
				<option value="" <? if($status == "all") echo "selected"; ?>>All</option>
			</Select>
         <!--    &nbsp;Nationality :
            <input type="Text" name="nationality" size="20" value="<?//=$_POST[nationality]?>">(eg, "rus" for all Russians")  -->
             
			<!-- Print Button -->
			&nbsp;<img id="imgPrint" src="/common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onClick="PlanPrint();" />
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
		<tr align="center"><td>		
			<!--- Select School_year ---->
			&nbsp;S.Year : 
			<Select name="school_year" size="1">
				<option value="all" <? if ($school_year == 'all') echo  "selected";?>>All</option>
				<option value="1" <? if ($school_year == '1') echo "selected";?>>1</option>
				<option value="2" <? if ($school_year == '2') echo "selected";?>>2</option>
				<option value="3" <? if ($school_year == '3') echo "selected";?>>3</option>
				<option value="4" <? if ($school_year == '4') echo "selected";?>>4</option>
				
			</Select>  

			&nbsp;Student ID : <input type="text" name="student_id" size="10" value="<?=$student_id?>">

			Student Name : <input type="Text" name="student_name" size="10">&nbsp;&nbsp;
			<!-- <span class="style1">Fee Name</span>: <input type="Text" name="fee_name" size="14">(eg, "dorm") --> 
			
			<input type="submit" name="search" value="Retrieve">
			<!--  &nbsp;&nbsp;<input type="button" name="insert_advising" value="Insert" onClick="call_add()" -->			
			</td>
		</tr>
	</table>

<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="center" width='60'>Studnet ID</td>
	 <td align="center" width='100'>Name</td>
	 <td align="center" width='40'>Dept.</td>
	 <td align="center" width='40'>School Year</td>
	 <td align="center" width='80'>Academic Status</td>
	 <!-- <td align="center" width='100'>Tuition/Fee</td>
	 <td align="center" width='100'>Scholarship Amount</td> 
	 <td align="center" width='100'>Paid Amount</td>
	 <td align="center" width='100'>Rest Amount (current)</td>
	-->	 
	 <td align="center" width='80'>Advising Condition (<?=$open_year?>)</td>
	 
	 <td align="center" width='50'>&nbsp;</td>
  </tr>
<?  
	$sql = "select student_id, s_full_name, status, school_year,dept_code from miudb.student where student_id <> 'NULL'";  
	
	if($department!="all") 
		$sql= $sql.=" and dept_code='".$department."'";
	if($status=="current") 
		$sql= $sql.=" and status IN(10,30,85)";
	else if($status!="") 
		$sql= $sql.=" and status='".$status."'";
	//if($t_level!="") $sql.=" and current_level_of_study='$t_level'";
	if($school_year!="" && $school_year !="all")
		$sql= $sql.=" and school_year='".$school_year."'";
	if($student_id!="") 
		$sql= $sql.=" and student_id like '%$student_id%'";
	if($student_name!="") $sql.=" and s_full_name like '%$student_name%'";
	
	$sql= $sql."order by student_id";
	/*if($nationality!="") {
		$nationality=strtoupper($nationality);
		$sql.=" and country_code IN (select  country_code from miudb.code_country where UPPER(country_name) like '%$nationality%')";
	}  */
	$res = mysql_query($sql);
	$cnt=$tpa=$tra=$tsc=$ttf=0;
	$sids=""; // for copying "student_id"s into clipboard
	
	if ($res)
	  while ($rs = mysql_fetch_array($res)) {	  
		$student_id=$rs[student_id];
		$sids.=($rs[student_id].";");
		echo "<tr class='listitem'>";
		echo "<td width='60'>".$rs[student_id]."</td>";
		echo "<td width='100'>".$rs[s_full_name]." </td>";
		echo "<td width='40'>".getDeptAbb($rs[dept_code])."</td>";
		echo "<td width='40'>".$rs[school_year]."</td>";
		
		$sql_inner = "select s_status_name 
	        from miudb.code_student_status
			where (s_status_code = '$rs[status]')
			";
			$res_inner = mysql_query($sql_inner);
			if ($res_inner)
				$rs_inner = mysql_fetch_array($res_inner);
			$font_color = "color='black'";
			if ($rs[status] != '10')
				$font_color = "color='red'";
        echo "<td width='80' align=center><font ".$font_color.">".$rs_inner[s_status_name]."</font></td>";
		
		/*if($rs[status]!=10 && $rs[status]!=30  && $rs[status]!=85)  $font_color="red"; else $font_color=black;
		echo "<td width='80'><font color=".$font_color.">".getStatusName($rs[status])."</font></td>";*/
		echo "<td width='50' align=center><input type='checkbox' name='advising' value='1' onClick='call_must($cnt,\"$student_id\",value)'";
        if($rs[advising]==1) echo "checked></td>";
        else echo ">"; 
	
	
		echo "<td width='50'><input bgcolor='gray' type='button' value='Detail' onclick=call_detail('".$rs[student_id]."','".$open_year."','".$semester."') ".$use_button."></td>";
	  
		echo "</tr>";
		$cnt++; 
	}
	echo("<tr><td colspan='6' >Total : $cnt</td></tr>"); 
//}
?>
</table>

<input type=hidden name='operation'>
<input type=hidden name='must_checked'>
<input type=hidden name='sid'>
<input type=hidden name='reqAdvising' value="">
<input type=hidden name='cnt' value ='<?=$cnt?>'>

</form>
<center><table border=0>
	<tr>
	<td colspan='11'>
	<form name='form2'>
	<textarea name='sids' cols=50 rows=2><?=$sids?></textarea>
	<br><input type=button value='copy student IDs into clipboard' onclick='copyToClipboard(document.form2.sids.value);'>		
	</form>
	
	</td>
	</tr>
</table></center>
</body>

<script>
	
	function call_add() {
		var checkIdWin = window.open('add_advising_list_form.php','','width=700,height=500,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}


	function call_detail(student_id, open_year, semester) {
		var checkIdWin = window.open('advising_detail.php?student_id='+student_id+'&open_year='+open_year,'','width=870,height=700,scrollbars=yes,left=20,top=0,resizable=yes,location=no');
		checkIdWin.focus();
	}

	function call_must(id,sid,idx){
        //alert (sid,idx);
        //document.write(sid,idx);
        document.advising_management_form.operation.value='must_change';
        document.advising_management_form.sid.value=sid;
        document.advising_management_form.advising.value=idx;
       
                if(document.advising_management_form.advising[id].checked==true) {
                        document.advising_management_form.reqAdvising.value='1';
                }else {
                        document.advising_management_form.reqAdvising.value='0';
                }
                alert('reqAdvising : '+document.advising_management_form.reqAdvising.value);
       
        document.advising_management_form.submit();
}


	function copyToClipboard (text) {
	  window.prompt ("Please press Ctrl+C, Enter", text);
	}

	
</script>
</html>