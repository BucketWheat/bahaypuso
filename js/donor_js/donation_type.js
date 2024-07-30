$(document).ready(function () {
    $('#inputCategory').change(function () {
        var type = $(this).val().toLowerCase();

        if (type == 'cash') {
            $("#amount-input").append('<label for="amount" id="amount-label">Amount</label>');
            $("#amount-input").append('<input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>');
        } else {
            $('#amount-input').empty();
        }
    });
});