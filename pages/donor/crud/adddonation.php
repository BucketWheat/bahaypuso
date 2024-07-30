<?php
session_start();
require("../functions/connections.php");

if (isset($_POST['inputDonate'])) {
    //get values
    $donor_id = mysqli_real_escape_string($con, $_POST['donorID']);
    $category = mysqli_real_escape_string($con, $_POST['inputCategory']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $description = mysqli_real_escape_string($con, $_POST['inputDescription']);

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    $status = "Pending";

    if (!empty($category) && $category == "-") {
        $_SESSION['notice'] = "Please choose donation type.";
        header("Location: ../donation_index.php?#donate");
        die;
    } else if ($category == "Cash") {
        if (!empty($donor_id) && !empty($category) && !empty($amount) && !empty($description)) {
            $query_cash = "INSERT INTO tbl_donation (donor_id, donation_category, amount, description, date_recorded, date_received, status) VALUES ($donor_id, '$category', $amount, '$description', '$date', NULL, '$status')";
            $run_cash = mysqli_query($con, $query_cash);

            if ($run_cash) {
                unset($_SESSION['notice']);
                $_SESSION['formSubmitted'] = "success";
                header("Location: ../donation_index.php");
            die;
            } else {
                $_SESSION['notice'] = "An error occurred";
                header("Location: ../donation_index.php?#donate");
                die;
            }

        } else {
            $_SESSION['notice'] = "Please make sure to fill up required fields";
            header("Location: ../donation_index.php?#donate");
            die;
        }
    } else {
        if (!empty($donor_id) && !empty($category) && !empty($description)) {
            $query_add = "INSERT INTO tbl_donation (donor_id, donation_category, description, date_recorded, date_received, status) VALUES ($donor_id, '$category', '$description', '$date', NULL, '$status')";
            $run_add = mysqli_query($con, $query_add);

            if ($run_add) {
                unset($_SESSION['notice']);
                $_SESSION['formSubmitted'] = "success";
                header("Location: ../donation_index.php");
            die;
            } else {
                $_SESSION['notice'] = "An error occurred";
                header("Location: ../donation_index.php?#donate");
                die;
            }

        } else {
            $_SESSION['notice'] = "Please make sure to fill up required fields";
            header("Location: ../donation_index.php?#donate");
            die;
        }
    }    
}
