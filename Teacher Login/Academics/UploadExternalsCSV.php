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
        $selectQuery = "SELECT `Subject Code` from subject_details";
        $query = mysqli_query($conn, $selectQuery);
        while($res = mysqli_fetch_assoc($query)){
            $sub[] = $res['Subject Code'];
        }

        $SubNotFound=$SubsMismatch=false;
        if (count($sub) != count($lines[0])-1) {
            $SubsMismatch=true;
        }
        for ($i=1; $i<=count($sub) && !$SubsMismatch; $i++) {
            $code=trim($lines[0][$i]);
            if (!in_array($code, $sub)) {
                $SubNotFound=true;
                break;
            }
        }
        if ($SubNotFound || $SubsMismatch) {
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
            for($j=1; $j < count($lines[0]); $j++) {
                $id = trim($lines[$i][0]);
                $code = trim($lines[0][$j]);
                if(in_array($id, $result)) {
                    $val = $lines[$i][$j];
                    $updateQuery = "UPDATE `sem1_externals` SET
                        `External Marks` = '$val'
                    WHERE `Student ID` = '$id' AND `Subject Code` ='$code'";
                    $query = mysqli_query($conn, $updateQuery);
                    if($query) {
                        $_SESSION["Uploaded"] = true;
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
        header("location: Exam.php");
    }
}

?>