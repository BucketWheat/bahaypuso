<?php
session_start();
include("../functions/connections.php");

if (isset($_POST['delete-article'])) {

    $article_id = $_POST['delete-article-id'];

    $query = "DELETE FROM tbl_recommendation_article WHERE recommendation_article_id = '$article_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        header("Location: ../recommendation_management.php?#datatable-article");
        $_SESSION['formSubmitted'] = 'deleted';
        die;
    }
}
