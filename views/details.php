<?php

    ob_start();
?>
    <!-- <div class="logo dg-lg"><div>dent<span>All</span></div></div> -->
    <div class="container" id="file">
        <div class="head">
            <h3 class="name_pt"></h3>
        </div>
        <div class="info_pt">
            <h5>Des informations personnelles : </h5>
            <form action="dashboard.php?action=more_details&&ID=<?=$code?>" method="post" id="more_details" class="mt-4 ps-4">
                    <div class="row">
                        <div class="rflex">
                            <h3 class="fs-5">CIN: </h3>
                            <p class="fs-5 "><?=$code?></p>
                        </div>
                        <div class="rflex">
                            <h3 class="fs-5">Nom et prénom : </h3>
                            <p class="fs-5 "></p>

                        </div>
                        <div class="rflex">
                            <h3 class="fs-5">tél :</h3>
                            <p class="fs-5"></p>
                        </div>
                        <div class="rflex">
                            <h3 class="fs-5">Adresse :</h3>
                            <p class="fs-5 "></p>
                        </div>
                        <div class="rflex">
                            <h3 class="fs-5">Date de naissance :</h3>
                            <p class="fs-5"></p>
                        </div>

                        <button class="more" style="visibility:hidden" type="submit"></button>
                    </div>
            </form>
        </div>
        <div class="content">
            <h5>Les rendez-vous : </h5>
            <div class="mt-4">

            </div>
        </div>




    </div>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/dashboard.php' ; ?> 
<script src="js/upload_details.js"></script>