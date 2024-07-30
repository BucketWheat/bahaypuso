/* check name of senior */
$(document).ready(function () {
    $("#inputSenior").change(function () {
        var senior = $(this).val();
        var text = $('#check_senior').text();

        if (senior != '' && senior != '-') {
            $('#addHealthinfo').removeAttr('disabled');
            $.ajax({
                url: 'functions/check_senior.php',
                type: 'post',
                data: { senior: senior },
                dateType: 'json',
                success: function (data) {

                    var obj = JSON.parse(data);
                    $('#check_senior').html(obj.response);
                    $('#seniorID').val(obj.senior_id);
                }
            });
        } else if (text == 'No matching data.' || text == '' || senior == '-') {
            $('#addHealthinfo').attr('disabled', true);
        } else if (text == 'Name of senior matched.') {
            $('#addHealthinfo').removeAttr('disabled');
        }
    });
});

$(document).ready(function () {
    $("#inputSenior").blur(function () {
        var senior = $(this).val();
        var text = $('#check_senior').text();

        if (senior != '' && senior != '-') {
            $('#addHealthinfo').removeAttr('disabled');
            $.ajax({
                url: 'functions/check_senior.php',
                type: 'post',
                data: { senior: senior },
                dateType: 'json',
                success: function (data) {

                    var obj = JSON.parse(data);
                    $('#check_senior').html(obj.response);
                    $('#seniorID').val(obj.senior_id);
                }
            });
        } else if (text == 'No matching data.' || text == '' || senior == '-') {
            $('#addHealthinfo').attr('disabled', true);
        } else if (text == 'Name of senior matched.') {
            $('#addHealthinfo').removeAttr('disabled');
        }
    });
});