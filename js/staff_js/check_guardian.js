/* check guardian of senior */
$(document).ready(function () {
    $("#inputGuardian").keyup(function () {
        var guardian = $(this).val();
        var text = $('#check_guardian').text();

        if (guardian != '') {

            $.ajax({
                url: '../functions/check_guardian.php',
                type: 'post',
                data: { guardian: guardian },
                dateType: 'json',
                success: function (data) {

                    var obj = JSON.parse(data);
                    $('#check_guardian').html(obj.response);
                    $('#guardianID').val(obj.guardian_id);
                }
            });
        } else {
            $("#check_guardian").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Enter guardian' + "'" + 's valid fullname.</div>');
        }

        if (text == 'Guardian not found.' || text == "Enter guardian's valid fullname." || text == '') {
            $('#addSenior').attr('disabled', true);
        } else if (text == 'Guardian fullname matched.') {
            $('#addSenior').removeAttr('disabled');
        } else {
            $('#addSenior').attr('disabled', true);
        }
    });
});

$(document).ready(function () {
    $("#inputGuardian").blur(function () {
        var guardian = $(this).val();
        var text = $('#check_guardian').text();

        if (guardian != '') {

            $.ajax({
                url: '../functions/check_guardian.php',
                type: 'post',
                data: { guardian: guardian },
                dateType: 'json',
                success: function (data) {

                    var obj = JSON.parse(data);
                    $('#check_guardian').html(obj.response);
                    $('#guardianID').val(obj.guardian_id);
                }
            });
        } else {
            $("#check_guardian").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Enter guardian' + "'" + 's valid fullname.</div>');
        }

        if (text == 'Guardian not found.' || text == "Enter guardian's valid fullname." || text == '') {
            $('#addSenior').attr('disabled', true);
        } else if (text == 'Guardian fullname matched.') {
            $('#addSenior').removeAttr('disabled');
        } else {
            $('#addSenior').attr('disabled', true);
        }
    });
});


/* check guardian of senior on update*/
$(document).ready(function () {
    $("#updateGuardian").keyup(function () {
        var updateGuardian = $(this).val();
        var updateText = $('#check_guardian_update').text();

        if (updateGuardian != '') {

            $.ajax({
                url: '../functions/check_guardian.php',
                type: 'post',
                data: { guardian: updateGuardian },
                dateType: 'json',
                success: function (updateData) {

                    var updateObj = JSON.parse(updateData);
                    $('#check_guardian_update').html(updateObj.response);
                    $('#updateGuardianID').val(updateObj.guardian_id);
                }
            });
        } else {
            $("#check_guardian_update").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Enter guardian' + "'" + 's valid fullname.</div>');
        }

        if (updateText == 'Guardian not found.' || updateText == "Enter guardian's valid fullname." || updateText == '') {
            $('#updateSenior').attr('disabled', true);
        } else if (updateText == 'Guardian fullname matched.') {
            $('#updateSenior').removeAttr('disabled');
        } else {
            $('#updateSenior').attr('disabled', true);
        }
    });
});

$(document).ready(function () {
    $("#updateGuardian").blur(function () {
        var updateGuardian = $(this).val();
        var updateText = $('#check_guardian_update').text();

        if (updateGuardian != '') {

            $.ajax({
                url: '../functions/check_guardian.php',
                type: 'post',
                data: { guardian: updateGuardian },
                dateType: 'json',
                success: function (updateData) {

                    var updateObj = JSON.parse(updateData);
                    $('#check_guardian_update').html(updateObj.response);
                    $('#updateGuardianID').val(updateObj.guardian_id);
                }
            });
        } else {
            $("#check_guardian_update").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Enter guardian' + "'" + 's valid fullname.</div>');
        }

        if (updateText == 'Guardian not found.' || updateText == "Enter guardian's valid fullname." || updateText == '') {
            $('#updateSenior').attr('disabled', true);
        } else if (updateText == 'Guardian fullname matched.') {
            $('#updateSenior').removeAttr('disabled');
        } else {
            $('#updateSenior').attr('disabled', true);
        }
    });
});

