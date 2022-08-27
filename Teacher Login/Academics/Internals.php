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

$file_issue = $subject_not_found = $student_not_found = $success = $updated = false;
$updateCounsel = false;

if(isset($_SESSION['FileFormatIssue']))
    $file_issue = true;
else if(isset($_SESSION['SubjectNotFound']['status']))
    $subject_not_found = true;
else if(isset($_SESSION['StudentNotFound']['status']))
    $student_not_found = true;
else if(isset($_SESSION['Uploaded']))
    $success = true;

if(isset($_SESSION['Updated']))
    $updated = true;

$selectQuery = "SELECT * from subject_details";
$query2 = mysqli_query($conn, $selectQuery);
$res = mysqli_fetch_assoc($query2);

if(isset($_GET['sub'])) {
    $sub  = $_GET['sub'];
} else {
    $sub = $res['Subject Name'];
}

if (isset($_POST['submit'])) {
    $studentID = format($_POST['studentID']);
    $code = $res['Subject Code'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d M, Y H:i:s');
    $check = "SELECT * FROM sem1_internals";
    $query = mysqli_query($conn, $check);
    if ($res = mysqli_fetch_assoc($query)) {
        echo $date;
        $shortfalls = format($_POST['shortfalls']);
        $remarks = format($_POST['remarks']);
        $updateQuery = "UPDATE `sem1_internals` SET
            `Counselling_date`='$date',
            `Shortfalls`='$shortfalls',
            `Remarks`='$remarks'
        WHERE `Student ID` = '$studentID' AND `Subject Code` =  '$code'";
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
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <link href="../../css/styles.css" rel="stylesheet" />
    <title>Students Internals Marks Details Page</title>
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
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
                                </a>
                                <a class="nav-link" href="Exam.php">
                                    External Assessment
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
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
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Student Progress Updation</li>
                        <li class="breadcrumb-item active">Internal Assessment's</li>
                    </ol>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <?php
                            $selectQuery = "SELECT * from subject_details";
                            $query2 = mysqli_query($conn, $selectQuery);
                            while($result = mysqli_fetch_assoc($query2)){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($sub == $result['Subject Name']) { ?> active <?php } ?>" data-toggle="pill" href="#<?php echo $result['Subject Name']; ?>"><?php echo $result['Subject Name']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>

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
                    } else if ($success) {
                        unset($_SESSION["Uploaded"]); ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Student marks uploaded successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    if ($updated) {
                        unset($_SESSION["Updated"]); ?>
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
                                    <h5>Marks Sheet</h5>
                                </div>
                                <div class="col-6">
                                <form action="UploadInternalsCSV.php" method="POST" enctype="multipart/form-data">
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
                            <div class="tab-content">
                            <?php
                                $selectQuery = "SELECT * from subject_details";
                                $query2 = mysqli_query($conn, $selectQuery);
                            while($res = mysqli_fetch_assoc($query2)){
                            ?>
                                <div class="tab-pane fade <?php if($sub == $res['Subject Name']) { ?> show active <?php } ?>" id="<?php echo $res['Subject Name']; ?>">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                        <div class="d-flex justify-content-around">
                                           <h3><?php echo "Subject Code : ".$res['Subject Code']; ?></h3>
                                           <h3><?php echo "Subject Name : ".$res['Subject Name']; ?></h3>
                                        </div>
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle">Students ID</th>
                                                    <th rowspan="2" class="align-middle">Students Name</th>
                                                    <th colspan="4">
                                                        <div class="row">
                                                                <div class="col-8 ">
                                                                    <label> Internal Assessment-01</label>
                                                                </div>
                                                            <div class="col align-self-center">
                                                                <a href="UpdateInternals.php?id=IA1&code=<?php echo $res['Subject Code'] ?>" role="button" class="btn btn-primary btn-block">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th colspan="4">
                                                        <div class="row">
                                                            <div class="col-8 ">
                                                                <label> Internal Assessment-02</label>
                                                            </div>
                                                            <div class="col align-self-center">
                                                                <a href="UpdateInternals.php?id=IA2&code=<?php echo $res['Subject Code'] ?>" role="button" class="btn btn-primary btn-block">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th colspan="4">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <label> Internal Assessment-03</label>
                                                            </div>
                                                            <div class="col align-self-center">
                                                                <a href="UpdateInternals.php?id=IA3&code=<?php echo $res['Subject Code'] ?>" role="button" class="btn btn-primary btn-block">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th rowspan="2" class="align-middle">Average</th>
                                                </tr>
                                                <tr>
                                                    <th>CT</th>
                                                    <th>CA</th>
                                                    <th>AP</th>
                                                    <th>MO</th>
                                                    <th>CT</th>
                                                    <th>CA</th>
                                                    <th>AP</th>
                                                    <th>MO</th>
                                                    <th>CT</th>
                                                    <th>CA</th>
                                                    <th>AP</th>
                                                    <th>MO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $selectQuery = "SELECT * from `student_details`";
                                                    $query = mysqli_query($conn, $selectQuery);
                                                    while($result = mysqli_fetch_assoc($query)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $result['Student ID']; ?></td>
                                                    <td><?php echo $result['Name']; ?></td>
                                                <?php
                                                    $ID = $result['Student ID'];
                                                    $code = $res['Subject Code'];

                                                    $selectQuery1 = "SELECT * from `sem1_internals` WHERE `Student ID` = '$ID' AND `Subject Code` ='$code'";
                                                    $query1 = mysqli_query($conn, $selectQuery1);
                                                    $result = mysqli_fetch_assoc($query1);
                                                    ?>
                                                    <td><?php echo (@$result['IA1_CT'] != null)? $result['IA1_CT'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA1_CA'] != null)? $result['IA1_CA'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA1_AP'] != null)? $result['IA1_AP'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA1_MO'] != null)? $result['IA1_MO'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA2_CT'] != null)? $result['IA2_CT'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA2_CA'] != null)? $result['IA2_CA'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA2_AP'] != null)? $result['IA2_AP'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA2_MO'] != null)? $result['IA2_MO'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA3_CT'] != null)? $result['IA3_CT'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA3_CA'] != null)? $result['IA3_CA'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA3_AP'] != null)? $result['IA3_AP'] : "-"; ?></td>
                                                    <td><?php echo (@$result['IA3_MO'] != null)? $result['IA3_MO'] : "-"; ?></td>
                                                    <td <?php if(@$result['Average'] > 12) { ?>style="background-color: #51f542;"
                                                    <?php } else{ ?> style="background-color: #f54242;" <?php } ?>
                                                    ><?php echo (@$result['Average']!="0" && @$result['Average']!=null)?$result['Average']: "-"; ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-around">
                                           <i>Note:</i>
                                           <i>CT = Number of Classes Taken</i>
                                           <i>CA = Number of Classes attended</i>
                                           <i>AP = Attendance in percentage</i>
                                           <i>MO = Marks Obtained</i>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Counselling after Internal Assessment Test</h5>
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
                                                        <option value="<?php echo $res['Student ID']; ?>"><?php echo $res['Student ID']; ?></option>
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
                                                    $query = mysqli_query($conn, "SELECT * from subject_details");
                                                    $code = mysqli_fetch_assoc($query)['Subject Code'];
                                                    $selectQuery = "SELECT * from `sem1_internals` WHERE `Subject Code` ='$code'";
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
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="../../js/scripts.js"></script>
</body>
</html>
