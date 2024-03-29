<?php
    session_start();
    // Include the database configuration file
    require_once 'ajax/dbconfig.php';
    
     $file_name   = "";
     $aside_color = "sidebar-light-primary";
     $nav_color   = "bg-white";
     $card_color  = "primary";

    $query = "SELECT logo_path as file_name FROM settings WHERE id = 1";
    $result = $mysqli->query($query);
    
    if(mysqli_num_rows($result) > 0)
    {
        $row = $result->fetch_assoc();
        $file_name = $row['file_name'];
    } 

    $query = "SELECT * FROM agent_login WHERE id = ".$_SESSION['user_id'];
    $result = $mysqli->query($query);
    $loginUserName = '';
    
    if(mysqli_num_rows($result) > 0)
    {
        $row = $result->fetch_assoc();
        $loginUserName = $row['user_id'];
    } 


?>
    
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light <?=$nav_color?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      -->
      
      
    </ul>

    <?php
          // Include the database configuration file
          require_once 'ajax/dbconfig.php';         
          
          $userID = $_SESSION['user_id'];

          // Fetch all data from the email_template table
          $query = "SELECT COUNT(id) as cnt FROM notification WHERE notification.view=0 AND login_id=".$userID;
          $result = $mysqli->query($query);
          $count = 0;
          // Check if any rows were returned
          if ($result->num_rows > 0)
          {                        
              while ($row = $result->fetch_assoc())
              {     
                $count = $row['cnt'];                                                                                                                       
              }
          }
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


    <li class="nav-item dropdown">
          <a id="notification_bell" class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
            if($count > 0)
            {

            
          ?>
          <span class="badge badge-danger navbar-badge"><?=$count?><!--<?=$_SESSION['user_id']?>--></span>

          <?php
            }
          ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">Notifications</span>

              <?php
                    // Include the database configuration file
                    require_once 'ajax/dbconfig.php';         
                    
                    $userID = $_SESSION['user_id'];
                    $userType = $_SESSION['user_type'];
                    $query = "SELECT * FROM notification WHERE view=0 AND login_id=".$userID;

                    /*
                    if($userType == 0) //admin
                    {
                      $query = "SELECT * FROM notification WHERE view=0 AND login_id IN (SELECT id FROM agent_login WHERE is_admin=0)";
                    }
                    else
                    {
                      $query = "SELECT * FROM notification WHERE view=0 AND login_id=".$userID;
                    }
                    */

                    
                    
                    
                    $result = $mysqli->query($query);

                    // Check if any rows were returned
                    if ($result->num_rows > 0)
                    {                        
                        while ($row = $result->fetch_assoc())
                        {                                                                               
                          ?>
                              <div class="dropdown-divider"></div>
                              <a href="ticket.php?notification_id=<?=$row['id']?>" class="dropdown-item">
                                <i class="fas fa-comments mr-2"></i> <?=$row['msg']?>           
                              </a> 
                          <?php                                                
                        }
                    }
                    
              ?>

                      
              
              




              <!--<div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              -->
          </div>

        </li>

      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i><?=$loginUserName?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="login.php" class="dropdown-item">
            <i class="fas fa-sign-out mr-2"></i>Logout
          </a>
        </div>
        
        <!--
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
        -->
      </li>






     
     
    </ul>
  </nav>
  <!-- /.navbar -->

<aside class="main-sidebar <?=$aside_color?> elevation-4">
    <!-- Brand Logo -->
    <!--
    <a href="index3.html" class="brand-link">
      <img src="uploads/<?=$file_name?>" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8; width:90%;">
    </a>
    -->
    <a href="index.php">
        <img src="uploads/<?=$file_name?>" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8; width:100%;height: 80px;">
    </a>
    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-host-scrollbar-vertical-hidden"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 374px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style=""><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!--<li class="nav-item">            
              <li class="nav-item">
                  <a href="dashboard.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
            </li> -->
            
              
        <li class="nav-item">

          <?php
              if($_SESSION['user_type'] == 0) //admin user
              {
?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Masters
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="company_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="contact_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="work_status_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Work Status Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="projects.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Master</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="settings.php" class="nav-link">
              <i class="fa fa-cog nav-icon"></i>
              <p>Settings</p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="agent_master.php" class="nav-link">
              <i class="far fa-user nav-icon"></i>
              <p>Agent</p>
            </a>
          </li>
		  
		  
		  <li class="nav-item">
            <a href="ticket.php" class="nav-link">
              <i class="far fa-comments nav-icon"></i>
              <p>Ticket</p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="report_all.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Report</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="report1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Close</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hold</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report3.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Progress</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report4.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Not Started</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="report_not_resolved.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Not Resolved</p>
                </a>
              </li>

              

            </ul>
          </li>
<?php
              }
              else
              {
?>
                  <li class="nav-item">
                    <a href="ticket.php" class="nav-link">
                      <i class="far fa-comments nav-icon"></i>
                      <p>Ticket</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chart-bar"></i>
                      <p>
                        Reports
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="report1.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Close</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="report2.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Hold</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="report3.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>In Progress</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="report4.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Not Started</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="report_not_resolved.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Not Resolved</p>
                        </a>
                      </li>



                    </ul>
                  </li>

          
<!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="report1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Close</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hold</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report3.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Progress</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="report4.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Not Started</p>
                </a>
              </li>
            </ul>
          </li>
              -->


<?php
              }
          ?>

            





          
           <!--
           <li class="nav-item">
            <a href="projects.php" class="nav-link">
              <i class="far fa-calendar-alt nav-icon"></i>
              <p>Project</p>
            </a>
          </li>
          -->
          
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      
      
      
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>
  
  
  
      