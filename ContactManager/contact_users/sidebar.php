<?php
    // Include the database configuration file
    require_once '../ajax/dbconfig.php';
    
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

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="../login.php" class="dropdown-item">
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
        <img src="../uploads/<?=$file_name?>" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8; width:100%;height: 80px;">
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
         
          
		  <li class="nav-item">
            <a href="ticket.php" class="nav-link">
              <i class="far fa-user nav-icon"></i>
              <p>Ticket</p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      
      
      
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>
  
  
  
      