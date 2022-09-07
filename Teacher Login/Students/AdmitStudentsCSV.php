<?php

session_start();
if(isset($_SESSION['username']) != true)
{
    header("location: ../../index.php");
    exit;
}
include "../../config.php";
include "../../function.php";

if(isset($_POST['upload'])) {
    $file = $_FILES['marks_upload'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filepath = $file['tmp_name'];
    $file_error = $file['error'];

    if($filetype != 'text/csv') {
        $_SESSION["FileFormatIssue"] = true;
        header("location: AdmitStudents.php");
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

        $selectQuery = "SELECT `Student ID` from `student_details`";
        $query1 = mysqli_query($conn, $selectQuery);
        $result = array();
        while($res = mysqli_fetch_assoc($query1)) {
            $result[] = $res['Student ID'];
        }


        for ($i=1; $i < count($lines); $i++) {
            $id = trim($lines[$i][0]);
            for($j=0; $j < count($lines[0]); $j++) {
                $label = trim($lines[0][$j]);
                $value = trim($lines[$i][$j]);
                if (is_null($value) || empty($value)) {
                    continue;
                }
                if($j == 0) {
                    if (!in_array($id, $result)) {
                        $insertQuery = "INSERT INTO `student_details` (`$label`) VALUES ('$id')";
                        $query = mysqli_query($conn, $insertQuery);

                        $selectQuery = "SELECT `Subject Code` from subject_details";
                        $query = mysqli_query($conn, $selectQuery);
                        while($res = mysqli_fetch_assoc($query)){
                            $code = $res['Subject Code'];
                            $insertQuery = "INSERT INTO `sem1_internals`(`Student ID`, `Subject Code`) VALUES ('$id','$code')";
                            $query2 = mysqli_query($conn, $insertQuery);
                        }
                        $selectQuery = "SELECT `Subject Code` from subject_details";
                        $query = mysqli_query($conn, $selectQuery);
                        while($res = mysqli_fetch_assoc($query)){
                            $code = $res['Subject Code'];
                            $insertQuery = "INSERT INTO `sem1_externals`(`Student ID`, `Subject Code`) VALUES ('$id','$code')";
                            $query2 = mysqli_query($conn, $insertQuery);
                        }
                    } else {
                        $_SESSION["DuplicateStudent"] = array();
                        $_SESSION["DuplicateStudent"]["status"] = true;
                        $_SESSION["DuplicateStudent"]["StudID"] = $id;
                        header("location: AdmitStudents.php");
                        exit();
                    }
                } else {
                    $updateQuery = "UPDATE `student_details` SET `$label` = '$value' WHERE `Student ID` = '$id'";
                    mysqli_query($conn, $updateQuery);
                }
            }
        }
        unlink($destfile);
        $_SESSION["insertStudents"] = true;
        header("location: AdmitStudents.php");
    }
}

?>