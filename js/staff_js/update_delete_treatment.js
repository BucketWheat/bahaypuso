/* UPDATE AND ADMINISTER TREATMENT INFORMATON */
$(document).ready(function () {

    $('#datatable').DataTable({
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]],
        "order": [[0, "desc"]]
    });

    $('#datatable').on('click', '.viewbtn', function () {
        $('#treatment_modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID').val(data[0]);
        $('#healthinfoID').val(data[1])
        $('#updateSenior').val(data[2]);
        $('#updateCondition').val(data[3]);
        $('#updateTreatmentName').val(data[4]);
        $('#updateTreatmentDetails').val(data[5]);

        $('#updateNurse').val(data[6]);
        /* $('#check_nurse').val(''); */

        $('#updateDate').val(data[7]);
        $('#updateStatus').val(data[8]);
    });

    /* ADMINISTER TREATMENT */
    $('#datatable').on('click', '.administer', function () {
        $('#modal-administer').modal('show'); 

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#treatment_senior').val(data[2]);
        $('#treatment_condition').val(data[3]);
        $('#treatment_name').val(data[4]);
        $('#treatment_details').val(data[5]);
        $('#treatment_ID').val(data[0]);
        $('#treat_seniorID').val(data[9]);
    });

    /* VIEW AND UPDATE ADMINISTED TREATMENT INFORMATON */
    $('#datatable_administered').DataTable();

    $('#datatable_administered').on('click', '.viewbtn', function () {
        $('#administered_modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        /* $('#updateID').val(data[0]);
        $('#healthinfoID').val(data[1])
        $('#updateSenior').val(data[2]);
        $('#updateCondition').val(data[3]);
        $('#updateTreatmentName').val(data[4]);
        $('#updateTreatmentDetails').val(data[5]);

        $('#updateNurse').val(data[6]);
        $('#check_nurse').val('');

        $('#updateDate').val(data[7]);
        $('#updateStatus').val(data[8]); */
    });

    /* VIEW CANCELLED TREATMENT INFORMATON */

    $('#datatable_cancelled').DataTable({
        "order": [[0, "desc"]]
    });

    $('#datatable_cancelled').on('click', '.viewbtn', function () {
        $('#cancelled_treatment').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        /* $('#updateID').val(data[0]); */
        $('#updateSenior_cancelled').val(data[1]);
        $('#updateCondition_cancelled').val(data[2]);
        $('#updateTreatmentName_cancelled').val(data[3]);
        $('#updateTreatmentDetails_cancelled').val(data[4]);

        $('#updateNurse_cancelled').val(data[5]);
        $('#check_nurse_cancelled').val('');

        $('#updateDate_cancelled').val(data[6]);
        $('#updateStatus_cancelled').val(data[7]);
    });
});