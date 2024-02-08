<?php 
require_once "redirect.php";

  session_start();
  $user_id = $_SESSION['user_id'];
  $user_type = $_SESSION['user_type'];

  require_once 'ajax/dbconfig.php';
  $query = "SELECT * from agent_login WHERE id=".$user_id;

  $result = $mysqli->query($query);

  if ($result->num_rows > 0) {
      // Loop through each row and output the data in <tbody>       
      if ($row = $result->fetch_assoc())
      {                                                           
          if($row['agent_id'] != null)
          {
            $user_id = $row['agent_id'];
          }
          else
          {
          $user_id = 0;
          }
      }
  } 
  else 
  {
    $user_id = 0;
  }

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
            <h1>All Ticket</h1>
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
                      <h4 class="modal-title">Ticket Activity: <span id="ticket_no"></span></h4>
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
                          <li class="nav-item">
                            <a class="nav-link" href="#internal_activity" data-toggle="tab">Internal</a>
                          </li>   
                          <li class="nav-item">
                            <a class="nav-link" href="#external_activity" data-toggle="tab">External</a>
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
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary float-right" onclick="saveNote()"><i class="fas fa-save"></i> Submit</button>
                                    </div>
                                </div>
                              </div>
                            <div id="activity_view" class="timeline timeline-inverse">
                            </div>
                          </div> <!-- system activity -->


                          <div class="tab-pane" id="internal_activity">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <textarea type="text" placeholder="Ticket Note" class="form-control" id="internal_comment" name="internal_comment" required=""> </textarea>
                                  </div>
                                </div>                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary float-right" onclick="saveInternalNote()"><i class="fas fa-save"></i> Submit</button>
                                    </div>
                                </div>
                              </div>
                            <div id="internal_activity_view" class="timeline timeline-inverse">
                            </div>
                          </div> <!-- internal activity -->

                          <div class="tab-pane" id="external_activity">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <textarea type="text" placeholder="Ticket Note" class="form-control" id="external_comment" name="external_comment" required=""> </textarea>
                                  </div>
                                </div>
                                <div class="col-sm-12">                                               
                                    <!--<label>Is Admin</label>-->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="external_visibility">
                                        <label class="form-check-label" for="exampleCheck2">Notify Contact</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary float-right" onclick="saveExternalNote()"><i class="fas fa-save"></i> Submit</button>
                                    </div>
                                </div>
                              </div>
                            <div id="external_activity_view" class="timeline timeline-inverse">
                            </div>
                          </div> <!-- external activity -->


                          <div class="tab-pane active" id="timeline">
                          <form>
                            <div class="row">
							
								<div class="col-md-4">
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
								
								
                                <div class="col-md-4">
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Contact</label>
                                        <select class="form-control" id="contact_ids" name="contact_ids">                                                                                        
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
                  <div class="col-md-4">
                        <div class="form-group">
                          <label>Assigned By</label>
                          <select class="form-control" id="assigned_by" name="assigned_by" required>
                              <option value="">Please Select Assigned By</option>
                              <?php
                                  require_once 'ajax/dbconfig.php';

                                  $query = "SELECT * FROM agent_master";
                                  $result = $mysqli->query($query);

                                  // Check if any rows were returned
                                  if ($result->num_rows > 0) {
                                      // Loop through each row and output the data in <tbody>
                                      while ($row = $result->fetch_assoc())
                                      {                                              
                                          echo '<option value="'.$row['id'].'">' . $row['name'] . '</option>';
                                      }
                                  }
                                  // Close the database connection
                                  //$mysqli->close();
                              ?>                              
                          </select>
                      </div>
                  </div>
                  
                  <div class="col-md-4">
                        <div class="form-group">
                          <label>Assigned To</label>
                          
                          <select class="form-control" id="assigned_to" name="assigned_to" required>
                              <option value="">Please Select Assigned To</option>
                              <?php
                                  require_once 'ajax/dbconfig.php';


                                  $query = "SELECT * FROM agent_master";
                                  

                                  error_log("Current User Type:".$user_type);

                                  if($user_type == 0) //admin
                                  {
                                    $query = "SELECT * FROM agent_master";
                                  }
                                  else if($user_type == 1) // agent
                                  {
                                    //$query = "SELECT * FROM agent_master WHERE id IN (SELECT reporting_to_id FROM agent_reporting_to WHERE agent_id=".$user_id.")";
                                    $query = "SELECT * FROM agent_master WHERE id IN (SELECT agent_id  FROM agent_reporting_to WHERE reporting_to_id=".$user_id.")";
                                  }
                                  else
                                  {
                                    $query = "SELECT * FROM agent_master";
                                  }

                                  error_log("Query To Fetch Data:".$query);
                                  
                                  //$query = "SELECT * FROM agent_master";
                                  $result = $mysqli->query($query);

                                  // Check if any rows were returned
                                  if ($result->num_rows > 0) {
                                      // Loop through each row and output the data in <tbody>
                                      while ($row = $result->fetch_assoc())
                                      {                                              
                                          echo '<option value="'.$row['id'].'">' . $row['name'] . '</option>';
                                      }
                                  }
                                  // Close the database connection
                                  //$mysqli->close();
                              ?>                              
                          </select>
                      </div>
                  </div>

                  <div class="col-md-4">
                        <div class="form-group">
                            <label for="link_status">Work Status</label>
                            <select class="form-control" id="work_status" name="work_status" required="">
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
                            <button type="button" class="btn btn-<?=$card_color?> float-right" onclick="addCompany()"><i class="fas fa-save"></i> Submit</button>
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

      <input id="login_user" type="text" hidden value="<?=$user_id?>" />
      <div class="container-fluid">
                
        <div class="row">
          <div class="col-12">
            <div class="card card-<?=$card_color?>">
              <div class="card-header">
                <h3 class="card-title">Ticket List</h3>    
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal-lg" style="float: right;margin: 0;padding: 0;background-color: white;color: black;width: 10%;visibility: hidden;">Add</button>            
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div>
                  <lable>From Date:</lable>
                  <input id="from_date"  type="date" />
                  <lable>To Date:</lable>
                  <input id="to_date"type="date" />
                  <input id="search"type="button" value="Serach" class="btn btn-primary" />
                </div>
                <table id="company_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>                                
                                <th>Ticket No</th>
                                <th>Created Date</th>
                                <th>Company-<br>Project</th>
                                <!--<th>Project Name</th>-->
                               
                                <th>Ticket Title</th>
                                <!--<th>Details</th>  -->
                                
                                <th>Assign By-Assign To</th>  
                                
                                
                                
                                <th>Work Status-<br>Link Status</th> 
                                <!--<th>Status</th>  -->
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
                                  ORDER BY tkt.ticket_id DESC";
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
                                        
                                        echo '<td>' . $row['assign_by'] ."-<br>". $row['assign_to']. '</td>';
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
      
      "bAutoWidth": false, // Disable the auto width calculation 
        "aoColumns": [
          { "sWidth": "10%" }, // 1st column width 
          { "sWidth": "10%" }, // 1st column width 
          { "sWidth": "10%" }, // 3rd column width and so on 
          { "sWidth": "10%" }, // 3rd column width and so on 
          { "sWidth": "10%" }, // 3rd column width and so on 
          { "sWidth": "10%" }, // 3rd column width and so on 
          { "sWidth": "10%" }, // 3rd column width and so on 
        ],

        order: [[0, 'desc']],

      "buttons": ["excel", "pdf", "colvis"/*, { 
          sExtends: 'excel',
          text: 'View'
        }*/
   ]
    }).buttons().container().appendTo('#company_table_wrapper .col-md-6:eq(0)');
    
  });
  
  //$('#reporting_by').select2();
  //$('#contact_ids').select2();

  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

  var ticket_id = "";
  var global_contact_id = "";
  var global_project_id = "";

  document.getElementById('from_date').valueAsDate = new Date();
  document.getElementById('to_date').valueAsDate = new Date();


  $("#search").click(function(){   

    $('#company_table').DataTable().destroy();
    $("#categoryTableBody").html("");
    
    
    $.ajax({
        type: "POST",
        url: "ajax/get_all_ticket.php",
        data: {
          from_date:$("#from_date").val(),
          to_date:$("#to_date").val()
        },
        dataType: "json",
        success: function(response) {
          //alert(response);
          // Handle the response from the server
          //resData = JSON.parse(response);
          


          //var data = JSON.parse(response);
          var data = response;
          data.forEach(function (ticketData, index) {                                                           
              var td = "";
              td = td + "<td>" + ticketData.ticket_id + "</td>";
              td = td + "<td>" + ticketData.ReportedOn + "</td>";
              td = td + "<td>" + ticketData.CompanyName + "-<br>" + ticketData.ProjectName + "</td>";              
              td = td + "<td title='" + ticketData.details + "'>" + ticketData.Title + "</td>";              
              td = td + "<td>" + ticketData.assign_by + "-<br>" + ticketData.assign_to + "</td>";  
              td = td + "<td>" + ticketData.WorkStatus + "-<br>" + ticketData.link_status + "</td>";     

              if(ticketData.attachement != '')
              {
                td = td + "<td><a target='_blank' href='<?=$_SESSION['base_url']?>/ticket_uploads/"+ticketData.attachement+"'>Download</a></td>";
              }
              else
              {
                td = td + "<td></td>";
              }

              $("#categoryTableBody").append("<tr onclick='get_company(" + ticketData.ticket_id + ")'>" + td + "</tr>");
          });   




          $("#company_table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, 
            
            "bAutoWidth": false, // Disable the auto width calculation 
              "aoColumns": [
                { "sWidth": "10%" }, // 1st column width 
                { "sWidth": "10%" }, // 1st column width 
                { "sWidth": "10%" }, // 3rd column width and so on 
                { "sWidth": "10%" }, // 3rd column width and so on 
                { "sWidth": "10%" }, // 3rd column width and so on 
                { "sWidth": "10%" }, // 3rd column width and so on 
                { "sWidth": "10%" }, // 3rd column width and so on 
              ],
            
              order: [[0, 'desc']],

            "buttons": ["excel", "pdf", "colvis"
        ]
          }).buttons().container().appendTo('#company_table_wrapper .col-md-6:eq(0)');
          
          



          
        }
      });



    


    

    

  });

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
          $("#project_id").val(global_project_id).trigger('change');
          
        }
      });

      var contactOptions = "";
      //contactOptions = contactOptions + "<option value=''>Select Contact</option>";
      $("#contact_ids").html("");

      $.ajax({
        type: "POST",
        url: "ajax/get_contact_by_company_id.php",
        data: {
          company_id:$("#company_id").val()
        },
        dataType: "json",
        success: function(response) {
          // Handle the response from the server
          //resData = JSON.parse(response);
          $("#contact_ids").html("");
         

          $.each(response, function(key, value){
            contactOptions = contactOptions + "<option value=" + value.contact_id  + ">" + value.name + "</option>";               
          });

          $("#contact_ids").html(contactOptions);

          
          //$("#contact_ids").val("").trigger('change');
          $("#contact_ids").val(global_contact_id).trigger('change');
          
        }
      });



  });
  
    $(".add-btn").click(function(){
        $("#id").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#contact_ids").val("");
        $("#title").val("");
        $("#details").val("");
        $("#assigned_by").val("");
        $("#assigned_to").val("");
        $("#work_status").val("");

        $("#project_id").html("");
        $("#contact_ids").html("");

        $("#attachment_view").show();

        $("#activity_view").html("");
        $("#internal_activity_view").html("");
        $("#external_activity_view").html("");

        $("#ticket_no").html("New Ticket");
        $("#download_attachment").html("");



        $('#company_id').prop('disabled', false);
        $('#project_id').prop('disabled', false);
        $('#title').prop('disabled', false);
        $('#details').prop('disabled', false);

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
          formData.append("type", 1);				

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
                    //alert("Database updated successfully.");
                    Toast.fire({
                      icon: 'success',
                      title: 'Data Saved Successfully'
                    });
                    $("#comment").val("");
                    LoadTicketActivity(ticket_id);
                  } else if (response.status === "exist") {
                    // Display success message
                    //alert("Record Already Found in Database.");
                    Toast.fire({
                        icon: 'error',
                        title: "Record Already Found in Database."
                    });
                  }  else {
                    // Display error message
                    //alert('Please fill in all Mandatory fields.');
                    Toast.fire({
                        icon: 'error',
                        title: "Please fill in all Mandatory fields."
                    });
                  }
                },
                error: function() {
                  // Display error message
                  //alert("An error occurred while updating Database.");
                  Toast.fire({
                      icon: 'error',
                      title: "An error occurred while updating Database."
                  });
                }
              });
    }

    function saveInternalNote()
    {
          //var visibility = $("#internal_visibility").is(":checked") ? 1 : 0;  

          var formData = new FormData();
          //formData.append("attachment", $('#attachment')[0].files[0]);
          formData.append("comment", $("#internal_comment").val());
					formData.append("visibility", 0);	
          formData.append("ticket_id", ticket_id);	
          formData.append("type", 2);					

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
                    //alert("Database updated successfully.");
                    Toast.fire({
                      icon: 'success',
                      title: 'Data Saved Successfully'
                    });
                    $("#internal_comment").val("");
                    LoadTicketActivity(ticket_id);
                  } else if (response.status === "exist") {
                    // Display success message
                    //alert("Record Already Found in Database.");
                    Toast.fire({
                        icon: 'error',
                        title: "Record Already Found in Database."
                    });
                  }  else {
                    // Display error message
                    //alert('Please fill in all Mandatory fields.');
                    Toast.fire({
                        icon: 'error',
                        title: "Please fill in all Mandatory fields."
                    });
                  }
                },
                error: function() {
                  // Display error message
                  //alert("An error occurred while updating Database.");
                  Toast.fire({
                      icon: 'error',
                      title: "An error occurred while updating Database."
                  });
                }
              });
    }

    function saveExternalNote()
    {
          var visibility = $("#external_visibility").is(":checked") ? 1 : 0;  

          var formData = new FormData();
          //formData.append("attachment", $('#attachment')[0].files[0]);
          formData.append("comment", $("#external_comment").val());
					formData.append("visibility", visibility);	
          formData.append("ticket_id", ticket_id);
          formData.append("type", 3);					

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
                    //alert("Database updated successfully.");
                    Toast.fire({
                      icon: 'success',
                      title: 'Data Saved Successfully'
                    });
                    $("#external_comment").val("");
                    LoadTicketActivity(ticket_id);
                  } else if (response.status === "exist") {
                    // Display success message
                    //alert("Record Already Found in Database.");
                    Toast.fire({
                        icon: 'error',
                        title: "Record Already Found in Database."
                    });
                  }  else {
                    // Display error message
                    //alert('Please fill in all Mandatory fields.');
                    Toast.fire({
                        icon: 'error',
                        title: "Please fill in all Mandatory fields."
                    });
                  }
                },
                error: function() {
                  // Display error message
                  //alert("An error occurred while updating Database.");
                  Toast.fire({
                      icon: 'error',
                      title: "An error occurred while updating Database."
                  });
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

          formData.append("ticket_id", ticket_id);	
          formData.append("contact_ids", $("#contact_ids").val());	

          formData.append("assigned_by", $("#assigned_by").val());
          formData.append("assigned_to", $("#assigned_to").val());
          formData.append("work_status", $("#work_status").val());

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
                    Toast.fire({
                        icon: 'error',
                        title: "Record Already Found in Database."
                    });
                  }  else {
                    // Display error message
                    Toast.fire({
                        icon: 'error',
                        title: "Please fill in all Mandatory fields."
                    });
                  }
                },
                error: function() {
                  // Display error message
                  Toast.fire({
                      icon: 'error',
                      title: "An error occurred while updating Database."
                  });
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
                  //var company_data = response[0];
                  var company_data = response;
                  console.log(response);
                  $(".add-btn").trigger('click'); 
                  
                  $('#company_id').prop('disabled', true);
                  $('#project_id').prop('disabled', true);
                  $('#title').prop('disabled', true);
                  $('#details').prop('disabled', true);

                  $("#ticket_no").html("Ticket No:" + ID + "/ Date:" + company_data.CreatedDate);

                  $("#company_id").val(company_data.company_id);
                  $("#project_id").val(company_data.project_id);
                  $("#title").val(company_data.title);
                  $("#details").val(company_data.details);

                  /*$("#company_id").trigger('change');
                  $("#contact_ids").val(company_data.contact_ids);                  
                  $("#contact_ids").trigger('change');*/

                  /*$('#company_id').on('change', function() {
                    $("#contact_ids").trigger('change');                                              
                  });*/

                  //$("#company_id").trigger('change');

                  //$("#contact_ids").val(company_data.contact_ids);
                  global_contact_id=company_data.contact_ids;
                  global_project_id=company_data.project_id;
                  //$("#contact_ids").val(company_data.contact_ids).change();
                  //$("#contact_ids").val(company_data.contact_ids).change();

                  $("#company_id").trigger('change');


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
                  

                  ticket_id = ID;

                  LoadTicketActivity(ID);

                  if(company_data.assigned_by == null)
                  {
                    $("#assigned_by").val($("#login_user").val());
                  }
                  else
                  {
                    $("#assigned_by").val(company_data.assigned_by);
                  }

                  
                  $("#assigned_to").val(company_data.assigned_to);

                  $("#work_status").val(company_data.work_status);


                    
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
                  var systemActivity = "";
                  var internalActivity = "";
                  var externalActivity = "";
                  var timelineStruture = '<div class="time-label"> <span class="bg-success"> %%DATETIME%% </span> </div> <div> <i class="fas fa-comments bg-warning"></i> <div class="timeline-item"> <span class="time"> <i class="far fa-clock"></i> %%AGO%% </span> <h3 class="timeline-header"> <a href="#">%%USER_NAME%%</a> commented on your post </h3> <div class="timeline-body"> %%COMMENT%% </div> <div class="timeline-footer"> <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a> </div> </div> </div>';
                  $.each(response, function(key, item) 
                  {

                    var timelineData = timelineStruture;
                    timelineData = timelineData.replace("%%DATETIME%%", item.datetime);
                    timelineData = timelineData.replace("%%AGO%%", "");
                    timelineData = timelineData.replace("%%USER_NAME%%", item.user_name);
                    timelineData = timelineData.replace("%%COMMENT%%", item.comment);

                    if(item.type == "1")
                    {
                      systemActivity = systemActivity + timelineData;
                    }
                    else if(item.type == "2")
                    {
                      internalActivity = internalActivity + timelineData;
                    }
                    else if(item.type == "3")
                    {
                      externalActivity = externalActivity + timelineData;
                    }

                    


                    /*trData = trData + "<tr>";

                    trData = trData + "<td>" + item.datetime + "</td>";
                    trData = trData + "<td>" + item.ticket_id + "</td>";
                    trData = trData + "<td>" + item.user_name + "</td>";
                    trData = trData + "<td>" + item.notify_contact + "</td>";
                    trData = trData + "<td>" + item.comment  + "</td>";

                    trData = trData + "</tr>";*/

                  });

                  //$("#activity_body").html(trData);
                  $("#activity_view").html(systemActivity);
                  $("#internal_activity_view").html(internalActivity);
                  $("#external_activity_view").html(externalActivity);

                    
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
