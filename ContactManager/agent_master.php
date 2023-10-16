<?php 
require_once "redirect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Company Master</title>

<?php include "include_css.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <?php include "sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agent Master</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Agent</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Agent</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                <div class="card-body p-0">
                                <div class="bs-stepper linear">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step active" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Login Details</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Personal Info</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#login-tab">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="login-tab" id="login-tab-trigger" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Notification Mode</span>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="bs-stepper-content">
                                    
                                    <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User ID</label><span style="color:red;">*</span>
                                                    <input type="text" class="form-control" id="user_id" name="user_id" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label><span style="color:red;">*</span>
                                                    <div class="input-group mb-3">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                      </div>
                                                      <input type="password" class="form-control" id="password" name="password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agent Type</label><span style="color:red;">*</span>
                                                    <select class="form-control select2" id="agent_type" name="agent_type" required>
                                                        <option value="">Please Select Agent Type</option>
                                                        <option value="1">Support</option>
                                                        <option value="2">Impementation</option>
                                                        <option value="3">Sales</option>                                                        
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="col-sm-6">                                               
                                                <label>Is Admin</label>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_admin">
                                                    <label class="form-check-label" for="exampleCheck2">Is Admin</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="validateLoginDetails()">Next</button>
                                    </div>
                                    
                                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Person Name</label><span style="color:red;">*</span>
                                                    <input type="text" class="form-control" id="person_name" name="person_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact In Difficulty</label>
                                                    <input type="text" class="form-control" id="contact_in_difficulty" name="contact_in_difficulty" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Reporting To</label>
                                                    <select multiple class="form-control select2" id="reporting_to" name="reporting_to" required>
                                                        <?php
                                                            require_once 'ajax/dbconfig.php';
                            
                                                            $query = "SELECT * FROM agent_master";
                                                            $result = $mysqli->query($query);
                            
                                                            // Check if any rows were returned
                                                            if ($result->num_rows > 0) {
                                                                // Loop through each row and output the data in <tbody>
                                                                while ($row = $result->fetch_assoc()) {                                              
                                                                    echo '<option value="'.$row['id'].'">' . $row['name'] . '</option>';
                                                                }
                                                            }
                                                            // Close the database connection
                                                            //$mysqli->close();
                                                        ?>
                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>PAN</label>
                                                    <input type="text" class="form-control" id="pan" name="pan" />
                                                </div>

                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" id="city" name="city" />
                                                </div>

                                                



                                            </div>
                                            <div class="col-md-6">
                                                

                                                <div class="form-group">
                                                    <label>Aadhar</label>
                                                    <input type="text" class="form-control" id="aadhar" name="aadhar" />
                                                </div>

                                                <!--
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="text" class="form-control" id="photo" name="photo" />
                                                    </div>
                                                -->

                                                <div class="form-group">
                                                    <label for="image">Agent Image (JPEG, 250x80 px):</label>
                                                    <input type="file" name="photo" id="photo" accept="image/jpeg" required="">
                                                </div>

                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea type="text" class="form-control" id="address" name="address" required></textarea>
                                                </div>

                                            </div>
                                        </div>
                            
                                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                        <button class="btn btn-primary" onclick="ValidatePersonalInfo()">Next</button>
                                    </div>
                                    
                                    <div id="login-tab" class="content" role="tabpanel" aria-labelledby="login-tab-trigger">
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label><span style="color:red;">*</span>
                                                    <div class="input-group mb-3">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                      </div>
                                                      <input type="text" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>WhatApp No</label><span style="color:red;">*</span>
                                                    <input type="text" class="form-control" id="whatapp_no" name="whatapp_no" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile No</label><span style="color:red;">*</span>
                                                    <div class="input-group mb-3">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                      </div>
                                                      <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SMTP</label>
                                                    <input type="text" class="form-control" id="smtp" name="smtp" required>
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
                                                      <input type="text" class="form-control" id="email_password" name="email_password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                        
                                        <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
                            
                            
                                    </div>
                                    
                                </div>
                                
                                </div>
                                </div>
                                
                                <!--<div class="card-footer">
                                Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
                                </div>-->
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        <!--
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control" id="person_name" name="person_name" placeholder="Person Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="contact_in_difficulty" name="contact_in_difficulty" placeholder="Contact In Difficulty" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select multiple class="form-control select2" id="reporting_to" name="reporting_to" placeholder="Reporting To" required>
                                            <option value="2">Agent 1</option>
                                            <option value="3">Agent 2</option>
                                            <option value="7">Agent 3</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="address" name="address" placeholder="Address" required></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_admin">
                                        <label class="form-check-label" for="exampleCheck2">Is Admin</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="whatapp_no" name="whatapp_no" placeholder="WhatApp No" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="smtp" name="smtp" placeholder="SMTP" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email_password" name="email_password" placeholder="Email Password" required>
                                    </div>
                                </div>
                            </div> 
                                        
                                        
                            <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                                Close
                            </button>
                            <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
                        </form>
                        
                        -->
                        
                        
                        <!--
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Personal Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Login Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Notification Mode</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Person Name</label>
                                                    <input type="text" class="form-control" id="person_name" name="person_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Contact In Difficulty</label>
                                                    <input type="text" class="form-control" id="contact_in_difficulty" name="contact_in_difficulty" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Reporting To</label>
                                                    <select multiple class="form-control select2" id="reporting_to" name="reporting_to" required>
                                                        <option value="2">Agent 1</option>
                                                        <option value="3">Agent 2</option>
                                                        <option value="7">Agent 3</option>                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Address</label>
                                                    <textarea type="text" class="form-control" id="address" name="address" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">User ID</label>
                                                    <input type="text" class="form-control" id="user_id" name="user_id" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Password</label>
                                                    <input type="text" class="form-control" id="password" name="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_admin">
                                                    <label class="form-check-label" for="exampleCheck2">Is Admin</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">WhatApp No</label>
                                                    <input type="text" class="form-control" id="whatapp_no" name="whatapp_no" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Mobile No</label>
                                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">SMTP</label>
                                                    <input type="text" class="form-control" id="smtp" name="smtp" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryName">Email Password</label>
                                                    <input type="text" class="form-control" id="email_password" name="email_password" required>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
                        
                        <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                            Close
                        </button>
                        <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
                        
                        
                         -->


                    </div>
                    <!--<div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>-->
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <!--<div class="row">
                <div class="col-md-6">
                   
                    <div class="card card-<?=$card_color?>">
                        <div class="card-header">
                            <h3 class="card-title">Company Master</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <button type="button" class="btn btn-<?=$card_color?>" data-toggle="modal" data-target="#modal-lg" >Add</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>-->
                
        <div class="row">
          <div class="col-12">
            <div class="card card-<?=$card_color?>">
              <div class="card-header">
                <h3 class="card-title">Agent Master List</h3>
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;">Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="company_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Agent Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Category rows will be dynamically added here -->
                            <?php
                                // Include the database configuration file
                                require_once 'ajax/dbconfig.php';

                                // Fetch all data from the agent_master table
                                $query = "SELECT * FROM agent_master INNER JOIN agent_notification ON agent_master.id=agent_notification.agent_id GROUP by agent_master.id";
                                $result = $mysqli->query($query);

                                // Check if any rows were returned
                                if ($result->num_rows > 0) {
                                    // Loop through each row and output the data in <tbody>
                                  $index=1;
                                    while ($row = $result->fetch_assoc()) {                                              
                                        echo '<tr>';
                                        echo '<td>' . $index . '</td>';
                                        echo '<td>' . $row['name'] . '</td>';
                                        echo '<td>' . $row['email'] . '</td>';
                                        echo '<td>' . $row['mobile_no'] . '</td>';
                                        //echo '<td><button class="btn btn-danger" onclick="deleteCompany('.$row['id'].')"><i class="fas fa-trash"></i></button></td>';
                                        echo '<td><i style="margin: 0 10px;cursor: pointer;" class="fas fa-edit" onclick="GetAgent('.$row['id'].')"></i> <i style="margin: 0 10px;cursor: pointer;" class="fas fa-trash" onclick="deleteCompany('.$row['id'].')"></i></td>';
                                        echo '</tr>';
                                  $index++;
                                    }
                                } else {
                                    // No rows found
                                    echo '<tr><td colspan="3">No data found.</td></tr>';
                                }

                                // Close the database connection
                                $mysqli->close();
                            ?>

                        </tbody>
                        
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php"; ?>
</div>
<!-- ./wrapper -->

<?php include "include_js.php"; ?>


<!-- Page specific script -->
<script>
  
  /*
  $(function () {
    $("#company_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "bAutoWidth": false, // Disable the auto width calculation 
        "aoColumns": [
          { "sWidth": "10%" }, // 1st column width 
          { "sWidth": "70%" }, // 2nd column width 
          { "sWidth": "20%" } // 3rd column width and so on 
        ],
      "buttons": ["excel", "pdf", "colvis"
   ]
    }).buttons().container().appendTo('#company_table_wrapper .col-md-6:eq(0)');
    
  });
  */

  $(function () {
    $("#company_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "colvis"/*, { 
          sExtends: 'excel',
          text: 'View'
        }*/
   ]
    }).buttons().container().appendTo('#company_table_wrapper .col-md-6:eq(0)');
    
  });
  
  
    // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
  
  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
    var agentID = "";

    function ValidatePersonalInfo()
    {
        if ($("#person_name").val() == "")
        {
            Toast.fire({
                icon: 'error',
                title: "Please Fill all Mandatory Fileds"
            });
        }
        else
        {
            stepper.next();
        }
    }
    function validateLoginDetails ()
    {
        if ($("#user_id").val() == "")
        {
            Toast.fire({
                icon: 'error',
                title: "Please Fill all Mandatory Fileds"
            });
        } else if ($("#password").val() == "")
        {
            Toast.fire({
                icon: 'error',
                title: "Please Fill all Mandatory Fileds"
            });
        }
        else if ($("#agent_type").val() == "")
        {
            Toast.fire({
                icon: 'error',
                title: "Please Fill all Mandatory Fileds"
            });
        }
        else
        {
            stepper.next();
        }
        
    }
    
  
    $(".add-btn").click(function(){
      //console.log("clicked");
     
        $('#person_name').val("");
        $('#contact_in_difficulty').val("");
        $('#address').val("");
        
        $('#user_id').val("");
        $('#password').val("");
        $('#is_admin').prop('checked', 0);
        
        $('#email').val("");
        $('#whatapp_no').val("");
        $('#mobile_no').val("");
        $('#smtp').val("");
        $('#email_password').val(""); 


        $("#city").val("");
        $("#aadhar").val("");
        $("#pan").val("");
        //$("#photo").val("");
        
        
        $("#reporting_to").val("").trigger('change');
        
        agentID = "";
 
    });
    
    $('#reporting_to').select2();
    //$("#reporting_to").val('').trigger('change');$("#reporting_to").val(['3','7']).trigger('change');
    

    
    function GetAgent(AgentID)
    {
        
        $.ajax({
        type: "GET",
        url: "ajax/get_agent.php",
        data: { id: AgentID },
        dataType: "json",
        success: function (response) {
            if (response.error) {
                // Handle error response
                console.log(response.error);
            } else {
                
                var agentData = response;
                console.log(agentData);
                $(".add-btn").trigger('click');
                agentID = AgentID;
                $('#person_name').val(agentData.name);
                $('#contact_in_difficulty').val(agentData.difficulty_contact);
                $('#address').val(agentData.address);
                
                $('#user_id').val(agentData.user_id);
                $('#password').val(agentData.password);
                $('#is_admin').prop('checked', agentData.is_admin);

                $('#is_admin').prop('checked', false);
                if(agentData.is_admin == "0")
                {
                    $('#is_admin').prop('checked', true);
                }
                
                $('#email').val(agentData.email);
                $('#whatapp_no').val(agentData.whatsapp_no);
                $('#mobile_no').val(agentData.mobile_no);
                $('#smtp').val(agentData.smtp);
                $('#email_password').val(agentData.email_pasword);   
                
                $("#agent_type").val(agentData.agent_type);

                $("#city").val(agentData.city);
                $("#aadhar").val(agentData.aadhar_no);
                $("#pan").val(agentData.pan_no);
                $("#photo").val(agentData.photo);
                
                
               
                
                var reportingToIds = agentData.reportingToIds;
                $("#reporting_to").val(reportingToIds).trigger('change');
                /*$.each(reportingToIds, function(i, obj) {
                  use obj.id and obj.name here, for example:
                  alert(obj.name);
                });*/
    
               
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.log(error);
        }
    });

    }
    function addCompany()
        {
            
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
            var emailPassword = $("#email_password").val();

            var agentType = $("#agent_type").val();



            formdata = new FormData(); 
            var file = $("#photo")[0].files[0];
            formdata.append("photo", file);

            formdata.append("id", agentID);
            formdata.append("person_name",  personName);
            formdata.append("contact_in_difficulty",  contactDifficulty);
            formdata.append("address",  address);
            formdata.append("reporting_to",  reportingTo);
            formdata.append("user_id",  userId);
            formdata.append("password",  password);
            formdata.append("is_admin",  isAdmin);
            formdata.append("email",  email);
            formdata.append("whatapp_no",  whatsappNo);
            formdata.append("mobile_no",  mobileNo);
            formdata.append("smtp",  smtp);
            formdata.append("agent_type", agentType);
            formdata.append("email_password",  emailPassword);
            formdata.append("city",  $("#city").val());
            formdata.append("aadhar_no",  $("#aadhar").val());
            formdata.append("pan_no",  $("#pan").val());




        
            // Validate fields
            if (personName === "" || mobileNo === "" || userId === "" || email === "") {
              
              Toast.fire({
                    icon: 'error',
                    title: "Please fill in all Mandatory fields."
                });
              return;
            }
        
            // AJAX request
            $.ajax({
              url: "ajax/save_agent.php",
              type: "POST",
              data: formdata,
              /*data: {
                id:agentID,
                person_name: personName,
                contact_in_difficulty: contactDifficulty,
                address: address,
                reporting_to: reportingTo,
                user_id: userId,
                password: password,
                is_admin: isAdmin,
                email: email,
                whatapp_no: whatsappNo,
                mobile_no: mobileNo,
                smtp: smtp,
                agent_type:agentType,
                email_password: emailPassword,

                photo:$("#photo")[0].files[0],

                city: $("#city").val(),
                aadhar_no: $("#aadhar").val(),
                pan_no: $("#pan").val()
              },*/
              //dataType: "json",
                contentType: false,
                processData: false,
              success: function(response) {
                var res = JSON.parse(response);
                if (res.status === "success") {
                  Toast.fire({
                    icon: 'success',
                    title: 'Data Saved Successfully'
                    });
                  // Redirect or perform additional actions
                  setTimeout( function(){ 
                    location.reload(true);
                  }  , 2000 );
                } else {
                  Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
              },
              error: function() {
                alert("Error occurred during the AJAX request.");
              }
            });





               /*Toast.fire({
                    icon: 'success',
                    title: 'Data Saved Successfully'
                });*/
             
             // Send the AJAX request
             /*$.ajax({
                type: "POST",
                url: "ajax/save_company.php",
                data: {
                  company_name:$("#companyName").val(),
                  gst:$("#gst").val(),  
                  address:$("#address").val()  
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  if (response.status === "success") {
                    // Display success message
                    alert("Database updated successfully.");
                    location.reload(true);
                  } else if (response.status === "exist") {
                    // Display success message
                    alert("Record Already Found in Database.");
                  }  else {
                    // Display error message
                    alert("Failed to update Database.");
                  }
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });*/
        }

        function deleteCompany(ID)
        {
            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: "ajax/delete_company.php",
                data: {
                  id:ID
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  if (response.status === "success") {
                    // Display success message
                    alert("Database updated successfully.");
                    location.reload(true);
                  }else if (response.status === "exist") {
                    // Display success message
                    alert("Record Already Found in Contact.");
                  } else {
                    // Display error message
                    alert("Failed to update Database.");
                  }
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
        }
</script>
</body>
</html>
