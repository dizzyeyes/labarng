
    $(document).ready(function() {
        var currentLangCode = "简体中文(zh-cn)";
        // build the language selector's options
        $.each($.fullCalendar.langs, function(langCode) {
            $('#lang-selector').append(
                $('<option/>')
                    .attr('value', langCode)
                    .prop('selected', langCode == currentLangCode)
                    .text(langCode)
            );
        });
        // rerender the calendar when the selected option changes
        $('#lang-selector').on('change', function() {
            if (this.value) {
                currentLangCode = this.value;
                $('#calendar').fullCalendar('destroy');
                renderCalendar();
            }
        });
        function renderCalendar() {
            $('#calendar').fullCalendar({
                theme:true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                weekNumbers: true,
                defaultDate: undefined,
                lang: currentLangCode,
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
        }
        renderCalendar();
        
    });
