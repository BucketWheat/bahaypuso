/* LOAD ACCOUNT INFORMATION OF STAFF */
$(document).ready(function () {

    //set value of account information
    var staffFname = $('#staff_fname').val();
    var staffLname = $('#staff_lname').val();

    if (staffFname != '' && staffLname != '') {
        $.ajax({
            url: 'functions/load_account_information_staff.php',
            type: 'post',
            data: {
                staffFname: staffFname,
                staffLname: staffLname
            },
            dateType: 'json',
            success: function (data) {

                var data = JSON.parse(data);
                $('#updateID').val(data.staffID);
                $('#updateFname').val(data.fname);
                $('#updateLname').val(data.lname);
                $('#updateAddress').val(data.address);
                $('#updateDOB').val(data.dob);
                $('#updateAge').val(data.age);
                $('#updateSex').val(data.sex);

                var finalPRC = data.prc;
                if (finalPRC == '') {
                    $('#updatePRC').val('');
                } else {
                    $('#updatePRC').val(finalPRC);
                }
                
                $('#updateContact').val(data.contact);
                $('#updateEmail').val(data.email);
                $('#updateUsername').val(data.username);
                $('#updateStatus_active').val(data.status);
            }
        });
    }
});