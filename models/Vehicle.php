<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Vehicle
{
    private int    $_id;
    private string $_name;
    private string $_description;
    private string $_price;
    private int $_id_agencies;


public function __construct()
{
}

/**
 * @return int
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

/**
 * @return string
 */
public function getPrice(): string
{
    return $this->_price;
}

/**
 * @param string $valuePrice
 * 
 * @return void
 */
public function setPrice(string $valuePrice): void
{
    $this->_price = $valuePrice;
}

//public function getId_agencies(): int
//{
//    return $this->_id_agencies;
//}
//
//public function setId_agencies(int $valueId_agencies): void
//{
//    $this->_id_agencies = $valueId_agencies;
//}

 /**
     * création vehicule
     * @return [type]
     */
    public function addVehicle()
    {
        $sql = 'INSERT INTO `vehicles`(`name`, `description`, `price`) VALUES (:name, :description, :price);';
        $pdo = Database::getInstance();
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':description', $this->getDescription());
        $sth->bindValue(':price', $this->getPrice());
        //$sth->bindValue(':id_agencies', $this->getId_agencies());
        return $sth->execute();
    }

      /**
     * afficher tous les vehicules
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `vehicles`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }


    public static function read(int $id):object| bool
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `vehicles` WHERE id_vehicles = :id;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }

    public function updateVehicle()
    {
        $sql = 'UPDATE `vehicles` SET `name`=:name,`description`=:description,`price`=:price WHERE `id_vehicles`=:id;';
        $pdo = Database::getInstance();
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':description', $this->getDescription());
        $sth->bindValue(':price', $this->getPrice());
        $sth->bindValue(':id', $this->getId());
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

    /**
     * supprimer le vehicule sélectionner 
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function deleteVehicle(int $id): bool
    {
        $pdo = Database::getInstance(); 
        $sql = 'DELETE   
                FROM `vehicles`
                WHERE `id_vehicles` = :id;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }



}