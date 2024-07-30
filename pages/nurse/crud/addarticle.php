<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-article'])) {

    // get values
    $title = ucwords(mysqli_real_escape_string($con, $_POST['title-article']));
    $desc = mysqli_real_escape_string($con, $_POST['description-article']);
    $url = mysqli_real_escape_string($con, $_POST['url-article']);
    date_default_timezone_set("Asia/Manila");
    $date_created = date("Y-m-d");
    $created_by = mysqli_real_escape_string($con, $_POST['uploader-article']);

    if (!empty($title) && !empty($desc) && !empty($url) && !empty($created_by)) {

        // insert into database
        $query = "INSERT INTO tbl_recommendation_article (recommendation_article_title, recommendation_article_description, recommendation_article_url, date_created, created_by) VALUES ('$title', '$desc', '$url', '$date_created', '$created_by')";

        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = 'added';
            header("Location: ../recommendation_management.php?#datatable-article");
            die;
        } else {
            $_SESSION['formSubmitted'] = 'db error';
            header("Location: ../recommendation_management.php?#datatable-article");
            die;
        }
    } else {
        $_SESSION['formSubmitted'] = 'failed';
        header("Location: ../recommendation_management.php?#datatable-article");
        die;
    }
}
