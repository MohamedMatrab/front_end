<?php
class connect {
    private $connect;
    function __construct() {
        try {
            $this->connect = new pdo("mysql:host=localhost; dbname=bd_dentiste","root","meriem2002");
        }catch (PDOException $e){
            echo "Not Connected :" . $e->getMessage();
        }
    }
    function insertRendezVous($CIN,$Last_Name, $First_Name , $Date_Of_birth , $tel, $date_rendez,$Heure_rendez,$services) {
        $requete = $this->connect->prepare("insert into rendez_vous(CIN,First_Name,Last_Name ,Date_Of_birth , tel,date_rendez,Heure_rendez,services) values(?,?,?,?,?,?,?,?)") ;
        $requete->execute(array($CIN,$Last_Name, $First_Name , $Date_Of_birth , $tel , $date_rendez , $Heure_rendez, $services )) ;
    }

    function import_Heures_occupees_dans_un_jour_donne($date_Reserve,$Heure_reserve) {
        $requete = $this->connect->prepare("SELECT Heure_rendez 
        FROM rendez_vous
        where date_rendez = ?") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($date_Reserve)) ;
        while ($row = $requete->fetch()) {
            if ($row->Heure_rendez == $Heure_reserve) {
                return true ;
            }
        }
        return false ;

    }

    function Verifiy_Full_Day() {
        $requete = $this->connect->prepare("SELECT date_rendez , count(date_rendez) as Nbr_Rdv_in_day
        FROM rendez_vous group by date_rendez" ) ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        return json_decode(json_encode($requete->fetchAll()), true);
    }
}