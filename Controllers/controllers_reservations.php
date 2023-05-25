<?php
require_once 'Models/connect.php';

// Function to disable specific dates with full day appointments
    function disabled_day() {
        // Create an object to connect to the database
        $obj = new connect();
        $obj->rendezVousTable() ;
        require_once 'views/Appointment.php';
    }  

// Function to handle appointment booking
    function PrendreRdv() { 
        require_once 'views/Appointment.php';
        ?>
        <script>
            let body_container = document.querySelector("body") ;
                
                const Html_succes = `<div class="succes">
                    <div>
                        <div class="succes_icons"><i class="bi bi-person-check-fill"></i></div>
                        <p>Notre equipe prendra contact avec vous prochainement</p>
                        <a href="index.php?action=appoint">Ok</a>
                    </div>
                </div>` ;

                let container = document.querySelector(".app_container_") ;
                container.classList.add("app_fixe") ;
                body_container.insertAdjacentHTML("beforeend",Html_succes);
        </script>
        <?php
    }
    

?>