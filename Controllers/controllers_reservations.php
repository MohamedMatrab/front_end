<?php
require_once 'Models/connect.php';

// Function to disable specific dates with full day appointments
function disabled_day() {
    // Create an object to connect to the database
    $obj = new connect();

    // Retrieve data from the database using the 'Verifiy_Full_Day()' method on the 'connect' object
    $array = $obj->Verifiy_Full_Day();

    // Create an empty array to store dates with full day appointments
    $Full_Day = array();

    // Loop through the $array and extract dates with 2 appointments
    for ($i=0 ; $i < count($array) ; $i++) {
        if ($array[$i]['Nbr_Rdv_in_day'] === 2 ) {
            array_push($Full_Day,$array[$i]['date_rendez']);
        }
    } 
    // delete Date before current Date 
    foreach ($Full_Day as $day) {
        if ($day < date("Y-m-d")) {
            $Full_Day = \array_diff($Full_Day, [$day]) ;
        }
    }
    $FullDay = json_encode($Full_Day);

    // Require and include a view file based on the value of $index
    require_once 'views/Appointment.php';
    ?>
    <script type="text/javascript">
        var datesForDisable =  <?php echo $FullDay ;?> ;
        // Initialize a datepicker using jQuery Datepicker plugin with options
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            //todayHighlight: true,
            datesDisabled: datesForDisable  ,
            startDate : new Date(),
            daysOfWeekDisabled : [0]
        });
    </script>
<?php
}

// Function to handle appointment booking
function PrendreRdv() {
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            if (isset($_POST['valider'])) { 
                // Extraire les données du formulaire dans des variables distinctes
                extract($_POST); 
                // Créer un nouvel objet de la classe "connect" pour se connecter à la base de données
                $obj = new connect(); 
                
                // Appeler la méthode pour vérifier si l'heure de rendez-vous dans un date donnée est occupée
                $heure_occupe = $obj->import_Heures_occupees_dans_un_jour_donne($date_rendez, $Heure_rendez); 
                
                // Si l'heure de rendez-vous est occupée
                if ($heure_occupe) { 
                    require_once  'views/Appointment.php';
                    ?>
                    <script src="js/echec.js"></script>
                    <?php
                    // Rediriger vers la page d'accueil avec le paramètre d'action "alert" pour afficher un message d'alerte
                    //header("Location:index.php?action=alert"); 
                } else { 
                    
                    // Insérer les données du formulaire dans la base de données
                    $obj->insertRendezVous($CIN, $date_rendez, $Heure_rendez, $id_medecin); 
                    // Rediriger vers la page d'accueil avec le paramètre d'action "appoint" pour afficher un message de confirmation
                    require_once 'views/Appointment.php'; 
                    ?>
                    <script src="js/succes.js"></script>
                    <?php
                }
            }
        }
    } catch (PDOException $e) { 
        echo "Not Connected :" . $e->getMessage(); 
    }
}
?>