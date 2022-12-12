<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Agencie
{
    private int   $_id;
    private string $_name;
    private string $_adress;
    private string $_description;
    //private string $_city;
    //private string $_zipcode;


public function __construct()
{
}   

/**
 * @return string
 */
public function getId(): string
{
    return $this->_id;  
}

/**
 * @param string $valueId
 * 
 * @return void
 */
public function setId(string $valueId): void
{
    $this->_id = $valueId;
}

/**
 * @return string
 */
public function getName(): string
{
    return $this->_name;
}

/**
 * @param string $valueName
 * 
 * @return void
 */
public function setName(string $valueName): void
{
    $this->_name = $valueName;
}

/**
 * @return string
 */
public function getAdress(): string
{
    return $this->_adress;
}

/**
 * @param string $valueAddress
 * 
 * @return void
 */
public function setAdress(string $valueAdress): void
{
    $this->_adress = $valueAdress;
}

/**
 * @return string
 */
public function getDescription(): string
{
    return $this->_description;
}

/**
 * @param string $valueDescription
 * 
 * @return void
 */
public function setDescription(string $valueDescription): void
{
    $this->_description = $valueDescription;
}

///**
// * @return string
// */
//public function getCity(): string
//{
//    return $this->_city;
//}

///**
// * @param string $valueCity
// * 
// * @return void
// */
//public function setCity(string $valueCity): void
//{
//    $this->_city = $valueCity;
//}

///**
// * @return string
// */
//public function getZipcode(): string
//{
//    return $this->_zipcode;
//}
//
///**
// * @param string $valueZipcode
// * 
// * @return void
// */
//public function setZipcode(string $valueZipcode): void
//{
//    $this->_zipcode = $valueZipcode;
//}



 /**
     * création agence
     * @return [type]
     */
    public function addAgencie()
    {
        $sql = 'INSERT INTO `agencies`(`name`, `adress`, `description`) VALUES (:name, :adress, :description);';
        $pdo = Database::getInstance();
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':adress', $this->getAdress());
        $sth->bindValue(':description', $this->getDescription());
        //$sth->bindValue(':city', $this->getCity());
        //$sth->bindValue(':zipcode', $this->getZipcode());
        //$sth->bindValue(':id_agencies', $this->getId_agencies());
        return $sth->execute();
    }

       
    public static function read($id): object | bool
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * 
        FROM `agencies`
        WHERE id_agencies = :id;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_OBJ);
    }

     /**
     * afficher tous les patients
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `agencies`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }

     /**
     *
     * @param int $id
     * 
     * @return bool
     */
    public static function deleteAgencie(int $id): bool
    {
        $pdo = Database::getInstance(); 
        $sql = 'DELETE   
                FROM `agencies`
                WHERE `id_agencies` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

    // modifier le profil du utilisateur.
    public function updateAgencie()
    {
        $modifyAgencie = 'UPDATE `agencies` SET `name`=:name, `adress`=:adress,`description`=:description WHERE `id_agencies`= :id';
        $sth = Database::getInstance()->prepare($modifyAgencie);
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':adress', $this->getAdress());
        $sth->bindValue(':description', $this->getDescription());
        $sth->bindValue(':id', $this->getId(), PDO::PARAM_INT);

        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }
}