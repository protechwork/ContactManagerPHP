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
            <h1>Work Status Master</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item active">Work Status</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Work Status</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="categoryName">Work Status Name</label><span style="color:red;">*</span>
                                        <input type="text" class="form-control" id="work_status_name" name="work_status_name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link_status">Link Work Status</label><span style="color:red;">*</span>
                                        <select class="form-control" id="link_status" name="link_status" required="">
                                            <option value="">Select Status</option>
                                            <option value="1">Close</option>
                                            <option value="2">Hold</option>
                                            <option value="3">In Progress</option>
                                            <option value="4">Not Started</option>
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
                <h3 class="card-title">Work Status Master List</h3>
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;">Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="company_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Work Status Name</th>
                                <th>Link Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Category rows will be dynamically added here -->
                            <?php
                                // Include the database configuration file
                                require_once 'ajax/dbconfig.php';

                                // Fetch all data from the work_status_master table
                                $query = "SELECT * FROM work_status_master";
                                $result = $mysqli->query($query);

                                // Check if any rows were returned
                                if ($result->num_rows > 0) {
                                    // Loop through each row and output the data in <tbody>
                                  $index=1;
                                    while ($row = $result->fetch_assoc()) { 


                                        $statusName = $row['link_status'];  
                                        if($statusName == "1")
                                        {
                                          $statusName = "Close";
                                        }
                                        else if($statusName == "2")
                                        {
                                          $statusName = "Hold";
                                        }
                                        else if($statusName == "3")
                                        {
                                          $statusName = "In Progress";
                                        }
                                        else if($statusName == "4")
                                        {
                                          $statusName = "Not Started";
                                        }
                                        
                                        

                                        echo '<tr>';
                                        echo '<td>' . $index . '</td>';
                                        echo '<td>' . $row['name'] . '</td>';
                                        echo '<td>' . $statusName . '</td>';
                                        echo '<td><i class="fas fa-edit" onclick="get_company('.$row['id'].')"></i><i class="fas fa-trash" onclick="deleteCompany('.$row['id'].')"></i></td>';
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
      $("#work_status_name").val("");
      $("#link_status").val("");
    });
  
    function addCompany()
        {
             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/save_work_status.php",
                data: {
                  work_status_id:$("#id").val(),
                  name:$("#work_status_name").val(),
                  link_status:$("#link_status").val()
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
                url: "ajax/get_work_status.php",
                data: {
                  work_status_id:ID,
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  var company_data = response[0];
                  console.log(response);
                  $(".add-btn").trigger('click');
                  $("#id").val(company_data.id);
                  $("#work_status_name").val(company_data.name);
                  $("#link_status").val(company_data.link_status);
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
                url: "ajax/delete_work_status.php",
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
