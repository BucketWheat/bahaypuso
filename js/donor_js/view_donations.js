/* VIEW DONATIONS INFORMATION */
$(document).ready(function () {

    $('#datatable-cash').DataTable();

    $('#datatable-cash').on('click', '.viewbtn', function () {
        $('#modal-cash').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#type').val(data[1]);
        $('#amount').val("₱"+data[2]+".00");
        $('#description').val(data[3]);
        $('#recorded').val(data[4]);
        $('#received').val(data[5]);
        $('#status').val(data[6]);

    });

    $('#datatable-misc').DataTable();

    $('#datatable-misc').on('click', '.viewbtn', function () {
        $('#modal-misc').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#type_misc').val(data[1]);
        $('#description_misc').val(data[2]);
        $('#recorded_misc').val(data[3]);
        $('#received_misc').val(data[4]);
        $('#status_misc').val(data[5]);

    });

});