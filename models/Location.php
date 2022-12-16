<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Location
{
    public int $_id;
    public string $_rental_date;
    public string $_return_date;
    public int $_id_users;
    public int $_id_vehicles;
    public int $_id_agencies;

    /**
     */
    public function __construct()
    {
        $this->_pdo = Database::getInstance();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $valueId
     * 
     * @return void
     */
    public function setId(int $valueId): void
    {
        $this->_id = $valueId;
    }

    /**
     * @return string
     */
    public function getRental_date(): string
    {
        return $this->_rental_date;
    }

    /**
     * @param string $valueRentalDate
     * 
     * @return void
     */
    public function setRental_date(string $valueRental_date): void
    {
        $this->_rental_date = $valueRental_date;
    }

    /**
     * @return string
     */
    public function getReturn_date(): string
    {
        return $this->_return_date;
    }

    /**
     * @param string $valueReturnDate
     * 
     * @return void
     */
    public function setReturn_date(string $valueReturn_date): void
    {
        $this->_return_date = $valueReturn_date;
    }

    /**
     * @return int
     */
    public function getId_users(): int
    {
        return $this->_id_users;
    }

    /**
     * @param int $valueIdUsers
     * 
     * @return void
     */
    public function setId_users(int $valueId_users): void
    {
        $this->_id_users = $valueId_users;
    }

    /**
     * @return int
     */
    public function getId_vehicles(): int
    {
        return $this->_id_vehicles;
    }

    /**
     * @param int $valueIdVehicles
     * 
     * @return void
     */
    public function setId_vehicles(int $valueId_vehicles): void
    {
        $this->_id_vehicles = $valueId_vehicles;
    }

    /**
     * @return int
     */
    public function getId_agencies(): int
    {
        return $this->_id_agencies;
    }

    /**
     * @param int $valueIdAgencies
     * 
     * @return void
     */
    public function setId_agencies(int $valueId_agencies): void
    {
        $this->_id_agencies = $valueId_agencies;
    }

    /**
     * Ajout d'une réservation
     * @return [type]
     */
    public function addLocation()
    {
        $sql = 'INSERT INTO `registers`(`rental_date`, `return_date`, id_users, id_vehicles, id_agencies) 
        VALUES (:rental_date, :return_date, :id_users, :id_vehicles, :id_agencies)';
        $sth = $this->_pdo->prepare($sql);
        $sth->bindValue(':rental_date', $this->getRental_date());
        $sth->bindValue(':return_date', $this->getReturn_date());
        $sth->bindValue(':id_users', $this->getId_users());
        $sth->bindValue(':id_vehicles', $this->getId_vehicles());
        $sth->bindValue(':id_agencies', $this->getId_agencies());
        if ($sth->execute()) {
            return ($sth->rowCount() >= 1) ? true : false;
        }
    }

    /**
     * afficher toutes les réservations
     * @return object
     */
    public static function read($id): object
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * 
                FROM `registers`    
                INNER JOIN `users` 
                ON `registers`.`id_users` = `users`.`id_users`
                INNER JOIN `agencies` 
                ON `registers`.`id_agencies` = `agencies`.`id_agencies`
                WHERE `registers`.id_registers = :id;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_OBJ);
    }

     /**
     * afficher tous les patients
     * @return object
     */
    public static function readVehiclelocation($id): object
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * 
                FROM `registers`   
                INNER JOIN `vehicles` 
                ON `registers`.`id_vehicles` = `vehicles`.`id_vehicles`
                WHERE `registers`.id_registers = :id;';
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
        $sql = 'SELECT `users`.`firstname`, `users`.`lastname`, `registers`.`id_registers`, rental_date, return_date, `registers`.`id_users`, `vehicles`.`id_vehicles` ,`vehicles`.`name` AS vehicle_name , `agencies`.`name`  
                FROM `registers`  
                INNER JOIN `agencies` 
                ON `registers`.`id_agencies` = `agencies`.`id_agencies`  
                INNER JOIN `vehicles` 
                ON `registers`.`id_vehicles` = `vehicles`.`id_vehicles`  
                INNER JOIN `users` 
                ON `registers`.`id_users` = `users`.`id_users`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

       /**
     * Affichage du rendez-vous dans profile du patient
     * @return [type]
     */
    public static function readProfilLocation(int $id)
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `registers`.`id_registers`, rental_date, return_date, `registers`.`id_users`, `vehicles`.`id_vehicles` ,`vehicles`.`name` AS vehicle_name , `agencies`.`name` 
                FROM `registers` 
                INNER JOIN `users` 
                ON `registers`.`id_users` = `users`.`id_users`
                INNER JOIN vehicles
                ON `registers`.`id_vehicles` = `vehicles`.`id_vehicles`
                INNER JOIN agencies
                ON `registers`.`id_agencies` = `agencies`.`id_agencies`
                WHERE `registers`.`id_users` = :id;';        
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupération des données utilisateur
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function displayLocation(int $id)
    {
        $pdo = Database::getInstance();
        $sth = $pdo->query('SELECT * FROM `registers` 
        INNER JOIN `users`
        ON `users`.`id_users` = `users`.`id_users`
        INNER JOIN `vehicles`
        ON `registers`.`id_vehicles` = `vehicles`.`id_vehicles`
        INNER JOIN `agencies`
        ON `registers`.`id_agencies` = `agencies`.`id_agencies`
        WHERE `users`.`id_users` =' . $id . ';');
        $post = $sth->fetch(PDO::FETCH_OBJ);
        return $post;
    }

    // modifier la réservation de utilisateur.
    public function updateLocation($id)
    {
        $modifyRegisters = 'UPDATE `registers` 
                            SET `rental_date`=:rental_date, `return_date`=:return_date, id_vehicles = :id_vehicles, id_agencies =:id_agencies 
                            WHERE `id_registers`= :id';
        $sth = Database::getInstance()->prepare($modifyRegisters);
        $sth->bindValue(':rental_date', $this->getRental_date());
        $sth->bindValue(':return_date', $this->getReturn_date());
        $sth->bindValue(':id_vehicles', $this->getId_vehicles());
        $sth->bindValue(':id_agencies', $this->getId_agencies());
        $sth->bindValue(':id', $id, PDO::PARAM_INT);

        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

      /**
     *
     * @param int $id
     * 
     * @return bool
     */
    public static function deleteLocation(int $id): bool
    {
        $pdo = Database::getInstance();
        $sql = 'DELETE   
                FROM `registers`
                WHERE `id_registers` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }
}
