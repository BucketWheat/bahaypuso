/* LOAD ACCOUNT INFORMATION OF NURSE */
$(document).ready(function () {

    //set value of account information
    var nurseFname = $('#nurse_fname').val();
    var nurseLname = $('#nurse_lname').val();

    if (nurseFname != '' && nurseLname != '') {
        $.ajax({
            url: 'functions/load_account_information_nurse.php',
            type: 'post',
            data: {
                nurseFname: nurseFname,
                nurseLname: nurseLname,
            },
            dateType: 'json',
            success: function (data) {

                var data = JSON.parse(data);
                $('#updateID').val(data.nurseID);
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