
<style>
        .fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start {
            background-color: yellow;
        }

        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        .title{
            font-size: 30px;
        }
    </style>
</head>
<body class="bg-light">

    <?php

        // Inclusion du fichier de base de données
        require_once('database/bd.php');     

    // Récupération des horaires depuis la base de données

        $schedules = $conn->query("SELECT * FROM `schedule_list`");
        $sched_res = [];

            // Transformation des horaires dans un format lisible pour l'affichage

        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }

       // $get_color = $conn->query("SELECT color FROM `schedule_list` WHERE id = $row['id']
    // Fermeture de la connexion à la base de données

        if(isset($conn)) $conn->close();
    ?>

<div class="container py-5" id="page-container">
    <div class="row">
        <div class="col-md-9">
            <div id="calendar"></div>
        </div>
        <div class="col-md-3">
            <div class="card rounded-0 shadow">
                <div class="card-header bg-gradient bg-primary text-light">
                    <h5 class="card-title">Événements</h5>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <form action="?page=save" method="post" id="schedule-form">
                            <input type="hidden" name="id" value="">
                            <div class="form-group mb-2">
                                <label for="title" class="control-label">Participant 1</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="title" class="control-label">Participant 2</label>
                                <input type="text" class="form-control form-control-sm rounded-0" name="participant2" id="participant2">
                            </div>
                            <div class="form-group mb-2">
                                <label for="description" class="control-label">Description</label>
                                <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="start_datetime" class="control-label">Début</label>
                                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="end_datetime" class="control-label">Fin</label>
                                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="end_datetime_r" class="control-label">Fin répétition</label>
                                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime_r" id="end_datetime_r">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="checked" id="recursif" name="recursif">
                                <label class="form-check-label" for="recursif">
                                    Événement récursif
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Sauvegarder</button>
                        <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Détails de l'événement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Participant</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Participant 2</dt>
                            <dd id="participant2" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Horaire début</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Horaire fin</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Modifier</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Supprimer</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>