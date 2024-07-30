<?php

    include("connections.php");

    if (isset($_POST['username'])) {
        $username = mysqli_real_escape_string($con,$_POST['username']);
    
        $query = "select count(*) as cntAdmin from tbl_admin where username='".$username."'";

        $result = mysqli_query($con,$query);
        $response = '<div class="alert alert-success" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">Username is available.</div>';

        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_array($result);
      
            $count = $row['cntAdmin'];
          
            if($count > 0){
                $response = '<div class="alert alert-danger" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Username already exists!</div>';
            }
         }
         echo $response;
         die;
    }