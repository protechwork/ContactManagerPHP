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
            <h1>Project Master</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Project</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="categoryName">Project Name</label><span style="color:red;">*</span>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Company">Select Company</label><span style="color:red;">*</span>
                                        <select class="form-control" id="company_id" name="company_id" required>
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
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="categoryName">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link_status">Type</label>
                                        <select class="form-control" id="type" name="type" required="">
                                            <option value="">Select Type</option>
                                            <option value="1">AMC Support</option>
                                            <option value="2">Sales</option>
                                            <option value="3">Recovery</option>
                                            <option value="4">Developement</option>
                                            <option value="5">Implementation</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="categoryName">Receipt Amount</label>
                                        <input type="text" class="form-control" onfocusout="calculatePenddingAmount();" id="receipt_amount" name="receipt_amount" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="categoryName">Pendding Amount</label>
                                        <input type="text" class="form-control"  id="pending_amount" disabled name="pending_amount" required>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link_status">Financial Status</label>
                                        <select class="form-control" id="f_status" name="f_status" required="">
                                            <option value="">Select Status</option>
                                            <option value="1">PO Pendding</option>
                                            <option value="2">PO Recieve</option>
                                            <option value="3">Billed</option>
                                            <option value="4">Partial Payment</option>
                                            <option value="5">Payment Clear</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link_status">Work Status</label>
                                        <select class="form-control" id="status" name="status" required="">
                                            <option value="">Select Work Status</option>
                                            <?php
                                                    // Include the database configuration file
                                                    require_once 'ajax/dbconfig.php';
                                                    $columnList= array();
        
                                                    // Fetch all data from the email_template table
                                                    $query = "SELECT work_status_master.* FROM work_status_master";
                                                    $result = $mysqli->query($query);
        
                                                    // Check if any rows were returned
                                                    if ($result->num_rows > 0)
                                                    {
                                                        // Loop through each row and output the data in <tbody>
                                                        while ($row = $result->fetch_assoc())
                                                        {                                                     
                                                          echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';                                                  
                                                        }
                                                    }
                                              ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                                Close
                            </button>
                            <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
                            <input type="text" hidden class="form-control" id="id" name="id" required>
                        </form>
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
                
        <div class="row">
          <div class="col-12">
            <div class="card card-<?=$card_color?>">
              <div class="card-header">
                <h3 class="card-title">Project List</h3>
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;">Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="company_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Project Name</th>
                                <th>Company Name</th>
                                <th>Type</th>
                                <th>Work Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Category rows will be dynamically added here -->
                            <?php
                                // Include the database configuration file
                                require_once 'ajax/dbconfig.php';

                                // Fetch all data from the project table
                                $query = "SELECT project.id,project.name AS project_name, companies.name AS company_name, 
                                (CASE 
                                    WHEN project.type = 1 THEN 'AMC Support'
                                    WHEN project.type = 2 THEN  'Sales'
                                    WHEN project.type = 3 THEN  'Recovery'
                                    WHEN project.type = 4 THEN 'Developement'
                                   WHEN project.type = 5 THEN 'Implementation'
                                    ELSE 'Not Defined'
                                END) AS type_name,
                                work_status_master.name as status_name
                            FROM project INNER JOIN companies ON project.company_id=companies.company_id
                            LEFT JOIN work_status_master ON project.status=work_status_master.id";

                                $result = $mysqli->query($query);

                                // Check if any rows were returned
                                if ($result->num_rows > 0) {
                                    // Loop through each row and output the data in <tbody>
                                  $index=1;
                                    while ($row = $result->fetch_assoc()) {                                              
                                        echo '<tr onclick="get_company('.$row['id'].')">';
                                        echo '<td>' . $index . '</td>';
                                        echo '<td>' . $row['project_name'] . '</td>';
                                        echo '<td>' . $row['company_name'] . '</td>';
                                        echo '<td>' . $row['type_name'] . '</td>';
                                        echo '<td>' . $row['status_name'] . '</td>';
                                        echo '<td><i class="fas fa-trash" onclick="deleteCompany('.$row['id'].')"></i></td>';
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
  
    $(".add-btn").click(function(){
        $("#id").val("");
        $("#name").val("");
        $("#company_id").val("");
        $("#amount").val("");
        $("#receipt_amount").val("");
        $("#pending_amount").val("");
        $("#type").val("");
        $("#f_status").val("");
        $("#status").val("");
    });
    
    function calculatePenddingAmount()
    {
        var peddingAmount = Number($("#amount").val()) -  Number($("#receipt_amount").val()) ;
        
        if(peddingAmount != NaN)
        {
            $("#pending_amount").val(peddingAmount);
        }
        else
        {
             $("#pending_amount").val(0);
        }
        
    }
  
    function addCompany()
        {
             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/save_project.php",
                data: {
                   id:$("#id").val(),
                     name:$("#name").val(),
                     company_id:$("#company_id").val(),
                     amount:$("#amount").val(),
                     receipt_amount:$("#receipt_amount").val(),
                     pending_amount:$("#pending_amount").val(),
                     type:$("#type").val(),
                     f_status:$("#f_status").val(),
                     status:$("#status").val()
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
                    alert('Please fill in all Mandatory fields.');
                  }
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
        }
        
        function get_company(ID)
        {
            $.ajax({
                type: "POST",
                url: "ajax/get_project.php",
                data: {
                  id:ID,
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  var company_data = response[0];
                  console.log(response);
                  $(".add-btn").trigger('click');

                    $("#id").val(company_data.id);
                    $("#name").val(company_data.name);
                    $("#company_id").val(company_data.company_id);
                    $("#amount").val(company_data.amount);
                    $("#receipt_amount").val(company_data.receipt_amount);
                    $("#pending_amount").val(company_data.pending_amount);
                    $("#type").val(company_data.type);
                    $("#f_status").val(company_data.finacial_status);
                    $("#status").val(company_data.status);
        
        
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
              
        }

        function deleteCompany(ID)
        {
            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: "ajax/delete_project.php",
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
