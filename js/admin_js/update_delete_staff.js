/* UPDATE ACTIVE STAFF ACCOUNT */
$(document).ready(function () {

    $('#datatable').DataTable();

    $('#datatable').on('click', '.viewbtn', function () {
        $('#viewmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var staff_id = data[0];
        $('#updateID').val(staff_id);

        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_staff.php',
            type: 'post',
            data: { staff_id: staff_id },
            dateType: 'json',
            success: function (data) {

                var obj = JSON.parse(data);
                $('#updateFname').val(obj.fname);
                $('#updateLname').val(obj.lname);
            }
        });

        $('#updateAddress').val(data[2]);
        $('#updateDOB').val(data[3]);
        $('#updateAge').val(data[4]);
        $('#updateSex').val(data[5]);
        $('#updatePRC').val(data[6]);
        $('#updateContact').val(data[7]);
        $('#updateEmail').val(data[8]);
        $('#updateUsername').val(data[9]);
        $('#updateStatus_active').val(data[13]);
    });
});

/* UPDATE INACTIVE STAFF ACCOUNT */
$(document).ready(function () {

    $('#datatable-inactive').DataTable();

    $('#datatable-inactive').on('click', '.viewbtn', function () {
        $('#viewmodal-inactive').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        var staff_id = data[0];
        $('#updateID_inactive').val(data[0]);
       
        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_staff.php',
            type: 'post',
            data: { staff_id: staff_id },
            dateType: 'json',
            success: function (data) {

                var obj = JSON.parse(data);
                $('#updateFname_inactive').val(obj.fname);
                $('#updateLname_inactive').val(obj.lname);
            }
        });
        $('#updateAddress_inactive').val(data[2]);
        $('#updateDOB_inactive').val(data[3]);
        $('#updateAge_inactive').val(data[4]);
        $('#updateSex_inactive').val(data[5]);
        $('#updatePRC_inactive').val(data[6]);
        $('#updateContact_inactive').val(data[7]);
        $('#updateEmail_inactive').val(data[8]);
        $('#updateUsername_inactive').val(data[9]);
        $('#updateStatus_inactive').val(data[13]);
    });
});