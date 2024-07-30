/* DATA TABLES OF PENDING DONATIONS */
$(document).ready(function () {
    $('#datatable').DataTable();

    $('#datatable').on('click', '.viewbtn', function () {
        $('#viewmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID').val(data[0]);
        $('#updateFullname').val(data[1]);
        $('#updateContact').val(data[2]);
        $('#updateEmail').val(data[3]);
        $('#updateCategory').val(data[4]);
        $('#updateDescription').val(data[5]);
        $('#updateDate').val(data[6]);
        $('#updateStatus').val(data[7]);
    });

    /* $('#datatable').on('click', '.delbtn', function () {
        $('#delmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#delete-id').val(data[0]);
        $('#delName').html('Are you sure you want to delete donation records from ' + data[1] + '?');
    }); */
});

/* DATA TABLES OF RECEIVED DONATIONS */
$(document).ready(function () {
    $('#datatable2').DataTable();

    $('#datatable2').on('click', '.viewbtn', function () {
        $('#viewReceived').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#receivedID').val(data[0]);
        $('#receivedFullname').val(data[1]);
        $('#receivedContact').val(data[2]);
        $('#receivedEmail').val(data[3]);
        $('#receivedCategory').val(data[4]);
        $('#receivedDescription').val(data[5]);
        $('#receivedDaterecorded').val(data[6]);
        $('#receivedDate').val(data[7]);
        $('#receivedStatus').val(data[8]);
    });

    /* $('#datatable2').on('click', '.delbtn', function () {
        $('#delReceived').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#deleteReceived-id').val(data[0]);
        $('#delReceivedname').html('Are you sure you want to delete donation records from ' + data[1] + '?');
    }); */
});

/* DATA TABLES OF CANCELLED DONATIONS */
$(document).ready(function () {
    $('#datatable-cancelled').DataTable();

    $('#datatable-cancelled').on('click', '.viewbtn', function () {
        $('#viewmodal-cancelled').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#updateID_cancelled').val(data[0]);
        $('#updateFullname_cancelled').val(data[1]);
        $('#updateContact_cancelled').val(data[2]);
        $('#updateEmail_cancelled').val(data[3]);
        $('#updateCategory_cancelled').val(data[4]);
        $('#updateDescription_cancelled').val(data[5]);
        $('#updateDate_cancelled').val(data[6]);
        $('#updateStatus_cancelled').val(data[7]);
    });

    /* $('#datatable2').on('click', '.delbtn', function () {
        $('#delReceived').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        $('#deleteReceived-id').val(data[0]);
        $('#delReceivedname').html('Are you sure you want to delete donation records from ' + data[1] + '?');
    }); */
});
