<!-- partial -->

<div class="container-fluid page-body-wrapper">

    <?php $this->load->View('Template/inclure/right_sidebar');?>
    <?php $this->load->View('Template/inclure/sidebar');?>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Listes des demandes de congés : </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right ml-4" data-bs-toggle="modal"
                        data-bs-target="#modal_demande_conger">
                        Demander conger
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal_demande_conger" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog mt-4">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Demande de conger</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <?php $type_conger = $this->cm->get_entries_type();?>
                                <?php $code_em = $this->pm->get_entries();?>
                                <?php $nom = $this->session->userdata('noms');?>
                                <?php $prenom = $this->session->userdata('prenom');?>

                                <div class="modal-body">
                                    <form action="" method="post" id="form">
                                        <div class="form-group">
                                            <label for="">Code employé : </label>
                                            <select name="code_em" id="code_em" class="form-control">
                                                <?php if($this->session->userdata('role')=='Admin' || $this->session->userdata('role')=='Super_Admin'): ?>
                                                    <option value="">...</option>
                                                    <?php if(count($code_em)): ?>
                                                        <?php foreach ($code_em as $code): ?>
                                                            <option value="<?= $code->code_em ?>"><?= $code->code_em ?></option>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                <?php else: ?>
                                                    <option value="<?= $this->session->userdata('code_em') ?>"><?= $this->session->userdata('code_em') ?></option>
                                                <?php endif ?>
                                            </select>
                                            <small><?php echo form_error('code_em'); ?></small>
                                        </div>
                                        <?php if($this->session->userdata('role')=='Admin' || $this->session->userdata('role')=='Super_Admin'): ?>

                                        <?php else: ?>
                                        <div class="form-group">
                                            <label for="">Nom et prénom : </label>
                                            <select name="nom_prenom" id="nom_prenom" class="form-control">   
                                                <option value="<?= $nom . ' ' . $prenom ?>"><?= $nom . ' ' . $prenom ?></option>
                                            </select>
                                            <small><?php echo form_error('nom_prenom'); ?></small>
                                        </div>
                                        <?php endif ?>
                                        <div class="form-group">
                                            <label for="">Type de conger : </label>
                                            <select name="type_conger" id="type_conger" class="form-control"
                                                value="<?= set_value('type_conger');?>">
                                                <option value="">...</option>
                                                <?php if(count($type_conger)):?>
                                                <?php foreach ($type_conger as $type_conger): ?>
                                                <option value="<?= $type_conger->nom ?>"><?= $type_conger->nom ?>
                                                </option>
                                                <?php endforeach?>
                                                <?php endif;?>
                                            </select>
                                            <small><?php echo form_error('type_conger'); ?></small>
                                        </div>
                                        <div class="form-group" id="exceptionnel_div" style="display:none;">
                                            <label for="" id="titre">Pour : </label>
                                            <select name="exceptionnel" id="exceptionnel" class="form-control">
                                                <option value="">...</option>
                                                <option value="Circoncision">Circoncision</option>
                                                <option value="Mariage">Mariage</option>
                                                <option value="Déménagement">Déménagement</option>
                                                <option value="Deuil">Deuil</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Durée du congé</label><br>
                                            <input name="type" type="radio" id="radio_1" data-value="Half"
                                                class="duration" value="Half Day">
                                            <label for="radio_1" class="mr-4">demi_journée</label>
                                            <input name="type" type="radio" id="radio_2" data-value="Full" class="type"
                                                value="Full Day">
                                            <label for="radio_2" class="mr-4">Jours entiere</label>
                                            <input name="type" type="radio" class="with-gap duration" id="radio_3"
                                                data-value="More" value="More than One day" checked="">
                                            <label for="radio_3">Plus d'un jour</label>
                                        </div>
                                        <div class="form-group">
                                            <label id='debut' for="">Commencer le : </label>
                                            <input type="date" name="date_debut" id="date_debut" class="form-control"
                                                placeholder="Date du debut du conger"
                                                value="<?= set_value('date_debut');?>">
                                            <small><?php echo form_error('date_debut'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label id="fin" for="">Jusqu'a : </label>
                                            <input type="date" name="date_fin" id="date_fin" class="form-control"
                                                placeholder="Date du fin du conger"
                                                value="<?= set_value('date_fin');?>">
                                            <small><?php echo form_error('date_fin'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Reason : </label>
                                            <input type="text" class="form-control" name="reason" id="reason"
                                                value="<?= set_value('reason');?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Piece jointe : </label>
                                            <input type="file" class="form-control" name="img_reason" id="img_reason"
                                                value="<?= set_value('img_reason');?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-primary" id="add">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-14">
                        <div class="table-responsive">
                            <table class="table" id="records">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Code empoyer</th>
                                        <th class="text-center">Type de conger</th>
                                        <th class="text-center">Exceptionnel</th>
                                        <th class="text-center">Debuter le</th>
                                        <th class="text-center">Jusqu'a</th>
                                        <th class="text-center">Duree du conger</th>
                                        <th class="text-center">Date de demande</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Piece justificatif</th>
                                        <th class="text-center">Status</th>
                                    <?php if($this->session->userdata('role')!='Employer'): ?>
                                        <th class="text-center">Décision</th>
                                    <?php else: ?>
                                    <?php endif;?>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- content-wrapper ends -->
        <?php $this->load->view('Template/inclure/footer'); ?>


        <!-- <script>
            $(document).ready(function() {
                // Gestionnaire d'événements pour le changement de valeur de code_em
                $('#code_em').change(function() {
                    var selectedCodeEm = $(this).val();
                    $.ajax({
                        url: '<?= base_url() ?>get_nom_prenom_by_code_em',
                        method: 'post',
                        data: { code_em: selectedCodeEm },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#nom_prenom').val(response.nom_prenom);
                            } else {
                                $('#nom_prenom').val('');
                            }
                        }
                    });
                });

                // Gestionnaire d'événements pour le changement de valeur de nom_prenom
                $('#nom_prenom').change(function() {
                    var selectedNomPrenom = $(this).val();
                    var nom = selectedNomPrenom.split(' ')[0];
                    var prenom = selectedNomPrenom.split(' ')[1];
                    $.ajax({
                        url: '<?= base_url() ?>get_code_em_by_nom_prenom',
                        method: 'post',
                        data: { nom: nom, prenom: prenom },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#code_em').val(response.code_em);
                            } else {
                                $('#code_em').val('');
                            }
                        }
                    });
                });
            });
        </script> -->



    
    <script>
            // pour le radio box
        $(document).ready(function() {
            $('#form input').on('change', function(e) {
                e.preventDefault(e);

                // Get the record's ID via attribute  
                var duration = $('input[name=type]:checked', '#form').attr('data-value');

                if (duration == 'Half') {
                    $('#date_fin').hide();
                    $('#debut').text('Date');
                    $('#fin').text('');
                    $('#date_debut').show();
                } else if (duration == 'Full') {
                    $('#date_fin').hide();
                    $('#date_debut').show();
                    $('#debut').text('Date');
                    $('#fin').text('');
                } else if (duration == 'More') {
                    $('#date_fin').show();
                    $('#date_debut').show();
                    $('#debut').text('Commencer le');
                    $('#fin').text("Jusqu'a");
                }
            });
        });
            // type conger
        $(document).ready(function() {
            $('#type_conger').on('change', function() {
                var selectedType = $(this).val();

                if (selectedType === 'Exceptionnel') {
                    $('#exceptionnel_div').show();
                    $('#titre').text('Pour : ');
                } else {
                    $('#exceptionnel_div').hide();
                    $('#titre').text('');
                }
            });
        });

        // Lorsque le bouton avec l'ID "add" est cliqué
        $(document).ready(function() {
            $(document).on('click', '#add', function(e) {
                e.preventDefault();

                // Obtenir la date actuelle
                var date_demande = getCurrentDate();
                var date_debut = $("#date_debut").val();
                var date_fin = $("#date_fin").val();
                var reason = $("#reason").val();
                var img_reason = $("#img_reason")[0].files[0];
                var status_conger = 'Non traiter';

                // Vérifier si la date de début est vide
                if (date_debut === '') {
                    alert("Veuillez sélectionner une date de début.");
                    return;
                }

                // Obtenir la durée sélectionnée
                var duration = $('input[name=type]:checked', '#form').attr('data-value');
                if (duration === undefined) {
                    alert("Veuillez sélectionner une durée de congé.");
                    return;
                }

                // Calculer la durée du congé en fonction des dates de début et de fin
                var duree_conger = calculateLeaveDuration(date_debut, date_fin, duration);

                // Vérifier les dates et la durée
                if (verifyDates(date_demande, date_debut) <= 0 || verifyDates(duree_conger) <= 0) {
                    alert("Veuillez vérifier les dates et réessayer.");
                    return;
                }

                // Obtenir d'autres données du formulaire
                var code_em = $("#code_em").val();
                var type_conger = $("#type_conger").val();
                var exceptionnel = $("#exceptionnel").val();

                // Effectuer une requête AJAX pour obtenir le solde de congé
                $.ajax({
                    url: "<?php echo base_url(); ?>get_solde",
                    type: "post",
                    dataType: "json",
                    data: { code_em: code_em },
                    success: function(data) {
                        if (data.responce == "success") {
                            var solde_conger = data.solde_conger;
                            var solde_exceptionnel = data.solde_exceptionnel;

                            // Vérifier le solde de congé disponible
                            if ((type_conger == 'Avec solde' && duree_conger > (solde_conger/2)) ||
                                (type_conger == 'Exceptionnel' && duree_conger > solde_exceptionnel)) {
                                toastr["error"](data.message);
                            } else {
                                // Soumettre les données du formulaire
                                submitFormData(code_em, type_conger, date_debut, date_fin, duree_conger, date_demande, reason, img_reason, status_conger, exceptionnel);
                            }
                        } else {
                            toastr["error"](data.message);
                        }
                    }
                });
            });

            // Fonction pour soumettre les données du formulaire via AJAX
            function submitFormData(code_em, type_conger, date_debut, date_fin, duree_conger, date_demande, reason, img_reason, status_conger, exceptionnel) {
                var formData = new FormData();
                formData.append('code_em', code_em);
                formData.append('type_conger', type_conger);
                formData.append('date_debut', date_debut);
                formData.append('date_fin', date_fin);
                formData.append('duree_conger', duree_conger);
                formData.append('date_demande', date_demande);
                formData.append('reason', reason);
                formData.append('img_reason', img_reason);
                formData.append('status_conger', status_conger);
                formData.append('exceptionnel', exceptionnel);

                // Effectuer une requête AJAX pour ajouter la demande de congé
                $.ajax({
                    url: "<?php echo base_url(); ?>add_conger",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.responce == "success") {
                            // Recharger les données et masquer le formulaire
                            $('#records').DataTable().destroy();
                            fetch();
                            $('#modal_demande_conger').modal('hide');
                            toastr["success"](data.message);
                        } else {
                            toastr["error"](data.message);
                        }
                    }
                });

                // Réinitialiser le formulaire
                $("#form")[0].reset();
            }
        });


        // Fonction pour calculer la durée du congé en jours
        function calculateLeaveDuration(dateDebut, dateFin, duration) {
            var diffInMilliseconds = new Date(dateFin) - new Date(dateDebut);
            var diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

            if (duration === 'Half') {
                // Efface la valeur de dateFin
                $("#date_fin").val('..../../..');
                return 0.5;
            } else if (duration === 'Full') {
                // Efface la valeur de dateFin
                $("#date_fin").val('..../../..');
                return 1;
            } else {
                return diffInDays;
            }
        }



        // Fonction pour vérifier les dates
        function verifyDates(dateDemande, dateDebut) {
            return new Date(dateDebut) - new Date(dateDemande);
        }

        // Fonction pour obtenir la date actuelle au format 'YYYY-MM-DD'
        function getCurrentDate() {
            var dateActuelle = new Date();
            var annee = dateActuelle.getFullYear();
            var mois = (dateActuelle.getMonth() + 1).toString().padStart(2, '0');
            var jour = dateActuelle.getDate().toString().padStart(2, '0');
            return annee + '-' + mois + '-' + jour;
        }

        // affiche donner
        function fetch() {
            $.ajax({
                url: "<?= base_url(); ?>fetch_conger",
                type: "get",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var i = 1; // Pas besoin des guillemets autour de 1
                    $('#records').DataTable({
                        data: data.posts,
                        responsive: true,
                        columns: [{
                                data: 'id',
                                render: function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {data: 'code_em'},
                            {data: 'type_conger'},
                            {data: 'exceptionnel'},
                            {data: 'date_debut'},
                            {data: 'date_fin'},
                            {
                                data: 'duree_conger',
                                render: function(data, type, row, meta) {
                                    // Vous pouvez ajouter 'jrs' après la valeur de la colonne
                                    return data + ' jrs';
                                }
                            },
                            {data: 'date_demande'}, 
                            {data: 'reason'}, 
                            {
                                data: 'img_reason',
                                render: function(data, type, row, meta) {
                                    var imageSrc = '<?= base_url(); ?>assets/images/piece_justificatif/' + data;
                                    return '<a href="' + imageSrc + '" data-lightbox="gallery"><img src="' + imageSrc + '" style="max-width: 100px; max-height: 100px;"></a>';
                                }

                            },
                            {data: 'status_conger'},
                            <?php if($this->session->userdata('role')!='Employer'): ?>
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row, meta) {
                                    var a = `
                                        <a href="#" value="${row.id}" id="accept" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                        <a href="#" value="${row.id}" id="rejet" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                    `;
                                    return a;
                                }
                            },
                            <?php else: ?>
                            <?php endif; ?>
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row, meta) {
                                    var a = `
                                    <a href="#" value="${row.id}" id="edit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit" style="color: blue;"></i></a>
                                    <a href="#" value="${row.id}" id="del" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                                    `;
                                    return a;
                                }
                            }
                        ]
                    });
                    // Appliquer une classe CSS pour centrer le texte sur les colonnes
                    $('#records').DataTable().columns().every(function() {
                        this.nodes().to$().addClass('text-center');
                    });
                    lightbox.option({
                        'resizeDuration': 200,
                        'wrapAround': true
                    });
                }
            });
        }

        fetch();

        // --- delete records ---
        $(document).on('click', '#del', function(e) {
            e.preventDefault();

            var del_id = $(this).attr("value");

            // ---- || ----
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Êtes-vous certain ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annulez',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url(); ?>delete_conger",
                        type: "post",
                        dataType: "json",
                        data: {
                            del_id: del_id
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.responce == 'success') {
                                $('#records').DataTable().destroy();
                                fetch();
                                swalWithBootstrapButtons.fire(
                                    "Supprimé !", 
                                    'Votre fichier a été supprimé :)', 
                                    'success'
                                )
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Annulé',
                                    'Votre fichier imaginaire est en sécurité :)',
                                    'error'
                                )
                            }
                        }
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {

                }
            })


        });
        // --- Accepter demande ---
        $(document).on('click', '#accept', function(e) {
            e.preventDefault();
            var accept_id = $(this).attr("value");
            var status_conger = 'En attente';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Êtes-vous certain ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annulez',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    acceptConger(accept_id, status_conger, swalWithBootstrapButtons);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // L'utilisateur a annulé l'opération
                }
            });
        });

        function acceptConger(accept_id, status_conger, swal) {
            $.ajax({
                url: "<?= base_url(); ?>accepter_conger1",
                type: "post",
                dataType: "json",
                data: {
                    accept_id: accept_id,
                    status_conger: status_conger
                },
                success: function(data) {
                    console.log(data);
                    if (data.responce === 'success') {
                        $('#records').DataTable().destroy();
                        fetch();
                        swal.fire(
                            "Accepter !",
                            'Demande de congé acceptée :)',
                            'success'
                        );
                    } else {
                        swal.fire(
                            'Annulé',
                            'La demande reste non traiter :)',
                            'error'
                        );
                    }
                }
            });
        }

        
        // --- Rejeter demande ---
        $(document).on('click', '#rejet', function(e) {
            e.preventDefault();

            var rejet_id = $(this).attr("value");
            var status_conger = 'Rejeter';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Êtes-vous certain ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annulez',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url(); ?>rejeter_conger",
                        type: "post",
                        dataType: "json",
                        data: {
                            rejet_id: rejet_id,
                            status_conger: status_conger
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.responce == 'success') {
                                $('#records').DataTable().destroy();
                                fetch();
                                swalWithBootstrapButtons.fire(
                                    "Accepter !", 
                                    'Demande de congé rejeter :)', 
                                    'success'
                                )
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Annulé',
                                    'Demande reste en attente :)',
                                    'error'
                                )
                            }
                        }
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {}
            })
        });

      

        </script>
        </body>

        </html>