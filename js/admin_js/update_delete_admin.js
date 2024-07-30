$(document).ready(function () {

    $('#datatable').DataTable();

    $('#datatable').on('click', '.editbtn', function () {
        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID').val(data[0]);
        $('#updateFullname').val(data[1]);
        $('#updateUsername').val(data[2]);

        $('#updateUsername').keyup(function () {
            var username = $(this).val();
            var text = $('#updateStatus').text();

            if (username != '') {

                if ((username.split(" ").length - 1) > 0) {
                    $('#updateStatus').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Username must not have whitespaces!</div>');
                }
                else {
                    $.ajax({
                        url: 'functions/check_username_admin.php',
                        type: 'post',
                        data: { username: username },
                        success: function (response) {

                            $('#updateStatus').html(response);
                        }
                    });
                }
            } else {
                $("#updateStatus").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Input Valid Username.</div>');
            }

            if (text == 'Username already exist!' || text == 'Input Valid Username.' || text == '') {
                $('#updateAdmin').attr('disabled', true);
            } else if (text == 'Username is available.') {
                $('#updateAdmin').removeAttr('disabled');
            } else {
                $('#updateAdmin').attr('disabled', true);
            }
        });

        $('#updateUsername').change(function () {
            var username = $(this).val();
            var text = $('#updateStatus').text();

            if (username != '') {

                if ((username.split(" ").length - 1) > 0) {
                    $('#updateStatus').html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Username must not have whitespaces!</div>');
                }
                else {
                    $.ajax({
                        url: 'functions/check_username_admin.php',
                        type: 'post',
                        data: { username: username },
                        success: function (response) {

                            $('#updateStatus').html(response);
                        }
                    });
                }
            } else {
                $("#updateStatus").html('<div class="alert alert-danger" id="notAvail" role="alert" style="padding: 5px; margin-top: 3px;">Input Valid Username.</div>');
            }

            if (text == 'Username already exist!' || text == 'Input Valid Username.' || text == '') {
                $('#updateAdmin').attr('disabled', true);
            } else if (text == 'Username is available.') {
                $('#updateAdmin').removeAttr('disabled');
            } else {
                $('#updateAdmin').attr('disabled', true);
            }
        });
    });

    $('#datatable').on('click', '.delbtn', function () {
        $('#delmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#delete-id').val(data[0]);
        $('#delName').html('Are you sure you want to delete ' + data[1] + '?');
    });
});
