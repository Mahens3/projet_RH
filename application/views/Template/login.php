<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Telesourcia</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />
</head>
<body>
    <section class="vh-100" style="background-color:cadetblue;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0" style="background-color:cadetblue;">
                            <div class="col-md-6 col-lg-5 d-none d-md-block mt-5">
                                <img src="<?php echo base_url('assets/images/graphic1.svg" alt="logo'); ?>"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-2 text-black mr-4 ml-4" style="background-color: seashell;border-radius: 1em;">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0 ml-4"><img
                                                src="<?php echo base_url('assets/images/logo_telesourcia.png" alt="logo'); ?>"></span>
                                    </div>
                                    <h4 class="fw-normal mb-3 pb-3 ml-4" style="letter-spacing: 1px;">Identifiez_vous !!
                                    </h4>
                                    <?php if ($this->session->flashdata('error_message')) : ?>
                                        <div class="alert alert-danger mr-4 ml-4">
                                            <?php echo $this->session->flashdata('error_message'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('success_message')) : ?>
                                        <div class="alert alert-success">
                                            <?php echo $this->session->flashdata('success_message'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?php echo base_url();?>action" id="form_login" method="post">
                                        <div class="form-outline mb-4 mr-4 ml-4">
                                            <label class="form-label" for="form2Example17">Adresse email</label>
                                            <input class="form-control form-control-lg" type="email" id="email"
                                                name="email" placeholder="Email"
                                                value="<?php echo set_value('email'); ?>" />
                                            <small><?php echo form_error('email'); ?></small>
                                        </div>

                                        <div class="form-outline mb-4 mr-4 ml-4">
                                            <label class="form-label" for="form2Example27">Mot de passe</label>
                                            <input class="form-control form-control-lg" type="password" id="password"
                                                name="password" placeholder="Password"
                                                value="<?php echo set_value('password'); ?>" />
                                            <small><?php echo form_error('password'); ?></small> </br>
                                            <input class="mt-3" type="checkbox" id="showPassword"> Afficher le mot de
                                            passe
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit" style="width:29em; margin-left:6%">SE
                                                CONNECTER</button>
                                        </div>

                                        <!-- <p class="mb-5 pb-lg-2" style="color: #393f81;">Pas de compte? <a
                                                href="#!" style="color: #393f81;"></a>S'inscrire</p> -->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    const passwordField = document.getElementById("password");
    const showPasswordCheckbox = document.getElementById("showPassword");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    });
    </script>

    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
    <script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
    <script src="<?php echo base_url('assets/js/template.js');?>"></script>
    <script src="<?php echo base_url('assets/js/settings.js');?>"></script>
    <script src="<?php echo base_url('assets/js/todolist.js');?>"></script>
    <!-- endinject -->

</body>

</html>

</html>