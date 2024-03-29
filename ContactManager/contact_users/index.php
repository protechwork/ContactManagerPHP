<?php 
require_once "redirect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Manager</title>
<link rel="icon" href="https://www.icsweb.in/image/ICS%20ICON.png">
  <!-- Google Font: Source Sans Pro -->
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
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 


  <!-- Main Sidebar Container -->
  <?php include "sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">

        <!--
          <div class="col-lg-3 col-6">
           
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php
                        // Include the database configuration file
                        require_once '../ajax/dbconfig.php';

                        // Fetch all data from the companies table
                        $query = "SELECT count(*) as cnt FROM companies";
                        $result = $mysqli->query($query);

                        // Check if any rows were returned
                        if ($result->num_rows > 0) {
                            // Loop through each row and output the data in <tbody>
                          
                            if ($row = $result->fetch_assoc()) {                                              
                                echo $row['cnt'];
                            }
                        } else {
                            // No rows found
                            echo '0';
                        }
                    ?>
                </h3>

                <p>Registrated Company</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="company_master.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
           
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php
                        // Include the database configuration file
                        require_once '../ajax/dbconfig.php';

                        // Fetch all data from the contacts table
                        $query = "SELECT count(*) as cnt FROM contacts";
                        $result = $mysqli->query($query);

                        // Check if any rows were returned
                        if ($result->num_rows > 0) {
                            // Loop through each row and output the data in <tbody>
                          
                            if ($row = $result->fetch_assoc()) {                                              
                                echo $row['cnt'];
                            }
                        } else {
                            // No rows found
                            echo '0';
                        }

                        // Close the database connection
                        $mysqli->close();
                    ?></h3>

                <p>Registrated Contacts</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="contact_master.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
           
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          -->
          



          <?php
                  // Include the database configuration file
                  require_once 'ajax/dbconfig.php';

                  $close = 0;
                  $hold = 0;
                  $inprogress = 0;
                  $notstarted = 0;

                  // Fetch all data from the contacts table
                  $query = "SELECT (SELECT 
                  COUNT(tkt.ticket_id)
                  FROM 
                  ticket tkt 
                  LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                  WHERE wstatus.link_status=1 AND tkt.contact_ids=(SELECT agent_login.contact_id FROM agent_login WHERE agent_login.id=".$_SESSION['user_id'].")) AS close,
                  (SELECT 
                  COUNT(tkt.ticket_id)
                  FROM 
                  ticket tkt 
                  LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                  WHERE wstatus.link_status=2 AND tkt.contact_ids=(SELECT agent_login.contact_id FROM agent_login WHERE agent_login.id=".$_SESSION['user_id'].")) AS hold,
                  (SELECT 
                  COUNT(tkt.ticket_id)
                  FROM 
                  ticket tkt 
                  LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                  WHERE wstatus.link_status=3 AND tkt.contact_ids=(SELECT agent_login.contact_id FROM agent_login WHERE agent_login.id=".$_SESSION['user_id'].")) AS inprogress,
                  (SELECT 
                  COUNT(tkt.ticket_id)
                  FROM 
                  ticket tkt 
                  LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                  WHERE wstatus.link_status=4 AND tkt.contact_ids=(SELECT agent_login.contact_id FROM agent_login WHERE agent_login.id=".$_SESSION['user_id'].")) AS not_started";
                  $result = $mysqli->query($query);

                  // Check if any rows were returned
                  if ($result->num_rows > 0) {
                      // Loop through each row and output the data in <tbody>
                    
                      if ($row = $result->fetch_assoc()) {                                              
                          //echo $row['cnt'];
                          $close = $row['close'];
                          $hold = $row['hold'];
                          $inprogress = $row['inprogress'];
                          $notstarted = $row['not_started'];
                      }
                  }

                  // Close the database connection
                  $mysqli->close();
              ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$close?></h3>
                <p>Close Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="report1.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$hold?></h3>
                <p>Hold Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="report2.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$inprogress?></h3>
                <p>In-Progress Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="report3.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$notstarted?></h3>
                <p>Not Started Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="report4.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>








        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
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
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
