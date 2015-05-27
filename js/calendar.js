

    $(document).ready(function() {
        
        $('#calendar').fullCalendar({
            theme:true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: undefined,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var title = prompt('Event Title:');
                var eventData;
                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#calendar').fullCalendar('unselect');
            },
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            eventClick: function(event) {
                // opens events in a popup window
                console.log(event);
                window.open('detail.php?event='+event._id, 'gcalevent', 'width=700,height=600');                
                return false;
            },
            events: datajson
        });
        
    });
