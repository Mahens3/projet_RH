<?php        $data['conge_notifications'] = $this->Notification_model->getCongeNotifications(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telesourcia</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendors/feather/feather.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Linbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/');?>js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/');?>images/favicon.ico" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url();?>admin_dashboard"><img
                        src="<?php echo base_url('assets/');?>images/logo_telesourcia.png" class="mr-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="<?php echo base_url('assets/');?>images/favicon.ico" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle mr-2" id="notificationDropdown" href="#"
                            data-toggle="dropdown">    
                                <i class="icon-bell mx-0"></i>
                            <?php
                                $code_em = $this->session->userdata('code_em');
                                if($this->session->userdata('role') == 'n+1'){

                                    $this->db->select('departement');
                                    $this->db->from('personnel');
                                    $this->db->where('code_em', $code_em);
                                    $user_query = $this->db->get();
                                    $user_department = $user_query->row()->departement;
                            
                                    // Get all requests from employees in the same department
                                    $this->db->join('personnel', 'personnel.code_em = notification.code_em');
                                    $this->db->where('personnel.departement', $user_department);

                                    $this->db->where('status_conger','Non Traiter');
                                }
                                elseif($this->session->userdata('role') == 'Admin'){
                                    $this->db->where('status_conger','En attente');
                                }
                                elseif($this->session->userdata('role') == 'Employer'){
                                    $this->db->where('status_conger','Accepter');
                                    $this->db->or_where('status_conger','Rejeter');
                                }
                                else {}
                                $this->db->where('etat','non lu');
                                $this->db->from("notification");
                                $count = $this->db->count_all_results();
                            ?>
                            <?php if($count == 0): ?>
                            <?php else:?>
                                <span class="badge badge-danger badge-counter" style="padding: 3px 5px; font-size: 10px; text; transform: translate(-10px, -12px);">
                                    <?=  $count; ?>+
                                </span>
                            <?php endif; ?>
                            <!-- <span class="count"></span> -->
                        </a>
                        
                        <?php echo $this->session->userdata('role');?>
                        
                        <!-- Inclure la vue partielle des notifications -->
                        <?php $this->load->view('partials/header_notifications', $data); ?>
                        
                        
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" style="color:revert;">
                        <?php echo $this->session->userdata('prenom');?>
                            <img src="<?php echo base_url('assets/');?>images/favicon.ico" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url();?>logout">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="#">
                            <i class="icon-ellipsis"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>