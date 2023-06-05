<?php
class connect
{
    private $connect;
    function __construct()
    {
        try {
            $this->connect = new pdo("mysql:host=localhost; dbname=bd_dentiste", "root", "meriem2002");
        } catch (PDOException $e) {
            echo "Not Connected :" . $e->getMessage();
        }
    }
    function getConnect()
    {
        $pdo = $this->connect;
        return $pdo;
    }
    function isTableExist($tableName)
    {
        $requete = $this->connect->prepare("SHOW TABLES FROM bd_dentiste ");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute();
        $tables = array();
        while ($row = $requete->fetch()) {
            array_push($tables, $row->Tables_in_bd_dentiste);
        }
        if (in_array($tableName, $tables)) {
            return TRUE;
        }
    }
    function portfolioTable()
    {
        $tableName = 'portfolio';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE portfolio(
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(50),
                image MEDIUMBLOB,
                description VARCHAR(250),
                service_id VARCHAR(20)) 
            ";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function doctorTable()
    {
        $tableName = 'doctor';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE doctor(
                CIN VARCHAR(10) PRIMARY KEY NOT NULL,
                Nom VARCHAR(20) ,
                Prenom VARCHAR(20) ,
                Gmail VARCHAR(30) ,
                tel VARCHAR(25) ,
                id_service int ,
                (id_service ) REFERENCES service(service_id )
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function serviceTable()
    {
        $tableName = 'service';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE service(
                service_id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(50)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }

    function historiqueTable()
    {
        $tableName = 'historique';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE historique(
                CIN varchar(15) NOT NULL,
                First_Name VARCHAR(15) ,
                Last_Name VARCHAR(15) ,
                Date_Of_birth VARCHAR(20) ,
                tel VARCHAR(30) ,
                address VARCHAR(50) ,
                taille VARCHAR(10) ,
                poids VARCHAR(10) ,
                date_rendez VARCHAR(10) ,
                heure_rendez VARCHAR(10) ,
                service VARCHAR(20) ,
                ordonnance MEDIUMBLOB
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }

    function rendezVousTable()
    {
        $tableName = 'rendez_vous';
        if ($this->isTableExist($tableName)) {
            return;
        } else {
            $sql = "CREATE TABLE rendez_vous(
                id_rendez int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                CIN VARCHAR(15) NOT NULL UNIQUE ,
                First_Name VARCHAR(15) ,
                Last_Name VARCHAR(15) ,
                Date_Of_birth VARCHAR(20) ,
                tel VARCHAR(30) ,
                address VARCHAR(50) ,
                date_rendez VARCHAR(10) ,
                Heure_rendez VARCHAR(10) ,
                service VARCHAR(20) 
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
    function import_Heures_occupees_dans_un_jour_donne($date_Reserve, $Heure_reserve)
    {
        $requete = $this->connect->prepare("SELECT Heure_rendez 
        FROM rendez_vous
        where date_rendez = ?");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($date_Reserve));
        while ($row = $requete->fetch()) {
            if ($row->Heure_rendez == $Heure_reserve) {
                return true;
            }
        }
        return false;
    }

    function Verifiy_Full_Day()
    {
        $requete = $this->connect->prepare("SELECT date_rendez , count(date_rendez) as Nbr_Rdv_in_day
        FROM rendez_vous group by date_rendez");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute();
        return json_decode(json_encode($requete->fetchAll()), true);
    }
    function select($table)
    {
        $requete = $this->connect->prepare('select DISTINCT * from ' . $table);
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute();
        return $requete->fetchAll();
    }

    function selectDoctor($id_services)
    {
        $requete = $this->connect->prepare('select Nom , Prenom  from doctor where id_service = ? ');
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id_services));
        return $requete->fetch();
    }

    function selectId($nom_service)
    {
        $requete = $this->connect->prepare('select service_id  from service where title = ? ');
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($nom_service));
        return $requete->fetch();
    }

    function Delete_rendez($id)
    {
        $requete = $this->connect->prepare("delete from  rendez_vous where id_rendez = ?");
        $requete->execute(array($id));
    }

    function select_code($code)
    {
        $requete = $this->connect->prepare('select * from historique where CIN = ? LIMIT 1');
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($code));
        return $requete->fetch();
    }

    function insert_more_detail($taille, $poids, $code)
    {
        // insert into history table
        $requete = $this->connect->prepare('UPDATE historique SET taille = ?, poids = ? WHERE CIN = ?');
        $requete->execute(array($taille, $poids, $code));
    }

    function appoint_info($code)
    {
        $requete = $this->connect->prepare('select date_rendez , service  from historique where CIN = ? ORDER BY date_rendez');
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($code));
        return $requete->fetchAll();
    }

    function getOrdonnance($code, $date)
    {
        $requete = $this->connect->prepare("SELECT ordonnance from historique where CIN = ? and date_rendez = ?");
        $requete->setFetchMode(PDO::FETCH_ASSOC);
        $requete->execute(array($code, $date));
        return $requete->fetch();
    }
    function insertRendezVous($CIN, $Last_Name, $First_Name, $Date_Of_birth, $tel, $address, $date_rendez, $Heure_rendez, $services)
    {
        $requete = $this->connect->prepare("insert into rendez_vous(CIN,First_Name,Last_Name ,Date_Of_birth , tel,address, date_rendez,Heure_rendez,service) values(?,?,?,?,?,?,?,?,?)");
        $requete->execute(array($CIN, $Last_Name, $First_Name, $Date_Of_birth, $tel, $address, $date_rendez, $Heure_rendez, $services));
    }

    function insert_into_history($id)
    {
        // select from rendez-vous table
        $requete = $this->connect->prepare("select * from  rendez_vous where id_rendez = ?");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute(array($id));
        $patient = $requete->fetch();
        // insert into history table
        $requete = $this->connect->prepare("insert into historique (CIN,First_Name,Last_Name,Date_Of_birth,tel,address,taille,poids,date_rendez,Heure_rendez,service) values(?,?,?,?,?,?,?,?,?,?,?)");
        $requete->execute(array($patient->CIN, $patient->Last_Name, $patient->First_Name, $patient->Date_Of_birth, $patient->tel, $patient->address, '0', '0', $patient->date_rendez, $patient->Heure_rendez, $patient->service));
    }
    function getServices()
    {
        $requete = $this->connect->prepare("select title from  service");
        $requete->setFetchMode(PDO::FETCH_OBJ);
        $requete->execute();
        return $requete->fetchAll();
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
            $stmt = $this->connect->prepare($sql);
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
            $alter_query = "ALTER TABLE users AUTO_INCREMENT = 1";
            $this->connect->exec($alter_query);
        }
    }
    function close_connection()
    {
        $this->connect = null;
    }
}
