            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();?>admin_dashboard">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">UI Elements</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="pages/ui-features/buttons.html">Buttons</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="pages/ui-features/typography.html">Typography</a></li>
                            </ul>
                        </div>
                    </li> -->
                    <?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Super_Admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#registre_user" aria-expanded="false" aria-controls="auth">
                                <i class="icon-head menu-icon"></i>
                                <span class="menu-title">Personnel</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="registre_user">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>personnel">Personnel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>departement">Departement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>post">Posts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#conger" aria-expanded="false" aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Gestion de congé</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="conger">
                            <ul class="nav flex-column sub-menu">
                                <?php if ($this->session->userdata('role') == 'Super_Admin'): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>solde_conger">Solde congé</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>type_conger">Type de congé</a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('role') != 'Admin'): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>demande_conger">Demande de congé</a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('role') != 'n+1' && $this->session->userdata('role') != 'Employer'): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>conger_en_cours">Demande en attente</a>
                                    </li>
                                <?php endif; ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>conger_gagner">Congé gagné</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>historique_conger">Historiques</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>