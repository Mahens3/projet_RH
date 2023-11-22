<?php 
    $code_em = $this->session->userdata('code_em');
    $solde = $this->dashboard_model->Getsolde_conger($code_em);                        
?> 

        <div class="container-fluid page-body-wrapper">

            <?php $this->load->View('Template/inclure/right_sidebar');?>
            <?php $this->load->View('Template/inclure/sidebar');?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <!-- Content Row 1 -->
                    <div class="row">
                        <?php if ($this->session->userdata('role')=='Admin' || $this->session->userdata('role')=='Super_Admin'): ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url();?>personnel" style="text-decoration:none;margin-top: -14px;">
                                <div class="card border-left-primary shadow h-100 py-2" style="border-left: 5px solid navy;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2 text-center">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 mt-2">Total personnel
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" style="color:black;">
                                                    <?php
                                                        $this->db->where('status','actif');
                                                        $this->db->from("personnel");
                                                        echo $this->db->count_all_results();
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-users fa-2x" style=" color: gray;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('role')=='Super_Admin'): ?>
                        <?php else : ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" style="border-left: 5px solid green;">
                                <div class="card-body" >
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Solde conger
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $solde->nbr_jrs;?> jrs</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x mt-3"  style="color: gray;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('role')=='Admin' || $this->session->userdata('role')=='Super_Admin'): ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url();?>conger_en_cours" style="text-decoration:none;">
                            <div class="card border-left-info shadow h-100 py-2" style="border-left: 5px solid blue;">
                                <div class="card-body" >
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Conger en attente </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" style="color:black;">
                                                    <?php
                                                        $this->db->where('status_conger','En attente');
                                                        $this->db->from("demande_conger");
                                                        echo $this->db->count_all_results();
                                                    ?>
                                                    En attente
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"  style=" color: gray;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('role') == 'n+1' || $this->session->userdata('role') == 'Super_Admin'): ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="<?= base_url(); ?>demande_conger" style="text-decoration:none;">
                            <div class="card border-left-info shadow h-100 py-2" style="border-left: 5px solid blue;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Demande de conge</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" style="color: black;">
                                                    <?php
                                                    try {
                                                        $role = $this->session->userdata('role');
                                                        $code_em = $this->session->userdata('code_em');

                                                        if ($role == 'n+1') {
                                                            // Get the department code of the current user
                                                            $this->db->select('departement');
                                                            $this->db->from('personnel');
                                                            $this->db->where('code_em', $code_em);
                                                            $user_query = $this->db->get();
                                                            $user_department = $user_query->row()->departement;

                                                            // Count non-treated requests from employees in the same department
                                                            $this->db->where('status_conger', 'Non Traiter');
                                                            $this->db->where("code_em IN (SELECT code_em FROM personnel WHERE departement = '$user_department')", NULL, false);
                                                            $this->db->from("demande_conger");
                                                            echo $this->db->count_all_results();
                                                        } else {
                                                            // For other roles, count all non-treated requests
                                                            $this->db->where('status_conger', 'Non Traiter');
                                                            $this->db->from("demande_conger");
                                                            echo $this->db->count_all_results();
                                                        }
                                                    } catch (Exception $e) {
                                                        echo 'Une erreur est survenue : ' . $e->getMessage();
                                                    }
                                                    ?>
                                                    Non traiter
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300" style="color: gray;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 5px solid orange;">
                                <div class="card-body" >
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Solde exceptionnel
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $solde->solde_exeptionnel;?> jrs</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300" style=" color: gray;" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- oontent row 2-->
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/');?>vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo base_url('assets/');?>vendors/chart.js/Chart.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/');?>js/off-canvas.js"></script>
    <script src="<?php echo base_url('assets/');?>js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url('assets/');?>js/template.js"></script>
    <script src="<?php echo base_url('assets/');?>js/settings.js"></script>
    <script src="<?php echo base_url('assets/');?>js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo base_url('assets/');?>js/dashboard.js"></script>
    <script src="<?php echo base_url('assets/');?>js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>