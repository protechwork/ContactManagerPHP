<?php 
require_once "redirect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings</title>

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
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
                <div class="col-md-6">
                    <!-- Company Master Form -->
                    <div class="card card-<?=$card_color?>">
                        <div class="card-header">
                            <h3 class="card-title">Setting</h3>
                            <button type="button" class="close" aria-label="Close">
                                <a href="index.php" style="color:inherit">
                                    <span aria-hidden="true" style="">×</span>
                                </a>
                            </button>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="ajax/upload_image.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="image">Upload Image (JPEG, 250x80 px):</label>
                                    <input type="file" name="image" id="image" accept="image/jpeg" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-<?=$card_color?>">Upload</button>
                                </div>
                            </form>
                            <div class="form-group">
                                <label for="change_sidebar">Change Side Bar Color</label>
                                <select class="form-control" id="change_sidebar" name="change_sidebar" required>
                                            <option value="sidebar-light-primary">Light</option>
                                            <option value="sidebar-dark-primary">Dark</option>
                                            
                              </select>
                            </div> 
                            <div class="form-group">
                                <label for="change_header">Change Header Color</label>
                                <select class="form-control" id="change_header" name="change_header" required>
                                            <option value="sidebar-light-primary">Light</option>
                              </select>
                            </div> 
                            <div class="form-group">
                                <label for="change_card">Change Card Color</label>
                                <select class="form-control" id="change_card" name="change_card" required>
                                            <option value="sidebar-light-primary">Light</option>
                              </select>
                            </div> 

                            <div class="form-group">
                                <label for="default_work_status">Defualt Work Status</label>
                                <select class="form-control" id="default_work_status" name="default_work_status" required>
                                            <option value="">Select Work Status</option>
                                            <?php
                                              // Include the database configuration file
                                              require_once 'ajax/dbconfig.php';
                                              // Fetch all data from the work_status_master table
                                              $query = "SELECT * FROM work_status_master";
                                              $result = $mysqli->query($query);

                                              // Check if any rows were returned
                                              if ($result->num_rows > 0)
                                              {                                                                                              
                                                  while ($row = $result->fetch_assoc())
                                                  {                                                      
                                                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';                                                                                                     
                                                  }
                                              }
                                              // Close the database connection
                                              $mysqli->close();
                                            ?>
                                </select>
                            </div> 


                            <div class="form-group">
                                <label for="start_ticket_no">Start Ticket No</label>                                
                                  <input type="text" class="form-control" id="start_ticket_no" name="start_ticket_no" required>                                  
                            </div> 
                            
                            <a href="index.php" class="btn btn-<?=$card_color?>" role="button">Close</a>
                            <button id="btnSaveTicketNo" type="button" class="btn btn-primary">Save</button>
                            
                        </div>
                    </div>
                </div>
            </div>
                
     
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
    $("#change_sidebar").change(function() {
        alert($("#change_sidebar").val());
    });
    
    $("#change_header").change(function() {
        alert("test");
    });
    
    $("#change_card").change(function() {
        alert("test");
    });

    LoadSettings();
    function LoadSettings()
    {
      $.ajax({
        type: "POST",
        url: "ajax/get_setting.php",
        data: {},
        dataType: "json",
        success: function(response)
        {
          // Handle the response from the server
          var setting_data = response[0];
          console.log(response);          

          $("#default_work_status").val(setting_data.default_work_status);
          $("#start_ticket_no").val(setting_data.default_start_ticket_no);        
        },
        error: function() {
          // Display error message
          alert("An error occurred while updating Database.");
        }
      });
    }


    $("#btnSaveTicketNo").click(function()
    {
          $.ajax({
            type: "POST",
            url: "ajax/save_settings.php",
            data: {
              work_status:$("#default_work_status").val(),
              start_ticket_no:$("#start_ticket_no").val()
            },
            dataType: "json",
            success: function(response)
            {
              // Handle the response from the server
              if (response.status === "success")
              {
                // Display success message
                alert("Settings updated successfully.");                
              }
            },
            error: function() {
              // Display error message
              alert("An error occurred while updating Database.");
            }
          });
    });


    function getParams ()
    {
        var result = {};
        var tmp = [];
    
        location.search
            .substr (1)
            .split ("&")
            .forEach (function (item)
            {
                tmp = item.split ("=");
                result [tmp[0]] = decodeURIComponent (tmp[1]);
            });
    
        return result;
    }
    
    location.getParams = getParams;
    
    console.log (location.getParams());
    console.log (location.getParams()["msg"]);
    
    if(location.getParams()["msg"] != undefined)
    {
        alert(location.getParams()["msg"]);
    }
    
    
    
    
</script>
</body>
</html>
