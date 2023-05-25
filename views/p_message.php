<?= isset($_SESSION['message']) ? '<div class="alert alert-info" style="margin:1rem;text-align:center;" role="alert" >' . $_SESSION['message'] . '</div>' : ''; ?>
<?php
unset($_SESSION['message']);
?>