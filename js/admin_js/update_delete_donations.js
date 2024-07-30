/* VIEW DONATIONS INFORMATION */
$(document).ready(function () {

    /* DATA TABLES FOR PENDING AND CANCELLED DONATIONS */

    $('#datatable-pending-cash').DataTable();

    $('#datatable-pending-cash').on('click', '.viewbtn', function () {
        $('#modal-pending-cash').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#donationID-cash').val(data[0]);
        $('#fullname').val(data[2]);
        $('#institution').val(data[3]);
        $('#contact').val(data[4]);
        $('#address').val(data[5]);
        $('#email').val(data[6]);
        $('#type').val(data[7]);
        $('#amount').val("₱"+data[8]+".00");
        $('#description').val(data[9]);
        $('#recorded').val(data[10]);
        $('#received').val(data[11]);
        $('#status').val(data[12]);

    });

    $('#datatable-pending-misc').DataTable();

    $('#datatable-pending-misc').on('click', '.viewbtn', function () {
        $('#modal-pending-misc').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#donationID-misc').val(data[0]);
        $('#fullname-misc').val(data[2]);
        $('#institution-misc').val(data[3]);
        $('#contact-misc').val(data[4]);
        $('#address-misc').val(data[5]);
        $('#email-misc').val(data[6]);
        $('#type-misc').val(data[7]);
        $('#description-misc').val(data[8]);
        $('#recorded-misc').val(data[9]);
        $('#received-misc').val(data[10]);
        $('#status-misc').val(data[11]);
    });

    /* DATA TABLES FOR RECEIVED DONATIONS */

    $('#datatable-received-cash').DataTable();

    $('#datatable-received-cash').on('click', '.viewbtn', function () {
        $('#modal-received-cash').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#donationID-cash').val(data[0]);
        $('#fullname').val(data[2]);
        $('#institution').val(data[3]);
        $('#contact').val(data[4]);
        $('#address').val(data[5]);
        $('#email').val(data[6]);
        $('#type').val(data[7]);
        $('#amount').val("₱"+data[8]+".00");
        $('#description').val(data[9]);
        $('#recorded').val(data[10]);
        $('#received').val(data[11]);
        $('#status').val(data[12]);

    });

    $('#datatable-received-misc').DataTable();

    $('#datatable-received-misc').on('click', '.viewbtn', function () {
        $('#modal-received-misc').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#donationID-misc').val(data[0]);
        $('#fullname-misc').val(data[2]);
        $('#institution-misc').val(data[3]);
        $('#contact-misc').val(data[4]);
        $('#address-misc').val(data[5]);
        $('#email-misc').val(data[6]);
        $('#type-misc').val(data[7]);
        $('#description-misc').val(data[8]);
        $('#recorded-misc').val(data[9]);
        $('#received-misc').val(data[10]);
        $('#status-misc').val(data[11]);
    });

});