<?
/*=============================================================================
<<<<<<< HEAD
  Program : Display Advising list by department
  Author  : Seokwon Kong
  Date    : 2014.04.01	
  Comment :  
=======
  Program : Tuition Fee Management Form
  Author  : Sejong Oh, Sam Han
  Date    : 2012.05.09, 2013.10.02	
  Comment :  LEI was added by Sam Han
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
<<<<<<< HEAD
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/create_user_access_log.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/function.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");
?>
<?php
	
if($operation=='must_change') {	
		//"reqAdvising ---> " . $reqAdvising;
	
		$sql="update miudb.advising_history s set s.advising_condition='$reqAdvising' where s.student_id='$sid'";
=======
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
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
		echo $sql;
		mysql_query($sql);
		if(mysql_affected_rows()>=1) echo("<script>alert('Must information was successfully updated!'); </script>");
		else echo("<script>alert('Change failed!');</script>");	
	}
<<<<<<< HEAD

=======
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<<<<<<< HEAD
<link href="../../../common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>
<center><h3>Advising Student List</h3></center>
=======
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
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
<!--- Select Course year ---->
<?
$c_year=$_SESSION['c_year'];
if($open_year=="") $open_year=$c_year;
?>
<<<<<<< HEAD

<form action="advising_management_form.php" method="post" name="advising_form" id="advising_form" style="margin:0px;">
	<table width ="800" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >
			<!-- onSubmit="return checkForm(this)" -->
		<tr align="left"><td>
			<b>Year :
  			<Select name="open_year" size="1">
			<? print_year($_SESSION[c_year],$open_year,-3,7);?>		
  			</Select>		
  		
  	  <tr> 
      <td width="100" bgcolor="#E8E8E8">&nbsp;&nbsp; Semester</td>
      <td bgcolor="#EFEFEF">
			<Select name="semester" size="1">
				<option value="" <?if($rs[semester]=="") echo(" selected");?>>All</option>
				<option value="1" <?if($rs[semester]=="1") echo(" selected");?>>Spring</option>
				<option value="2" <?if($rs[semester]=="2") echo(" selected");?>>Summer</option>
				<option value="3" <?if($rs[semester]=="3") echo(" selected");?>>Fall</option>
				<option value="4" <?if($rs[semester]=="4") echo(" selected");?>>Winter</option>
			</Select>
	  </td>
    </tr>
  			<!--- Select department ---->
			&nbsp;Department : 
			<!-- <Select name="department" size="1">
				<?print_dept_abb($department); ?>
               </Select>  -->
        
		  <Select name="department" size="1">
				<option value="all" <? if ($department == "" || $department == "all") echo "selected" ?>>All</option>
					<?  
		     			$sql = "select * from miudb.code_dept";
						$res = mysql_query($sql);
						if ($res)
						while ($rs = mysql_fetch_array($res)) {
							$sel = "";
							if ($department == $rs[dept_code]) $sel="selected";
							echo "<option value=".$rs[dept_code]." ".$sel.">".$rs[dept_name]."</option>"; 
		  				}
					?>
			</Select>


           	<!--- Select Status ---->
=======
			
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
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
			&nbsp;Status : 
			<Select name="status" size="1">		
				<option value="current" <? if($status == "" || $status =="current") echo "selected"; ?>>Current</option>			
					<?  						
<<<<<<< HEAD
		     			$sql = "select * from view_student_status order by s_status_code";
=======
		     			$sql = "select * from miudb.view_student_status order by s_status_code";
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
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
<<<<<<< HEAD
          <!--- Select School_year ---->
				&nbsp;&nbsp;S.Year : 
			<Select name="school_year" size="1">
				<option value="all" <? if ($school_year == 'all') echo  "selected";?>>All</option>
				<option value="1" <? if ($school_year == '1') echo "selected";?>>1</option>
				<option value="2" <? if ($school_year == '2') echo "selected";?>>2</option>
				<option value="3" <? if ($school_year == '3') echo "selected";?>>3</option>
				<option value="4" <? if ($school_year == '4') echo "selected";?>>4</option>
				
			</Select>   
			<br>&nbsp;Student ID : <input type="text" name="student_id" size="10" value="<?=$student_id?>">
					
			Student Name : <input type="Text" name="student_name" size="20"> 
			<!-- <input type="button" name="search" value="Retrieve" onClick='call_retrieve()' > -->
			
		<input type="submit" name="search" value="Retrieve">	
		<?				
			if ($session_userid =="S2008102" || $session_userid =="S2007006" || $session_userid =="S2007015" || $session_userid =="S2007103" || $session_userid=='stafftemp'  || $session_userid=='S2010501') $use_button=""; //added by SJH 2012/8/29
			else $use_button="disabled";
		?> 
			<!-- &nbsp; <? //echo ("<input type='submit' name='advising_save' value='Save' onclick=\"action='./add_advising_list_form.php';submit();\">") ; ?>	 -->
			&nbsp; <? echo ("<input type='submit' name='advising_save' value='Save' onclick=\"action='./advising_upd.php';submit();\">") ; ?>	
						
			<!-- Print Button -->
			&nbsp;<img id="imgPrint" src="../../../common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onClick="PlanPrint();" />
=======
         <!--    &nbsp;Nationality :
            <input type="Text" name="nationality" size="20" value="<?//=$_POST[nationality]?>">(eg, "rus" for all Russians")  -->
             
			<!-- Print Button -->
			&nbsp;<img id="imgPrint" src="/common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onClick="PlanPrint();" />
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
				<script>
					function PlanPrint() {
						document.all.imgPrint.style.display = "none";
						window.print();
						document.all.imgPrint.style.display = "";
					}
				</script>
			<!-- Print Button End-->
<<<<<<< HEAD
			
=======
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
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
			</td>
		</tr>
	</table>

<<<<<<< HEAD

<table class="datatable"  width ="546" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#adc3e1" height="1">
   <tr><td></td></tr>
</table>
<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header"> 
	 <td align="center" width='80'>Studnet ID</td>
	 <td align="center" width='173'>Name</td>
	 <td align="center" width='60'>Dept.</td>
	 <td align="center" width='60'>S Year</td>
	 <td align="center" width='80'>Status</td>
	 <td align="center" width='50'><input type="checkbox" id="check_all" name="check_all" onClick="call_checkAll()">Advising</a></td>
	 <td align="center" width='50'>&nbsp</td>
  </tr>
<!-- </table>
  <table class="datatable" align="center" cellspacing="1" cellpadding="3"  bgcolor="#cdcdcd" >  -->
<?
	$sql = "select s.student_id, s.family_name, s.given_name, s.status, s.school_year,s.dept_code from miudb.student s where s.student_id <> ''"; 
	//$sql = "select s.student_id, s.family_name, s.given_name, s.status, s.school_year,s.dept_code,a.advising_condition from miudb.student s, miudb.advising_history a where s.student_id <> ''  "; 

	if($department!="all") 
		$sql= $sql." and s.dept_code='".$department."'";
	if($status=="current") 
		$sql= $sql.=" and s.status IN(10,30,85)";
	else if($status!="") 
		$sql= $sql.=" and s.status='".$status."'";
	if($school_year!="" && $school_year!="all") 
	//if($school_year!="all") 
		$sql= $sql.=" and s.school_year='".$school_year."'";
	if($student_id!="") 
		$sql= $sql.=" and s.student_id like '%$student_id%'";
	if($student_name!="") $sql.=" and s.s_full_name like '%$student_name%'";

	$sql = $sql."order by s.student_id";
	
	//echo $sql;
	$cnt = 0;
	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {
			$student_id=$rs[student_id];
		    echo "<tr class='listitem'>";
			echo "<input type='hidden' name='student_id[$cnt]' value='$student_id'>";
            echo "<td width='80' align=center>".$rs[student_id]."</td>";
            echo "<td width='173' align=center>".$rs[given_name]." ".$rs[family_name]."</td>";
            echo "<td width='60' align=center>".getDeptAbb($rs[dept_code])."</td>";
            echo "<td width='60' align=center>".$rs[school_year]."</td>";

			$sql_inner = "select s_status_name 
=======
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
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
	        from miudb.code_student_status
			where (s_status_code = '$rs[status]')
			";
			$res_inner = mysql_query($sql_inner);
			if ($res_inner)
				$rs_inner = mysql_fetch_array($res_inner);
			$font_color = "color='black'";
			if ($rs[status] != '10')
				$font_color = "color='red'";
<<<<<<< HEAD
            echo "<td width='80' align=center><font ".$font_color.">".$rs_inner[s_status_name]."</font></td>";
			
            $sql_1 = "select * from miudb.advising_history where (student_id='$rs[student_id]')";
            $res_1 = mysql_query($sql_1);
            if($res_1)
            $rs_1 = mysql_fetch_array($res_1);
			echo "<td width='50' align=center><input type='checkbox' name='advising' value='1' onClick='call_must($cnt,\"$student_id\",value)'";
            if($rs_1[advising_condition]==1) echo "checked></td>";
            else echo ">"; 
 		
            echo "<td width='50' align=center><input bgcolor='gray' type='button' value=' Edit ' onclick=call_edit('".$rs[student_id]."') $use_button></td>";
            echo "</tr>";
			//echo "<tr><td colspan='6' height='1' bgcolor='#DFDFDF'></td></tr>";
			$cnt ++;
		}
	echo("<tr><td colspan='6' >Total : $cnt</td></tr>");
    
//}	
?>

</table>
=======
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

>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
<input type=hidden name='operation'>
<input type=hidden name='must_checked'>
<input type=hidden name='sid'>
<input type=hidden name='reqAdvising' value="">
<input type=hidden name='cnt' value ='<?=$cnt?>'>
<<<<<<< HEAD
</form>
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

	//Edited by JH YEO --09/06/05
	function call_show_email(dept_code, status_code) {
		var checkIdWin = window.open('student_mail_address.php?department='+dept_code+'&status='+status_code,'','width=900,height=400,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
	function call_checkAll() 
		{
			for(var i=0; i<document.advising_form.length; i++) {
				document.advising_form.elements[i].checked=true;
			}

		}


function call_must(id,sid,idx){
	//alert (sid,idx);
	//document.write(sid,idx);
	document.advising_form.operation.value='must_change';
	document.advising_form.sid.value=sid;
	document.advising_form.advising.value=idx;
	
		if(document.advising_form.advising[id].checked==true) {
			document.advising_form.reqAdvising.value='1';
		}else {
			document.advising_form.reqAdvising.value='0';
		}
		alert('reqAdvising : '+document.advising_form.reqAdvising.value);
	
	document.advising_form.submit();
}


=======

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

	
>>>>>>> c443e244521c4feb124bf5d924f64387b19a483d
</script>
</html>