<?php
require_once 'Models/connect.php';
session_start();

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
        let body_container = document.querySelector("html");
        if (localStorage.hasOwnProperty("succes")) {
            const Html_succes = `
            <div class="succes">
            <div>
                <div class="succes_icons">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <p>`+localStorage.getItem('succes')+`</p>
                <br>
                <a href="index.php?action=appoint">Ok</a>
            </div>
            </div>`;
            let container = document.querySelector("body");
            container.classList.add("app_fixe");
            body_container.insertAdjacentHTML("beforeend", Html_succes);
        }else if ( localStorage.hasOwnProperty("echec") ) { 
            const Html_echec = `
            <div class="echec">
            <div>
                <div class="echec_icons">
                    <i class="bi bi-exclamation-lg"></i>
                </div>
                <p>`+localStorage.getItem('echec')+`</p>
                <br>
                <a href="index.php?action=appoint">Ok</a>
            </div>
            </div>`;
            let container = document.querySelector("body");
            container.classList.add("app_fixe");
            body_container.insertAdjacentHTML("beforeend", Html_echec);
        }else {
        }
        
    </script>

    <?php 
        
    }
    

?>