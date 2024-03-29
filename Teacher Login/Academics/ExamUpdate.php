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
$id = $_GET['id'];

if(isset($_POST['save'])) {
    $Ext = $_POST['Ext'];

    $selectQuery1 = "SELECT `Subject Code` from `subject_details`";
    $query1 = mysqli_query($conn, $selectQuery1);
    while($res = mysqli_fetch_assoc($query1)) {
        $code = $res['Subject Code'];
        if ($Ext[$code] != null) {
            $selectQuery = "SELECT `Internals Total` from `sem1_externals` WHERE `Student ID` = '$id' AND `Subject Code` = '$code'";
            $query2 = mysqli_query($conn, $selectQuery);
            $res1 = mysqli_fetch_assoc($query2);
            $sum = $res1['Internals Total'] + $Ext[$code];
            $GL = get_grade_letter($sum);
            $updateQuery = "UPDATE `sem1_externals` SET
                `External Marks`= '$Ext[$code]',
                `Grade` = '$GL'
            WHERE `Student ID` = '$id' AND `Subject Code` = '$code'";
            $query2 = mysqli_query($conn, $updateQuery);
            if($query2) {
                $_SESSION["UpdatedExamMarks"] = true;
                header("location: Exam.php");
            }
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
    <title>Exam Updation Page</title>
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Finalized Marks Sheets</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <form action="" method="POST">
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
                                                if($id == $Sid){
                                                $selectQuery1 = "SELECT `Subject Code` from `subject_details`";
                                                $query1 = mysqli_query($conn, $selectQuery1);
                                                while($res = mysqli_fetch_assoc($query1)) {
                                                    $code = $res['Subject Code'];
                                                    $selectQuery2 = "SELECT * from `sem1_externals` WHERE `Student ID` = '$id' AND `Subject Code` = '$code'";
                                                    $query2 = mysqli_query($conn, $selectQuery2);
                                                    $res2 = mysqli_fetch_assoc($query2);
                                            ?>
                                            <td><?php echo (@$res2['Internals Total'] != null)? $res2['Internals Total'] : "-"; ?></td>
                                            <td><input type="number" name="Ext[<?php echo $code ?>]" class="form-control" value="<?php echo $res2['External Marks']; ?>"></td>
                                            <td><?php echo (@$res2['Grade'] != null)? $res2['Grade'] : "-"; ?></td>
                                            <?php } ?>

                                            <td>
                                                <div class="row">
                                                    <div class="col py-2">
                                                        <button type="submit" name="save" class="btn btn-success btn-block">
                                                            Save
                                                        </button>
                                                    </div>
                                                    <div class="col">
                                                        <a class="btn btn-warning btn-block" role="button" href="Exam.php">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <?php } else {
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
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </form>
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
