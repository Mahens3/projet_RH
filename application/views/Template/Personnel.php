<!-- partial -->
<div class="container-fluid page-body-wrapper">

    <?php $this->load->View('Template/inclure/right_sidebar');?>
    <?php $this->load->View('Template/inclure/sidebar');?>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper pr-0 pl-3">

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-xl-0">
                            <h3 class="font-weight-bold ml-2">Liste des personnels : </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right ml-4" data-bs-toggle="modal"
                        data-bs-target="#modal_personnel">
                        Ajouter
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal_personnel" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog mt-4">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nouveau personnel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <?php $departement = $this->pm->get_departement();?>
                                <?php $posts = $this->pm->get_entries_post();?>

                                <div class="modal-body">
                                    <form action="" method="post" id="form">
                                        <div class="form-group">
                                            <label for="">Code employé : </label>
                                            <input type="text" name="code_em" id="code_em" class="form-control"
                                                placeholder="Code employer" value="<?= set_value('code_em');?>">
                                            <small><?php echo form_error('code_em'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nom : </label>
                                            <input type="text" name="nom" id="nom" class="form-control"
                                                placeholder="Nom" value="<?= set_value('nom');?>">
                                            <small><?php echo form_error('nom'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Prénom : </label>
                                            <input type="text" name="prenom" id="prenom" class="form-control"
                                                placeholder="Prenom">
                                        </div>
                                        <div class="form-group">
                                            <label for="">E-mail : </label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Adresse email" value="<?= set_value('email');?>">
                                            <small><?php echo form_error('email'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mot de passe : </label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Mot de passe" value="<?= set_value('password');?>">
                                            <small><?php echo form_error('password'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Adresse : </label>
                                            <input type="text" name="adresse" id="adresse" class="form-control"
                                                placeholder="Addresse + code postale" value="<?= set_value('adresse');?>">
                                            <small><?php echo form_error('adresse'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date de naissance : </label>
                                            <input type="date" name="date_nais" id="date_nais" class="form-control"
                                                value="<?= set_value('date_nais');?>">
                                            <small><?php echo form_error('date_nais'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">CIN : </label>
                                            <input type="text" name="CIN" id="CIN" class="form-control"
                                                placeholder="Carte d'identite Nationnal" value="<?= set_value('CIN');?>">
                                            <small><?php echo form_error('CIN'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contact : </label>
                                            <input type="text" name="contact" id="contact" class="form-control"
                                                placeholder="Contact" value="<?= set_value('contact');?>">
                                            <small><?php echo form_error('contact'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contact proche : </label>
                                            <input type="text" name="contact_proche" id="contact_proche" class="form-control"
                                                placeholder="Personne a Contact au cas ou" value="<?= set_value('contact_proche');?>">
                                            <small><?php echo form_error('contact_proche'); ?></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Sexe : </label>
                                            <select name="sexe" id="sexe" class="form-control" value="<?= set_value('sexe');?>">
                                                <option value="">...</option>
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                            </select>
                                            <small><?php echo form_error('sexe'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Departement</label>
                                            <select name="departement" id="departement" class="form-control" value="<?= set_value('departement');?>">
                                                    <option value="">...</option>
                                                <?php if(count($departement)):?>
                                                    <?php foreach ($departement as $dep): ?>
                                                    <option value="<?= $dep->dep_name ?>"><?= $dep->dep_name ?></option>
                                                    <?php endforeach?>
                                                <?php endif;?>
                                            </select>
                                            <small><?php echo form_error('departement'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Poste : </label>
                                            <select name="post" id="post" class="form-control" value="<?= set_value('post');?>">
                                                    <option value="">...</option>
                                                <?php if(count($posts)):?>
                                                    <?php foreach ($posts as $post): ?>
                                                    <option value="<?= $post->design ?>"><?= $post->design ?></option>
                                                    <?php endforeach?>
                                                <?php endif;?>
                                            </select>
                                            <small><?php echo form_error('post'); ?></small>
                                        </div>
                                         <div class="form-group">
                                            <label for="">Type de contrat </label>
                                            <select name="contrats" id="contrats" class="form-control" value="<?= set_value('contrats');?>">
                                                <option>...</option>
                                                <option value="CDI">CDI</option>
                                                <option value="CDD">CDD</option>
                                                <option value="Pigiste">Pigiste</option>
                                            </select>
                                            <small><?php echo form_error('contrats'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rôle (Privilege) : </label>
                                            <select name="role" id="role" class="form-control" value="<?= set_value('role');?>">
                                                <option value="">...</option>
                                                <option value="Super_Admin">Super_Admin</option>
                                                <option value="Admin">Admin</option>
                                                <option value="n+1">n+1</option>
                                                <option value="Employer">Employer</option>
                                            </select>
                                            <small><?php echo form_error('role'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date de création : </label>
                                            <input type="date" name="date_creation" id="date_creation"
                                                class="form-control" value="<?= set_value('date_creation');?>">
                                            <small><?php echo form_error('date_creation'); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Votre profil : </label>
                                            <input type="file" class="form-control" name="profil" id="profil"
                                                value="<?= set_value('profil');?>">
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
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Prenom</th>
                                        <th class="text-center">E-mail</th>
                                        <th class="text-center">Contact</th>
                                        <th class="text-center">Post</th>
                                        <th class="text-center">Status</th>
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
                        <div class="modal-dialog mt-4">
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
                                        <input type="hidden" name="edit_id" id="edit_id" value="">
                                        <div class="form-group">
                                            <label for="">Code employé : </label>
                                            <input type="text" name="edit_code" id="edit_code" class="form-control"
                                                placeholder="Code employer" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nom : </label>
                                            <input type="text" name="edit_nom" id="edit_nom" class="form-control"
                                            placeholder="Nom" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Prénom : </label>
                                            <input type="text" name="edit_prenom" id="edit_prenom" class="form-control"
                                                placeholder="Prenom">
                                        </div>
                                        <div class="form-group">
                                            <label for="">E-mail : </label>
                                            <input type="email" name="edit_email" id="edit_email" class="form-control"
                                                placeholder="Adresse email" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Adresse : </label>
                                            <input type="text" name="edit_adresse" id="edit_adresse" class="form-control"
                                                placeholder="Addresse Postale" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date de naissance : </label>
                                            <input type="date" name="edit_nais" id="edit_nais" class="form-control"
                                                placeholder="Votre date de naissance" value="">
                                            </div>
                                        <div class="form-group">
                                            <label for="">Contact : </label>
                                            <input type="tel" name="edit_contact" id="edit_contact" class="form-control"
                                                placeholder="Contact" value="">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Sexe : </label>
                                            <select name="edit_sexe" id="edit_sexe" class="form-control" value="<?= set_value('edit_sexe');?>">
                                                <option value="">...</option>
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Departement</label>
                                            <select name="edit_departement" id="edit_departement" class="form-control" value="<?= set_value('edit_departement');?>">
                                                    <option value="">...</option>
                                                <?php if(count($departement)):?>
                                                    <?php foreach ($departement as $dep): ?>
                                                    <option value="<?= $dep->dep_name ?>"><?= $dep->dep_name ?></option>
                                                    <?php endforeach?>
                                                    <?php endif;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Poste : </label>
                                            <select name="edit_post" id="edit_post" class="form-control" value="<?= set_value('edit_post');?>">
                                                <option value="">...</option>
                                                <?php if(count($posts)):?>
                                                    <?php foreach ($posts as $post): ?>
                                                    <option value="<?= $post->design ?>"><?= $post->design ?></option>
                                                    <?php endforeach?>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Rôle (Privilege) : </label>
                                                <select name="edit_role" id="edit_role" class="form-control" value="<?= set_value('edit_role');?>">
                                                    <option value="">...</option>
                                                <option value="Super_Admin">Super_Admin</option>
                                                <option value="Admin">Admin</option>
                                                <option value="n+1">n+1</option>
                                                <option value="Employer">Employer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date de création : </label>
                                            <input type="date" name="edit_date" id="edit_date"
                                                class="form-control" placeholder="Date de création" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status : </label>
                                            <select name="edit_status" id="edit_status" class="form-control" value="<?= set_value('edit_status');?>">
                                                <option value="">...</option>
                                                <option value="actif">actif</option>
                                                <option value="inactif">inactif</option>
                                            </select>
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
        
    // // Fonction pour générer un nouvel identifiant incrémenté
    // function generateNewID(currentID) {
    // // Extrait le numéro de l'identifiant actuel
    // const currentNumber = parseInt(currentID.slice(1));
    
    // // Incrémente le numéro
    // const newNumber = currentNumber + 1;
    
    // // Formate le nouveau numéro avec des zéros à gauche si nécessaire (par exemple, T002)
    // const newID = "T" + (newNumber < 10 ? "000" : newNumber < 100 ? "00" : newNumber < 1000 ? "0" : "") + newNumber;
    
    // return newID;
    // }

        // Ajout personel
        $(document).on('click', '#add', function(e) {
            e.preventDefault();

            var code_em = $("#code_em").val();
            var nom = $("#nom").val();
            var prenom = $("#prenom").val();
            var email = $("#email").val();
            var pwd = $("#password").val();
            var adresse = $("#adresse").val();
            var date_nais = $("#date_nais").val();
            var CIN = $("#CIN").val();
            var contact = $("#contact").val();
            var contact_proche = $("#contact_proche").val();
            var sexe = $("#sexe").val();
            var post = $("#post").val();
            var contrats = $("#contrats").val();
            var departement = $("#departement").val();
            var role = $("#role").val();
            var date_creation = $("#date_creation").val();
            var profil = $("#profil")[0].files[0];
            var status = 'actif';

            function test_obligatoire() {
                if (role == '...')
                    return "Choisissez le role de l'employer";
                if (status == '...')
                    return "Choisissez le status de l'employer";
                if (sexe == '...')
                    return "Choisissez le genre";
                else
                    return false;
            }
            if (test_obligatoire() != false)
                alert(test_obligatoire());
            else {
                     // Utilisez md5 pour hacher le mot de passe
                var password = CryptoJS.MD5(pwd).toString();
                var formData = new FormData();
                formData.append('code_em', code_em);
                formData.append('nom', nom);
                formData.append('prenom', prenom);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('adresse', adresse);
                formData.append('date_nais', date_nais);
                formData.append('CIN', CIN);
                formData.append('contrats', contrats);
                formData.append('contact', contact);
                formData.append('contact_proche', contact_proche);
                formData.append('sexe', sexe);
                formData.append('post', post);
                formData.append('departement', departement);
                formData.append('role', role);
                formData.append('date_creation', date_creation);
                formData.append('profil', profil);
                formData.append('status', status);
                $.ajax({
                    url: "<?php base_url(); ?>add_personnel",
                    type: "post",
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.responce == "success") {
                            $('#records').DataTable().destroy();
                            fetch();
                            $('#modal_personnel').modal('hide');
                            toastr["success"](data.message);
                        } else {
                            toastr["error"](data.message);
                        }
                    }
                });

                $("#form")[0].reset();
            }
        });

        function fetch() {
            $.ajax({
                url: "<?= base_url(); ?>fetch",
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
                                data: 'id',
                                render: function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            {
                                data: 'code_em'
                            },
                            {
                                data: 'nom'
                            },
                            {
                                data: 'prenom'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'contact'
                            },
                            {
                                data: 'post'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: null,
                                render: function(data, type, row, meta) {
                                    var a = `
                                        <a href="#" value="${row.id}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
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
                        url: "<?= base_url(); ?>delete",
                        type: "post",
                        dataType: "json",
                        data: {
                            del_id: del_id
                        },
                        success: function(data) {
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
                url: "<?= base_url(); ?>edit",
                type: "post",
                dataType: "json",
                data: {
                    edit_id: edit_id
                },
                success: function(data) {
                    $('#edit_modal').modal('show');
                    $('#edit_id').val(data.posts.id);
                    $('#edit_code').val(data.posts.code_em);
                    $('#edit_nom').val(data.posts.nom);
                    $('#edit_prenom').val(data.posts.prenom);
                    $('#edit_email').val(data.posts.email);
                    $('#edit_adresse').val(data.posts.adresse);
                    $('#edit_nais').val(data.posts.date_nais);
                    $('#edit_contact').val(data.posts.contact);
                    $('#edit_sexe').val(data.posts.sexe);
                    $('#edit_post').val(data.posts.post);
                    $('#edit_role').val(data.posts.role); // Assurez-vous d'utiliser le bon nom pour le rôle
                    $('#edit_departement').val(data.posts.departement);
                    $('#edit_date').val(data.posts.date_creation);
                    $('#edit_status').val(data.posts.status);
                }
            });
        });

        // --- update records ---
        $(document).on('click','#modif',function(e){
            e.preventDefault();

            var edit_id = $('#edit_id').val();
            var edit_code = $('#edit_code').val();
            var edit_nom = $('#edit_nom').val();
            var edit_prenom = $('#edit_prenom').val();
            var edit_email = $('#edit_email').val();
            var edit_adresse = $('#edit_adresse').val();
            var edit_nais = $('#edit_nais').val();
            var edit_contact = $('#edit_contact').val();
            var edit_sexe = $('#edit_sexe').val();
            var edit_post = $('#edit_post').val();
            var edit_role = $('#edit_role').val(); // Assurez-vous d'utiliser le bon nom pour le rôle
            var edit_departement = $('#edit_departement').val();
            var edit_date = $('#edit_date').val();
            var edit_status = $('#edit_status').val();

             // Cryptez le mot de passe en MD5
            edit_password = CryptoJS.MD5(pwd).toString();
            $.ajax({
                url: "<?= base_url(); ?>update",
                type: "post",
                dataType: "json",
                data: {
                    edit_id : edit_id,
                    edit_code : edit_code,
                    edit_nom : edit_nom,
                    edit_prenom : edit_prenom,
                    edit_email : edit_email,
                    edit_adresse : edit_adresse,
                    edit_nais : edit_nais,
                    edit_contact : edit_contact,
                    edit_sexe : edit_sexe,
                    edit_post : edit_post,
                    edit_role : edit_role,
                    edit_departement : edit_departement,
                    edit_date : edit_date,
                    edit_status : edit_status
                },
                success : function(data){
                    if (data.responce == "success") {
                        $('#records').DataTable().destroy();
                        fetch();
                        $('#edit_modal').modal('hide');
                        toastr["success"](data.message);
                    } 
                    else {
                        toastr["error"](data.message);
                    }
                }
            })

        });

        </script>


        </body>

        </html>