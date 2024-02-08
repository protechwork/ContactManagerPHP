<?php
    //session_start();
    //session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Manager | Log in</title>
    <link rel="icon" href="https://www.icsweb.in/image/ICS%20ICON.png">
    <!-- Google Font: Source Sans Pro dsg fdsg  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <!--<link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Toast Css -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select css -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Stepper -->
    <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  </head>
  <body class="hold-transition login-page">
    <div>
      <div class="login-logo">
        <a href="login.php">
          <b>Ticket Management System Installation Wizard</b>
        </a>
      </div>
      <!-- /.login-logo -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body p-0">
                <div class="bs-stepper linear">
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step active" data-target="#step1">
                      <button type="button" class="step-trigger" role="tab" aria-controls="step1" id="step1-trigger" aria-selected="true">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Database Configuration</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Admin Agent User Configuration</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#login-tab">
                      <button type="button" class="step-trigger" role="tab" aria-controls="login-tab" id="login-tab-trigger" aria-selected="false" disabled="disabled">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Complete</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <div id="step1" class="content active dstepper-block" role="tabpanel" aria-labelledby="step1-trigger">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Host Name</label>
                            <span style="color:red;">*</span>
                            <input type="text" class="form-control" id="host_name" name="host_name" value="localhost" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>MySQL User Name</label>
                            <span style="color:red;">*</span>
                            <input type="text" class="form-control" id="user_name" name="user_name" value="icsweho2_tkadmin" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>MySQL Password</label>
                            <span style="color:red;">*</span>
                            <input type="text" class="form-control" id="password" name="password" value="icsweho2_test_user" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Database Name</label>
                            <span style="color:red;">*</span>
                            <input type="text" class="form-control" id="database_name" name="database_name" value="icsweho2_icsticket" required>
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary" onclick="step1()">Next</button>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Person Name</label>
                            <span style="color:red;">*</span>
                            <input type="text" class="form-control" id="person_name" name="person_name" value="Aamer" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Mobile No</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="123456" required>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User ID</label><span style="color:red;">*</span>
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="Aamer" required="">
                                </div>
                            </div>                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label><span style="color:red;">*</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" value="123" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label><span style="color:red;">*</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="email" name="email" value="rakesh@icsweb.in" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SMTP</label>
                                    <input type="text" class="form-control" id="smtp" name="smtp" value="smtp.gmail.com" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="email_password" name="email_password" value="icsweb.@#123" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Port</label>
                                    <input type="text" class="form-control" id="port" name="port" value="465" required="">
                                </div>
                            </div>
                        </div>

                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" onclick="step2()">Next</button>
                    </div>
                    <div id="login-tab" class="content" role="tabpanel" aria-labelledby="login-tab-trigger">                      
                      <div class="row">
                        Finishing
                      </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;"> Close </button>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <!--<script src="../plugins/jqvmap/jquery.vmap.min.js"></script><script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!--<script src="dist/js/demo.js"></script>-->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="dist/js/pages/dashboard.js"></script>-->
    <!-- DataTables  & ../Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Toast JS -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Select Plugin -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Stepper -->
    <script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script>
      // Add a click event handler for the "Settings" dropdown item
      document.getElementById("settingsDropdown").addEventListener("click", function(event) {
        // Prevent the default behavior (closing the dropdown)
        event.preventDefault();
        // Toggle the visibility of the submenu
        const submenu = document.getElementById("settingsSubmenu");
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
      });
    </script>
    <script>
      // BS-Stepper Init
      document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      })
      $("#password").keypress(function(e) {
        if (e.which == 13) {
          login();
        }
      });

      function login() {
        // Send the AJAX request
        $.ajax({
          type: "POST",
          url: "ajax/user_login.php",
          data: {
            user_name: $("#email").val(),
            user_pass: $("#password").val()
          },
          dataType: "json",
          success: function(response) {
            // Handle the response from the server
            if (Number(response.user_id) > 0) {
              window.location = "index.php";
            } else {
              // Display error message
              alert("login failed");
            }
          },
          error: function() {
            // Display error message
            alert("An error occurred while updating Database.");
          }
        });
        /*if($("#email").val()=="admin" && $("#password").val()=="123")
        {
            window.location = "index.php";
        }*/
      }


    function step1 ()
    {  
        // Send the AJAX request
        $.ajax({
          type: "POST",
          url: "create_db_config.php",
          data: {
            host_name:$("#host_name").val(),
            user_name:$("#user_name").val(),
            password:$("#password").val(),
            database_name:$("#database_name").val()
          },
          //dataType: "json",
          success: function(response) {
            alert(response);
            stepper.next();   
          },
          error: function() {
            // Display error message
            //alert("An error occurred while updating Database.");
          }
        });

                     
    }

    function step2 ()
    {     
        //stepper.next();          
        //return;
        var personName = $("#person_name").val();
        var contactDifficulty = $("#contact_in_difficulty").val();
        var address = $("#address").val();
        var reportingTo = $("#reporting_to").val();
        var userId = $("#user_id").val();
        var password = $("#password").val();
        var isAdmin = $("#is_admin").is(":checked") ? 1 : 0;
        var email = $("#email").val();
        var whatsappNo = $("#whatapp_no").val();
        var mobileNo = $("#mobile_no").val();
        var smtp = $("#smtp").val();
        var port = $("#port").val();
        var emailPassword = $("#email_password").val();

        var agentType = $("#agent_type").val();


        formdata = new FormData(); 
        /*var file = $("#photo")[0].files[0];
        formdata.append("photo", file);*/

        formdata.append("photo", '');
        formdata.append("id", '');
        formdata.append("person_name",  personName);
        formdata.append("contact_in_difficulty",  contactDifficulty);
        formdata.append("address",  address);
        formdata.append("reporting_to",  reportingTo);
        formdata.append("user_id",  userId);
        formdata.append("password",  password);
        formdata.append("is_admin",  isAdmin);
        formdata.append("email",  email);
        //formdata.append("whatapp_no",  whatsappNo);
        formdata.append("whatapp_no",  mobileNo);
        formdata.append("mobile_no",  mobileNo);
        formdata.append("smtp",  smtp);
        formdata.append("port",  port);
        formdata.append("agent_type", agentType);
        formdata.append("email_password",  emailPassword);
        formdata.append("city",  $("#city").val());
        formdata.append("aadhar_no",  $("#aadhar").val());
        formdata.append("pan_no",  $("#pan").val());
    
        // Validate fields
        if (personName === "" || mobileNo === "" || userId === "" || email === "") {
            
            /*Toast.fire({
                icon: 'error',
                title: "Please fill in all Mandatory fields."
            });*/
            alert("Please fill in all Mandatory fields.");
            return;
        }
    
        // AJAX request
        $.ajax({
            url: "save_agent.php",
            type: "POST",
            data: formdata,              
            //dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
            var res = JSON.parse(response);
            if (res.status === "success") {
                alert("Admin User Created");
                stepper.next();  
                /*
                Toast.fire({
                icon: 'success',
                title: 'Data Saved Successfully'
                });
                // Redirect or perform additional actions
                setTimeout( function(){ 
                location.reload(true);
                }  , 2000 );
                */



            } else {
                
              /*
                Toast.fire({
                    icon: 'error',
                    title: response.message
                });

                */
            }
            },
            error: function() {
            alert("Error occurred during the AJAX request.");
            }
        });        

                      
    }






    </script>
  </body>
</html>