<?php
 class Hostels{
     
    //Gets all the details about a particular hostel **FROM tbl hostels 
    public function getHostelDetails($con, $hostel_no, &$error){
        $query = "SELECT * FROM hostels WHERE hostel_no = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $bool = $stmt->execute();

        if($bool == false){
            array_push($error, $con->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array();

        return $row;
    }
    
    //Gets the information about a particular hostel; **RETURNS just the trow with the lowest price
    public function getHostelInfo($con,$hostel_no){
       $query = "SELECT * FROM hostels JOIN rooms on hostels.hostel_no = rooms.hostel_no "
        . "JOIN rules ON rooms.hostel_no = rules.hostel_no "
        . "JOIN amenities ON amenities.hostel_no = rules.hostel_no "
        . "WHERE hostels.hostel_no = ? GROUP BY hostels.hostel_no";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array();
        
        return $row;
    }
    
    /*
     * Gets ALL the rooms for a particular hostel
     * e.g Hostel 1: returns 1 sharing + price; returns 2 sharing + price e.t.c. 
     */
    public function getRooms($con, $data){
        //Data array contents
        $hostel_no = $data['hostel_no']; $gender = $data['gender'];
        
        $query = 'SELECT * FROM hostels JOIN rooms ON hostels.hostel_no = rooms.hostel_no WHERE hostels.hostel_no = ? '
                . 'AND rooms.blocked_'.$gender.' > rooms.'.$gender.'_count OR blocked_'.$gender.'= 0';
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        $result = $stmt->get_result();
        
        return $result;
    }
    
    /*
     * Gets the details about a particular room in a hostel 
     */
    public function getRoomDetails($con,$data){
        $hostel_no = $data['hostel_no']; $no_sharing = $data['no_sharing'];
        
        $query = "SELECT * FROM hostels JOIN rooms ON hostels.hostel_no = rooms.hostel_no "
                . "WHERE hostels.hostel_no = ? AND no_sharing = ?";
        
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $hostel_no,$no_sharing);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array();
        
        return $row;
    }
    
    public function notRated($con, $data){
        
        //array data;
        $user_id = $data['user_id'];
        $hostel_no = $data['hostel_no'];
        
        $query = "SELECT * FROM ratings WHERE user_id = ? AND hostel_no = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $user_id,$hostel_no);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        //If they had rated that hostel..
        if(mysqli_num_rows($result) > 0){
            return false;
        }
        
        return true;
    }
    
    
    public function ratingCount($con,$hostel_no){
        $query = "SELECT COUNT(*) AS no_ratings FROM `ratings` WHERE hostel_no = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        
        return $row['no_ratings'];
    }
    
    
    public function updateRatings($con, $data){
        
        //Array data
        $rating = $data['rating'];
        $review = $data['review'];
        $hostel_no = $data['hostel_no'];
        $user_id = $data['user_id'];
                
        //INSERT the rating to the ratings table 
        $insert = "INSERT INTO `ratings`(`rating`, `review`, `hostel_no`, `user_id`) VALUES (?,?,?,?)";
        $stmt_1 = $con->prepare($insert);
        $stmt_1->bind_param("ssss", $rating, $review, $hostel_no, $user_id);
        $stmt_1->execute();
        
        /*
         * Do the calculations
         */
        //Get the db data
        $row = $this->getHostelInfo($con,$hostel_no);
        $total_rating = $row['total_rating'];
        $no_rated = $this->ratingCount($con,$hostel_no);
        
        
        $total_rating += $rating; //Add the user rating to the total_rating
        $avg_rating = $total_rating/$no_rated; //Get the avaerage rating 
       
        //UPDATE the TOTAL_RATING and AVG_RATING in HOSTELS table 
        $update = "UPDATE hostels SET total_rating = ?, avg_rating = ? WHERE hostel_no = ?";
        $stmt_2 = $con->prepare($update);
        $stmt_2->bind_param("sss", $total_rating, $avg_rating, $hostel_no);
        $stmt_2->execute();
    }
    
 }
