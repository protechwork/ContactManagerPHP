<?php
// Include the database configuration file
require_once 'dbconfig.php';
// get_agent.php

// Check if the ID parameter is provided
if (!empty($_GET['id'])) {
    $agentId = $_GET['id'];


    // Fetch agent data from agent_master, agent_notification, and agent_login tables
    $query = "SELECT am.name, am.difficulty_contact, am.address, an.mobile_no, an.whatsapp_no, an.smtp, an.email_pasword, an.email, al.user_id, al.password, al.is_admin FROM agent_master am 
              INNER JOIN agent_notification an ON am.id = an.agent_id
              INNER JOIN agent_login al ON am.id = al.id
              WHERE am.id = $agentId";
              
    $result = $mysqli->query($query);//var_dump($query);die();

    if ($result && $result->num_rows > 0) {
        $agentData = $result->fetch_assoc();
        
        
        
        
        
         $reportingToIds = array(); // Array to store reporting_to_id values
        
        // Fetch reporting_to_id values for the current agent
            $query = "SELECT reporting_to_id FROM agent_reporting_to WHERE agent_id=". $agentId;
              
            $result = $mysqli->query($query);
        
            if ($result && $result->num_rows > 0) {
                $reportingToIds = $result->fetch_all();
            }
        // ...
        
        $agentData["reportingToIds"]=$reportingToIds;
        
        
        
        
        
        
        

        // Return the agent data as a JSON response
        header('Content-Type: application/json');
        echo json_encode($agentData);
    } else {
        // Return an empty response or an appropriate error message
        echo json_encode([]);
    }

    $mysqli->close();
}

