    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];
    

    $(function() {

        if (!!scheds) {
            Object.keys(scheds).map(k => {
                var row = scheds[k]
                events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime });
            });
        }
        
        
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear(),
        

        calendar = new Calendar(document.getElementById('calendar'), {
            initialView: 'timeGridWeek',
            nowIndicator: true,
            selectable: true,
            selectHelper: true,
            select: function(info) {
                var start = info.start; // Récupère la date de début sélectionnée
                var end = info.end;

                $('#start_datetime').val(moment(start).format('YYYY-MM-DDThh:mm'));//erreur de recuperation
                $('#end_datetime').val(moment(end).format('YYYY-MM-DDThh:mm'));//erreur de recuperation 
            },
            slotMinTime: "08:00",
            slotMaxTime: "18:00", 
            hiddenDays: [0, 3, 6],
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,list,timeGridWeek',
                center: 'title',
            },
            titleFormat: { 
                month: 'long',
                year: 'numeric',
                day: 'numeric',
                weekday: 'long'
            },
            selectable: true,
            themeSystem: 'bootstrap',
            events: events,
            eventClick: function(info) {
                var details = $('#event-details-modal');
                var id = info.event.id;

                if (!!scheds[id]) { // boite de dialogue lors du clique sur le bouton edit
                    details.find('#title').text(scheds[id].title);
                    details.find('#description').text(scheds[id].description);
                    details.find('#start').text(scheds[id].sdate, 'YYYY-MM-DD HH:mm');
                    details.find('#end').text(scheds[id].edate);
                    details.find('#edit,#delete').attr('data-id', id);
                    details.modal('show');
                } else {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function(info) {
                // Do Something after events mounted
            },
            editable: true
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('');
            $(this).find('input:visible').first().focus();
        });

        // Edit Button
        $('#edit').click(function() {
            var id = $(this).attr('data-id');

            if (!!scheds[id]) {
                var form = $('#schedule-form');

                console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"));
                form.find('[name="id"]').val(id);
                form.find('[name="title"]').val(scheds[id].title);
                form.find('[name="description"]').val(scheds[id].description);
                form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"));
                form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"));
                $('#event-details-modal').modal('hide');
                form.find('[name="title"]').focus();
            } else {
                alert("L'événement n'existe pas !");
            }
        });

        // Delete Button / Deleting an Event
        $('#delete').click(function() {
            var id = $(this).attr('data-id');

            if (!!scheds[id]) {
                var _conf = confirm("Voulez-vous vraiment supprimer cet évenement ?");
                if (_conf === true) {
                    location.href = "?page=delete&id=" + id;
                }
            } else {
                alert("Cet évenement n'existe pas");
            }
        });


        $('#calendar').fullCalendar( 'addEventSource',        
        function(start, end, callback) {
            // When requested, dynamically generate a
            // repeatable event for every monday.
            var events = [];
            var monday = 1;
            var one_day = (24 * 60 * 60 * 1000);
    
            for (loop = start.getTime();
                 loop <= end.getTime();
                 loop = loop + one_day) {
    
                var column_date = new Date(loop);
    
                if (column_date.getDay() == monday) {
                    // we're in Moday, create the event
                    events.push({
                        title: 'Morning Meeting',
                        start: new Date(column_date.setHours(10, 00)),
                        end: new Date(column_date.setHours(10, 40)),
                        allDay: false
                    });
                }
            } // for loop
    
            // return events generated
            callback( events );
        }
    );













    });