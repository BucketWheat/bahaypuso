$(document).ready(function() {
    $('#inputDOB').change(function() {
        var today = new Date();
        var birthDate = new Date($('#inputDOB').val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        $('#inputAge').val(age);
    });
}); 

$(document).ready(function() {
    $('#updateDOB').change(function() {
        var today1 = new Date();
        var birthDate1 = new Date($('#updateDOB').val());
        var age1 = today1.getFullYear() - birthDate1.getFullYear();
        var m1 = today1.getMonth() - birthDate1.getMonth();
        if (m1 < 0 || (m1 === 0 && today1.getDate() < birthDate1.getDate())) {
            age1--;
        }
        $('#updateAge').val(age1);
    });
}); 