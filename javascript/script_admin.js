var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

$(function() {
    // Vérification de la présence de données d'agenda
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k];
            // Ajout des événements à la liste des événements
            events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime });
        });
    }

    // Initialisation du calendrier
    calendar = new Calendar(document.getElementById('calendar'), {
        initialView: 'timeGridWeek',
        nowIndicator: true,
        selectable: true,
        selectHelper: true,
        select: function(startStr, endStr, allDays) {
            // Callback lorsqu'une plage horaire est sélectionnée
            console.log(start, end, allDays);
            $('#start_datetime').val(moment(startStr).format('YYYY-MM-DDThh:mm'));
            $('#end_datetime').val(moment(endStr).format('YYYY-MM-DDThh:mm'));
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
            // Callback lorsqu'un événement est cliqué
            var details = $('#event-details-modal');
            var id = info.event.id;

            if (!!scheds[id]) {
                details.find('#title').text(scheds[id].title);
                details.find('#description').text(scheds[id].description);
                details.find('#start').text(scheds[id].sdate);
                details.find('#end').text(scheds[id].edate);
                details.find('#edit,#delete').attr('data-id', id);
                details.modal('show');
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function(info) {
            // Action à effectuer après l'affichage des événements
        },
        editable: true
    });

    // Affichage du calendrier
    calendar.render();

    // Écouteur de réinitialisation du formulaire
    $('#schedule-form').on('reset', function() {
        $(this).find('input:hidden').val('');
        $(this).find('input:visible').first().focus();
    });

    // Bouton Éditer
    $('#edit').click(function() {
        // Action lors du clic sur le bouton Éditer
        var id = $(this).attr('data-id');

        if (!!scheds[id]) {
            var form = $('#schedule-form');

            console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"));
            form.find('[name="id"]').val(id);
            form.find('[name="title"]').val(scheds[id].title);
            form.find('[name="description"]').val(scheds[id].description);
            form.find('[name="color"]').val(scheds[id].color);
            form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"));
            form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"));
            $('#event-details-modal').modal('hide');
            form.find('[name="title"]').focus();
        } else {
            alert("Event is undefined");
        }
    });

    // Bouton Supprimer / Suppression d'un événement
    $('#delete').click(function() {
        // Action lors du clic sur le bouton Supprimer
        var id = $(this).attr('data-id');

        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "?page=delete&id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    });
});
