<?php
class connect
{
    private $connect;
    function __construct() {
        try {
            $this->connect = new pdo("mysql:host=localhost; dbname=dentiste","root","meriem2002");
        }catch (PDOException $e){
            echo "Not Connected :" . $e->getMessage();
        }
    }
    function getConnect(){
        $pdo = $this->connect;
        return $pdo;
    }
    function isTableExist($tableName){
        // $stmt = $this->connect->prepare('SELECT EXISTS 
        // (
        //     SELECT 1 
        //     FROM  `information_schema.tables` 
        //     WHERE  `table_schema` = ? 
        //     AND  `table_name` = ?
        // )
        // ');
        // $stmt->execute(array('bd_dentiste', $tableName));
        // return $stmt->fetchColumn() == 1;
        $requete = $this->connect->prepare("SHOW TABLES FROM dentiste ") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        $tables = array(); 
        while ($row = $requete->fetch()) {
            array_push($tables,$row->Tables_in_dentiste);
        }
        if(in_array($tableName, $tables)){
            return TRUE;
        }
    }
    function portfolioTable(){
        $tableName = 'portfolio';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName(
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(50),
                image MEDIUMBLOB,
                description VARCHAR(250),
                service_id int,
                FOREIGN KEY (service_id) REFERENCES services(ID)
                )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function doctorTable(){
        $tableName = 'doctor';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName(
                id INT PRIMARY KEY AUTO_INCREMENT,
                CIN VARCHAR(15)  NOT NULL UNIQUE ,
                Nom VARCHAR(20) ,
                Prenom VARCHAR(20) ,
                Gmail VARCHAR(30) ,
                tel VARCHAR(25) ,
                image MEDIUMBLOB,
                id_service int ,
                FOREIGN KEY (id_service ) REFERENCES services(ID )
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function AlldoctorTable(){
        $tableName = 'Alldoctor';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName(
                id INT PRIMARY KEY AUTO_INCREMENT,
                CIN VARCHAR(15)  NOT NULL UNIQUE ,
                Nom VARCHAR(20) ,
                Prenom VARCHAR(20) ,
                Gmail VARCHAR(30) ,
                tel VARCHAR(25) ,
                image MEDIUMBLOB,
                id_service int ,
                FOREIGN KEY (id_service ) REFERENCES services(ID )
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function serviceTable(){
        $tableName = 'services';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName(
                ID INT PRIMARY KEY AUTO_INCREMENT,
                Nom_du_service VARCHAR(255)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function AllserviceTable(){
        $tableName = 'Allservices';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName(
                ID INT PRIMARY KEY AUTO_INCREMENT,
                Nom_du_service VARCHAR(255)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function serviveDetailsTabele(){
        $tableName = 'service_details';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE $tableName (
                id_service INT PRIMARY KEY NOT NULL,
                proverb VARCHAR(250),
                image1 VARCHAR(150),
                descr1 LONGTEXT,
                title1 VARCHAR(150),
                image2 VARCHAR(150),
                descr2 LONGTEXT,
                title2 VARCHAR(150),
                image3 VARCHAR(150),
                FOREIGN KEY (id_service) REFERENCES services (ID)
                );";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
        
    }

    function historiqueTable(){
        $tableName = 'historique';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE historique(
                id INT PRIMARY KEY AUTO_INCREMENT,
                CIN varchar(15) NOT NULL,
                First_Name VARCHAR(15) ,
                Last_Name VARCHAR(15) ,
                Date_Of_birth date ,
                tel VARCHAR(30) ,
                address VARCHAR(50) ,
                taille VARCHAR(10) ,
                poids VARCHAR(10) ,
                date_rendez date ,
                heure_rendez time ,
                service_id INT,
                service VARCHAR(255) ,
                ordonnance MEDIUMBLOB , 
                id_user INT,
                state ENUM('0','1'),
                FOREIGN KEY (id_user) REFERENCES users(id) ,
                FOREIGN KEY (service_id) REFERENCES services(ID)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    
    function rendezVousTable(){
        $tableName = 'rendez_vous';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE rendez_vous(
                id_rendez int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                CIN VARCHAR(15) NOT NULL UNIQUE ,
                First_Name VARCHAR(15) ,
                Last_Name VARCHAR(15) ,
                Date_Of_birth date ,
                tel VARCHAR(30) ,
                address VARCHAR(50) ,
                date_rendez date ,
                Heure_rendez time ,
                service_id INT,
                service VARCHAR(255) ,
                state   ENUM('0', '1') ,
                `show` ENUM('0','1'),
                id_user INT,
                FOREIGN KEY (id_user) REFERENCES users(id),
                FOREIGN KEY (service_id) REFERENCES services(ID)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function centreTable(){
        $tableName = 'centre';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE centre(
                description text ,
                motivation text ,
                localisation varchar(200) ,
                address varchar(100),
                numero_1 varchar(100) ,
                numero_2 varchar(100),
                email varchar(100) ,
                facebook varchar(100) ,
                instagram varchar(100) ,
                twitter varchar(100),
                start time,
                end time 
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function photos_centreTable(){
        $tableName = 'photos_centre';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE photos_centre(
                id_photo int NOT NULL PRIMARY KEY AUTO_INCREMENT ,
                photo_centre MEDIUMBLOB 
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
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
    function select($table) {
        if ($table == "historique"){
            $requete = $this->connect->prepare('select DISTINCT * from historique ') ;
        }else{
            $requete = $this->connect->prepare('select * from rendez_vous ORDER BY date_rendez ASC, Heure_rendez ASC ') ;
        }
       
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        return $requete->fetchAll() ;
    }

    function selectDoctor($id_service) {
        $requete = $this->connect->prepare('select Nom , Prenom  from doctor where id_service = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id_service)) ;
        return $requete->fetch() ;
    }
    function selectAllDoctor($id_service) {
        $requete = $this->connect->prepare('select Nom , Prenom  from Alldoctor where id_service = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id_service)) ;
        return $requete->fetch() ;
    }

    function selectIdService($nom_service) {
        $requete = $this->connect->prepare('select ID  from services where Nom_du_service  = ? ') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($nom_service)) ;
        return $requete->fetch() ;
    }
    function selectService($id) {
        $requete = $this->connect->prepare('select Nom_du_service  from services where ID  = ? ') ;
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $requete->execute(array($id)) ;
        return $requete->fetch() ;
    }

    function Delete_rendez($id) {
        $requete = $this->connect->prepare("delete from  rendez_vous where CIN = ?") ;
        $requete->execute(array($id)) ;
    }
    function Delete_rendez_By_Id($id) {
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
        $requete = $this->connect->prepare('select date_rendez , service_id,service  from historique where CIN = ? ORDER BY date_rendez ASC, Heure_rendez ASC') ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($code)) ;
        return $requete->fetchAll() ;
    }
    
    function getOrdonnance($code,$date) {
        $requete = $this->connect->prepare("SELECT ordonnance from historique where CIN = ? and date_rendez = ?") ;
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $requete->execute(array($code,$date)) ;
        return $requete->fetch() ;
    }
    function insertRendezVous($CIN,$Last_Name, $First_Name , $Date_Of_birth , $tel, $address, $date_rendez,$Heure_rendez,$id_service,$services,$id_user) {
        try {
            $requete1 = $this->connect->prepare("select CIN from rendez_vous where id_user = ? ") ;
            $requete1->execute(array($id_user)) ;
            $stmt = $requete1->fetchAll(PDO::FETCH_ASSOC);
            foreach($stmt as $cin){
                if ($cin['CIN'] == $CIN ){
                    return 0 ;
                }
            }
            $requete = $this->connect->prepare("insert into rendez_vous(CIN,First_Name,Last_Name ,Date_Of_birth , tel,address, date_rendez,Heure_rendez,service_id,service,id_user) values(?,?,?,?,?,?,?,?,?,?,?)") ;
            $requete->execute(array($CIN,$Last_Name, $First_Name , $Date_Of_birth , $tel , $address , $date_rendez , $Heure_rendez,$id_service, $services ,$id_user)) ;
            return 1 ;
        }catch(Exception $e){
            return $e->getMessage();
        }     
    }

    function insert_into_history($id) {
        // select from rendez-vous table
        $requete = $this->connect->prepare("select * from  rendez_vous where CIN = ?") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id)) ;
        $patient = $requete->fetch() ;
        // insert into history table
        $requete = $this->connect->prepare("insert into historique (CIN,First_Name,Last_Name,Date_Of_birth,tel,address,taille,poids,date_rendez,Heure_rendez,service_id,service,id_user) values(?,?,?,?,?,?,?,?,?,?,?,?,?)") ;
        $requete->execute(array($patient->CIN ,$patient->Last_Name, $patient->First_Name , $patient->Date_Of_birth , $patient->tel , $patient->address ,'0' ,'0' , $patient->date_rendez , $patient->Heure_rendez,$patient->service_id, $patient->service ,$patient->id_user )) ;
    }

    function getServices(){
        $requete = $this->connect->prepare("select  Nom_du_service  from  services") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        return $requete->fetchAll() ;
    }
    function getAllServices(){
        $requete = $this->connect->prepare("select  Nom_du_service  from  Allservices") ;
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute() ;
        return $requete->fetchAll() ;
    }
    function selectHours(){
        $requete = $this->connect->prepare("select start,end  from  centre") ;
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $requete->execute() ;
        return $requete->fetch() ;
    }
    function usersTable()
    {
        $tableName = 'users';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE users(
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    fname VARCHAR(30),
                    lname VARCHAR(30),
                    email VARCHAR(50),
                    password VARCHAR(70),
                    phone_num VARCHAR(50),
                    cin VARCHAR(50),
                    ville VARCHAR(30),
                    img MEDIUMBLOB,
                    adresse VARCHAR(100),
                    date_naissance DATE,
                    sexe ENUM('1','2'),
                    role ENUM('0', '1', '2')
             )";
             $stmt=$this->connect->prepare($sql);
             $stmt->execute();
        }
    }

    function reAutoIncrement($table)
    {
        $check_empty = "SELECT COUNT(*) FROM $table";
        $stmt = $this->connect->query($check_empty);
        $count = $stmt->fetchColumn();

        // return the id to 0 if table is empty
        if ($count == 0) {
            $alter_query = "ALTER TABLE ".$table." AUTO_INCREMENT = 1";
            $this->connect->exec($alter_query);
        }
    }

    function close_connection()
    {
        $this->connect = null;
    }

}


    

