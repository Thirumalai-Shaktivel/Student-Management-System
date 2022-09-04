<?php

session_start();
if(isset($_SESSION['username']) != true)
{
    header("location: ../../index.php");
    exit;
}
$username = trim($_SESSION['username']);
include "../../config.php";
include "../../function.php";

$file_issue = $subject_not_found = $student_not_found = $uploaded = false;
$updateCounsel = $success = false;

if(isset($_SESSION['FileFormatIssue']))
    $file_issue = true;
else if(isset($_SESSION['SubjectNotFound']['status']))
    $subject_not_found = true;
else if(isset($_SESSION['StudentNotFound']['status']))
    $student_not_found = true;
else if(isset($_SESSION['Uploaded']))
    $uploaded = true;

if(isset($_SESSION['UpdatedExamMarks']))
    $success = true;

$selectQuery = "SELECT `Subject Code` from subject_details";
$query = mysqli_query($conn, $selectQuery);
$code = mysqli_fetch_assoc($query)['Subject Code'];

if (isset($_POST['submit'])) {
    $studentID = format($_POST['studentID']);
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d M, Y H:i:s');
    $check = "SELECT * FROM sem1_externals";
    $query = mysqli_query($conn, $check);
    if ($res = mysqli_fetch_assoc($query)) {
        $shortfalls = format($_POST['shortfalls']);
        $remarks = format($_POST['remarks']);
        $updateQuery = "UPDATE `sem1_externals` SET
            `Counselling_date`='$date',
            `Shortfalls`='$shortfalls',
            `Remarks`='$remarks'
        WHERE `Student ID` = '$studentID' AND `Subject Code`='$code'";
        $query = mysqli_query($conn, $updateQuery);
        if($query){
            $updateCounsel = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome (Basic Icons) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <link href="../../css/styles.css" rel="stylesheet" />
    <title>Students Exam Marks Details Page</title>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand" href="../HomePage.php">Teacher</a>

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
        <ul class="navbar-nav ml-auto ml-md-0">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i>
                <?php
                    echo($username)
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a href="../HomePage.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Academics</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Students Info
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../Students/StudentsList.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    All Students
                                </a>
                                <a class="nav-link" href="../Students/StudentDetails.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    Student Details
                                </a>
                                <a class="nav-link" href="../Students/AdmitStudents.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    Admit Students
                                </a>
                            </nav>
                        </div>
                        <a href="SubjectDetails.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            Subject Details
                        </a>
                        <a href="Announcements.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                            Announce Upcoming Events
                        </a>
                        <a href="Attendence.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="far fa-calendar-check"></i></div>
                            Update Attendence
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                            Student Progress Updation
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="Internals.php">
                                    Internal Assessment's
                                </a>
                                <a class="nav-link" href="Exam.php">
                                    External Assessment
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php
                        echo($username)
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Student Progress Updation</li>
                        <li class="breadcrumb-item active">External Assessment</li>
                    </ol>
                    <nav class="navbar navbar-dark bg-primary mb-3 d-flex justify-content-center rounded">
                        <h1 class="navbar-brand mb-0">I SEMESTER</h1>
                    </nav>

                    <?php if ($file_issue) {
                        unset($_SESSION["FileFormatIssue"]); ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>File type not supported! Please upload .csv file</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else if ($subject_not_found) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $_SESSION["SubjectNotFound"]["SubCode"] ?> is not a valid subject code!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php unset($_SESSION["SubjectNotFound"]);
                    } else if ($student_not_found) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $_SESSION["StudentNotFound"]["StudID"] ?> is not found! please check the Student ID</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php unset($_SESSION["StudentNotFound"]);
                    } else if ($uploaded) {
                        unset($_SESSION["Uploaded"]); ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Student marks uploaded successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if ($success) {
                        unset($_SESSION["UpdatedExamMarks"]); ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Student marks updated successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>University Results</h4>
                                </div>
                                <div class="col-6">
                                    <form action="UploadExternalsCSV.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5>
                                                    Have a CSV file?
                                                    <a href="https://raw.githubusercontent.com/Thirumalai-Shaktivel/Student-Management-System/master/resource/MarksExample.csv"> upload format </a>
                                                </h5>
                                                <input type="file" name="marks_upload" class="mb-2">
                                            </div>
                                            <div class="col align-self-center">
                                                <button type="submit" name="upload" class="btn btn-success btn-block">
                                                    <strong>Upload</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="align-middle">Students ID</th>
                                            <th rowspan="2" class="align-middle">Students Name</th>
                                            <?php
                                                $selectQuery = "SELECT `Subject Code`, `Subject Name` from subject_details";
                                                $query2 = mysqli_query($conn, $selectQuery);
                                                while($result = mysqli_fetch_assoc($query2)) {
                                            ?>
                                            <th colspan="3">
                                                <?php echo $result['Subject Code']; ?><br>
                                                <?php echo $result['Subject Name']; ?>
                                            </th>
                                            <?php } ?>
                                            <th rowspan="2" class="align-middle">Action</th>
                                        </tr>
                                        <tr>
                                        <?php
                                            $selectQuery = "SELECT `Subject Code`, `Subject Name` from subject_details";
                                            $query2 = mysqli_query($conn, $selectQuery);
                                            while($result = mysqli_fetch_assoc($query2)) {
                                        ?>
                                            <th>INT</th>
                                            <th>EXT</th>
                                            <th>GL</th>
                                        <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $selectQuery = "SELECT `Student ID`, `Name` from `student_details`";
                                            $query = mysqli_query($conn, $selectQuery);
                                            while($result = mysqli_fetch_assoc($query)){
                                                $Sid = $result['Student ID'];
                                        ?>
                                        <tr>
                                            <td><?php echo $Sid; ?></td>
                                            <td><?php echo $result['Name']; ?></td>
                                            <?php
                                                $selectQuery1 = "SELECT `Subject Code` from `subject_details`";
                                                $query1 = mysqli_query($conn, $selectQuery1);
                                                while($res1 = mysqli_fetch_assoc($query1)){
                                                    $code = $res1['Subject Code'];
                                                    $selectQuery2 = "SELECT `External Marks`, `Internals Total`, `Grade` from `sem1_externals` WHERE `Student ID` = '$Sid' AND `Subject Code` = '$code'";
                                                    $query2 = mysqli_query($conn, $selectQuery2);
                                                    $res2 = mysqli_fetch_assoc($query2);
                                            ?>
                                                <td><?php echo (@$res2['Internals Total'] != null)? $res2['Internals Total'] : "-"; ?></td>
                                                <td><?php echo (@$res2['External Marks'] != null)? $res2['External Marks'] : "-"; ?></td>
                                                <td><?php echo (@$res2['Grade'] != null)? $res2['Grade'] : "-"; ?></td>
                                            <?php } ?>
                                            <td><a href="ExamUpdate.php?id=<?php echo $result['Student ID']; ?>" role="button" class="btn btn-primary btn-block"> Edit</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 d-flex justify-content-around">
                                <i>Note:</i>
                                <i>INT = Internal Marks obtained</i>
                                <i>EXT = External Marks obtained</i>
                                <i>GL = Grade Letter Obtained</i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Counselling after University Results</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-sm">
                                                <label for="studentID">Student ID</label>
                                                    <select id="studentID" name="studentID" class="form-control">
                                                        <option selected>Please Select Student ID</option>
                                                    <?php
                                                    $selectQuery = "SELECT * from `student_details`";
                                                    $query = mysqli_query($conn, $selectQuery);
                                                    while($res = mysqli_fetch_assoc($query)) {
                                                    ?>
                                                        <option value="<?php echo $res['Student ID']; ?>"><?php echo $res['Student ID'].": ".$res['Name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm">
                                                <label for="shortfalls">Discuss the shortfalls in the Academics performance</label>
                                                <textarea type="text" name="shortfalls" class="form-control" id="shortfalls" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm">
                                                <label for="remarks">Remarks</label>
                                                <textarea type="text" name="remarks" class="form-control" id="remarks" rows="3"></textarea>
                                           </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-5">
                                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <a href="Internals.php" role="button" class="btn btn-outline-warning btn-lg btn-block">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm">
                            <div>
                                 <?php if($updateCounsel) { $updateCounsel = false; ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Counselling details updated successfully</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Counselling Details</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle">Student ID</th>
                                                        <th class="align-middle">Date and time of Counselling</th>
                                                        <th class="align-middle">Discussed the shortfalls in the Academics performance</th>
                                                        <th class="align-middle">Adherence to the suggestions given by the facutly<br>(submitted by the students)</th>
                                                        <th class="align-middle">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $query = mysqli_query($conn, "SELECT `Subject Code` from subject_details");
                                                    $code = mysqli_fetch_assoc($query)['Subject Code'];
                                                    $selectQuery = "SELECT * from `sem1_externals` WHERE `Subject Code` ='$code'";
                                                    $query = mysqli_query($conn, $selectQuery);
                                                    while($result = mysqli_fetch_assoc($query)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $result['Student ID']; ?></td>
                                                        <td><?php echo (@$result['Counselling_date'] != null)? $result['Counselling_date'] : "-"; ?></td>
                                                        <td><?php echo (@$result['Shortfalls'] != null)? $result['Shortfalls'] : "-"; ?></td>
                                                        <td><?php echo (@$result['Adherence'] != null)? $result['Adherence'] : "-"; ?></td>
                                                        <td><?php echo (@$result['Remarks'] != null)? $result['Remarks'] : "-"; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <!-- JavaScript -->
    <script src="../../js/scripts.js"></script>
    <script src="../../js/datatable.js"></script>
</body>
</html>
