/* ACTIVE SENIOR ACCOUNT UPDATE */
$(document).ready(function() {
    
    $('#datatable').DataTable();

    $('#datatable').on('click', '.viewbtn', function() {
        $('#viewmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        var senior_id = data[0]; 
        $('#updateID').val(senior_id);

        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_senior.php',
            type: 'post',
            data: { senior_id: senior_id },
            dateType: 'json',
            success: function (data) {

                var obj = JSON.parse(data);
                $('#updateFname').val(obj.fname);
                $('#updateLname').val(obj.lname);
            }
        });

        $('#updateGuardianID').val(data[2]);
        var guardianID = data[2];
        $.ajax({
            url: 'functions/get_guardianname.php',
            type: 'post',
            data: { guardianID: guardianID },
            success: function (response) {
                $('#updateGuardian').val(response);
            }
        });
        $('#updateAddress').val(data[3]);
        $('#updateDOB').val(data[4]);
        $('#updateAge').val(data[5]);
        $('#updateSex').val(data[6]);
        $('#updateWeight').val(data[7]);
        $('#updateBlood').val(data[8]);
        $('#updateMedication').val(data[9]);
        $('#updateCondition').val(data[10]);
        $('#updateStatus-active').val(data[11]);
    });
});

/* INACTIVE SENIOR ACCOUNT UPDATE */
$(document).ready(function() {
    
    $('#datatable-inactive').DataTable();

    $('#datatable-inactive').on('click', '.viewbtn', function() {
        $('#viewmodal-inactive').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        var senior_id = data[0]; 
        $('#updateID_inactive').val(senior_id);

        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_senior.php',
            type: 'post',
            data: { senior_id: senior_id },
            dateType: 'json',
            success: function (data) {

                var obj = JSON.parse(data);
                $('#updateFname_inactive').val(obj.fname);
                $('#updateLname_inactive').val(obj.lname);
            }
        });

        $('#updateGuardianID_inactive').val(data[2]);
        var guardianID_inactive = data[2];
        $.ajax({
            url: 'functions/get_guardianname.php',
            type: 'post',
            data: { guardianID: guardianID_inactive },
            success: function (response) {
                $('#updateGuardian_inactive').val(response);
            }
        });
        $('#updateAddress_inactive').val(data[3]);
        $('#updateDOB_inactive').val(data[4]);
        $('#updateAge_inactive').val(data[5]);
        $('#updateSex_inactive').val(data[6]);
        $('#updateWeight_inactive').val(data[7]);
        $('#updateBlood_inactive').val(data[8]);
        $('#updateMedication_inactive').val(data[9]);
        $('#updateCondition_inactive').val(data[10]);
        $('#updateStatus_inactive').val(data[11]);
    });
});
