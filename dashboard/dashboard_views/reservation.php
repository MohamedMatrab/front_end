<?php

   ob_start();
?>
    <section class="appointment" id="appointment">
        <div class="container">
            <div>
                <p>Metrics for</p>
                <h2><?php 
                    $date = date('l, j F Y', strtotime(date('Y-m-d')));
                    echo $date ;
                ?></h2>
            </div>
            <div class="table-appoint tab mt-5">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">CIN</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">téléphone</th>
                            <th scope="col">date</th>
                            <th scope="col">heure</th>
                            <th scope="col">Médecin</th>
                            <th scope="col">State</th>
                            <th scope="col">Annulation</th>
                            <th scope="col"><i class="bi bi-check2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$allReservation?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'dashboard_views/dashboard.php' ; ?> 