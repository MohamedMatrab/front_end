<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="stylesheet" href="style/bootstrap.min.css" >
    <link rel="stylesheet" href="style/dashboard.css" >
    <link rel="stylesheet" href="assets/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container" id="file">
        <div class="head">
            <h3 class="name_pt">Dossier médical de Meriem Lachhab</h3>
            <p class="date_rdv">le 05/26/2023</p>
        </div>
        <form action="index.php?action=more_details&&ID=<?php echo $CIN  ;?>" method="post" id="more_details">
            <div class="info row">
                <div class="col-6">
                    <div class="box">
                        <h3>Nom</h3>
                        <span><?=$name?></span>
                    </div>
                    <div class="box">
                        <h3>Numéro de téléphone</h3>
                        <span><?=$tel?></span>
                    </div>
                    <div class="box">
                        <h3>Adresse</h3>
                        <span><?=$address?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="box">
                        <h3>Date de naissance</h3>
                        <span><?=$date_Birth?></span>
                    </div>
                    <?=$form?>
                </div>
                <button style="visibility:hidden" type="submit"></button>
            </div>
        </form>
        <div class="content">
            <h3>Les rendez-vous</h3>
            <?=$appointment?>
        </div>


    </div>





    <script src="js/all.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>