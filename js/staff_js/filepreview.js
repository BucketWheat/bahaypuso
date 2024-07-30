$(document).ready(function () {

    // IMAGE FILE UPLOAD
    $('#upload-photo').click(function () {
        $('#preview-photo').html('');
        var fd = new FormData();
        var files = $('#file-photo')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'functions/preview_photo.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $('#preview-photo').html('<img src="../../uploads/tmp/' + response + '" class="photo-preview" style="display: inline-block;" alt="Image Preview">')
                } else {
                    alert('Invalid file format');
                }
            }
        });
    });

    // IMAGE FILE UPLOAD ON UPDATE
    $('#upload-photo-update').click(function () {
        $('#preview-photo').html('');
        var fd = new FormData();
        var files = $('#file-photo-update')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'functions/preview_photo.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $('#preview-photo-update').html('<img src="../../uploads/tmp/' + response + '" class="photo-preview" style="display: inline-block;" alt="Image Preview">')
                } else {
                    alert('Invalid file format');
                }
            }
        });
    });

    // VIDEO FILE UPLOAD
    $('#upload-video').click(function () {
        $('#preview-video').html('');
        var fd = new FormData();
        var files = $('#file-video')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'functions/preview_video.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $('#preview-video').html('<video width="100%" controls><source src = "../../uploads/tmp/' + response + '" type = "video/mp4"><source src="../../uploads/tmp/' + response + '" type="video/mov">Your browser does not support the video tag.</video>')
                } else {
                    alert('Invalid file format');
                }
            }
        });
    });

    // VIDEO FILE UPLOAD ON UPDATE
    $('#upload-video-update').click(function () {
        $('#preview-video-update').html('');
        var fd = new FormData();
        var files = $('#file-video-update')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'functions/preview_video.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $('#preview-video-update').html('<video width="100%" controls><source src = "../../uploads/tmp/' + response + '" type = "video/mp4"><source src="../../uploads/tmp/' + response + '" type="video/mov">Your browser does not support the video tag.</video>')
                } else {
                    alert('Invalid file format');
                }
            }
        });
    });
});