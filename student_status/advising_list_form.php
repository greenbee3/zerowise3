<?
/*=============================================================================
  Program : Tuition Fee List Form
  Author  : Junho Yeo, Sam Han
  Date    : 2008.08.23, 2013. 12	
  Comment : 
  ===============================================================================*/
?>
<? // check login
include_once($_SERVER['DOCUMENT_ROOT']."common/login/check_login.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/dbcon.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/gen_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_lib.php");
include_once($_SERVER['DOCUMENT_ROOT']."common/lib/code_financial_lib.php");

if($open_year=="") $open_year=$_SESSION['c_year'];		

?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/common/css/table.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<center><h3>Tuition Fee List</h3></center>
	<!--- Select Course year ---->

<form action="advising_list_form.php" method="post" name="advising_list_form" id="advising_list_form" style="margin:0px;">
	<table width ="800" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF" style="border:0px #333333 solid;" >

		<tr align="left"><td colspan='3'>
  			<!--- Select Year ---->
  			<b>Year :
  			<Select name="open_year" size="1">
				<? print_year(($_SESSION['c_year']),$open_year-1,-1,2);?>				
  			</Select>
			<!--- Select Level ---->
		<!-- 	&nbsp;&nbsp;Level : </b>
		<Select name="t_level" size="1">
			<?print_t_level($t_level);?>					
		</Select> -->
			
			<!-- &nbsp;&nbsp;Fee Name : </b>
						 <select name='fee_name' onChange="etc_selected(this.value);">
							<?
							//	if($_SESSION['office']=='14') print_fee_name($fee_name); // financial affairs
							//	else echo"<option value='ETC'>ETC</option>";
							?>
						</select>	 -->		
	    <!--- Select department ---->
			&nbsp;Department : 
			<Select name="dept_code" size="1">
				<?	if($_SESSION[uid]=='leiadmin') echo "<option value='510'>LEI</option>"; // LEI Admin
				else print_dept_abb($dept_code); ?>
			</Select>
			<!--- Select School_year ---->
			&nbsp;School_year : 
			<Select name="school_year" size="1">
				<?print_school_year($school_year);?>
			</Select>
        </td>
        
	  </tr>

		<tr align="left"><td>				
			
            <!-- - Select country --
            			&nbsp;Country : 
            			<input type=text name="country_name" size="30"> (eg, Mongolia, Russia, Korea, etc) -->
			&nbsp;&nbsp;&nbsp;<input type="submit" name="search_list" value="Search">
			&nbsp;&nbsp;<input type="button" name="insert_advising" value="Insert" onClick="call_add()">
			</td>

			<td align="left" >
			<!-- Print Button -->
			<img id="imgPrint" src="/common/images/print_button.jpg" border="0"  align="absbottom" style="cursor:hand;" onClick="PlanPrint();" />
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

  <br>
<table align="center" cellspacing="1" cellpadding="3" class="datatable" bgcolor="#cdcdcd">
  <tr class="header" class="datatable" bgcolor="#cdcdcd"> 
	 <td align="center" width='50'>Open Year</td>
	 <td align="center" width='50'>Semester</td>
	 <td align="center" width='40'>Dept.</td>
	 <td align="center" width='60'>School Year</td>
	 <td align="center" width='180'>&nbsp;</td>
  </tr>

<?  
	$sql = "select * from miudb.advising_reference r
			where r.open_year ='$open_year' ";
	/*if ($_SESSION['office']!='14') // if not financial affairs
		$sql.=" and r.managing_office='$_SESSION[office]'";*/

	if ($semester != "")
		$sql = $sql." and r.semester = '".$semester."'";
	if ($dept_code != "")
		$sql = $sql." and r.dept_code = '".$dept_code."'" ;  
	if ($school_year != "")
		$sql = $sql." and r.school_year = '".$school_year."'" ;  
	
	$sql = $sql." order by r.open_year, r.semester ";

	$res = mysql_query($sql);
	if ($res)
		while ($rs = mysql_fetch_array($res)) {			
			echo "<tr class='listitem'>";
		/*	echo "<td align='left'>".$rs[fee_name];
				if($rs[fee_name]=='ETC') echo(" ($rs[fee_name_etc])");
				echo("</td>");*/
            echo "<td align='center'>".$rs[open_year]."</td>";
			

            echo "<td>".getSemName($rs[semester])."</td>";
		            echo("<td  align='center'>".getDeptAbb($rs[dept_code])."</td>");
			echo "<td align='center'>".$rs[school_year]."</td>";
			/*if($rs[must_be_paid]==1) $mbp='Yes'; else $mbp='No'; 
			echo "<td  align='center'>".$mbp."</td>";
            echo "<td align='right'>".number_format($rs[fee_amount])."</td>";
*/
		/*	if ($session_userid == 'S2007015' || $session_userid == 'S2007013') {
				echo "<td><input bgcolor='gray' type='button' value=' Edit ' onclick=call_edit('".$rs[reference_id]."') disabled>
				          <input bgcolor='gray' type='button' value='Delete' onclick=call_del('".$rs[reference_id]."','".$open_year."','".$semester."','".$t_level."') disabled></td>";
			}
			else {*/
				echo "<td align='center'><input bgcolor='gray' type='button' value=' Edit (Charge)' onclick=call_edit('".$rs[reference_id]."')>
				                         <input bgcolor='gray' type='button' value='Delete' onclick=call_del('".$rs[reference_id]."','".$open_year."','".$semester."','".$t_level."')></td>";
				
			//}
			echo "</tr>";
		}
?>

</table>
</body>

<script>
	function call_add() {
		var checkIdWin = window.open('add_advising_list_form.php','','width=700,height=500,scrollbars=yes,left=20,top=0,resizable=yes');
		checkIdWin.focus();
	}
	
	function call_edit(reference_id) {
		var checkIdWin = window.open('edit_advising_list_form.php?reference_id='+reference_id,'','width=830,height=600,scrollbars=yes,left=50,top=30,resizable=yes,location=no');
		checkIdWin.focus();
	}

	function call_del(reference_id, open_year, semester,t_level) {
		if(confirm("Do you want to delete this fee?")) {
			var checkIdWin = window.open('del_advising_list.php?reference_id='+reference_id+'&open_year='+open_year+'&semester='+semester,'','width=500,height=500,scrollbars=yes,left=50,top=30,resizable=yes,location=no');
		}
	}

</script>
</html>

<script>
function call_exit() {
	window.close();
}

/*function etc_selected(v){
if(v=='ETC') document.tuition_fee_info_form.fee_name_etc.disabled=false;
else document.tuition_fee_info_form.fee_name_etc.disabled=true;
}

function check_f(){
	if(document.tuition_fee_info_form.fee_name.value=="") {
		alert("Select the fee name");
		return false;
	}
	else {
		return true;
	}
}*/

</script>