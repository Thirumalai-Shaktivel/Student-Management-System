<?php

session_start();
if(isset($_SESSION['username']) != true)
{
    header("location: ../../index.php");
    exit;
}
include "../../config.php";

if(isset($_POST['upload_result'])) {
    $file = $_FILES['marks_upload'];
    $id = $_POST['studentID'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filetmp = $file['tmp_name'];
    $file_error = $file['error'];

    if($filetype != 'application/pdf') {
        $_SESSION["ResultFileFormatIssue"] = true;
        header("location: Exam.php");
        exit();
    }
    if ($file_error == 0) {
        $dirname = '../../uploads/'.$id.'/';
        if(!is_dir($dirname)) {
            mkdir($dirname, 0755, true);
        }
        $destinationfile = $dirname.$id.'_VTU_Result.pdf';
        move_uploaded_file($filetmp, $destinationfile);

        $selectQuery = "SELECT `Subject Code` from subject_details";
        $query = mysqli_query($conn, $selectQuery);
        $code = mysqli_fetch_assoc($query)['Subject Code'];

        $updateQuery = "UPDATE `sem1_externals` SET `VTU_Result`='$destinationfile'
                        WHERE `Student ID` = '$id' AND `Subject Code` = '$code'";
        $query = mysqli_query($conn, $updateQuery);
        if($query){
            $_SESSION["UploadedResult"] = true;
            header("location: Exam.php");
        }
    }
}

?>