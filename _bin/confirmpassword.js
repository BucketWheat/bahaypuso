$(document).ready(function () {
    $('#inputPassword').keyup(function () {
        var pass = $('#inputPassword').val();
        var confirm = $('#passwordConfirm').val();

        if (pass != confirm) {
            $('.status').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password doesn' + "'" + 't match!</div>');
            $('#change-password').attr('disabled', true);
        } else if (pass == '' && confirm == '') {
            $('.status').html("");
            $('#change-password').attr('disabled', true);
        }
        else {
            $('.status').html('<div class="alert alert-success" role="alert" style="padding: 5px; margin-top: 3px;">Password matched.</div>');
            $('#change-password').removeAttr('disabled');
        }
    });

    $('#passwordConfirm').keyup(function () {
        var pass = $('#inputPassword').val();
        var confirm = $('#passwordConfirm').val();

        if (pass != confirm) {
            $('.status').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password doesn' + "'" + 't match!</div>');
            $('#change-password').attr('disabled', true);
        } else if (pass == '' && confirm == '') {
            $('.status').html("");
            $('#change-password').attr('disabled', true);
        }
        else {
            $('.status').html('<div class="alert alert-success" role="alert" style="padding: 5px; margin-top: 3px;">Password matched.</div>');
            $('#change-password').removeAttr('disabled');
        }
    });
});