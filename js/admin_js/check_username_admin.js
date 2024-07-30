/* check nurse username if taken */
$(document).ready(function () {
    $("#inputUsername").keyup(function () {
        var username = $(this).val();
        var text = $('#status').text();

        if (username != '') {

            if ((username.split(" ").length - 1) > 0) {
                $('#status').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Username must not have whitespaces!</div>');
            }
            else {
                $.ajax({
                    url: 'functions/check_username_admin.php',
                    type: 'post',
                    data: { username: username },
                    success: function (response) {

                        $('#status').html(response);
                    }
                });
            }
        } else {
            $("#status").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Input Valid Username.</div>');
        }
        
        if (text == 'Username already exist!' || text == 'Input Valid Username.' || text == '') {
            $('#addAdmin').attr('disabled', true);
        } else if (text == 'Username is available.') {
            $('#addAdmin').removeAttr('disabled');
        } else {
            $('#addAdmin').attr('disabled', true);
        }
    });
});

$(document).ready(function () {
    $("#inputUsername").blur(function () {
        var username = $(this).val();
        var text = $('#status').text();

        if (username != '') {

            if ((username.split(" ").length - 1) > 0) {
                $('#status').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Username must not have whitespaces!</div>');
            }
            else {
                $.ajax({
                    url: 'functions/check_username_admin.php',
                    type: 'post',
                    data: { username: username },
                    success: function (response) {

                        $('#status').html(response);
                    }
                });
            }
        } else {
            $("#status").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Input Valid Username.</div>');
        }
        
        if (text == 'Username already exist!' || text == 'Input Valid Username.' || text == '') {
            $('#addAdmin').attr('disabled', true);
        } else if (text == 'Username is available.') {
            $('#addAdmin').removeAttr('disabled');
        } else {
            $('#addAdmin').attr('disabled', true);
        }
    });
});