<?php

session_start();
if(isset($_SESSION['username']) != true)
{
    header("location: ../../index.php");
    exit;
}
include "../../config.php";

if(isset($_POST['upload'])) {
    $file = $_FILES['marks_upload'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filepath = $file['tmp_name'];
    $file_error = $file['error'];

    if($filetype != 'text/csv') {
        $_SESSION["FileFormatIssue"] = true;
        header("location: Internals.php");
        exit();
    }
    if ($file_error == 0) {
        $destfile = '../../uploads/'.$filename;
        move_uploaded_file($filepath, $destfile);

        $lines = array();
        $fp = fopen($destfile, 'r');
        while(!feof($fp) && ($line = fgetcsv($fp)) !== false) {
            $lines[] = $line;
        }

        $result = array();
        $selectQuery = "SELECT * from subject_details";
        $query = mysqli_query($conn, $selectQuery);
        while($res = mysqli_fetch_assoc($query)){
            $result[] = $res['Subject Code'];
        }
        $code = $lines[0][0];
        if (!in_array($code, $result)) {
            $_SESSION["SubjectNotFound"] = array();
            $_SESSION["SubjectNotFound"]["status"] = true;
            $_SESSION["SubjectNotFound"]["SubCode"] = $code;
            header("location: Internals.php");
            exit();
        }

        $selectQuery = "SELECT * from `student_details`";
        $query1 = mysqli_query($conn, $selectQuery);
        $result = array();
        while($res = mysqli_fetch_assoc($query1)) {
            $result[] = $res['Student ID'];
        }
        for ($i=1; $i < count($lines); $i++) {
            $sum = 0;
            for($j=$k=1; $j < count($lines[0]); $j+=3, $k++) {
                $id = $lines[$i][0];
                if(in_array($id, $result)) {
                    $classesTaken = (int)$lines[$i][$j];
                    $classesAttended = (int)$lines[$i][$j+1];
                    $attend_per = ($classesAttended/$classesTaken)*100;
                    $sum += $IA_marks = $lines[$i][$j+2];
                    $Average=(count($lines[0]) == 10)?$sum/$k:0;
                    // echo "<br>Sum: ".$sum."<br>".$Average;
                    $updateQuery = "UPDATE `sem1_internals` SET
                        `IA{$k}_CT`='$classesTaken',
                        `IA{$k}_CA`='$classesAttended',
                        `IA{$k}_AP`='$attend_per',
                        `IA{$k}_MO`='$IA_marks'
                    WHERE `Student ID` = '$id' AND `Subject Code` ='$code'";
                    $query2 = mysqli_query($conn, $updateQuery);
                    if($query2){
                        $_SESSION["Uploaded"] = true;
                    } else {
                        $_SESSION["Uploaded"] = false;
                    }
                } else {
                    $_SESSION["StudentNotFound"] = array();
                    $_SESSION["StudentNotFound"]["status"] = true;
                    $_SESSION["StudentNotFound"]["StudID"] = $id;
                    header("location: Internals.php");
                    exit();
                }
            }
        }
        unlink($destfile);
        header("location: Internals.php");
    }
}

?>
