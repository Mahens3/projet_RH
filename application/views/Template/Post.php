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
                            <h3 class="font-weight-bold">Post : </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right ml-4" data-bs-toggle="modal"
                        data-bs-target="#modal_post">
                        Ajouter
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal_post" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog mt-4">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nouveau Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="form">
                                        <div class="form-group">
                                            <label for="">Design : </label>
                                            <input type="text" name="design" id="design" class="form-control"
                                                placeholder="Nom du Post" value="<?= set_value('design');?>">
                                            <small><?php echo form_error('design'); ?></small>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-primary" id="add_post">Ajouter</button>
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
                                        <th class="text-center">Design</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Modal edit -->
            <!-- Button trigger modal -->
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog  mt-4">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modification des donnees</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Edit records form -->
                                    <form action="" method="post" id="edit_form">
                                        <input type="hidden" name="edit_id" id="edit_id" value="<?= set_value('edit_id');?>">
                                        <div class="form-group">
                                            <label for="">Design : </label>
                                            <input type="text" name="edit_design" id="edit_design" class="form-control"
                                                placeholder="Nom du post" value="<?= set_value('edit_design');?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-primary" id="modif">Modififer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- content-wrapper ends -->
        <?php $this->load->view('Template/inclure/footer'); ?>
        

        <script>
        // Ajout type 
        $(document).on('click', '#add_post', function(e) {
            e.preventDefault();

            var design = $("#design").val();

            $.ajax({
                url: "<?php base_url(); ?>add_post",
                type: "post",
                dataType: "json",
                data: {
                    design: design
                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#records').DataTable().destroy();
                        fetch();
                        $('#modal_post').modal('hide');
                        toastr["success"](data.message);
                    } else {
                        toastr["error"](data.message);
                    }
                }
            });

            $("#form")[0].reset();
        });

        // Afficher donner
        function fetch() {
            $.ajax({
                url: "<?= base_url(); ?>fetch_post",
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
                                data: 'id_post',
                                render: function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                data: 'design'
                            },
                            {
                                data: null,
                                render: function(data, type, row, meta) {
                                    var a = `
                                        <a href="#" value="${row.id_post}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                                        <a href="#" value="${row.id_post}" id="del" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
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
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url(); ?>delete_post",
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
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your imaginary file is safe :)',
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

        // --- edit records ---
        $(document).on('click', '#edit', function(e) {
            e.preventDefault();

            var edit_id = $(this).attr("value");

            $.ajax({
                url: "<?= base_url(); ?>edit_post",
                type: "post",
                dataType: "json",
                data: {
                    edit_id: edit_id
                },
                success: function(data) {
                    $('#edit_modal').modal('show');
                    $('#edit_id').val(data.posts.id_post);
                    $('#edit_design').val(data.posts.design);
                }
            });
        });


        // --- update records ---
        $(document).on('click', '#modif', function(e) {
            e.preventDefault();

            var edit_id = $('#edit_id').val();
            var edit_design = $('#edit_design').val();

            $.ajax({
                url: "<?= base_url(); ?>update_post",
                type: "post",
                dataType: "json",
                data: {
                    edit_id: edit_id,
                    edit_design: edit_design
                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#records').DataTable().destroy();
                        fetch();
                        $('#edit_modal').modal('hide');
                        toastr["success"](data.message);
                    } else {
                        toastr["error"](data.message);
                    }
                }
            })

        });
        </script>

        </body>

        </html>