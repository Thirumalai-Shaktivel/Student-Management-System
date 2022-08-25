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
    $insert = false;

    $id = $_GET['id'];
    $select = "SELECT * FROM `student_details` WHERE `Student ID` = '$id'";
    $query = mysqli_query($conn, $select);

    if(isset($_POST['save'])){
        $USN = format($_POST['USN']);
        $name = format($_POST['Firstname']) ." ". format($_POST['Lastname']);
        $ColID= format($_POST['ColID']);
        $dob_ = format($_POST['DOB']);
        $dob = date("d M, Y",strtotime($dob_));
        $religion = format($_POST['religion']);
        $admYear = format($_POST['AdmYear']);
        $admNature = format($_POST['AdmNature']);
        $hostel_DayScholar = format($_POST['hostel_DayScholar']);
        $degree = format($_POST['degree']);
        $passport = format($_POST['passport']);
        $drivingLicense = format($_POST['drivingLicense']);
        $language = format($_POST['language']);
        $blood = format($_POST['Blood']);
        $height_Weight = format($_POST['height_Weight']);
        $mobileNum = format($_POST['MobileNum']);
        $email = format($_POST['Email']);
        $bank1 = format($_POST['bank1']);
        $acNo1 = format($_POST['AcNo1']);
        $bank2 = format($_POST['bank2']);
        $acNo2 = format($_POST['AcNo2']);
        $fatherName = format($_POST['FatherName']);
        $fatherOccupation = format($_POST['FatherOccupation']);
        $fatherMobileNum = format($_POST['FatherMobileNum']);
        $fatherEmail = format($_POST['FatherEmail']);
        $fatherPhoto = format($_POST['FatherPhoto']);
        $fatherofficeAddress = mysqli_real_escape_string($conn, format($_POST['FatherofficeAddress']));
        $motherName = format($_POST['MotherName']);
        $motherOccupation = format($_POST['MotherOccupation']);
        $motherMobileNum = format($_POST['MotherMobileNum']);
        $motherEmail = format($_POST['MotherEmail']);
        $motherPhoto = format($_POST['MotherPhoto']);
        $motherofficeAddress = mysqli_real_escape_string($conn, format($_POST['MotherofficeAddress']));
        $guardianName = format($_POST['GuardianName']);
        $guardianOccupation = format($_POST['GuardianOccupation']);
        $guardianMobileNum = format($_POST['GuardianMobileNum']);
        if($guardianMobileNum == "+91 ") {
            $guardianMobileNum = "";
        }
        $guardianEmail = format($_POST['GuardianEmail']);
        $guardianPhoto = format($_POST['GuardianPhoto']);
        $guardianofficeAddress = mysqli_real_escape_string($conn, format($_POST['GuardianofficeAddress']));
        $addressCommunication = format($_POST['AddressCommunication']);
        $permAdd = mysqli_real_escape_string($conn, format($_POST['permAdd']));
        $communicationAddress = mysqli_real_escape_string($conn, format($_POST['CommunicationAddress']));
        $pinPermanent = format($_POST['PinPermanent']);
        $pinCommunication = format($_POST['PinCommunication']);
        $phonePermanent = format($_POST['PhonePermanent']);
        $phoneCommunication = format($_POST['PhoneCommunication']);
        $_10th_School = format($_POST['10th_School']);
        $_10th_Place = format($_POST['10th_Place']);
        $_10th_year = format($_POST['10th_year']);
        $_10th_Marks = format($_POST['10th_Marks']);
        $_10th_Medium = format($_POST['10th_Medium']);
        $_12th_School = format($_POST['12th_School']);
        $_12th_Place = format($_POST['12th_Place']);
        $_12th_Address = mysqli_real_escape_string($conn, format($_POST['12th_Address']));
        $_12th_Board = format($_POST['12th_Board']);
        $_12th_year = format($_POST['12th_year']);
        $_12th_Marks = format($_POST['12th_Marks']);
        $_12th_Medium = format($_POST['12th_Medium']);
        $_12th_MarksPercent = format($_POST['12th_MarksPercent']);
        $_12th_Marks_Maths = format($_POST['12th_Marks_Maths']);
        $_12th_Marks_Physics = format($_POST['12th_Marks_Physics']);
        $_12th_Marks_Chem = format($_POST['12th_Marks_Chem']);
        $diploma_School = format($_POST['diploma_School']);
        $diploma_Place = format($_POST['diploma_Place']);
        $diploma_year = format($_POST['diploma_year']);
        $diploma_Marks = format($_POST['diploma_Marks']);
        $diploma_Medium = format($_POST['diploma_Medium']);
        if($diploma_School == "") {
            $diploma_year = 0;
            $diploma_Medium = NULL;
        }
        $diploma_MarksPercent = format($_POST['diploma_MarksPercent']);
        $diploma_Marks_I = format($_POST['diploma_Marks_I']);
        $diploma_Marks_II = format($_POST['diploma_Marks_II']);
        $diploma_Marks_III = format($_POST['diploma_Marks_III']);
        $diploma_Marks_IV = format($_POST['diploma_Marks_IV']);
        $diploma_Marks_V = format($_POST['diploma_Marks_V']);
        $diploma_Marks_VI = format($_POST['diploma_Marks_VI']);
        $examPrep = format($_POST['examPrep']);
        $communicateEnglish = format($_POST['communicateEnglish']);
        $prepareEnglish = format($_POST['prepareEnglish']);
        $elderBrothersCount = format($_POST['elderBrothersCount']);
        $elderBrothersQualification = format($_POST['elderBrothersQualification']);
        $youngerBrothersCount = format($_POST['youngerBrothersCount']);
        $youngerBrothersQualification = format($_POST['youngerBrothersQualification']);
        $elderSistersCount = format($_POST['elderSistersCount']);
        $elderSistersQualification = format($_POST['elderSistersQualification']);
        $youngerSistersCount = format($_POST['youngerSistersCount']);
        $youngerSistersQualification = format($_POST['youngerSistersQualification']);
        $moveTogether = format($_POST['MoveTogether']);
        $personalProblems = format($_POST['personalProblems']);
        $healthCondition = format($_POST['healthCondition']);
        $anyMedication = format($_POST['anyMedication']);
        $otherInterest = format($_POST['otherInterest']);
        $hobbies = format($_POST['hobbies']);
        $sportsInterest = format($_POST['sportsInterest']);
        $prizeDetails = format($_POST['prizeDetails']);
        $specificTalents = format($_POST['specificTalents']);
        $ambition = format($_POST['ambition']);
        $branchReason = format($_POST['branchReason']);

        $updateQuery = "UPDATE `student_details` SET
        `USN`='$USN',
        `Name`='$name',
        `College ID`='$ColID',
        `DOB`='$dob',
        `Religion`='$religion',
        `Admission Year`='$admYear',
        `Admission Nature`='$admNature',
        `Hostel DayScholar`='$hostel_DayScholar',
        `Degree_Branch`='$degree',
        `Passport`='$passport',
        `Driving License`='$drivingLicense',
        `Languages`='$language',
        `Blood Group`='$blood',
        `Height_Weight`='$height_Weight',
        `Mobile Number`='$mobileNum',
        `Email`='$email',
        `Bank 1`='$bank1',
        `Account No 1`='$acNo1',
        `Bank 2`='$bank2',
        `Account No 2`='$acNo2',
        `Father Name`='$fatherName',
        `Father Occupation`='$fatherOccupation',
        `Father Number`='$fatherMobileNum',
        `Father Email`='$fatherEmail',
        `Father Photo`='$fatherPhoto',
        `Father Office Address`='$fatherofficeAddress',
        `Mother Name`='$motherName',
        `Mother Occupation`='$motherOccupation',
        `Mother Number`='$motherMobileNum',
        `Mother Email`='$motherEmail',
        `Mother Photo`='$motherPhoto',
        `Mother Office Address`='$motherofficeAddress',
        `Guardian Name`='$guardianName',
        `Guardian Occupation`='$guardianOccupation',
        `Guardian Number`='$guardianMobileNum',
        `Guardian Email`='$guardianEmail',
        `Guardian Photo`='$guardianPhoto',
        `Guardian Office Address`='$guardianofficeAddress',
        `Address of Communication`='$addressCommunication',
        `Permanent Address`='$permAdd',
        `Permanent Address PIN`='$pinPermanent',
        `Permanent Address Phone`='$phonePermanent',
        `Communication Address`='$communicationAddress',
        `Communication Address PIN`='$pinCommunication',
        `Communication Address Phone`='$phoneCommunication',
        `10th School Name`='$_10th_School',
        `10th School Place`='$_10th_Place',
        `10th Year`='$_10th_year',
        `10th Marks`='$_10th_Marks',
        `10th Medium`='$_10th_Medium',
        `12th School Name`='$_12th_School',
        `12th School Place`='$_12th_Place',
        `12th School Address`='$_12th_Address',
        `12th Board`='$_12th_Board',
        `12th Year`='$_12th_year',
        `12th Marks`='$_12th_Marks',
        `12th Medium`='$_12th_Medium',
        `12th Marks Percentage`='$_12th_MarksPercent',
        `12th Marks Maths`='$_12th_Marks_Maths',
        `12th Marks Physics`='$_12th_Marks_Physics',
        `12th Marks Chemistry`='$_12th_Marks_Chem',
        `Diploma School Name`='$diploma_School',
        `Diploma School Place`='$diploma_Place',
        `Diploma year`='$diploma_year',
        `Diploma Marks`='$diploma_Marks',
        `Diploma Medium`='$diploma_Medium',
        `Diploma Marks Percent`='$diploma_MarksPercent',
        `Diploma Marks Sem I`='$diploma_Marks_I',
        `Diploma Marks Sem II`='$diploma_Marks_II',
        `Diploma Marks Sem III`='$diploma_Marks_III',
        `Diploma Marks Sem IV`='$diploma_Marks_IV',
        `Diploma Marks Sem V`='$diploma_Marks_V',
        `Diploma Marks Sem VI`='$diploma_Marks_VI',
        `Exam Preparation Method`='$examPrep',
        `Communicate well in English`='$communicateEnglish',
        `Prepare English`='$prepareEnglish',
        `Elder Brothers Count`='$elderBrothersCount',
        `Elder Broters Qualification`='$elderBrothersQualification',
        `Younger Brothers Count`='$youngerBrothersCount',
        `Younger Brothers Qualification`='$youngerBrothersQualification',
        `Elder Sisters Count`='$elderSistersCount',
        `Elder Sisters Qualification`='$elderSistersQualification',
        `Younger Sisters Count`='$youngerSistersCount',
        `Younger Sisters Qualification`='$youngerSistersQualification',
        `Move Together`='$moveTogether',
        `Personal Problems`='$personalProblems',
        `Health Condition`='$healthCondition',
        `Any Medications`='$anyMedication',
        `Other Interests`='$otherInterest',
        `Hobbies`='$hobbies',
        `Sports Interest`='$sportsInterest',
        `Prize Details`='$prizeDetails',
        `Specific talents`='$specificTalents',
        `Ambition`='$ambition',
        `Branch Reason`='$branchReason'
        WHERE `Student ID` = '$id'";

        $query = mysqli_query($conn, $updateQuery);

        if($query){
            $_SESSION["UpdatedStudents"] = true;
            header("location: StudentsList.php");
        }
        else{
            ?>
            <script> alert("Sorry");</script>
            <?php
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
    <title>Student Details Updation Page</title>
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
                    <?php if($insert){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Student Details Admitted Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Admit Students</h4>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <h5>Student Information</h5>
                                <?php
                                    $select = "SELECT * FROM `student_details` WHERE `Student ID` = '$id'";
                                    $query = mysqli_query($conn, $select);
                                    $res = mysqli_fetch_assoc($query);
                                ?>
                                <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="StudId">Student ID</label>
                                            <input type="text" name="StudID" class="form-control" id="StudID" value="<?php echo $id; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="USN">University Seat Number</label>
                                            <input type="text" name="USN" class="form-control" id="usn" value="<?php echo $res['USN']?>">
                                        </div>
                                        <?php $arr = explode(" ", $res['Name']);?>
                                        <div class="form-group col-md-3">
                                            <label for="Name">First Name</label>
                                            <input type="text" name="Firstname" class="form-control" id="firstname" value="<?php echo $arr[0]?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Name">Last Name</label>
                                            <input type="text" name="Lastname" class="form-control" id="lastname" value="<?php echo $arr[1]?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="ColId">College ID</label>
                                            <input type="text" name="ColID" class="form-control" id="ColID" value="<?php echo $res['College ID']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="DOB">Date Of Birth</label>
                                            <input type="date" name="DOB" class="form-control" id="Dob" value="<?php echo date("Y-m-d",strtotime($res['DOB'])); ?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="religion">Religion / Community / Caste</label>
                                            <input type="text" name="religion" class="form-control" id="religion" value="<?php echo $res['Religion']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="AdmissionYear">Year of Admission</label>
                                            <input type="number" name="AdmYear" class="form-control" id="AdmYear" min="1900" max="2099" step="1"  value="<?php echo $res['Admission Year']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AdmNature">Nature of Admission *</label>
                                            <select id="AdmNature" name="AdmNature" class="form-control">
                                                <option>Please Select Nature of Admission</option>
                                                <option <?php if($res['Admission Nature']=='CET'){?> selected <?php } ?> value="CET">CET</option>
                                                <option <?php if($res['Admission Nature']=='COMED-'){?> selected <?php } ?> value="COMED-K">COMED-K</option>
                                                <option <?php if($res['Admission Nature']=='Management'){?> selected <?php } ?> value="Management">Management</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="hostel_DayScholar">Hostelite(H) / Day Scholar (D) *</label>
                                            <select id="hostel_DayScholar" name="hostel_DayScholar" class="form-control">
                                                <option>Please Select Year</option>
                                                <option <?php if($res['Hostel DayScholar']=='I Year'){?> selected <?php } ?> value="I Year">I Year</option>
                                                <option <?php if($res['Hostel DayScholar']=='II Year'){?> selected <?php } ?> value="II Year">II Year</option>
                                                <option <?php if($res['Hostel DayScholar']=='III Year'){?> selected <?php } ?> value="III Year">III Year</option>
                                                <option <?php if($res['Hostel DayScholar']=='IV Year'){?> selected <?php } ?> value="IV Year">IV Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="degree">Degree / Branch</label>
                                            <input type="text" name="degree" class="form-control" id="degree" value="<?php echo $res['Degree_Branch']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="passport">Passport No.</label>
                                            <input type="text" name="passport" class="form-control" id="passport" value="<?php echo $res['Passport']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="drivingLicense">Driving License No.</label>
                                            <input type="text" name="drivingLicense" class="form-control" id="drivingLicense" value="<?php echo $res['Driving License']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="language">Languages known</label>
                                            <input type="text" name="language" class="form-control" id="language" value="<?php echo $res['Languages']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="Blood">Blood Group</label>
                                            <select id="Blood" name="Blood" class="form-control">
                                                <option>Please Select Blood Group</option>
                                                <option <?php if($res['Blood Group']=='A+'){?> selected <?php } ?> value="A+">A+</option>
                                                <option <?php if($res['Blood Group']=='A-'){?> selected <?php } ?> value="A-">A-</option>
                                                <option <?php if($res['Blood Group']=='B+'){?> selected <?php } ?> value="B+">B+</option>
                                                <option <?php if($res['Blood Group']=='B-'){?> selected <?php } ?> value="B-">B-</option>
                                                <option <?php if($res['Blood Group']=='AB+'){?> selected <?php } ?> value="AB+">AB+</option>
                                                <option <?php if($res['Blood Group']=='AB-'){?> selected <?php } ?> value="AB-">AB-</option>
                                                <option <?php if($res['Blood Group']=='O+'){?> selected <?php } ?> value="O+">O+</option>
                                                <option <?php if($res['Blood Group']=='O-'){?> selected <?php } ?> value="O-">O-</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="height_Weight">Height & Weight</label>
                                            <input type="text" name="height_Weight" class="form-control" id="height_Weight" value="<?php echo $res['Height_Weight']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MobNum">Mobile Number *</label>
                                            <input type="text" name="MobileNum" class="form-control" id="PhNum" value="<?php echo $res['Mobile Number']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Email">E-mail</label>
                                            <input type="email" name="Email" class="form-control" id="Email" value="<?php echo $res['Email']?>">
                                        </div>
                                    </div>
                                <h5>Bank Details</h5>
                                <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="bank1">1) Bank</label>
                                            <input type="text" name="bank1" class="form-control" id="bank1" value="<?php echo $res['Bank 1']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AcNo1">A/C No.</label>
                                            <input type="text" name="AcNo1" class="form-control" id="AcNo1" value="<?php echo $res['Account No 1']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="bank2">2) Bank</label>
                                            <input type="text" name="bank2" class="form-control" id="bank2" value="<?php echo $res['Bank 2']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="AcNo2">A/C No.</label>
                                            <input type="text" name="AcNo2" class="form-control" id="AcNo2" value="<?php echo $res['Account No 2']?>">
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
                                            <input type="text" name="FatherName" class="form-control" id="FatherName" value="<?php echo $res['Father Name']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="FatherOccupation" class="form-control" id="FatherOccupation" value="<?php echo $res['Father Occupation']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="FatherMobNum">Mobile Number *</label>
                                            <input type="text" name="FatherMobileNum" class="form-control" id="FatherPhNum" value="<?php echo $res['Father Number']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherEmail">E-Mail ID *</label>
                                            <input type="email" name="FatherEmail" class="form-control" id="FatherEmail" value="<?php echo $res['Father Email']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FatherPhoto">Stamp Size Photo</label>
                                            <input type="text" name="FatherPhoto" class="form-control" id="FatherPhoto" value="<?php echo $res['Father Photo']?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="FatherofficeAddress" class="form-control" id="officeAddress" rows="3" required><?php echo $res['Father Office Address']; ?></textarea>
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
                                            <input type="text" name="MotherName" class="form-control" id="MotherName"  value="<?php echo $res['Mother Name']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="MotherOccupation" class="form-control" id="MotherOccupation" value="<?php echo $res['Mother Occupation']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="MotherMobNum">Mobile Number *</label>
                                            <input type="text" name="MotherMobileNum" class="form-control" id="MotherPhNum" value="<?php echo $res['Mother Number']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherEmail">E-Mail ID *</label>
                                            <input type="email" name="MotherEmail" class="form-control" id="MotherEmail" value="<?php echo $res['Mother Email']?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="MotherPhoto">Stamp Size Photo</label>
                                            <input type="text" name="MotherPhoto" class="form-control" id="MotherPhoto" value="<?php echo $res['Mother Photo']?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="MotherofficeAddress" class="form-control" id="officeAddress" rows="3"><?php echo $res['Mother Office Address']; ?></textarea>
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
                                            <input type="text" name="GuardianName" class="form-control" id="GuardianName" value="<?php echo $res['Guardian Name']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianOccupation">Qualification / Occupation / Designation</label>
                                            <input type="text" name="GuardianOccupation" class="form-control" id="GuardianOccupation" value="<?php echo $res['Guardian Occupation']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="GuardianMobNum">Mobile Number</label>
                                            <input type="text" name="GuardianMobileNum" class="form-control" id="GuardianPhNum" value="<?php echo $res['Guardian Number']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianEmail">E-Mail ID</label>
                                            <input type="email" name="GuardianEmail" class="form-control" id="GuardianEmail" value="<?php echo $res['Guardian Email']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="GuardianPhoto">Stamp Size Photo</label>
                                            <input type="text" name="GuardianPhoto" class="form-control" id="GuardianPhoto" value="<?php echo $res['Guardian Photo']?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="officeAddress">Office Address with Phone No.</label>
                                            <textarea type="text" name="GuardianofficeAddress" class="form-control" id="officeAddress" rows="3"><?php echo $res['Guardian Office Address']; ?></textarea>
                                        </div>
                                    </div>

                                    <h5>Address Information</h5>
                                    <hr  class="my-3">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="comAddress">Address of Communication</label>
                                            <input type="text" name="AddressCommunication" class="form-control" id="comAddress" value="<?php echo $res['Address of Communication']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="permAddress">Permanent Address</label>
                                            <textarea type="text" name="permAdd" class="form-control" id="permAddress" rows="3" required><?php echo $res['Permanent Address']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="commAddress">Communication Address</label>
                                            <textarea type="text" name="CommunicationAddress" class="form-control" id="commAddress" rows="3"><?php echo $res['Communication Address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="Pin">PIN</label>
                                            <input type="text" name="PinPermanent" class="form-control" id="inputPin" value="<?php echo $res['Permanent Address PIN']?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Pin">PIN</label>
                                            <input type="text" name="PinCommunication" class="form-control" id="inputPin" value="<?php echo $res['Communication Address PIN']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-4">
                                            <label for="Phone">Phone No.</label>
                                            <input type="text" name="PhonePermanent" class="form-control" id="Phone" value="<?php echo $res['Permanent Address Phone']?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Phone">Phone No.</label>
                                            <input type="text" name="PhoneCommunication" class="form-control" id="Phone" value="<?php echo $res['Communication Address Phone']?>">
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
                                            <input type="text" name="10th_School" class="form-control" id="10th_School" value="<?php echo $res['10th School Name']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="10th_Place">Place</label>
                                            <input type="text" name="10th_Place" class="form-control" id="10th_Place" value="<?php echo $res['10th School Place']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="10th_year">Year of Passing</label>
                                            <input type="number" name="10th_year" class="form-control" id="10th_year" min="2000" max="2050" step="1"  value="<?php echo $res['10th Year']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="10th_Marks">Marks Secured</label>
                                            <input type="text" name="10th_Marks" class="form-control" id="10th_Marks"  value="<?php echo $res['10th Marks']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="10th_Medium">Medium of Instruction</label>
                                            <input type="text" name="10th_Medium" class="form-control" id="10th_Medium"  value="<?php echo $res['10th Medium']?>">
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
                                            <input type="text" name="12th_School" class="form-control" id="12th_School" value="<?php echo $res['12th School Name']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="12th_Place">Place</label>
                                            <input type="text" name="12th_Place" class="form-control" id="12th_Place" value="<?php echo $res['12th School Place']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="12th_Address">Address</label>
                                            <textarea type="text" name="12th_Address" class="form-control" id="12th_Address" rows="3" required><?php echo $res['12th School Address']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Board">Board of Education</label>
                                                <select id="12th_Board" name="12th_Board" class="form-control">
                                                    <option>Please Select Board of Education</option>
                                                    <option <?php if($res['12th Board']=='CBSE'){?> selected <?php } ?> value="CBSE">CBSE</option>
                                                    <option <?php if($res['12th Board']=='State Board'){?> selected <?php } ?> value="State Board">State Board</option>
                                                    <option <?php if($res['12th Board']=='Others'){?> selected <?php } ?> value="Others">Others</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="12th_year">Year of Passing</label>
                                            <input type="number" name="12th_year" class="form-control" id="12th_year" min="2000" max="2050" step="1" value="<?php echo $res['12th Year']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="12th_Marks">Marks Secured</label>
                                            <input type="text" name="12th_Marks" class="form-control" id="12th_Marks" value="<?php echo $res['12th Marks']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="12th_Medium">Medium of Instruction</label>
                                            <input type="text" name="12th_Medium" class="form-control" id="12th_Medium" value="<?php echo $res['12th Medium']?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_MarksPercent">% of Marks</label>
                                            <input type="text" name="12th_MarksPercent" class="form-control" id="12th_MarksPercent"  value="<?php echo $res['12th Marks Percentage']?>">
                                        </div>
                                    </div>
                                    <h5>Marks: </h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Maths">Maths</label>
                                            <input type="text" name="12th_Marks_Maths" class="form-control" id="12th_Marks_Maths" value="<?php echo $res['12th Marks Maths']?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Physics">Physics</label>
                                            <input type="text" name="12th_Marks_Physics" class="form-control" id="12th_Marks_Physics" value="<?php echo $res['12th Marks Physics']?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="12th_Marks_Chem">Chemistry</label>
                                            <input type="text" name="12th_Marks_Chem" class="form-control" id="12th_Marks_Chem" value="<?php echo $res['12th Marks Chemistry']?>">
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
                                            <input type="text" name="diploma_School" class="form-control" id="diploma_School" value="<?php echo $res['Diploma School Name']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_Place">Place</label>
                                            <input type="text" name="diploma_Place" class="form-control" id="diploma_Place" value="<?php echo $res['Diploma School Place']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="diploma_year">Year of Passing</label>
                                            <input type="number" name="diploma_year" class="form-control" id="diploma_year" value="<?php echo $res['Diploma year']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_Marks">Marks Secured</label>
                                            <input type="text" name="diploma_Marks" class="form-control" id="diploma_Marks" value="<?php echo $res['Diploma Marks']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="diploma_Medium">Medium of Instruction</label>
                                            <input type="text" name="diploma_Medium" class="form-control" id="diploma_Medium" value="<?php echo $res['Diploma Medium']?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="diploma_MarksPercent">% of Marks</label>
                                            <input type="text" name="diploma_MarksPercent" class="form-control" id="diploma_MarksPercent" value="<?php echo $res['Diploma Marks Percent']?>">
                                        </div>
                                    </div>
                                    <h5>Semester wise Marks: </h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_I">I Sem</label>
                                            <input type="text" name="diploma_Marks_I" class="form-control" id="diploma_Marks_I" value="<?php echo $res['Diploma Marks Sem I']?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_II">II Sem</label>
                                            <input type="text" name="diploma_Marks_II" class="form-control" id="diploma_Marks_II" value="<?php echo $res['Diploma Marks Sem II']?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_III">III Sem</label>
                                            <input type="text" name="diploma_Marks_III" class="form-control" id="diploma_Marks_III" value="<?php echo $res['Diploma Marks Sem III']?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_IV">IV Sem</label>
                                            <input type="text" name="diploma_Marks_IV" class="form-control" id="diploma_Marks_IV" value="<?php echo $res['Diploma Marks Sem IV']?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_V">V Sem</label>
                                            <input type="text" name="diploma_Marks_V" class="form-control" id="diploma_Marks_V" value="<?php echo $res['Diploma Marks Sem V']?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="diploma_Marks_VI">VI Sem</label>
                                            <input type="text" name="diploma_Marks_VI" class="form-control" id="diploma_Marks_VI" value="<?php echo $res['Diploma Marks Sem VI']?>">
                                        </div>
                                    </div>
                                    <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="examPrep">Method of Examination Preparation</label>
                                                <select id="examPrep" name="examPrep" class="form-control">
                                                    <option></option>
                                                    <option <?php if($res['Exam Preparation Method']=='Combined Study'){?> selected <?php } ?> value="Combined Study">Combined Study</option>
                                                    <option <?php if($res['Exam Preparation Method']=='Self Study'){?> selected <?php } ?> value="Self Study">Self Study</option>
                                                    <option <?php if($res['Exam Preparation Method']=='Both'){?> selected <?php } ?> value="Both">Both</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="englishCommunication">Do you communicate well in English:</label> <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="communicateEnglish" id="inlineRadio1" value="Yes"
                                                    <?php if($res['Communicate well in English']=='Yes'){?> checked <?php } ?>>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="communicateEnglish" id="inlineRadio2" value="No"
                                                    <?php if($res['Communicate well in English']=='No'){?> checked <?php } ?>>
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="englishCommunication">If No, How you prepare yourself to improve</label>
                                            <textarea type="text" name="prepareEnglish" class="form-control" id="prepareEnglish" rows="3"><?php echo $res['Prepare English']; ?></textarea>
                                        </div>
                                    </div>
                                    <h6>No. of Brothers / Sisters & their Details</h6>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="elderBrothersCount">Brothers Elder</label>
                                            <input type="number" name="elderBrothersCount" class="form-control" id="elderBrothersCount" value="<?php echo $res['Elder Brothers Count']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="elderBrothersQualification">Qualification</label>
                                            <input type="text" name="elderBrothersQualification" class="form-control" id="elderBrothersQualification" value="<?php echo $res['Elder Broters Qualification']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="youngerBrothersCount">Younger</label>
                                            <input type="number" name="youngerBrothersCount" class="form-control" id="youngerBrothersCount" value="<?php echo $res['Younger Brothers Count']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="youngerBrothersQualification">Qualification</label>
                                            <input type="text" name="youngerBrothersQualification" class="form-control" id="youngerBrothersQualification" value="<?php echo $res['Younger Brothers Qualification']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="elderSistersCount">Sisters Elder</label>
                                            <input type="number" name="elderSistersCount" class="form-control" id="elderSistersCount" value="<?php echo $res['Elder Sisters Count']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="elderSistersQualification">Qualification</label>
                                            <input type="text" name="elderSistersQualification" class="form-control" id="elderSistersQualification" value="<?php echo $res['Elder Sisters Qualification']?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="youngerSistersCount">Younger</label>
                                            <input type="number" name="youngerSistersCount" class="form-control" id="youngerSistersCount" value="<?php echo $res['Younger Sisters Count']?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="youngerSistersQualification">Qualification</label>
                                            <input type="text" name="youngerSistersQualification" class="form-control" id="youngerSistersQualification" value="<?php echo $res['Younger Sisters Qualification']?>">
                                        </div>
                                    </div>

                                    <h5>PERSONAL DETAILS</h5>
                                    <hr  class="my-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="MoveTogether">Do you move freely with everyone in the class?</label>
                                            <textarea type="text" name="MoveTogether" class="form-control" id="MoveTogether" rows="3"><?php echo $res['Move Together']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="personalProblems">Personal Problems, if any</label>
                                            <textarea type="text" name="personalProblems" class="form-control" id="personalProblems" rows="3"><?php echo $res['Personal Problems']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="healthCondition">Health Condition</label>
                                            <textarea type="text" name="healthCondition" class="form-control" id="healthCondition" rows="3"><?php echo $res['Health Condition']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="anyMedication">Undergoing any medical Treatment? if so Please Mention</label>
                                            <textarea type="text" name="anyMedication" class="form-control" id="anyMedication" rows="3"><?php echo $res['Any Medications']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="otherInterest">Other areas of interest</label>
                                            <textarea type="text" name="otherInterest" class="form-control" id="otherInterest" rows="3"><?php echo $res['Other Interests']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="hobbies">Hobbies</label>
                                            <textarea type="text" name="hobbies" class="form-control" id="hobbies" rows="3"><?php echo $res['Hobbies']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sportsInterest">Are you interested in sports (Specify the name of the sports)</label>
                                            <textarea type="text" name="sportsInterest" class="form-control" id="sportsInterest" rows="3"><?php echo $res['Sports Interest']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="prizeDetails">Have you won any prizes? (District / National / International)</label>
                                            <textarea type="text" name="prizeDetails" class="form-control" id="prizeDetails" rows="3"><?php echo $res['Prize Details']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="specificTalents">Mention any of the your specific talents</label>
                                            <textarea type="text" name="specificTalents" class="form-control" id="specificTalents" rows="3"><?php echo $res['Specific talents']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="ambition">Future Plans & Ambition</label>
                                            <textarea type="text" name="ambition" class="form-control" id="ambition" rows="3"><?php echo $res['Ambition']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="branchReason">Reason for Choosing this Branch and College</label>
                                            <textarea type="text" name="branchReason" class="form-control" id="branchReason" rows="3"><?php echo $res['Branch Reason']; ?></textarea>
                                        </div>
                                    </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-2">
                                        <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Save</button>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <a href="StudentsList.php" role="button" class="btn btn-outline-warning btn-lg btn-block">Cancel</a>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <a href="DeleteStudent.php?id2=<?php echo $id ?>" role="button" class="btn btn-danger btn-lg btn-block">Delete</a>
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
