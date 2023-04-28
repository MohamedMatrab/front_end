<?php
class connect
{
    private $connect;
    function __construct()
    {
        try {
            $this->connect = new pdo("mysql:host=localhost; dbname=dentist", "root", "");
        } catch (PDOException $e) {
            echo "Not Connected :" . $e->getMessage();
        }
    }
    function insertRendezVous($CIN, $date_rendez, $Heure_rendez, $id_medecin)
    {
        try {
            $requete = $this->connect->prepare("insert into rendez_vous(CIN,date_rendez,Heure_rendez,id_medecin) values(?,?,?,?)");
            $requete->execute(array($CIN, $date_rendez, $Heure_rendez, $id_medecin));
        } catch (PDOException $e) {
            echo "Not Connected :" . $e->getMessage();
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
    function getConnect()
    {
        $pdo = $this->connect;
        return $pdo;
    }
    function isTableExist($tableName)
    {
        $stmt = $this->connect->prepare("SELECT EXISTS (
            SELECT 1
            FROM   information_schema.tables 
            WHERE  table_schema = :db_name
            AND    table_name = :table_name
        )");
        $stmt->execute(array(':db_name' => 'dentist', ':table_name' => $tableName));
        return $stmt->fetchColumn() == 1;
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
                service_id VARCHAR(20)
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
                service_id VARCHAR(20) PRIMARY KEY NOT NULL,
                title VARCHAR(50)
            )";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        }
    }
}
