<?php 
require_once "redirect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Master</title>

 <?php include "include_css.php"; ?>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
        <!-- Add the header and sidebar content of the AdminLTE3 template -->
        <!-- ... -->

  <!-- Main Sidebar Container -->
<?php include "sidebar.php"; ?>
        
  <div class="wrapper">
        <!-- Add the header and sidebar content of the AdminLTE3 template -->
        <!-- ... -->
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
           <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Contact Master</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Master</a></li>
                      <li class="breadcrumb-item active">Contact</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
            
          <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Contact</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                          <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Company">Select Company<span style="color:red;">*</span></label>
                                        <select class=" form-group form-control select2" id="company_id" name="company_id" required>
                                            <option value="">Select Company</option>
                                            <?php
                                                    // Include the database configuration file
                                                    require_once 'ajax/dbconfig.php';
                                                    $columnList= array();
        
                                                    // Fetch all data from the email_template table
                                                    $query = "SELECT companies.* FROM companies";
                                                    $result = $mysqli->query($query);
        
                                                    // Check if any rows were returned
                                                    if ($result->num_rows > 0)
                                                    {
                                                        // Loop through each row and output the data in <tbody>
                                                        while ($row = $result->fetch_assoc())
                                                        {                                                     
                                                          echo '<option value="' . $row['company_id'] . '">' . $row['name'] . '</option>';                                                  
                                                        }
                                                    }
                                              ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_name">Contact Person Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="email_id">Email Id<span style="color:red;">*</span></label>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="email_id" name="email_id" placeholder="Email" required>
                                        </div>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label for="user_name">User Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="mobile_no">Mobile Number<span style="color:red;">*</span></label>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile" required>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile_no">Altenative No</label>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="alt_mobile" name="alt_mobile" placeholder="Enter Altenate Mobile" required>
                                        </div>                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile_no">Desination</label>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" required>
                                        </div>                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" required>
                                        </div>                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display_name">Display Name</label>
                                        <input type="text" class="form-control" id="display_name" name="display_name" required>
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="display_image">Display Image</label>
                                        <input type="text" class="form-control" id="display_image" name="display_image" required> -->
                                        <div class="form-group">
                                            <label for="image">Display Image (JPEG, 250x80 px):</label>
                                            <input type="file" name="display_image" id="display_image" accept="image/jpeg" required="">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="status">Status<span style="color:red;">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                                    <option value="1">Active</option>
                                                    <option value="0">In Active</option>
                                      </select>
                                        
                                    </div> 
                                    

                                    <div class="form-group">
                                        <label for="user_pass">User Password<span style="color:red;">*</span></label>
                                        <input type="password" class="form-control" id="user_pass" name="user_pass" required>
                                    </div>


                                   


                                    



                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <div class="input-group mb-3">                                          
                                          <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                                        </div>                                        
                                    </div>


                                    <div class="form-group">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth" required>                                       
                                    </div>

                                    <div class="form-group">
                                        <label for="contact_type">User Type</label>
                                        <select class="form-control" id="contact_type" name="contact_type" required="">
                                          <option value="2">Contact User</option>
                                          <option value="3">Contact Admin</option>
                                          <option value="4">Contact+Agent</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                          <label for="address">Address</label>
                                          <div class="input-group mb-3">                                         
                                            <textarea type="text" class="form-control" rows="5" id="address" name="address" placeholder="Enter Address" required> </textarea>
                                          </div>                                        
                                      </div>

                                   
                                    
                                </div> 
                                
                               
                            
                            </div>
                            
                            <input type="text" class="form-control" hidden id="contact_id" name="contact_id" value="0" required>
                            <button type="button" class="btn btn-<?=$card_color?> float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                                Close
                            </button>
                            <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="create_contact()"><i class="fas fa-save"></i> Submit</button>
                        </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
            

            <!-- Main content -->
            <section class="content">
                <!--<div class="row">
                    <div class="col-md-12">
                        
                        <div class="card card-<?=$card_color?>">
                            
                            <div class="card-header">
                                <h3 class="card-title">Contact Master</h3>
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
                    <div class="col-md-12">
                        <!-- Variable Table -->
                        <div class="card card-<?=$card_color?>">
                             <div class="card-header">
                                <h3 class="card-title">Contact Master List</h3>
                                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;">Add</button>
                            </div>
                            <div class="card-body">
                                <table id="contact_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Contact Name</th>
                                            <th>Comapany Name</th>
                                            <th>Mobile No</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="variableTableBody">
                                    <?php
                                    // Include the database configuration file
                                    require_once 'ajax/dbconfig.php';

                                    // Fetch all data from the contacts table
                                    $query = "SELECT contacts.*,companies.name as company_name FROM contacts INNER JOIN companies ON companies.company_id=contacts.company_id";
                                    $result = $mysqli->query($query);

                                    // Check if any rows were returned
                                    if ($result->num_rows > 0) {
                                        // Loop through each row and output the data in <tbody>
                                      $index=1;
                                        while ($row = $result->fetch_assoc()) {                                     
                                            echo '<tr onclick="get_contact_by_id('.$row['contact_id'].')">';
                                            echo '<td>' . $index . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['company_name'] . '</td>';
                                            echo '<td>' . $row['mobile_no'] . '</td>';
                                            echo '<td>' . $row['email_id'] . '</td>';
                                            echo '<td> <i class="fas fa-trash" onclick="delete_contact('.$row['contact_id'].')"></i> </td>';
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
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        
        <!-- Add the footer content of the AdminLTE3 template -->
        <?php include "footer.php"; ?>
        <!-- ... -->
    </div>
    <!-- ./wrapper -->

<?php include "include_js.php"; ?>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>       
  $(function () {
    $("#contact_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      responsive: true,
        colReorder: true,
      "buttons": ["excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#contact_table_wrapper .col-md-6:eq(0)');

    $("#dob").datepicker({ dateFormat: 'yy-mm-dd' });

    $('.select2').select2()


/*
    $("#mobile_no").on("keypress keyup blur",function (event) { 

      $(this).val($(this).val().replace(/[^a-zA-Z ]/, ""));

      if (!((event.charCode > 64 && 
        event.charCode < 91) || event.charCode ==32 || (event.charCode > 96 && 
          event.charCode < 123))) {
          event.preventDefault();
        }
    });*/


    $('#mobile_no,#alt_mobile').keypress(function (e) {    
    
          var charCode = (e.which) ? e.which : event.keyCode    

          if (String.fromCharCode(charCode).match(/[^0-9]/g))    

              return false;                        

    }); 

    
  });
         $(".add-btn").click(function(){
            $("#contact_id").val("0");
            $("#company_id").val("");
            $("#contact_name").val("");
            $("#email_id").val("");
            $("#mobile_no").val("");
            $("#display_name").val("");
            $("#display_image").val("");
            $("#status").val("1");


            $("#alt_mobile").val("");
            $("#designation").val("");
            $("#department").val("");
            $("#address").val("");
            $("#city").val("");
            $("#dob").val("");
            
            $("#user_name").val("");
            $("#user_pass").val("");
        });
        
        function get_contact_by_id(ID)
        {
            $.ajax({
                type: "POST",
                url: "ajax/get_contact.php",
                data: {                  
                  id: ID
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                   console.log(response);
                    $(".add-btn").trigger('click');
                    var contactData = response[0];
                    $("#contact_id").val(contactData.contact_id);
                    $("#company_id").val(contactData.company_id);
                    $("#contact_name").val(contactData.name);
                    $("#email_id").val(contactData.email_id);
                    $("#mobile_no").val(contactData.mobile_no);
                    $("#display_name").val(contactData.display_name);
                    //$("#display_image").val(contactData.display_image);
                    $("#status").val(contactData.status);

                    $("#alt_mobile").val(contactData.alt_mobile);
                    $("#designation").val(contactData.designation);
                    $("#department").val(contactData.department);
                    $("#address").val(contactData.address);
                    $("#city").val(contactData.city);
                    $("#dob").val(contactData.dob);
                    
                    get_contact_login_by_id(contactData.contact_id);
                   
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
        }
        
         function get_contact_login_by_id(ID)
        {
            $.ajax({
                type: "POST",
                url: "ajax/get_contact_login.php",
                data: {                  
                  id: ID
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                   console.log(response);
                    var contactData = response[0];
                    $("#user_name").val(contactData.user_id);
                    $("#user_pass").val(contactData.password);
                    $("#contact_type").val(contactData.is_admin);
                   
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while Fetching login details.");
                }
              });
        }
    
        function create_contact()
        {
            /*
            //https://webkul.com/blog/send-images-through-ajax/
            formdata = new FormData(); 
            var file = $("#image_to_upload").files[0];
            formdata.append("image", file);
            
            formdata.append("contact_id" , $("#contact_id").val());
            formdata.append("company_id" , $("#company_id").val());
            formdata.append("contact_name" , $("#contact_name").val());
            formdata.append("email_id" , $("#email_id").val());
            formdata.append("mobile_no" , $("#mobile_no").val());
            formdata.append("display_name" , $("#display_name").val());
            formdata.append("display_image" , $("#display_image").val());
            formdata.append("status" , $("#status").val());
            
            formdata.append("user_name" , $("#user_name").val());
            formdata.append("user_pass" , $("#user_pass").val());
            
            
            */
            
            
            formdata = new FormData(); 
            var file = $("#display_image")[0].files[0];
            formdata.append("display_image", file);
            
            formdata.append("contact_id" , $("#contact_id").val());
            formdata.append("company_id" , $("#company_id").val());
            formdata.append("contact_name" , $("#contact_name").val());
            formdata.append("email_id" , $("#email_id").val());
            formdata.append("mobile_no" , $("#mobile_no").val());
            formdata.append("display_name" , $("#display_name").val());
            //formdata.append("display_image" , $("#display_image").val());
            formdata.append("status" , $("#status").val());

            formdata.append("alt_mobile", $("#alt_mobile").val());
            formdata.append("designation", $("#designation").val());
            formdata.append("department", $("#department").val());
            formdata.append("address", $("#address").val());
            formdata.append("city", $("#city").val());
            formdata.append("dob",$("#dob").val());
            
            formdata.append("user_name" , $("#user_name").val());
            formdata.append("user_pass" , $("#user_pass").val());
            formdata.append("user_type" , $("#contact_type").val());
            
             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/save_contact.php",
                data: formdata/*{                  
                  contact_id: $("#contact_id").val(),
                  company_id: $("#company_id").val(),
                  contact_name: $("#contact_name").val(),
                  email_id: $("#email_id").val(),
                  mobile_no: $("#mobile_no").val(),
                  display_name: $("#display_name").val(),
                  display_image: $("#display_image").val(),
                  status: $("#status").val(),
                  
                  user_name: $("#user_name").val(),
                  user_pass: $("#user_pass").val()
                }*/,
                contentType: false,
                 processData: false,
                //dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  if (JSON.parse(response).status === "success") {
                    // Display success message
                    alert("Database updated successfully.");
                    location.reload(true);
                  } else {
                    // Display error message
                    alert(JSON.parse(response).msg);
                  }
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
        }

        function delete_contact(ID)
        {
            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: "ajax/delete_contact.php",
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
