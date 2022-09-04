<?php

include "Teacher Login/login.php";
include "Student Login/login.php";
include "Student Login/register.php";
include "Teacher Login/register.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .responsive {
          max-width: 100%;
          height: auto;
        }
    </style>

    <title>Welcome Page</title>
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 200px;">
      <div class="row align-items-center">
        <div class="col-3">
          <img src="image/ksit_logo.png" width="140" class="responsive" alt="KSIT Logo">
        </div>
        <div class="col-9">
          <img src="image/ksit.png" width="700" class="responsive" alt="KSIT Logo">
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContents" aria-controls="navContents" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navContents">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Departments
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Artificial Intelligence & Machine Learning Engineering</a>
              <a class="dropdown-item" href="#">Computer Science and Design</a>
              <a class="dropdown-item" href="#">Computer Science and Engineering</a>
              <a class="dropdown-item" href="#">Electronics & Communication Engineering</a>
              <a class="dropdown-item" href="#">Mechanical Engineering</a>
              <a class="dropdown-item" href="#">Science & Humanities</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!-- <hr  class="my-1"> -->
    <div class="d-flex align-items-center justify-content-center" style="height: 100px;">
      <h2 class="display-5 text-center">Student Information Management System</h2>
    </div>
    <div class="jumbotron">
      <div class="row">
        <div class="col-3">
          <div class="nav flex-column nav-pills">
            <a class="nav-link active" href="#AI_ML" data-toggle="pill">Computer Science and Engineering</a>
            <a class="nav-link" href="#CSD" data-toggle="pill">Computer Science and Design</a>
            <a class="nav-link" href="#CSE" data-toggle="pill">Artificial Intelligence & Machine Learning Engineering</a>
            <a class="nav-link" href="#ECE" data-toggle="pill">Electronics & Communication Engineering</a>
            <a class="nav-link" href="#ME" data-toggle="pill">Mechanical Engineering</a>
            <a class="nav-link" href="#SH" data-toggle="pill">Science & Humanities</a>
          </div>
        </div>
        <div class="col-9">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="AI_ML">
              <div class="card">
                <h5 class="card-header">Computer Science and Engineering</h5>
                <div class="card-body">
                  <div class="row text-center">
                    <div class="col-md-6">
                      <h2 class="display-6">Teacher</h2>
                      <div class="text-center col-12">
                        <img src="image/Teacher.jpg" class="responsive" alt="Students">
                      </div>
                      <div class="form-row">
                        <div class="form-group col">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#TeacherLogin">
                                Login
                              </button>
                        </div>
                        <div class="modal fade" id="TeacherLogin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="TeacherLoginLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <form action="" method="post">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="TeacherLoginLabel">Teacher Login</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                      <div class="form-group">
                                        <h4>Teacher Name</h4>
                                        <input type="text" name="username" class="form-control" placeholder="Enter Teacher Name *" required>
                                      </div>
                                      <div class="form-group ">
                                        <h4>Password</h4>
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password *" required>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" name="TeacherLogin" class="btn btn-primary">Log In</button>
                                      <button data-dismiss="modal" type="button" class="btn btn-outline-danger">Cancel</a>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col ">
                            <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#TeacherSignUp">
                                Sign Up
                              </button>
                        </div>
                        <div class="modal fade" id="TeacherSignUp" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="TeacherSignUpLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <form action="" method="post">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="TeacherSignUpLabel">Teacher SignUp</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body text-left">
                                      <div class="mb-3">
                                          <h4 class="form-label">User Name</h4>
                                          <input type="text" name="username" class="form-control" placeholder="Enter User Name" required>
                                      </div>
                                      <div class="mb-3">
                                        <h4 class="form-label">New Password</h4>
                                        <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>
                                      </div>
                                      <div class="mb-3">
                                        <h4 class="form-label">Confirm Password</h4>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" name="TeacherSignUp" class="btn btn-primary">Sign Up</button>
                                      <button data-dismiss="modal" type="button" class="btn btn-outline-danger">Cancel</a>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h2 class="display-6">Student</h2>
                      <div class="text-center col-12">
                          <img src="image/College_Students.jpg"  width="490"  class="responsive" alt="Students">
                      </div>
                      <div class="form-row">
                        <div class="form-group col">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#StudentLogin">
                                Login
                              </button>
                        </div>
                        <div class="modal fade" id="StudentLogin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="StudentLoginLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <form action="" method="post">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="StudentLoginLabel">Student Login</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-left">
                                    <div class="form-group">
                                      <h4>Student ID</h4>
                                      <input type="text" name="uniqueId" class="form-control" placeholder="Enter Student ID *" required>
                                    </div>
                                    <div class="form-group ">
                                      <h4>Password</h4>
                                      <input type="password" name="password" class="form-control" placeholder="Enter Password *" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="StudentLogin" class="btn btn-primary">Log In</button>
                                    <button data-dismiss="modal" type="button" class="btn btn-outline-danger">Cancel</a>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col">
                            <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#StudentSignUp">
                                Sign Up
                              </button>
                        </div>
                        <div class="modal fade" id="StudentSignUp" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="StudentSignUpLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                              <form action="" method="post">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="StudentSignUpLabel">Student SignUp</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-left">
                                  <div class="mb-3">
                                      <h4 class="form-label">Student ID</h4>
                                      <input type="text" name="uniqueId" class="form-control" placeholder="Enter Student ID" required>
                                  </div>
                                  <div class="mb-3">
                                    <h4 class="form-label">New Password</h4>
                                    <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>
                                  </div>
                                  <div class="mb-3">
                                    <h4 class="form-label">Confirm Password</h4>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="StudentSignUp" class="btn btn-primary">Sign Up</button>
                                    <button data-dismiss="modal" type="button" class="btn btn-outline-danger">Cancel</a>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="tab-pane fade" id="CSD">2</div>
            <div class="tab-pane fade" id="CSE">3</div>
            <div class="tab-pane fade" id="ECE">4</div>
            <div class="tab-pane fade" id="ME">5</div>
            <div class="tab-pane fade" id="SH">6</div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
