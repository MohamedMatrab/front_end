<?php
include_once "connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xr+L5Zu0WT9CZd6cfmP6D1k4qTYYI40tNgQF3eJZIQjhHm8ALbKfRUSg9DZ1Ew2xOTc4JSKuU+J7lZ8F3bcNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style_homepage.css">

    
</head>
<body>
 
    <main>
    <div class="cards">
        <div class="card-single">
            <div class="card-content" >
            <?php
                $sql2=$connect->prepare("SELECT COUNT(*) AS doctors FROM users WHERE role=:rol");
                $sql2->bindValue(':rol', 1, PDO::PARAM_INT);
                $sql2->execute();
                $res3=$sql2->fetch();
                $doctor_count=$res3['doctors'];
                ?>
               
                <h2><?=$doctor_count; ?></h2>
                <b>Doctors</b>
            </div>
            <div>
                
                <span class="fa-solid fa-user-doctor"></span>
            </div>
        </div>

        <div class="card-single">
            <div class="card-content">
                <?php
                $sql3=$connect->prepare("SELECT COUNT(*) AS patient FROM users WHERE role=:rol");
                $sql3->bindValue(':rol', 0, PDO::PARAM_INT);
                $sql3->execute();
                $res4=$sql3->fetch();
                $patient_count=$res4['patient'];
                ?>
                <h2><?=$patient_count; ?></h2>
                <b>patients</b>
            </div>
            <div>
                <span class="fa fa-newspaper-o"></span>
            </div>
        </div>


        <div class="card-single">
            <div class="card-content">
            <?php
                $sql1=$connect->prepare("SELECT COUNT(*) AS servicee FROM services");
                $sql1->execute();
                $res1=$sql1->fetch();
                $service_count=$res1['servicee'];
                ?>
                <h2><?= $service_count;?></h2>
                <b>services</b>
            </div>
            <div>
                <span class="fa fa-outdent"></span>
            </div>
        </div>

        <div class="card-single">
            <?php
                $current_month_name = date('F');
            ?>
        <button type="button" class="btn btn-outline-warning"><b><?=$current_month_name ;?></b></button>
            <div class="card-content">
                <?php $current_month=date('m');
                    $current_year=date('Y');
                    $sql = $connect->prepare("SELECT COUNT(*) AS appointmentCount FROM rendez_vous WHERE MONTH(date_rendez) = :currentMonth AND YEAR(date_rendez) = :currentYear");
                    $sql->bindParam(':currentMonth', $currentMonth);
                    $sql->bindParam(':currentYear', $currentYear);
                    $sql->execute();
                    $result = $sql->fetch();
                    $appointment_count = $result['appointmentCount'];

                   ?>
                    <h2><?=$appointment_count; ?></h2>
                    <b> appointements</b>
                    </div>
                    <div>
                    <span class="fa fa-group"></span>
                </div>

    </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
   
    <div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4>Appointements</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Date of birthday</th>
                                <th>Date rendez-vous</th>
                                <th>Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql4 = $connect->prepare("SELECT First_Name, Last_Name, Date_Of_birth, date_rendez, service FROM rendez_vous LIMIT 4");
                            $sql4->execute();
                            $count = $sql4->rowCount();
                            if ($count > 0) {
                                foreach ($sql4 as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row['First_Name']; ?></td>
                                        <td><?= $row['Last_Name']; ?></td>
                                        <td><?= $row['Date_Of_birth']; ?></td>
                                        <td><?= $row['date_rendez']; ?></td>
                                        <td><?= $row['service']; ?></td>
                                    </tr>
                                    <?php
                                }
                                if ($count > 4) {
                                    ?>
                                    <tr>
                                        <td colspan="5"><a href="autre_page.php">Lire la suite</a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No records found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    
</main>
</body>
</html>