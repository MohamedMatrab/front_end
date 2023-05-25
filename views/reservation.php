<?php

   ob_start();
?>
    <section class="appointment" id="appointment">
        <div class="container">
            <div class="mb-5">
                <p>Metrics for</p>
                <h2><?php 
                    $date = date('l, j F Y', strtotime(date('Y-m-d')));
                    echo $date ;
                ?></h2>
            </div>
            <?=$allReservation?>    
        </div>
        
    </section>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/dashboard.php' ; ?> 