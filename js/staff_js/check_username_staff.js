/* check staff username if taken */
$(document).ready(function () {
    $("#updateUsername").keyup(function () {
        var username = $(this).val();
        var updateID = $('#updateID').val();

        if (username != '') {

            if ((username.split(" ").length - 1) > 0) {
                $('#status').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Username must not have whitespaces!</div>');
            }
            else {
                $.ajax({
                    url: 'functions/check_username_staff.php',
                    type: 'post',
                    data: {
                        username: username,
                        updateID: updateID
                    },
                    success: function (response) {

                        if (response == '1') {
                            $('#status').html('<div class="alert alert-secondary" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">No changes.</div>');
                            $('#updateStaff').removeAttr('disabled');
                        } else if (response == '2') {
                            $('#status').html('<div class="alert alert-danger" role="alert" id="notAvail" style="padding: 5px; margin-top: 3px;">Username already exists!</div>');
                            $('#updateStaff').attr('disabled', true);
                        } else if (response == '3') {
                            $('#status').html('<div class="alert alert-success" id="Avail" role="alert" style="padding: 5px; margin-top: 3px;">Username is available.</div>');
                            $('#updateStaff').removeAttr('disabled');
                        }
                    }
                });
                var text = $('#status').text();
                console.log(text);
            }
        } else {
            $("#status").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Input Valid Username.</div>');
            $('#updateStaff').attr('disabled', true);
        }
    });
});
