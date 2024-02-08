<?php 
require_once "redirect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ticket</title>

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
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
        

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
                
        <div class="row">
          <div class="col-12">
            <div class="card card-<?=$card_color?>">
              <div class="card-header">
                <h3 class="card-title">Settings</h3>                
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">							
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Company">New Password:</label>
                            <input type="password" class="form-control" id="cnf_password" name="cnf_password" required="">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Company">ReType Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required="">
                        </div>
                    </div>       
                </div>

                <div class="row">		
                  <div class="col-md-6">
                          <div class="form-group">
                            <button id="save_settings" type="button" class="btn btn-primary float-left" onclick="addCompany()" ><i class="fas fa-save"></i> Submit</button>
                          </div>
                  </div>
                </div>
                
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


    function addCompany()
        {        
            if(!($("#cnf_password").val() === $("#password").val()))
            {
              alert("both password should same");
              return;
            }
             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/change_password.php",
                data: {
                  new_pass:$("#password").val()
                },                
                dataType: "json",
                success: function(response) {
                  alert("password updated Successfully;");
                  window.location = "index.php";
                  /*if(JSON.parse(response).status === "success")
                  {
                    alert("password updated Successfully;");
                  }*/
                  
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
