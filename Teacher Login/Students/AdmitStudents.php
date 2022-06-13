<?php

    session_start();
    if(isset($_SESSION['username']) != true)
    {
        header("location: ../../index.php");
        exit;
    }
    include "../../config.php";
    include "../../function.php";

    $username = trim($_SESSION['username']);

    $insert = $dupl = $clas = $sec = $gen = false;

    if(isset($_SESSION['insertStudents']))
        $insert = true;
    else if(isset($_SESSION['DuplicateStudent']))
        $dupl = true;
    if(isset($_SESSION['class']))
        $clas = true;
    if(isset($_SESSION['section']))
        $sec = true;
    if(isset($_SESSION['gender']))
        $gen = true;

    if(isset($_POST['submit'])){
        $StudentId = format($_POST['StudID']);

        $check = "SELECT * FROM student_details WHERE `Student ID` = '$StudentId'";
        $query = mysqli_query($conn, $check);
        $res = mysqli_fetch_assoc($query);
        if(!$res){
            $name = format($_POST['Firstname']) ." ". format($_POST['Lastname']);
            if ($_POST['class'] == 'Please Select Class')
                $_SESSION['class'] = true;
            if($_POST['section'] == 'Please Select Section')
                $_SESSION['section']= true;
            $class = format($_POST['class']) ." ". format($_POST['section']);
            if($_POST['gender'] == 'Please Select Gender')
                $_SESSION['gender'] = true;
            else
                $gender = format($_POST['gender']);

            $blood = format($_POST['Blood']);
            $input = format($_POST['DOB']);
            $dob = date("d M, Y",strtotime($input));
            $email = format($_POST['Email']);
            $admNum = format($_POST['AdmNum']);
            $input = format($_POST['AdmDate']);
            $addDate= date("Y-m-d",strtotime($input));
            $religion = format($_POST['religion']);
            $nationality = format($_POST['Nationality']);
            $fatherName = format($_POST['FatherName']);
            $fatherOcc = format($_POST['FatherOccupation']);
            $fatherNum = format($_POST['FatherPhoneNum']);
            $motherName = format($_POST['MotherName']);
            $motherOcc = format($_POST['MotherOccupation']);
            $motherNum = format($_POST['MotherPhoneNum']);
            $prstAdd = mysqli_real_escape_string($conn, format($_POST['PresentAdd']));
            $permAdd = mysqli_real_escape_string($conn, format($_POST['PmtAdd']));

            if(!(@$_SESSION['class'] || @$_SESSION['section'] || @$_SESSION['gender'])){
                $insertQuery = "INSERT INTO `student_details`(`Student ID`, `Name`, `Class`, `Gender`, `Blood Group`, `DOB`, `Email`, `Admission Number`, `Admission Date`, `Religion`, `Nationality`, `Father Name`, `Father Occupation`, `Father PhoneNum`, `Mother Name`, `Mother Occupation`, `Mother PhoneNum`, `Present Address`, `Permanent Address`) VALUES ('$StudentId', '$name', '$class', '$gender', '$blood', '$dob', '$email', $admNum, '$addDate', '$religion', '$nationality', '$fatherName', '$fatherOcc', '$fatherNum', '$motherName', '$motherOcc', '$motherNum', '$prstAdd', '$permAdd')";

                $query = mysqli_query($conn, $insertQuery);

                if($query){
                    $_SESSION['insertStudents'] = true;

                    $selectQuery = "SELECT `Subject Code` from subject_details";
                    $query = mysqli_query($conn, $selectQuery);
                    while($res = mysqli_fetch_assoc($query)){
                            $code = $res['Subject Code'];
                            $insertQuery = "INSERT INTO `internals_marks`(`Student ID`, `Subject Code`) VALUES ('$StudentId','$code')";
                            $query2 = mysqli_query($conn, $insertQuery);
                        }
                    $selectQuery = "SELECT `Subject Code` from subject_details";
                    $query = mysqli_query($conn, $selectQuery);
                    while($res = mysqli_fetch_assoc($query)){
                            $code = $res['Subject Code'];
                            $insertQuery = "INSERT INTO `exam_marks`(`Student ID`, `Subject Code`) VALUES ('$StudentId','$code')";
                            $query2 = mysqli_query($conn, $insertQuery);
                        }
                }
                    header("location: AdmitStudents.php");
            }
            else{
                header("location: AdmitStudents.php");
            }
        }
        else{
            $_SESSION['DuplicateStudent'] = true;
            header("location: AdmitStudents.php");
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
    <title>Student Details Admiting Page</title>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand" href="../HomePage.php">Teacher</a>

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
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
            </li>
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
                        <div id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="StudentsList.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    All Students
                                </a>
                                <a class="nav-link" href="StudentDetails.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    Student Details
                                </a>
                                <a class="nav-link" href="AdmitStudents.php">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    Admit Students
                                </a>
                            </nav>
                        </div>
                        <a href="../Academics/SubjectDetails.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            Subject Details
                        </a>
                        <a href="../Academics/Announcements.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                            Announce Upcoming Events
                        </a>
                        <a href="../Academics/Attendence.php" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="far fa-calendar-check"></i></div>
                            Update Attendence
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                            Student Progress Updation
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../Academics/Internals.php">
                                    Internal Assessment's
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
                                </a>
                                <a class="nav-link" href="../Academics/Exam.php">
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
                        <li class="breadcrumb-item">Students Info</li>
                        <li class="breadcrumb-item active">Admit Students</li>
                    </ol>
                    <?php if($insert){  unset($_SESSION["insertStudents"]);?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Student Details Admitted Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else if($dupl) { unset($_SESSION["DuplicateStudent"]);?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Student ID already Taken!!</strong> Use Different Student ID(Must be Unqiue)
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else if($clas || $gen || $sec) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Shortage of Input!!</strong> Enter All the required inputs Again
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Admit Students</h4>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <h5>Student Information</h5>
                                <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="StudId">Student ID</label>
                                            <input type="text" name="StudID" class="form-control" id="StudID" placeholder="Enter Student ID *" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="USN">University Seat Number</label>
                                            <input type="text" name="USN" class="form-control" id="usn" value="1KS">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Name">First Name</label>
                                            <input type="text" name="Firstname" class="form-control" id="firstname" placeholder="Enter First Name *" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Name">Last Name</label>
                                            <input type="text" name="Lastname" class="form-control" id="lastname" placeholder="Enter Last Name *" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="ColId">College ID</label>
                                            <input type="text" name="ColID" class="form-control" id="ColID" placeholder="Enter College ID *" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="DOB">Date Of Birth</label>
                                            <input type="date" name="DOB" class="form-control" id="Dob" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion / Community / Caste</label>
                                            <input type="text" name="religion" class="form-control" id="religion" placeholder="Enter Religion *" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="AdmissionYear">Year of Admission</label>
                                            <input type="number" name="AdmYear" class="form-control" id="AdmYear" min="1900" max="2099" step="1" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AdmNature">Nature of Admission *</label>
                                            <select id="AdmNature" name="AdmNature" class="form-control">
                                                <option selected>Please Select Nature of Admission</option>
                                                <option value="CET">CET</option>
                                                <option value="COMED-K">COMED-K</option>
                                                <option value="Management">Management</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hostel_DayScholar">Hostelite(H) / Day Scholar (D) *</label>
                                            <select id="hostel_DayScholar" name="hostel_DayScholar" class="form-control">
                                                <option selected>Please Select Year</option>
                                                <option value="I Year">I Year</option>
                                                <option value="II Year">II Year</option>
                                                <option value="III Year">III Year</option>
                                                <option value="IV Year">IV Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="degree">Degree / Branch</label>
                                            <input type="text" name="degree" class="form-control" id="degree" placeholder="Enter Degree / Branch *" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="passport">Passport No.</label>
                                            <input type="text" name="passport" class="form-control" id="passport" placeholder="Enter Passport Number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="drivingLicense">Driving License No.</label>
                                            <input type="text" name="drivingLicense" class="form-control" id="drivingLicense" placeholder="Enter Driving License Number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="language">Languages known</label>
                                            <input type="text" name="language" class="form-control" id="language" placeholder="Enter Languages known">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="Blood">Blood Group</label>
                                            <select id="Blood" name="Blood" class="form-control">
                                                <option selected>Please Select Blood Group</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="height_Weight">Height & Weight</label>
                                            <input type="text" name="height_Weight" class="form-control" id="height_Weight">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MobNum">Mobile Number *</label>
                                            <input type="text" name="MobileNum" class="form-control" id="PhNum" value="+91 ">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Email">E-mail</label>
                                            <input type="email" name="Email" class="form-control" id="Email" placeholder="Enter Email-ID *">
                                        </div>
                                    </div>
                                <h5>Bank Details</h5>
                                <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="bank1">1) Bank</label>
                                            <input type="text" name="bank1" class="form-control" id="bank1" placeholder="Enter Bank Name *" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AcNo1">A/C No.</label>
                                            <input type="text" name="AcNo1" class="form-control" id="AcNo1" placeholder="Enter Account Number *" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="bank2">2) Bank</label>
                                            <input type="text" name="bank2" class="form-control" id="bank2" placeholder="Enter Bank Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AcNo2">A/C No.</label>
                                            <input type="text" name="AcNo2" class="form-control" id="AcNo2" placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                <h5>Parents / Guardians Information</h5>
                                <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Father Details</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="FatherName">Name of the Father</label>
                                            <input type="text" name="FatherName" class="form-control" id="FatherName" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="FatherOccupation" class="form-control" id="FatherOccupation" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="FatherMobNum">Mobile Number *</label>
                                            <input type="text" name="FatherMobileNum" class="form-control" id="FatherPhNum" value="+91 ">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherEmail">E-Mail ID *</label>
                                            <input type="email" name="FatherEmail" class="form-control" id="FatherEmail" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherPhoto">Stamp Size Photo</label>
                                            <input type="text" name="FatherPhoto" class="form-control" id="FatherPhoto" placeholder="Upload" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="FatherofficeAddress" class="form-control" id="officeAddress" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Mother Details</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="MotherName">Name of the Mother</label>
                                            <input type="text" name="MotherName" class="form-control" id="MotherName" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="MotherOccupation" class="form-control" id="MotherOccupation" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="MotherMobNum">Mobile Number *</label>
                                            <input type="text" name="MotherMobileNum" class="form-control" id="MotherPhNum" value="+91 ">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherEmail">E-Mail ID *</label>
                                            <input type="email" name="MotherEmail" class="form-control" id="MotherEmail" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherPhoto">Stamp Size Photo</label>
                                            <input type="text" name="MotherPhoto" class="form-control" id="MotherPhoto" placeholder="Upload" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="MotherofficeAddress" class="form-control" id="officeAddress" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Guardian Details</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="GuardianName">Guardian Name (Relationship)</label>
                                            <input type="text" name="GuardianName" class="form-control" id="GuardianName">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="GuardianOccupation" class="form-control" id="GuardianOccupation">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="GuardianMobNum">Mobile Number</label>
                                            <input type="text" name="GuardianMobileNum" <?php if(true){ ?> class="form-control" <?php } else { ?> class="custom-select is-invalid" <?php } ?> id="GuardianPhNum" value="+91 ">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianEmail">E-Mail ID</label>
                                            <input type="email" name="GuardianEmail" class="form-control" id="GuardianEmail">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianPhoto">Stamp Size Photo</label>
                                            <input type="text" name="GuardianPhoto" class="form-control" id="GuardianPhoto" placeholder="Upload">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="GuardianofficeAddress" class="form-control" id="officeAddress" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <h5>Address Information</h5>
                                    <hr  class="my-3">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="comAddress">Address of Communication</label>
                                            <input type="text" name="AddressCommunication" class="form-control" id="comAddress">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="permAddress">Permanent Address</label>
                                            <textarea type="text" name="permAdd" class="form-control" id="permAddress" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="commAddress">Communication Address</label>
                                            <textarea type="text" name="CommunicationAddress" class="form-control" id="commAddress" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="Pin">PIN</label>
                                            <input type="text" name="PinPermanent" class="form-control" id="inputPin">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Pin">PIN</label>
                                            <input type="text" name="PinCommunication" class="form-control" id="inputPin">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-4">
                                            <label for="Phone">Phone No.</label>
                                            <input type="text" name="PhonePermanent" class="form-control" id="Phone">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Phone">Phone No.</label>
                                            <input type="text" name="PhoneCommunication" class="form-control" id="Phone">
                                        </div>
                                    </div>

                                    <h5>QUALIFYING EXAMINATIONS</h5>
                                    <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>10th std</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="10th_School">Name of the Institute</label>
                                            <input type="text" name="10th_School" class="form-control" id="10th_School">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="10th_Place">Place</label>
                                            <input type="text" name="10th_Place" class="form-control" id="10th_Place">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="10th_year">Year of Passing</label>
                                            <input type="number" name="10th_year" class="form-control" id="10th_year" min="2000" max="2050" step="1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="10th_Marks">Marks Secured</label>
                                            <input type="text" name="10th_Marks" class="form-control" id="10th_Marks" value="        /        ">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="10th_Medium">Medium of Instruction</label>
                                            <input type="text" name="10th_Medium" class="form-control" id="10th_Medium">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>12th std PUC / 10+2</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="12th_School">Name of the Institute</label>
                                            <input type="text" name="12th_School" class="form-control" id="12th_School">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="12th_Place">Place</label>
                                            <input type="text" name="12th_Place" class="form-control" id="12th_Place">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="12th_Address">Address</label>
                                            <textarea type="text" name="12th_Address" class="form-control" id="12th_Address" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Board">Board of Education</label>
                                                <select id="12th_Board" name="12th_Board" class="form-control">
                                                    <option selected>Please Select Board of Education</option>
                                                    <option value="CBSE">CBSE</option>
                                                    <option value="State Board">State Board</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="12th_year">Year of Passing</label>
                                            <input type="number" name="12th_year" class="form-control" id="12th_year" min="2000" max="2050" step="1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="12th_Marks">Marks Secured</label>
                                            <input type="text" name="12th_Marks" class="form-control" id="12th_Marks" value="        /        ">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="12th_Medium">Medium of Instruction</label>
                                            <input type="text" name="12th_Medium" class="form-control" id="12th_Medium">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_MarksPercent">% of Marks</label>
                                            <input type="text" name="12th_MarksPercent" class="form-control" id="12th_MarksPercent">
                                        </div>
                                    </div>
                                    <h5>Marks: </h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Maths">Maths</label>
                                            <input type="number" name="12th_Marks_Maths" class="form-control" id="12th_Marks_Maths">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Physics">Physics</label>
                                            <input type="number" name="12th_Marks_Physics" class="form-control" id="12th_Marks_Physics">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Chem">Chemistry</label>
                                            <input type="number" name="12th_Marks_Chem" class="form-control" id="12th_Marks_Chem">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <h5>Diploma / Degree</h5>
                                            <hr  class="my-2">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="diploma_School">Name of the Institute</label>
                                            <input type="text" name="diploma_School" class="form-control" id="diploma_School">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_Place">Place</label>
                                            <input type="text" name="diploma_Place" class="form-control" id="diploma_Place">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="diploma_year">Year of Passing</label>
                                            <input type="number" name="diploma_year" class="form-control" id="diploma_year" min="2000" max="2050" step="1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_Marks">Marks Secured</label>
                                            <input type="text" name="diploma_Marks" class="form-control" id="diploma_Marks" value="        /        ">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="diploma_Medium">Medium of Instruction</label>
                                            <input type="text" name="diploma_Medium" class="form-control" id="diploma_Medium">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="diploma_MarksPercent">% of Marks</label>
                                            <input type="text" name="diploma_MarksPercent" class="form-control" id="diploma_MarksPercent">
                                        </div>
                                    </div>
                                    <h5>Semester wise Marks: </h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_I">I Sem</label>
                                            <input type="number" name="diploma_Marks_I" class="form-control" id="diploma_Marks_I">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_II">II Sem</label>
                                            <input type="number" name="diploma_Marks_II" class="form-control" id="diploma_Marks_II">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_III">III Sem</label>
                                            <input type="number" name="diploma_Marks_III" class="form-control" id="diploma_Marks_III">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_IV">IV Sem</label>
                                            <input type="number" name="diploma_Marks_IV" class="form-control" id="diploma_Marks_IV">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_V">V Sem</label>
                                            <input type="number" name="diploma_Marks_V" class="form-control" id="diploma_Marks_V">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_VI">VI Sem</label>
                                            <input type="number" name="diploma_Marks_VI" class="form-control" id="diploma_Marks_VI">
                                        </div>
                                    </div>
                                    <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="examPrep">Method of Examination Preparation</label>
                                                <select id="examPrep" name="examPrep" class="form-control">
                                                    <option selected></option>
                                                    <option value="Combined Study">Combined Study</option>
                                                    <option value="Self Study">Self Study</option>
                                                    <option value="Both">Both</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="englishCommunication">Do you communicate well in English:</label> <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="communicateEnglish" id="inlineRadio1" value="Yes">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="communicateEnglish" id="inlineRadio2" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="englishCommunication">If No, How you prepare yourself to improve</label>
                                            <textarea type="text" name="prepareEnglish" class="form-control" id="prepareEnglish" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <h6>No. of Brothers / Sisters & their Details</h6>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="elderBrothersCount">Brothers Elder</label>
                                            <input type="number" name="elderBrothersCount" class="form-control" id="elderBrothersCount">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="elderBrothersQualification">Qualification</label>
                                            <input type="text" name="elderBrothersQualification" class="form-control" id="elderBrothersQualification">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="youngerBrothersCount">Younger</label>
                                            <input type="number" name="youngerBrothersCount" class="form-control" id="youngerBrothersCount">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="youngerBrothersQualification">Qualification</label>
                                            <input type="text" name="youngerBrothersQualification" class="form-control" id="youngerBrothersQualification">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="elderSistersCount">Sisters Elder</label>
                                            <input type="number" name="elderSistersCount" class="form-control" id="elderSistersCount">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="elderSistersQualification">Qualification</label>
                                            <input type="text" name="elderSistersQualification" class="form-control" id="elderSistersQualification">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="youngerSistersCount">Younger</label>
                                            <input type="number" name="youngerSistersCount" class="form-control" id="youngerSistersCount">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="youngerSistersQualification">Qualification</label>
                                            <input type="text" name="youngerSistersQualification" class="form-control" id="youngerSistersQualification">
                                        </div>
                                    </div>

                                    <h5>PERSONAL DETAILS</h5>
                                    <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="MoveTogether">Do you move freely with everyone in the class?</label>
                                            <textarea type="text" name="MoveTogether" class="form-control" id="MoveTogether" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="personalProblems">Personal Problems, if any</label>
                                            <textarea type="text" name="personalProblems" class="form-control" id="personalProblems" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="healthCondition">Health Condition</label>
                                            <textarea type="text" name="healthCondition" class="form-control" id="healthCondition" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="anyMedication">Undergoing any medical Treatment? if so Please Mention</label>
                                            <textarea type="text" name="anyMedication" class="form-control" id="anyMedication" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="otherInterest">Other areas of interest</label>
                                            <textarea type="text" name="otherInterest" class="form-control" id="otherInterest" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="hobbies">Hobbies</label>
                                            <textarea type="text" name="hobbies" class="form-control" id="hobbies" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sportsInterest">Are you interested in sports (Specify the name of the sports)</label>
                                            <textarea type="text" name="sportsInterest" class="form-control" id="sportsInterest" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="prizeDetails">Have you won any prizes? (District / National / International)</label>
                                            <textarea type="text" name="prizeDetails" class="form-control" id="prizeDetails" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="specificTalents">Mention any of the your specific talents</label>
                                            <textarea type="text" name="specificTalents" class="form-control" id="specificTalents" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="ambition">Future Plans & Ambition</label>
                                            <textarea type="text" name="ambition" class="form-control" id="ambition" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="branchReason">Reason for Choosing this Branch and College</label>
                                            <textarea type="text" name="branchReason" class="form-control" id="branchReason" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-2">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <a href="AdmitStudents.php" role="button" class="btn btn-outline-danger btn-lg btn-block">Reset</a>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="../../js/scripts.js"></script>
</body>
</html>
