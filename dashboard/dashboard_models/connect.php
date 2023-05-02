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
    
    function select($table) {
        $requete = $this->connect->prepare('select * from ' .$table) ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        return $requete->fetchAll() ;
    }

    function selectDoctor($id_services) {
        $requete = $this->connect->prepare('select Nom , Prenom  from doctor where id_service = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id_services)) ;
        return $requete->fetchAll() ;
    }

    function selectId($nom_service) {
        $requete = $this->connect->prepare('select identifiant  from services where Nom_Service = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($nom_service)) ;
        return $requete->fetch() ;
    }

    function insert_into_history($id) {
        // select from rendez-vous table
        $requete = $this->connect->prepare("select * from  rendez_vous where id_rendez = ?") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id)) ;
        $patient = $requete->fetch() ;
        // insert into history table
        $requete = $this->connect->prepare("insert into historique (CIN,First_Name,Last_Name,Date_Of_birth,tel,date_rendez,Heure_rendez,services) values(?,?,?,?,?,?,?,?)") ;
        $requete->execute(array($patient->CIN ,$patient->Last_Name, $patient->First_Name , $patient->Date_Of_birth , $patient->tel , $patient->date_rendez , $patient->Heure_rendez, $patient->services )) ;
    }

    function Delete_rendez($id) {
        $requete = $this->connect->prepare("delete from  rendez_vous where id_rendez = ?") ;
        $requete->execute(array($id)) ;
    }
    
    function select_code($code) {
        $requete = $this->connect->prepare('select * from historique where CIN = ? LIMIT 1') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($code)) ;
        return $requete->fetch() ;
    }
    
    function insert_more_detail($taille,$poids,$code) {
        // insert into history table
        $requete = $this->connect->prepare('UPDATE historique SET taille = ?, poids = ? WHERE CIN = ?') ;
        $requete->execute(array($taille,$poids,$code)) ;
    }

    function appoint_info($code) {
        $requete = $this->connect->prepare('select date_rendez , services  from historique where CIN = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($code)) ;
        return $requete->fetchAll() ;
    }
}