$(document).ready(function () {
    $('#updatePassword').keyup(function () {
        var newPass = $('#updatePassword').val();
        var confirmPass = $('#passwordConfirm').val();

        if (newPass != confirmPass) {
            $('#check_confirm').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password doesn'+'t'+' match!</div>');
            $('#updatePass').attr('disabled', true);
        } else {
            $('#check_confirm').html('<div class="alert alert-success" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password match</div>');
            $('#updatePass').removeAttr('disabled');
        }
    });

    $('#passwordConfirm').keyup(function () {
        var newPass = $('#updatePassword').val();
        var confirmPass = $('#passwordConfirm').val();

        if (newPass != confirmPass) {
            $('#check_confirm').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password doesn'+'t'+' match!</div>');
            $('#updatePass').attr('disabled', true);
        } else {
            $('#check_confirm').html('<div class="alert alert-success" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Password match</div>');
            $('#updatePass').removeAttr('disabled');
        }
    });
});