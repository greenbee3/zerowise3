<?php
/*=============================================================================
  Program : Reg. admission pass/fail
  Author  : Sejong Oh
  Date    : 2012.10.1    
  Comment : 
  ===============================================================================*/
?>
<?php  // check login
include_once("../../../common/login/check_login.php");
include_once("../../../common/lib/dbcon.php");
include_once("../../../common/lib/create_user_access_log.php");  //write to log

$i=0; $upd_cnt=0;
while($i<$cnt) {
    $student_id = $_POST['student_id'][$i];
    $advising_condition = $_POST['advising_condition'][$i];
    $open_year = $_POST['open_year'][$i];
    $semester = $_POST['semester'][$i];
    $dept_code = $_POST['dept_code'][$i];
    $description = $_POST['description'][$i];
    $managing_office = $_POST['managing_office'][$i];

    //$tuition_paid = $_POST[tuition_paid][$i];
    //$admit_dept = $_POST[admit_dept][$i];
    //if ($admit_dept == 'none') $admit_dept = "";
   //echo $student_id."/".$advising."<br>";
   
        $sql = "
            insert into miudb.advising_history 
            (   history_id,
                student_id,
                open_year,
                semester,
                dept_code,
                school_year,
                advising_condition,
                description,
                check_date,
                ctime,
                mtime,
                managing_office
             )
             values (
                '',
                '$student_id',
                '$open_year',
                '$semester',
                '$dept_code',
                '$school_year',
                '$advising_condition',
                '$description',
                CURDATE(),
                '',
                '',
                '$managing_office'     
             )";    

            echo $sql;
    $res = mysql_query($sql);
    $affected_rows = mysql_affected_rows();
    if ($affected_rows>0)
        $upd_cnt++;
    $i++;
}

if ($upd_cnt>0) {
    echo "
    <script>
    alert('[Success] applicants are updated.');
    history.back();
    </script>
    ";
} else {
    echo "
    <script>
    alert('[Fail] no applicant is updated.');
    history.back();
    </script>
    ";
}

?>
