
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
        require_once('database/bd.php');

        $schedules = $conn->query("SELECT * FROM `schedule_list`");
        $sched_res = [];

        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            var_dump($row['color']);
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }

       // $get_color = $conn->query("SELECT color FROM `schedule_list` WHERE id = $row['id']

        if(isset($conn)) $conn->close();
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <a class="navbar-brand title" href="#">Projet biblio</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Evénements</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="?page=save" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Titre</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="color" class="control-label">Couleur</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="color" id="color" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Début</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">Fin</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                                <div>
                                   <input type="checkbox" id="scales" name="scales" checked>
                                   <label for="scales">Reccurence</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
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
                            <dt class="text-muted">Titre</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>