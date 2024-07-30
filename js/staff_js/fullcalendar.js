$(document).ready(function () {
    $('#calendar').css('font-size', '1em');
    var calendar = $('#calendar').fullCalendar({
       /*  editable: true, */
        eventLimit: true,
        events: 'functions/loadevents.php',
        selectable: true,
        selectHelper: true,
        eventRender: function (event, element) {
            element.popover({
                html:true,
                animation: true,
                delay: 100,
                title:"<div style='text-align:center;margin:0;'<strong>" + moment(event.start).format('h:mm a')+"</strong></div>" ,
                content:"<strong style='color:rgb(45, 150, 150);font-size:1.25em;'>"+event.description+"</strong>"+"<p style='color:black;margin:0;'>"+event.title+"</p>",
                trigger: 'hover'
            });
        },
    });
});

/* $.ajax({
    url: 'functions/loadevents.php',
    dateType: 'json',
    success: function (data) {

        var obj = JSON.parse(data);
       console.log(obj);
    }
}); */