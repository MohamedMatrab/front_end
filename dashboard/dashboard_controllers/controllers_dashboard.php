<?php
    require_once 'dashboard_models/connect.php';

    function dashboard() {
        require_once 'dashboard_views/dashboard.php';
    }
    
    function Show_Data($table) {
        $obj = new connect(); 
        $All = $obj->select($table) ;
        if ($table === 'historique') {
            ob_start();
            foreach ( $All as $patient ) {
                $id_service = $obj->selectId($patient->services);
                $doctor = $obj->selectDoctor($id_service->identifiant) ;
            ?>
                <tr>
                    <td><?php ?></td>
                    <td><?php echo $patient->CIN ;?></td>
                    <td><?php echo $patient->First_Name . ' ' . $patient->Last_Name ;?></td>
                    <td><?php echo $doctor[0]->Prenom .' '. $doctor[0]->Nom ?></td>
                    <td><a class="dossier" href="index.php?Code=<?php echo $patient->CIN ?>&&action=details"><i class="bi bi-file-earmark-person-fill"></i></a></td>
                </tr>
        <?php } $allReservation = ob_get_clean() ; ?> 
            <?php require_once 'dashboard_views/history.php';
        }else {
            ob_start();
            foreach ( $All as $patient ) {
                $id_service = $obj->selectId($patient->services);
                $doctor = $obj->selectDoctor($id_service->identifiant) ;
            ?>
                <tr>
                    <th scope="col"><?php echo $patient->CIN;?></th>
                    <th scope="col"><?php echo $patient->First_Name ;?></th>
                    <th scope="col"><?php echo $patient->Last_Name;?></th>
                    <th scope="col"><?php echo $patient->Date_Of_birth;?></th>
                    <th scope="col"><?php echo $patient->tel;?></th>
                    <th scope="col"><?php echo $patient->date_rendez;?></th>
                    <th scope="col"><?php echo $patient->Heure_rendez;?></th>
                    <th scope="col"><?php echo $doctor[0]->Nom .' '. $doctor[0]->Prenom;?></th>
                    <th scope="col"><a class= "valider" href="#">Valider</a></th>
                    <th scope="col"><a href="index.php?action=dash_appointment&&id=<?php echo $patient->id_rendez;?>&&fun=annuler">Annuler</a></th>
                    <th scope="col"><a href="index.php?action=dash_appointment&&id=<?php echo $patient->id_rendez;?>&&fun=visiter"><i class="bi bi-person-plus"></i></a></th>
                <tr>
            <?php } $allReservation = ob_get_clean() ; ?> 
            <?php require_once 'dashboard_views/reservation.php';
        }
    }
    
    function dashb_history(){
        Show_Data('historique') ;
    }

    function dashb_appointment(){
        Show_Data('rendez_vous') ;
    }


    function Delete_from_rendez($id) {
        $obj = new connect(); 
        $obj->Delete_rendez($id);
        dashb_appointment();
    }

    function Ajout_History($id) {
        $obj = new connect(); 
        $obj->insert_into_history($id);
        Delete_from_rendez($id) ;
    }

    function details_patient($code){
        $obj = new connect(); 
        $CIN = $code ;
        $patient = $obj->select_code($code);
        $name = $patient->First_Name ." " . $patient->Last_Name;
        $date_Birth = $patient->Date_Of_birth ;
        $tel = $patient->tel ;
        $address = $patient->address ;
        $services = $patient->services ;
        $poids = $patient->poids ;
        $taille = $patient->taille ;
        $doctor = $obj->selectDoctor($obj->selectId($services)->identifiant) ;
        if ($poids == 0  && $taille == 0 ){
            ob_start() ;
            ?>
                    <div class="box">
                        <h3>taille</h3> 
                        <input type="text" name="taille">
                    </div>
                    <div class="box">
                        <h3>poids</h3>
                        <input type="text" name="poids">
                    </div>
        <?php  $form = ob_get_clean() ; }
        if ( $poids != 0  && $taille != 0 ){  
                ob_start() ;
                ?>
                    <div class="box">
                        <h3>taille</h3> 
                        <span><?php echo $taille?></span>
                    </div>
                    <div class="box">
                        <h3>poids</h3>
                        <span><?php echo $poids?></span>
                    </div>
        <?php  $form = ob_get_clean() ; }

        // display info about appointment
        $appoint = $obj->appoint_info($code) ;
        ob_start();
        foreach ( $appoint as $p ) {
            $doctor = $obj->selectDoctor($obj->selectId($p->services)->identifiant) ;
            ?>
                <div class="info_appoint">
                    <div class="date box none">
                        <?php echo $p->date_rendez ?>
                    </div>
                    <div class="about-appoint hidde mt-2">
                        <div class="service box mb-2">
                            <h3 class="fs-5">service</h3> 
                            <span><?php echo $p->services?></span>
                        </div>
                        <div class="doctor box mb-2">
                            <h3 class="fs-5">doctor</h3> 
                            <span><?php echo $doctor[0]->Prenom .' '. $doctor[0]->Nom ?></span>
                        </div>
                    </div>

                    <div class="image">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input id="ordonnance" name="ordonnance" type="file" accept="image/*" class="sr-only">
                        </form>
                </div>
            <?php  } $appointment = ob_get_clean() ; 

        require_once 'dashboard_views/details_patient.php';
    }

    function insert_more_details($poids,$taille,$code) {
        $obj = new connect(); 
        
        $obj->insert_more_detail($taille,$poids,$code);
        details_patient($code);
    }