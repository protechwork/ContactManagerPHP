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
            <h1>Hold Ticket</h1>
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
    
            <!-- Activity Modal -->

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ticket Activity</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">


                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">                          
                          <li class="nav-item">
                            <a class="nav-link active" href="#timeline" data-toggle="tab">Ticket</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
                          </li>                          
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="tab-pane" id="activity">

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <textarea type="text" placeholder="Ticket Note" class="form-control" id="comment" name="comment" required=""> </textarea>
                                  </div>
                                </div>
                                <div class="col-sm-12">                                               
                                    <!--<label>Is Admin</label>-->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="visibility">
                                        <label class="form-check-label" for="exampleCheck2">Notify Contact</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary float-right" onclick="saveNote()"><i class="fas fa-save"></i> Submit</button>
                                    </div>
                                </div>
                              </div>



                              <!--<table id="activity_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date Time</th>
                                            <th>ticket Id</th>
                                            <th>Who Performed</th>
                                            <th>Notify Contact</th>
                                            <th>Note</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="activity_body">                                      
                                        <tr>
                                            <td>Date Time</td>
                                            <td>ticket Id</td>
                                            <td>Who Performed</td>
                                            <td>Notify Contact</td>
                                            <td>Note</td>  
                                        </tr>
                                    </tbody>
                                    
                            </table>
-->



                            <div id="activity_view" class="timeline timeline-inverse">
                                      
                                      
                                        
                                      

                            </div>
                                    
                              
                            <!--
                                    <div id="activity_view" class="timeline timeline-inverse">
                                      
                                      
                                        <div class="time-label">
                                          <span class="bg-success"> 3 Jan. 2014 </span>
                                        </div>

                                        <div>
                                          <i class="fas fa-comments bg-warning"></i>
                                          <div class="timeline-item">
                                            <span class="time">
                                              <i class="far fa-clock"></i> 27 mins ago 
                                            </span>
                                            <h3 class="timeline-header">
                                              <a href="#">Jay White</a> commented on your post
                                            </h3>
                                            <div class="timeline-body"> Take me to your leader! Switzerland is small and neutral! We are more like Germany, ambitious and misunderstood! </div>
                                            <div class="timeline-footer">
                                              <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                          </div>
                                        </div>

                                        <div>
                                          <i class="far fa-clock bg-gray"></i>
                                        </div>
                                      

                                    </div>
                                    -->
                                    


                          </div> <!-- activity -->


                          <div class="tab-pane active" id="timeline">
                          <form>
                            <div class="row">
							
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
                                                    //$query = "SELECT companies.* FROM companies";
                                                    $query = "SELECT cmp.* FROM 
                                                              companies cmp
                                                              INNER JOIN contacts cnt ON cnt.company_id=cmp.company_id 
                                                              INNER JOIN agent_login log ON log.contact_id=cnt.contact_id
                                                              WHERE log.id =".$_SESSION['user_id'];
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
								
								
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="Company">Select Project</label><span style="color:red;">*</span>
                                        <select class="form-control" id="project_id" name="project_id" required>
                                            <option value="">Select Project</option>
                                            <?php
                                                    // Include the database configuration file
                                                    require_once 'ajax/dbconfig.php';
                                                    $columnList= array();
        
                                                    // Fetch all data from the email_template table
                                                    $query = "SELECT project.* FROM project";
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
							
							
							<div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
                          <label for="categoryName">Subject</label><span style="color:red;">*</span>
                          <input type="text" class="form-control" id="title" name="title" required>
                      </div>
                  </div>
                  
                  <div class="col-md-12">
                        <div class="form-group">
                          <label for="categoryName">Details</label><span style="color:red;">*</span>
                          <textarea type="text" class="form-control"  id="details" name="details" required> </textarea>
                      </div>
                  </div>
              </div>

							<div class="row">  
								<div class="col-md-6">
                                     <div class="form-group">                                        
                                        <div id="attachment_view" class="form-group">
                                            <label for="image">Attachment (Less Than 5 MB)</label>
                                            <input type="file" name="attachment" id="attachment" accept="image/jpeg" required="">
                                        </div>
                                        <div id="download_attachment"></div>
                                    </div>
                                </div>    
                            </div>
                            
                                                       
                            
                            <button type="button" class="btn btn-primary float-right" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;">
                                Close
                            </button>
                            <button id="save_btn" type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
                            <input type="text" hidden class="form-control" id="id" name="id" required>
                        </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>


                    </div>
                  
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
                <h3 class="card-title">Titcket List</h3>
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;">Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="company_table" class="table table-bordered table-striped">
                        <thead>                           
                            <tr>                                
                                <th>Ticket No</th>
                                <th>Created Date</th>
                                <th>Company-<br>Project</th>                                                               
                                <th>Ticket Title</th>                                
                                <th>Assign By-<br>Assign To</th>  
                                <th>Work Status-<br>Link Status</th>                                
                                <th>Download</th>  
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Category rows will be dynamically added here -->
                            <?php
                                // Include the database configuration file
                                require_once 'ajax/dbconfig.php';

                                // Fetch all data from the project table
                                //$query = "SELECT * FROM ticket";
                                $query = "SELECT 
                                tkt.ticket_id,
                                cmp.name CompanyName, 
                                pro.name ProjectName, 
                                tkt.title Title, 
                                tkt.details, 
                                assgnby.name assign_by,
                                assgnto.name assign_to,
                                wstatus.name WorkStatus, 
                                CASE
                                  WHEN wstatus.link_status = 1 THEN 'Close'
                                  WHEN wstatus.link_status = 2 THEN 'Hold'      
                                  WHEN wstatus.link_status = 3 THEN 'In Progress'      
                                  WHEN wstatus.link_status = 4 THEN 'Not Started'      
                                END link_status, 
                                CASE
                                  WHEN tkt.status = 0 THEN 'In-Active'
                                  ELSE 'Active'
                                END Status,
                                  DATE_FORMAT(tkt.reported_on, '%d-%m-%Y %h:%i ') ReportedOn, 
                                  tkt.reported_by ReportedBy, 
                                  tkt.attachement 

                              FROM 
                                ticket tkt 
                                LEFT JOIN companies cmp ON tkt.company_id = cmp.company_id 
                                LEFT JOIN project pro ON tkt.project_id = pro.id 
                                LEFT JOIN agent_master assgnby ON tkt.assigned_by = assgnby.id
                                LEFT JOIN agent_master assgnto ON tkt.assigned_to = assgnto.id
                                LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                                WHERE wstatus.link_status=2 AND tkt.reported_by=".$_SESSION['user_id'];

                              if($_SESSION['user_type'] == "3")
                              {
                                $query = "SELECT 
                               tkt.ticket_id,
                                cmp.name CompanyName, 
                                pro.name ProjectName, 
                                tkt.title Title, 
                                tkt.details, 
                                assgnby.name assign_by,
                                assgnto.name assign_to,
                                wstatus.name WorkStatus, 
                                CASE
                                  WHEN wstatus.link_status = 1 THEN 'Close'
                                  WHEN wstatus.link_status = 2 THEN 'Hold'      
                                  WHEN wstatus.link_status = 3 THEN 'In Progress'      
                                  WHEN wstatus.link_status = 4 THEN 'Not Started'      
                                END link_status, 
                                CASE
                                  WHEN tkt.status = 0 THEN 'In-Active'
                                  ELSE 'Active'
                                END Status,
                                  DATE_FORMAT(tkt.reported_on, '%d-%m-%Y %h-%i-%s ') ReportedOn, 
                                  tkt.reported_by ReportedBy, 
                                  tkt.attachement 
                              FROM 
                                ticket tkt 
                                INNER JOIN companies cmp ON tkt.company_id = cmp.company_id 
                                LEFT JOIN project pro ON tkt.project_id = pro.id 
                                LEFT JOIN agent_master assgnby ON tkt.assigned_by = assgnby.id
                                LEFT JOIN agent_master assgnto ON tkt.assigned_to = assgnto.id
                                LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                                LEFT JOIN contacts cnt ON cnt.company_id=cmp.company_id 
                                LEFT JOIN agent_login log ON log.contact_id=cnt.contact_id
                                WHERE wstatus.link_status=2 AND log.id =".$_SESSION['user_id'];
                              }

                              if($_SESSION['user_type'] == "4")
                              {
                                $query = "SELECT 
                               tkt.ticket_id,
                                cmp.name CompanyName, 
                                pro.name ProjectName, 
                                tkt.title Title, 
                                tkt.details, 
                                assgnby.name assign_by,
                                assgnto.name assign_to,
                                wstatus.name WorkStatus, 
                                CASE
                                  WHEN wstatus.link_status = 1 THEN 'Close'
                                  WHEN wstatus.link_status = 2 THEN 'Hold'      
                                  WHEN wstatus.link_status = 3 THEN 'In Progress'      
                                  WHEN wstatus.link_status = 4 THEN 'Not Started'      
                                END link_status, 
                                CASE
                                  WHEN tkt.status = 0 THEN 'In-Active'
                                  ELSE 'Active'
                                END Status,
                                  DATE_FORMAT(tkt.reported_on, '%d-%m-%Y %h-%i-%s ') ReportedOn, 
                                  tkt.reported_by ReportedBy, 
                                  tkt.attachement 
                              FROM 
                                ticket tkt 
                                INNER JOIN companies cmp ON tkt.company_id = cmp.company_id 
                                LEFT JOIN project pro ON tkt.project_id = pro.id 
                                LEFT JOIN agent_master assgnby ON tkt.assigned_by = assgnby.id
                                LEFT JOIN agent_master assgnto ON tkt.assigned_to = assgnto.id
                                LEFT JOIN work_status_master wstatus ON tkt.work_status = wstatus.id
                                LEFT JOIN contacts cnt ON cnt.company_id=cmp.company_id 
                                LEFT JOIN agent_login log ON log.contact_id=cnt.contact_id
                                WHERE tkt.contact_ids=(SELECT agent_login.contact_id FROM agent_login WHERE agent_login.id=".$_SESSION['user_id'].") AND wstatus.link_status=2 AND log.id =".$_SESSION['user_id'];
                              }

                                error_log("UserID:".$_SESSION['user_id']);
                                error_log("Query:".$query);
                                

                                $result = $mysqli->query($query);

                                // Check if any rows were returned
                                if ($result->num_rows > 0) {
                                    // Loop through each row and output the data in <tbody>
                                  $index=1;
                                    while ($row = $result->fetch_assoc()) {                                              
                                      echo '<tr onclick="get_company('.$row['ticket_id'].')">';
                                      //echo '<td>' . $index . '</td>';  
                                      echo '<td>' . $row['ticket_id'] . '</td>';   
                                      echo '<td>' . $row['ReportedOn'] . '</td>';                       
                                      echo '<td>' . $row['CompanyName'] ."-<br>". $row['ProjectName'] . '</td>';
                                      //echo '<td>' . $row['ProjectName'] . '</td>';
                                      
                                      echo '<td title="'.$row['details'].'">' . $row['Title'] . '</td>';
                                      //echo '<td>' . $row['details'] . '</td>';  
                                      
                                      echo '<td>' . $row['assign_by'] .'-<br>'. $row['assign_to']. '</td>';
                                      //echo '<td></td>'; 
                                     
                                      //echo '<td>' . $row['ReportedBy'] . '</td>';
                                      echo '<td>' . $row['WorkStatus'] . '-<br>'. $row['link_status'].  '</td>';                                       
                                      //echo '<td>' . $row['Status'] . '</td>';     
                                      //echo '<td>' . $row['attachement'] . '</td>';
                                      if(!empty($row['attachement']))
                                      {
                                        echo '<td><a target="_blank" href="'.$_SESSION['base_url'].'/ticket_uploads/'.$row['attachement'].'">Download</a></td>';                                    
                                      } 
                                      else
                                      {
                                        echo '<td></td>';
                                      }
                                      
                                      //echo '<td><i class="fas fa-edit" onclick="get_company('.$row['ticket_id '].')"></i><i class="fas fa-trash" onclick="deleteCompany('.$row['ticket_id '].')"></i></td>';
                                      //echo '<td><i class="fas fa-trash" onclick="deleteCompany('.$row['ticket_id'].')"></i></td>';
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

  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  
  $('#reporting_by').select2();

  var ticket_id = "";

  $("#company_id").change(function()
  {    
    $("#project_id").html("");

    var options = "";
    options = options + "<option value=''>Select Project</option>";
    $("#project_id").html(options);

    $.ajax({
        type: "POST",
        url: "ajax/get_project_by_company_id.php",
        data: {
          company_id:$("#company_id").val()
        },
        dataType: "json",
        success: function(response) {
          // Handle the response from the server
          //resData = JSON.parse(response);
          $("#project_id").html("");
         

          $.each(response, function(key, value){
            options = options + "<option value=" + value.id + ">" + value.name + "</option>";               
          });

          $("#project_id").html(options);
          
        }
      });



  });
  
    $(".add-btn").click(function(){
        $("#id").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#title").val("");
        $("#details").val("");

        $("#activity_view").html("");

        $("#ticket_no").html("New Ticket");
        $("#download_attachment").html("");

        $('#save_btn').prop('disabled', false);
        

        ticket_id = "";
    });


    function saveNote()
    {
          //var visibility = $("#visibility").is(":checked") ? 1 : 0;  

          var formData = new FormData();
          //formData.append("attachment", $('#attachment')[0].files[0]);
          formData.append("comment", $("#comment").val());
					formData.append("visibility", 0);	
          formData.append("ticket_id", ticket_id);				

             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/save_ticket_activity.php",
                data: formData,                               
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(response) {
                  response=JSON.parse(response);
                  // Handle the response from the server
                  if (response.status === "success") {
                    // Display success message
                    Toast.fire({
                      icon: 'success',
                      title: 'Data Saved Successfully'
                    });
                    $("#comment").val("");
                    LoadTicketActivity(ticket_id);
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
  
    function addCompany()
        {
          var formData = new FormData();
          formData.append("attachment", $('#attachment')[0].files[0]);
          formData.append("company_id", $("#company_id").val());
					formData.append("project_id", $("#project_id").val());
					formData.append("title", $("#title").val());
					formData.append("details", $("#details").val());

             // Send the AJAX request
             $.ajax({
                type: "POST",
                url: "ajax/save_ticket.php",
                data: formData,
                /*data: {
					company_id : $("#company_id").val(),
					project_id : $("#project_id").val(),
					title : $("#title").val(),
					details : $("#details").val(),
					attachment : $("#attachment").val()
                },*/
                //dataType: "json",
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(response) {
                  response=JSON.parse(response);
                  // Handle the response from the server
                  if (response.status === "success") {
                    // Display success message
                    Toast.fire({
                      icon: 'success',
                      title: 'Data Saved Successfully '+ response.msg 
                    });
                    setTimeout( function(){ 
                      location.reload(true);
                    }  , 2000 );
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
                url: "ajax/get_ticket_by_id.php",
                data: {
                  ticket_id:ID,
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  var company_data = response[0];
                  console.log(response);
                  $(".add-btn").trigger('click');

                  $("#company_id").val(company_data.company_id);
                  $("#project_id").val(company_data.project_id);
                  $("#title").val(company_data.title);
                  $("#details").val(company_data.details);
                  
                  const myArray = company_data.attachement.split(".");
                  let ext = myArray[1];


                  if(company_data.attachement != "")
                  {
                    $("#download_attachment").html('<a target="_blank" href="<?=$_SESSION['base_url']?>/ticket_uploads/'+ company_data.attachement +'">Download</a> <div>'+ext+'</div>');
                    $("#attachment_view").hide();
                  } else {
                    $("#download_attachment").html("");
                    $("#attachment_view").show();
                  } 

                  $('#save_btn').prop('disabled', true);

                  ticket_id = ID;

                  LoadTicketActivity(ID);
                    
                },
                error: function() {
                  // Display error message
                  alert("An error occurred while updating Database.");
                }
              });
              
        }

        function LoadTicketActivity(ID)
        {
          //activity_body
            $.ajax({
                type: "POST",
                url: "ajax/get_ticket_activity_by_id.php",
                data: {
                  ticket_id:ID,
                },
                dataType: "json",
                success: function(response) {
                  // Handle the response from the server
                  //var company_data = response[0];
                  /*                    
                    comment
                    datetime
                    notify_contact
                    ticket_id
                    user_name
                  */
                  var trData = "";
                  var timelineDatas = "";
                  var timelineStruture = '<div class="time-label"> <span class="bg-success"> %%DATETIME%% </span> </div> <div> <i class="fas fa-comments bg-warning"></i> <div class="timeline-item"> <span class="time"> <i class="far fa-clock"></i> %%AGO%% </span> <h3 class="timeline-header"> <a href="#">%%USER_NAME%%</a> commented on your post </h3> <div class="timeline-body"> %%COMMENT%% </div> <div class="timeline-footer"> <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a> </div> </div> </div>';
                  $.each(response, function(key, item) 
                  {

                    var timelineData = timelineStruture;
                    timelineData = timelineData.replace("%%DATETIME%%", item.datetime);
                    timelineData = timelineData.replace("%%AGO%%", "");
                    timelineData = timelineData.replace("%%USER_NAME%%", item.user_name);
                    timelineData = timelineData.replace("%%COMMENT%%", item.comment);

                    timelineDatas = timelineDatas + timelineData;


                    /*trData = trData + "<tr>";

                    trData = trData + "<td>" + item.datetime + "</td>";
                    trData = trData + "<td>" + item.ticket_id + "</td>";
                    trData = trData + "<td>" + item.user_name + "</td>";
                    trData = trData + "<td>" + item.notify_contact + "</td>";
                    trData = trData + "<td>" + item.comment  + "</td>";

                    trData = trData + "</tr>";*/

                  });

                  //$("#activity_body").html(trData);
                  $("#activity_view").html(timelineDatas);

                    
                },
                error: function() {
                  // Display error message
                  //alert("An error occurred while updating Database.");
                  console.log("Ticket ID Activity not found maybe:");
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
