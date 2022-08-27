<?php

    session_start();
    if(isset($_SESSION['username']) != true)
    {
        header("location: ../../index.php");
        exit;
    }
    $display = false;
    $username = trim($_SESSION['username']);
    include "../../config.php";
    include "../../function.php";

    $oops = false;

    if(isset($_SESSION['Oops']))
        $oops = true;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $selectQuery = "SELECT * FROM `student_details` WHERE `Student ID` = '$id'";
        $query = mysqli_query($conn, $selectQuery);
        $result = mysqli_fetch_assoc($query);
        if($result)
            $display = true;
    }
    if(isset($_POST['find'])){
        $id = format($_POST['Sid']);
        $selectQuery = "SELECT * FROM `student_details` WHERE `Student ID` = '$id'";
        $query = mysqli_query($conn, $selectQuery);
        $result = mysqli_fetch_assoc($query);
        if($result){
            $display = true;
            //header("location: StudentDetails.php");
        }
        else{
            $_SESSION['Oops'] = true;
            header("location: StudentDetails.php");
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> -->
    <link href="../../css/styles.css" rel="stylesheet" />
    <title>View Students Details Page</title>
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
                                </a>
                                <a class="nav-link" href="../Academics/Exam.php">
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
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Students Info</li>
                        <li class="breadcrumb-item active">Student Details</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div>
                                <label for="StudID"><h5>Student ID</h5></label>
                                <form action="" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-sm-4">
                                            <input type="text" name="Sid" class="form-control" required>
                                        </div>
                                        <div class="form-group col-5 col-sm-3 col-lg-2">
                                            <button type="submit" name="find" class="btn btn-success btn-block">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if($display) { ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="display-4"><strong>Student Details</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md col">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Student ID</td><td><?php echo ":\t".$result['Student ID']?></td>
                                                </tr>
                                                <tr>
                                                    <td>University Seat Number</td><td><?php echo ":\t".$result['USN']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td><td><?php echo ":\t".$result['Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>College ID</td><td><?php echo ":\t".$result['College ID']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date Of Birth</td><td><?php echo ":\t".$result['DOB']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Religion / Community / Caste</td><td><?php echo ":\t".$result['Religion']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Year of Admission</td><td><?php echo ":\t".$result['Admission Year']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nature of Admission *</td><td><?php echo ":\t".$result['Admission Nature']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Hostelite(H) / Day Scholar (D) *</td><td><?php echo ":\t".$result['Hostel DayScholar']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Degree / Branch</td><td><?php echo ":\t".$result['Degree_Branch']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Passport No.</td><td><?php echo ":\t".$result['Passport']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Driving License No.</td><td><?php echo ":\t".$result['Driving License']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Languages known</td><td><?php echo ":\t".$result['Languages']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Blood Group</td><td><?php echo ":\t".$result['Blood Group']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Height & Weight</td><td><?php echo ":\t".$result['Height_Weight']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number *</td><td><?php echo ":\t".$result['Mobile Number']?></td>
                                                </tr>
                                                <tr>
                                                    <td>E-mail</td><td><?php echo ":\t".$result['Email']?></td>
                                                </tr>

                                                <tr>
                                                    <td>1) Bank</td><td><?php echo ":\t".$result['Bank 1']?></td>
                                                </tr>
                                                <tr>
                                                    <td>A/C No.</td><td><?php echo ":\t".$result['Account No 1']?></td>
                                                </tr>
                                                <tr>
                                                    <td>2) Bank</td><td><?php echo ":\t".$result['Bank 2']?></td>
                                                </tr>
                                                <tr>
                                                    <td>A/C No.</td><td><?php echo ":\t".$result['Account No 2']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Name of the Father</td><td><?php echo ":\t".$result['Father Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification / Occupation / Designation</td><td><?php echo ":\t".$result['Father Occupation']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number *</td><td><?php echo ":\t".$result['Father Number']?></td>
                                                </tr>
                                                <tr>
                                                    <td>E-Mail ID *</td><td><?php echo ":\t".$result['Father Email']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Office Address with Phone No.</td><td><?php echo ":\t".$result['Father Office Address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Name of the Mother</td><td><?php echo ":\t".$result['Mother Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification / Occupation / Designation</td><td><?php echo ":\t".$result['Mother Occupation']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number *</td><td><?php echo ":\t".$result['Mother Number']?></td>
                                                </tr>
                                                <tr>
                                                    <td>E-Mail ID *</td><td><?php echo ":\t".$result['Mother Email']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Office Address with Phone No.</td><td><?php echo ":\t".$result['Mother Office Address']?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Guardian Name (Relationship)</td><td><?php echo ":\t".$result['Guardian Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification / Occupation / Designation</td><td><?php echo ":\t".$result['Guardian Occupation']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number</td><td><?php echo ":\t".$result['Guardian Number']?></td>
                                                </tr>
                                                <tr>
                                                    <td>E-Mail ID</td><td><?php echo ":\t".$result['Guardian Email']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Office Address with Phone No.</td><td><?php echo ":\t".$result['Guardian Office Address']?></td> -->
                                                </tr>
                                                <tr>
                                                    <td>Address of Communication</td><td><?php echo ":\t".$result['Address of Communication']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Permanent Address</td><td><?php echo ":\t".$result['Permanent Address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>PIN</td><td><?php echo ":\t".$result['Permanent Address PIN']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone No.</td><td><?php echo ":\t".$result['Permanent Address Phone']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Communication Address</td><td><?php echo ":\t".$result['Communication Address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>PIN</td><td><?php echo ":\t".$result['Communication Address PIN']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone No.</td><td><?php echo ":\t".$result['Communication Address Phone']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Name of the 10th Institute</td><td><?php echo ":\t".$result['10th School Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Place</td><td><?php echo ":\t".$result['10th School Place']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Year of Passing</td><td><?php echo ":\t".$result['10th Year']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Marks Secured</td><td><?php echo ":\t".$result['10th Marks']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Medium of Instruction</td><td><?php echo ":\t".$result['10th Medium']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Name of the 12th / PU Institute</td><td><?php echo ":\t".$result['12th School Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Place</td><td><?php echo ":\t".$result['12th School Place']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td><td><?php echo ":\t".$result['12th School Address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Board of Education</td><td><?php echo ":\t".$result['12th Board']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Year of Passing</td><td><?php echo ":\t".$result['12th Year']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Marks Secured</td><td><?php echo ":\t".$result['12th Marks']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Medium of Instruction</td><td><?php echo ":\t".$result['12th Medium']?></td>
                                                </tr>
                                                <tr>
                                                    <td>% of Marks</td><td><?php echo ":\t".$result['12th Marks Percentage']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Maths</td><td><?php echo ":\t".$result['12th Marks Maths']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Physics</td><td><?php echo ":\t".$result['12th Marks Physics']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Chemistry</td><td><?php echo ":\t".$result['12th Marks Chemistry']?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Name of the Institute</td><td><?php echo ":\t".$result['Diploma School Name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Place</td><td><?php echo ":\t".$result['Diploma School Place']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Year of Passing</td><td><?php echo ":\t".$result['Diploma year']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Marks Secured</td><td><?php echo ":\t".$result['Diploma Marks']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Medium of Instruction</td><td><?php echo ":\t".$result['Diploma Medium']?></td>
                                                </tr>
                                                <tr>
                                                    <td> of Marks</td><td><?php echo ":\t".$result['Diploma Marks Percent']?></td>
                                                </tr>
                                                <tr>
                                                    <td>I Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem I']?></td>
                                                </tr>
                                                <tr>
                                                    <td>II Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem II']?></td>
                                                </tr>
                                                <tr>
                                                    <td>III Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem III']?></td>
                                                </tr>
                                                <tr>
                                                    <td>IV Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem IV']?></td>
                                                </tr>
                                                <tr>
                                                    <td>V Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem V']?></td>
                                                </tr>
                                                <tr>
                                                    <td>VI Sem</td><td><?php echo ":\t".$result['Diploma Marks Sem VI']?></td>
                                                </tr> -->
                                                <tr>
                                                    <td>Method of Examination Preparation</td><td><?php echo ":\t".$result['Exam Preparation Method']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Do you communicate well in English:</labeltd><td><?php echo ":\t".$result['Communicate well in English']?></td>
                                                </tr>
                                                <tr>
                                                    <td>If No, How you prepare yourself to improve</td><td><?php echo ":\t".$result['Prepare English']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Brothers Elder</td><td><?php echo ":\t".$result['Elder Brothers Count']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification</td><td><?php echo ":\t".$result['Elder Brothers Qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Younger</td><td><?php echo ":\t".$result['Younger Brothers Count']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification</td><td><?php echo ":\t".$result['Younger Brothers Qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sisters Elder</td><td><?php echo ":\t".$result['Elder Sisters Count']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification</td><td><?php echo ":\t".$result['Elder Sisters Qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Younger</td><td><?php echo ":\t".$result['Younger Sisters Count']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Qualification</td><td><?php echo ":\t".$result['Younger Sisters Qualification']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Do you move freely with everyone in the class?</td><td><?php echo ":\t".$result['Move Together']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Personal Problems, if any</td><td><?php echo ":\t".$result['Personal Problems']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Health Condition</td><td><?php echo ":\t".$result['Health Condition']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Undergoing any medical Treatment? if so Please Mention</td><td><?php echo ":\t".$result['Any Medications']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Other areas of interest</td><td><?php echo ":\t".$result['Other Interests']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Hobbies</td><td><?php echo ":\t".$result['Hobbies']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Are you interested in sports (Specify the name of the sports)</td><td><?php echo ":\t".$result['Sports Interest']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Have you won any prizes? (District / National / International)</td><td><?php echo ":\t".$result['Prize Details']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mention any of the your specific talents</td><td><?php echo ":\t".$result['Specific talents']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Future Plans & Ambition</td><td><?php echo ":\t".$result['Ambition']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Reason for Choosing this Branch and College</td><td><?php echo ":\t".$result['Branch Reason']?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4 col text-center">
                                    <div class="row">
                                        <div class="col-md">
                                            <img src="../../image/Male.jpg" alt="Student Image" style="width:300px; border-radius: 50%;">
                                        </div>
                                        <br>
                                        <div class="col-md">
                                            <img src="../../image/white.jpeg" style="height:340px; width: 300px">
                                        </div>
                                        <div class="col-md">
                                            <img src="../../image/white.jpeg" style="height:340px; width: 300px; border-color: coral;">
                                        </div>
                                        <div class="col-md" >
                                            <img src="../../image/Male.jpg" alt="Student Image" style="width:300px; border-radius: 50%;">
                                        </div>
                                        <div class="col-md">
                                            <img src="../../image/Male.jpg" alt="Student Image" style="width:300px; border-radius: 50%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } else{ ?>

                            <div class=" text-center">

                                <?php if($oops){ unset($_SESSION['Oops']); ?>

                                <div class="col">
                                    <img src="../../image/space.png" class="rounded" alt="Search">
                                </div>
                                <div class="col">
                                    <h2 class="display-4">WOOPS !! The Student doesn't seem to be here...</h2>
                                </div>
                                <?php } else { ?>
                                <div class="col">
                                    <h2 class="display-4">Search with Student ID...</h2>
                                </div>
                                <div class="col">
                                <img src="../../image/Searching.png" class="rounded" alt="Search">
                                </div>
                                <?php } ?>
                          </div>
                    <?php } ?>

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
