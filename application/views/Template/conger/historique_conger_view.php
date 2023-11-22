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
                            <h3 class="font-weight-bold">Historique des congés : </h3>
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
                url: "<?= base_url(); ?>fetch_historique_conger",
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
                            {
                                data: 'img_reason',
                                render: function(data, type, row, meta) {
                                    var imageSrc = '<?= base_url(); ?>assets/images/piece_justificatif/' + data;
                                    return '<a href="' + imageSrc + '" data-lightbox="gallery"><img src="' + imageSrc + '" style="max-width: 100px; max-height: 100px;"></a>';
                                }

                            },
                            {data: 'status_conger'}

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
</script>

</body>

</html>