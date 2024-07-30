/* UPDATE AND ADMINISTER PENDING HEALTH INFORMATION */
$(document).ready(function () {

    $('#datatable').DataTable();

    $('#datatable').on('click', '.editbtn', function () {
        $('#healthinfo-update').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID').val(data[0]);

        //get senior ID for update
        $('#updateSenior').val(data[1]);
        var seniorName = data[1];
        $.ajax({
            url: 'functions/get_seniorID.php',
            type: 'post',
            data: { seniorName: seniorName },
            success: function (response) {
                $('#updateseniorID').val(response);
            }
        });

        $('#updateBP').val(data[2]);
        $('#updateOxygen').val(data[3]);
        $('#updateTemp').val(data[4]);
        $('#updatePulse').val(data[5]);
        $('#updateWeight').val(data[6]);
        $('#updateDescription').val(data[7]);
        $('#updateDate').val(data[8]);

        //get staff ID for update
        $('#updatestaffName').val(data[9]);
        var staffName = data[9];

        $.ajax({
            url: 'functions/get_staffID.php',
            type: 'post',
            data: { staffName: staffName },
            success: function (response) {
                $('#updateStaffID').val(response);
            }
        });
        $('#updateStatus').val(data[10]);
        
    });

    $('#datatable').on('click', '.administer', function () {
        $('#modal-administer').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#healthinfoID').val(data[0]);

        //get senior_id fromt tbl_senior
        $('#administer_senior').val(data[1]);
        var seniorName = data[1];
        $.ajax({
            url: '../functions/get_seniorID.php',
            type: 'post',
            data: { seniorName: seniorName },
            success: function (response) {
                $('#administer_seniorID').val(response);
            }
        });

        $('#administer_condition').val(data[7]);

        //get nurse_id from tbl_nurse
        var nurseName = $('#nurseName').val();
        $.ajax({
            url: '../functions/get_nurseID.php',
            type: 'post',
            data: { nurseName: nurseName },
            success: function (response) {
                $('#administer_nurseID').val(response);
            }
        });
    });
});

/* UPDATE CANCELLED HEALTH INFORMATION */
$(document).ready(function () {

    $('#datatable-cancelled').DataTable({
        "order": [[0, "desc"]]
    });

    $('#datatable-cancelled').on('click', '.editbtn', function () {
        $('#healthinfo-update-cancelled').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID_cancelled').val(data[0]);
        $('#updateSenior_cancelled').val(data[1]);
        $('#updateBP_cancelled').val(data[2]);
        $('#updateOxygen_cancelled').val(data[3]);
        $('#updateTemp_cancelled').val(data[4]);
        $('#updatePulse_cancelled').val(data[5]);
        $('#updateWeight_cancelled').val(data[6]);
        $('#updateDescription_cancelled').val(data[7]);
        $('#updateDate_cancelled').val(data[8]);
        $('#updatestaffName_cancelled').val(data[9]);
        $('#updateStatus_cancelled').val(data[10]);
    });
});

/* VIEW ADMINISTERED HEALTH INFORMATION */
$(document).ready(function () {

    $('#datatable-administered').DataTable({
        "order": [[5, "desc"]]
    });

    $('#datatable-administered').on('click', '.editbtn', function () {
        $('#healthinfo-update-administered').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID_administered').val(data[0]);
        $('#viewSenior').val(data[1]);
        $('#viewBP').val(data[2]);
        $('#viewOxygen').val(data[3]);
        $('#viewTemp').val(data[4]);
        $('#viewPulse').val(data[5]);
        $('#viewWeight').val(data[6]);
        $('#viewDescription').val(data[7]);
        $('#viewDate').val(data[8]);
        $('#viewStaffName').val(data[10]);
        $('#viewDateAdministered').val(data[9]);
        $('#viewStatus').val(data[11]);
    });
});

