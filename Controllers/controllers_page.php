<?php
require_once 'Models/connect.php' ;

    function indexAction() {
        require_once 'views/home.php' ;
    }

    function aboutCentreAction() {
        require_once 'views/aboutCentre.php' ;
    }
    function aboutDoctorAction() {
        require_once 'views/aboutDoctor.php' ;
    }
    function disabled_day($index) {
        $obj = new connect() ;
        $array = $obj->Verifiy_Full_Day();
        $Full_Day = array() ;
        for ($i=0 ; $i < count($array) ; $i++) {
            if ($array[$i]['Nbr_Rdv_in_day'] === 2 ) {
                array_push($Full_Day,$array[$i]['date_rendez']  );
            }
        } 
        $FullDay = json_encode($Full_Day);
        require_once 'views/appointment_'.$index.'.php' ;
        ?>
        <script type="text/javascript">
        var datesForDisable = <?php echo $FullDay ;?> ; 
        

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            datesDisabled: datesForDisable
        });
        
  </script>
<?php    }
    function appointAction() {
        disabled_day(1);
    }
    function AlertWarning() {
        disabled_day(2);
    }
    function loginAction() {
        require_once 'views/login.php' ;
    }
    function signupAction() {
        require_once 'views/signup.php' ;
    }
    function portfolioAction() {
        require_once 'views/portfolio.php' ;
    }
    function detailsAction() {
        require_once 'views/service_details.php' ;
    }
    function contactAction() {
        require_once 'views/contact.php' ;
    }

    function PrendreRdv() {
        try {
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['valider'])) {
                    extract($_POST) ;
                    $obj = new connect() ;
                    $heure_occupe = $obj->import_Heures_occupees_dans_un_jour_donne($date_rendez,$Heure_rendez) ;
                    if ($heure_occupe) {
                        header("Location:index.php?action=alert");
                    }else {
                        $obj = new connect() ;
                        $obj->insertRendezVous($CIN,$date_rendez,$Heure_rendez,$id_medecin) ;
                        header("Location:index.php?action=appoint");
                    }
                }
            }
        }catch (PDOException $e){
            echo "Not Connected :" . $e->getMessage();
        }

    }

