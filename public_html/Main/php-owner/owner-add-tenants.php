<?php

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    
    /*
     * TABLES AFFECTED: users and user_hostel_bridge 
     */
    
    
    /*USERS table
    * Change user_status from NULL to Tenant
    */
    
    
    
    /*
     * USER_HOSTEL_BRIDGE table
     * INSERT user_id and hostel_no 
     */
    
    
    
    /*SELECT ->To display the tenants
     * 
     * Sample Query: 
     * SELECT * FROM users join user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id WHERE 
     * user_hostel_bridge.hostel_no = 1 AND users.user_status = "Tenant" AND users.user_type = "Student"   
     */
    
    
}