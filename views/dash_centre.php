<?php
session_start();
$title = "Centre";
ob_start();
?>

<?php
include_once "Models/connect.php";
    $conn = new connect();
    $conn->centreTable() ;
    $conn->photos_centreTable() ;
?>

<link rel="stylesheet" href="style/style-portfolio.css">
<div class="landing-page">
    <h2 class="main-header">Center</h2>
</div>
<?php include_once 'views/p_message.php' ?>
<div id="centre-page">
    <div class="container mt-5">
        <div class="images mb-3">
            <h6>Centre/pictures</h6>
            <?php 
                $sql2 = "SELECT * FROM photos_centre" ;
                $stmt2 = $conn->getConnect()->prepare($sql2);
                $stmt2->execute();
                $photo_centre = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if (!$photo_centre) {  ?>
                    <div class="text">No photo Found</div>
                <?php }
                else {
                    ?>
                    <div class="image_centre">
                    <?php
                    foreach( $photo_centre as $photo) { 
                        $image = 'data:image/jpg;base64,'.base64_encode($photo['photo_centre']);
                        ?>
                        <div class="img">
                            <img src="<?=$image?>" style = "width: 100%;" alt="error" srcset="">
                            <div class="del_centre" data-id = "<?=$photo['id_photo']?>">
                                <i class="bi bi-trash"></i>
                            </div>
                        </div>
                <?php
                    }
                    ?>
                        <div class="img" style="background-color: #81808075 ; display: flex;
    align-items: center;
    justify-content: center;">
                            <div class="add_photo">
                                <a><i class="bi bi-plus"></a></i>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php 
            $sql = "SELECT * FROM centre;";
            $stmt = $conn->getConnect()->prepare($sql);
            $stmt->execute();
            $centre = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$centre) {
?>
                <div class="description mb-3">
                    <h6>Centre/description</h6>
                    <p class="text">No Data available</p>
                </div>
                <div class="motivation mb-3">
                    <h6>Centre/motivation</h6>
                    <p class="text">No Data available</p>
                </div>
                <div class="add">
                    <a class="Add_centre" href="dashboard.php?action=addCentreInfo">Add information</a>
                </div>
        <?php
        }else { 
            ?>
                        <div class="description">
                            <h6>Centre/description</h6>
                            <p class="text"><?=$centre['description']?></p>
                        </div>
                        <div class="motivation">
                            <h6>Centre/motivation</h6>
                            <p class="text"><?=$centre['motivation']?></p>
                        </div>
                        <div class="contact_centre">
                            <h6>Centre/contact</h6>
                            <div class="local">
                                <p>adresse du cabinet :</p>
                                <p class="text"><a href="<?=$centre['localisation']?>"><?=$centre['address']?></a></p>
                            </div>
                            <div class="num1">
                                <p>numéro de téléphone :</p>
                                <p class="text"><a href="tel:+<?=$centre['numero_1']?>"><?=$centre['numero_1']?></a></p>
                            </div>
                            <div class="num2">
                                <p>numéro de téléphone en cas d'urgence :</p>
                                <p class="text"><a href="tel:+<?=$centre['numero_2']?>"><?=$centre['numero_2']?></a></p>
                            </div>
                            <div class="email">
                                <p>adresse e-mail  :</p>
                                <p class="text"><a href="<?=$centre['email']?>"><?=$centre['email']?></a></p>
                            </div>
                            <?php if(isset($centre['facebook'])) :?>
                            <div class="facebook">
                                <p>lien Facebook  :</p>
                                <p class="text"><a href="<?=$centre['facebook']?>"><?=$centre['facebook']?></a></p>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($centre['instagram'])) :?>
                            <div class="instagram">
                                <p>lien instagram  :</p>
                                <p class="text"><a href="<?=$centre['instagram']?>"><?=$centre['instagram']?></a></p>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($centre['twitter'])) :?>
                            <div class="twitter">
                                <p>lien instagram  :</p>
                                <p class="text"><a href="<?=$centre['instagram']?>"><?=$centre['instagram']?></a></p>
                            </div>
                            <?php endif; ?>
                            <div class="editCentre">
                                <a class="" href="dashboard.php?action=addCentreInfo">Edit Information</a>
                            </div>
                        </div>
                    <?php } 
        ?>
        
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- <script defer src="js/dash_portfolio.js"></script> -->
<script defer src="js/about_centre.js"></script></script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'views/dashboard.php'; ?>