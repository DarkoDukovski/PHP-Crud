<?php
if (isset($_SESSION['message'])):
    $isError = isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'error';
    $bgColor = $isError ? '#fef2f2' : '#f0fdf4';
    $borderColor = $isError ? '#fecaca' : '#bbf7d0';
    $textColor = $isError ? '#991b1b' : '#166534';
    $iconClass = $isError ? 'bi-exclamation-circle-fill' : 'bi-check-circle-fill';
    $iconColor = $isError ? '#ef4444' : '#22c55e';
    $title = $isError ? 'Error!' : 'Success!';
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert"
                style="background-color: <?= $bgColor ?>; border: 1px solid <?= $borderColor ?>; color: <?= $textColor ?>; border-radius: 12px; padding: 1rem 1.25rem;">
                <i class="bi <?= $iconClass ?> me-3" style="font-size: 1.25rem; color: <?= $iconColor ?>;"></i>
                <div>
                    <strong style="font-weight: 600;"><?= $title ?></strong> <span
                        style="font-weight: 500; opacity: 0.9;"><?= $_SESSION['message']; ?></span>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"
                    style="font-size: 0.8rem; opacity: 0.6; padding: 1.25rem;"></button>
            </div>
        </div>
    </div>

    <?php
    unset($_SESSION['message']);
    if (isset($_SESSION['message_type']))
        unset($_SESSION['message_type']);
endif;
?>