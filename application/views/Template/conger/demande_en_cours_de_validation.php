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
                            <h3 class="font-weight-bold">Congés en attente de validation : </h3>
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
                                    <th class="text-center">Debuter le</th>
                                    <th class="text-center">Jusqu'a</th>
                                    <th class="text-center">Duree du conger</th>
                                    <th class="text-center">Date de demande</th>
                                    <th class="text-center">Piece justificatif</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Décision</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>


            </div>
            <!-- content-wrapper ends -->
            <?php $this->load->view('Template/inclure/footer'); ?>

            <script>
            function fetch() {
                $.ajax({
                    url: "<?= base_url(); ?>fetch_conger_en_cours",
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
                                {
                                    data: 'code_em'
                                },
                                {
                                    data: 'type_conger'
                                },
                                {
                                    data: 'date_debut'
                                },
                                {
                                    data: 'date_fin'
                                },
                                {
                                    data: 'duree_conger',
                                    render: function(data, type, row, meta) {
                                        // Vous pouvez ajouter 'jrs' après la valeur de la colonne
                                        return data + ' jrs';
                                    }
                                },
                                {
                                    data: 'date_demande'
                                },
                                {
                                    data: 'img_reason',
                                    render: function(data, type, row, meta) {
                                        var imageSrc =
                                            '<?= base_url(); ?>assets/images/piece_justificatif/' +
                                            data;
                                        return '<a href="' + imageSrc +
                                            '" data-lightbox="gallery"><img src="' +
                                            imageSrc +
                                            '" style="max-width: 100px; max-height: 100px;"></a>';
                                    }

                                },
                                {
                                    data: 'status_conger'
                                },
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

            // --- Accepter demande ---
            $(document).on('click', '#accept', function(e) {
                e.preventDefault();
                var accept_id = $(this).attr("value");
                var status_conger = 'Accepter';

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
                    url: "<?= base_url(); ?>accepter_conger2",
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
                                'La demande reste en attente :)',
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