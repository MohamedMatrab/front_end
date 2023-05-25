<?php
require_once 'Models/connect.php';

function Show_Data($table) {
        $obj = new connect(); 
        $All = $obj->select($table) ;
        if ($table === 'historique') {
            ob_start();
            foreach ( $All as $index => $patient ) {
                //start
                $id_service = $obj->selectId($patient->service);
                $doctor = $obj->selectDoctor($id_service->service_id) ;
                if ( $index == 0 || ($index !=0 && array_search($patient->CIN, array_column($All, 'CIN')) ) ) { 
                    ?>
                        <tr>
                            <td><?php ?></td>
                            <td><?php echo $patient->CIN ;?></td>
                            <td><?php echo $patient->First_Name . ' ' . $patient->Last_Name ;?></td>
                            <td><a class="dossier" href="dashboard.php?action=ulpoad_details&&ID=<?php echo $patient->CIN ?>" data-id="<?php echo $patient->CIN ?>"><i class="bi bi-file-earmark-person-fill"></i></a></td>
                        </tr>
                    <?php
                }else{
                    continue ;
                }

            }
            $allReservation = ob_get_clean() ; 
            require_once 'views/history.php';
        }else {  
            ob_start();?>
            <div style="font-family: monospace" class="h2">Liste des rendez-vous</div>
            <?php
            $compteur = 0 ;
            if ( count($All) > 0 ) {
                foreach ( $All as $patient ) {
                    $id_service = $obj->selectId($patient->service);
                    $doctor = $obj->selectDoctor($id_service->service_id ) ;
                    $compteur +=1 ;
                ?>
                    <div class="patient">
                        <div class="name">
                            <p>N °<?php echo $compteur?></p>
                            <a class= "ajouter" href="dashboard.php?action=all_reservations&&id=<?php echo $patient->id_rendez;?>&&state=consulter"><i class="bi bi-person-plus"></i></a>
                        </div>
                        <div class="description  ">
                            <div class="box">
                                <p>Nom et Prénom :  <?php echo $patient->First_Name .' ' .$patient->Last_Name;?></p>
                                <p>CIN :  <?php echo $patient->CIN;?>  </p>
                                <p>Date de naissance :  <?php echo $patient->Date_Of_birth;?>  </p>
                                <p>tél :  <?php echo $patient->tel;?>  </p>
                                <p>date de rendez-vous :  <?php echo $patient->date_rendez;?>  </p>
                                <p>heure de rendez-vous :  <?php echo $patient->Heure_rendez;?>  </p>
                                <p>Nom et Prénom du docteur:  <?php echo $doctor->Nom .' '. $doctor->Prenom;?>  </p>
                            </div>
                            <div class="action">
                                <a class= "valider" href="#">Valider</a></th>
                                <a class= "annuler" href="dashboard.php?action=all_reservations&&id=<?php echo $patient->id_rendez;?>&&state=annuler">Annuler</a>
                            </div>
                        </div>
                    </div>
    
                    
                <?php 
                } 
                
            }
            $allReservation = ob_get_clean() ;
            require_once 'views/reservation.php';
        }
    }