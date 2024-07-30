$(document).ready(function () {
    /* DATA TABLE FOR PHOTOS */
    $('#datatable-photo').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    /* VIEW IMAGE DETAILS */
    $('#datatable-photo').on('click', '.editbtn', function () {
        $('#photo-modal-update').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#photo-id').val(data[0]);
        $('#title-photo-update').val(data[1]);
        $('#description-photo-update').val(data[2]);
        // set photo preview to blank first
        $('#preview-photo-update').html("");
        $('#preview-photo-update').html('<img src="../../uploads/photos/' + data[3] + '" class="photo-preview" style="display: inline-block;" alt="Image Preview">');
        $('#date-photo-update').val(data[4]);
        $('#created-photo-update').val(data[5]);
    });

    /* DELETE IMAGE DETAILS */
    $('#datatable-photo').on('click', '.delbtn', function () {
        $('#delmodal-photo').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#delete-photo-id').val(data[0]);
        $('#del-photo-title').html('Are you sure you want to delete <em><strong>' + data[1] + '</strong></em>?');
    });

    /* DATA TABLE FOR VIDEO */
    $('#datatable-video').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    /* VIEW VIDEO DETAILS */
    $('#datatable-video').on('click', '.editbtn', function () {
        $('#video-modal-update').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#video-id').val(data[0]);
        $('#title-video-update').val(data[1]);
        $('#description-video-update').val(data[2]);
        // set video preview to blank first
        $('#preview-video-update').html("");
        $('#preview-video-update').html('<video width="100%" controls><source src = "../../uploads/videos/' + data[3] + '" type = "video/mp4"><source src="../../uploads/videos/' + data[3] + '" type="video/mov">Your browser does not support the video tag.</video>');
        $('#date-video-update').val(data[4]);
        $('#created-video-update').val(data[5]);
    });

    /* DELETE VIDEO DETAILS */
    $('#datatable-video').on('click', '.delbtn', function () {
        $('#delmodal-video').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#delete-video-id').val(data[0]);
        $('#del-video-title').html('Are you sure you want to delete <em><strong>' + data[1] + '</strong></em>?');
    });

    /* DATA TABLE FOR ARTICLES */
    $('#datatable-article').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });

    /* VIEW ARTICLE DETAILS */
    $('#datatable-article').on('click', '.editbtn', function () {
        $('#article-modal-update').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#article-id').val(data[0]);
        $('#title-article-update').val(data[1]);
        $('#description-article-update').val(data[2]);
        // set article preview to blank first
        $('#url-article-update').val(data[3]);
        $('#date-article-update').val(data[4]);
        $('#created-article-update').val(data[5]);
    });

     /* DELETE ARTICLE DETAILS */
     $('#datatable-article').on('click', '.delbtn', function () {
        $('#delmodal-article').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#delete-article-id').val(data[0]);
        $('#del-article-title').html('Are you sure you want to delete <em><strong>' + data[1] + '</strong></em>?');
    });
});
