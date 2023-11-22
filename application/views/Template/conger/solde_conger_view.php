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
                            <h3 class="font-weight-bold">Liste des soldes congés : </h3>
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
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Solde conger</th>
                                    <th class="text-center">Dernier mise a jours</th>
                                    <th class="text-center">Solde exceptionnel</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        

    </div>
<!-- content-wrapper ends -->
<?php $this->load->view('Template/inclure/footer'); ?>

<script>
    function fetch() {
        $.ajax({
            url: "<?= base_url(); ?>fetch_solde",
            type: "post",
            dataType: "json",
            success: function(data) {
                console.log(data);
                var i = 1; // Pas besoin des guillemets autour de 1
                $('#records').DataTable({
                    data: data.posts,
                    responsive: true,
                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ],
                    columns: [{
                            data: 'id_solde',
                            render: function(data, type, row, meta) {
                                return i++;
                            }
                        },
                        {
                            data: 'code_em'
                        },
                        {
                            data: 'nbr_jrs',
                            render: function(data, type, row, meta) {
                                // Vous pouvez ajouter 'jrs' après la valeur de la colonne
                                return data + ' jrs';
                            }
                        },
                        {
                            data: 'date_dernier_mise_jrs'
                        },
                        {
                            data: 'solde_exeptionnel',
                            render: function(data, type, row, meta) {
                                // Vous pouvez ajouter 'jrs' après la valeur de la colonne
                                return data + ' jrs';
                            }
                        }
                    ]
                });

                 // Appliquer une classe CSS pour centrer le texte sur les colonnes
                $('#records').DataTable().columns().every(function() {
                    this.nodes().to$().addClass('text-center');
                });

            }
        });
    }

    fetch();
</script>
</body>

</html>