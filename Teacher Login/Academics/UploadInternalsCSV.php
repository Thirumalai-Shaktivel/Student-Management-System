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
        $destfile = '../../upload/'.$filename;
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

        for($i=$x=1; $i < count($lines[0]); $i+=3, $x++) {
            $Average = 0;
            for ($j = 1; $j < count($lines); $j++) {
                $id = $lines[$j][0];
                $classesTaken = (int)$lines[$j][$i];
                $classesAttended = (int)$lines[$j][$i+1];
                $attend_per = ($classesAttended/$classesTaken)*100;
                $IA_marks = $lines[$j][$i+2];
                $Average += $IA_marks;
                if(in_array($id, $result)) {
                    $insertQuery = "UPDATE `sem1_internals` SET
                        `IA{$x}_CT`='$classesTaken',
                        `IA{$x}_CA`='$classesAttended',
                        `IA{$x}_AP`='$attend_per',
                        `IA{$x}_MO`='$IA_marks',
                        `Average`='$Average'
                    WHERE `Student ID` = '$id' AND `Subject Code` ='$code'";
                    $query2 = mysqli_query($conn, $insertQuery);
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
