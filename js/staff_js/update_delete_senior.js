$(document).ready(function() {
    
    $('#datatable').DataTable();

    $('#datatable').on('click', '.viewbtn', function() {
        $('#viewmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        $('#updateID').val(data[0]);
        $('#updateFullname').val(data[1]);

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
    });
});
