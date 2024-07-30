<?php
session_start();
include "../functions/connections.php";

if (isset($_POST['add-article-update'])) {

    // get values
    $article_id = $_POST['article-id'];
    $title = mysqli_real_escape_string($con, $_POST['title-article-update']);
    $desc = mysqli_real_escape_string($con, $_POST['description-article-update']);
    $url = mysqli_real_escape_string($con, $_POST['url-article-update']);

    if (!empty($title) && !empty($desc) && !empty($url)) {

        // insert into database
        $query = "UPDATE tbl_recommendation_article SET recommendation_article_title='$title', recommendation_article_description='$desc', recommendation_article_url='$url' WHERE recommendation_article_id=$article_id";

        $run = mysqli_query($con, $query);

        if ($run) {
            $_SESSION['formSubmitted'] = 'updated';
            header("Location: ../recommendation_management.php?#datatable-article");
            die;
        } else {
            $_SESSION['formSubmitted'] = 'db error';
            header("Location: ../recommendation_management.php?#datatable-article");
            die;
        }
    } else {
        $_SESSION['formSubmitted'] = 'update_failed';
        header("Location: ../recommendation_management.php?#datatable-article");
        die;
    }
}
