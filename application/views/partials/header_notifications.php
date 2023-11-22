<!-- header_notifications.php -->
<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
    <?php foreach ($conge_notifications as $notification): ?>
        <?php
            if ($notification['status_conger'] == 'Accepter')
                $affiche = 'conger_gagner';          
            elseif ($notification['status_conger'] == 'Non traiter')
                $affiche = 'demande_conger';
            elseif ($notification['status_conger'] == 'En attente')
                $affiche = 'conger_en_cours';
            else{
                $affiche = 'historique_conger';
            }
        ?>
        <a class="dropdown-item preview-item" href="<?php echo base_url($affiche);?>">
            <div class="preview-thumbnail">
                <?php
                    $statusClasses = [
                        'Accepter' => 'bg-success',
                        'Non traiter' => 'bg-primary',
                        'En attente' => 'bg-warning',
                    ];

                    $defaultClass = 'bg-danger';

                    $selectedClass = $statusClasses[$notification['status_conger']] ?? $defaultClass;
                    $iconClass = ($notification['status_conger'] == 'Accepter') ? 'ti-check' : 'ti-calendar';
                ?>

                <div class="preview-icon <?= $selectedClass ?>">
                    <i class="<?= $iconClass ?> mx-0"></i>
                </div>

            </div>
            <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal"><?php echo $notification['prenom'] . ' ' . $notification['nom']; ?> <small>Demande une conger de <?php echo $notification['duree_conger'] ?> jours </small></h6>
                <p class="font-weight-light small-text mb-0 text-muted">
                    <?php echo $notification['date_notification']; ?>
                </p>
            </div>
        </a>
    <?php endforeach; ?>
</div>