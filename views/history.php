<?php
    ob_start();
?>    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 

    <section class="appointment" id="appointment">
        <div class="container">
            <div>
                <p>Historiqe</p>
                <h2><?php 
                    $date = date('l, j F Y', strtotime(date('Y-m-d')));
                    echo $date ;
                ?></h2>
            </div>
            <div class="table-appoint mt-5">
                <table class="table table-striped table-bordered" id="patient_data">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>CIN</th>
                            <th>Nom et Prénom</th>
                            <th></th>
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
<?php include_once 'views/dashboard.php' ; ?>           
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script>
    $(document).ready(function(){  
        $('#patient_data').DataTable( {
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [0,1,2] }
        ],
        responsive: true,
    });
    });  
    
</script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<!-- <script src="js/upload_history.js"></script> -->
<!-- <script src="js/history.js"></script> -->
