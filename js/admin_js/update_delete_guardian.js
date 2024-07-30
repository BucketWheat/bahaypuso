/* UPDATE ACTIVE GUARDIAN */
$(document).ready(function() {
    
    $('#datatable').DataTable();

    $('#datatable').on('click', '.viewbtn', function() {
        $('#viewmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        var guardian_id = data[0];
        $('#updateID').val(guardian_id);

        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_guardian.php',
            type: 'post',
            data: { guardian_id: guardian_id },
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
        $('#updateContact').val(data[6]);
        $('#updateEmail').val(data[7]);
        $('#updateUsername').val(data[8]);
        $('#updateStatus-active').val(data[12]);
    });
});

/* UPDATE INACTIVE GUARDIAN */
$(document).ready(function() {
    
    $('#datatable-inactive').DataTable();

    $('#datatable-inactive').on('click', '.viewbtn', function() {
        $('#viewmodal-inactive').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        var guardian_id = data[0];
        $('#updateID_inactive').val(guardian_id);
       
        /* Get First name and Last Name */
        $.ajax({
            url: 'functions/get_guardian.php',
            type: 'post',
            data: { guardian_id: guardian_id },
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
        $('#updateContact_inactive').val(data[6]);
        $('#updateEmail_inactive').val(data[7]);
        $('#updateUsername_inactive').val(data[8]);
        $('#updateStatus_inactive').val(data[12]);
    });
});