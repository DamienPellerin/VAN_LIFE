<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class User
{
    private int    $_id;
    private string $_lastname;
    private string $_firstname;
    private string $_mail;
    private string $_phone;
    private string $_city;
    private string $_zipcode;
    private string $_birthdate;
    private ?string $_password;
    private string $_created_at;
    private string $_adress;
    private string $_role;

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
    public function getLastname(): string
    {
        return $this->_lastname;
    }


    /**
     * @param string $valueLastname
     * 
     * @return void
     */
    public function setLastname(string $valueLastname): void
    {
        $this->_lastname = $valueLastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->_firstname;
    }

    /**
     * @param string $valueFirstname
     * 
     * @return void
     */
    public function setFirstname(string $valueFirstname): void
    {
        $this->_firstname = $valueFirstname;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->_mail;
    }

    /**
     * @param string $valueMail
     * 
     * @return void
     */
    public function setMail(string $valueMail): void
    {
        $this->_mail = $valueMail;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }

    /**
     * @param string $valuePhone
     * 
     * @return void
     */
    public function setPhone(string $valuePhone): void
    {
        $this->_phone = $valuePhone;
    }

    public function getCity(): string
    {
        return $this->_city;
    }

    /**
     * @param string $valueCity
     * 
     * @return void
     */
    public function setCity(string $valueCity): void
    {
        $this->_city = $valueCity;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->_zipcode;
    }

    /**
     * @param string $valueZipcode
     * 
     * @return void
     */
    public function setZipcode(string $valueZipcode): void
    {
        $this->_zipcode = $valueZipcode;
    }


    /**
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->_birthdate;
    }

    /**
     * @param string $valueBirthdate
     * 
     * @return void
     */
    public function setBirthdate(string $valueBirthdate): void
    {
        $this->_birthdate = $valueBirthdate;
    }

    public function getPassword(): string
    {
        return $this->_password;
    }

    public function setPassword(?string $password): void
    {
        $this->_password = $password;
    }

    public function getCreated_at(): string
    {
        return $this->_created_at;
    }

    public function setCreated_at(string $created_at): void
    {
        $this->_created_at = $created_at;
    }

    /**
     * récupération de l'adresse
     * @return string
     */
    public function getAdress(): string
    {
        return $this->_adress;
    }


    public function setAdress(string $adress): void
    {
        $this->_adress = $adress;
    }

    /**
     * @param string $mail
     * 
     * @return bool
     */
    public static function mailExist(string $mail): bool
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT `mail` FROM `users` WHERE `mail` = :mail;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':mail', $mail);
        $success = $sth->execute();
        if ($success) {
            if (empty($sth->fetch())) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function getByEmail(string $mail): object|bool
    { // ou User|bool
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `users` WHERE `mail` = :mail;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':mail', $mail);
        if ($sth->execute()) {
            //$sth->setFetchMode(PDO::FETCH_CLASS, 'User');
            $result = $sth->fetch();
            if ($result) {
                return $result;
            }
        }
        return false;
    }

    /**
     * création client
     * @return [type]
     */
    public function addUser(int $id = null)
    {
        $sql = 'INSERT INTO `users`(`lastname`, `firstname`, `mail`, `phone`, `city`, zipcode, `birthdate`, `password`, `adress`) 
                VALUES (:lastname, :firstname, :mail, :phone, :city, :zipcode, :birthdate, :password, :adress);';
        $this->pdo = Database::getInstance();
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':mail', $this->getMail());
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':city', $this->getCity());
        $sth->bindValue(':zipcode', $this->getZipcode());
        $sth->bindValue(':birthdate', $this->getBirthdate());
        $sth->bindValue(':password', $this->getPassword());
        $sth->bindvalue(':adress', $this->getAdress());
        if ($sth->execute()) {
            if (is_null($id)) {
                $this->setId($this->pdo->lastInsertId());
            }
            if ($sth->rowCount() == 1 || !is_null($id)) {
                return $this;
            }
        }
        return false;
    }

    /**
     * afficher tous les patients
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `users`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }

    /**
     * Récupération des données utilisateur
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function displayUser(int $id)
    {
        $pdo = Database::getInstance();
        $sth = $pdo->query('SELECT * FROM users WHERE id_users =' . $id . ';');
        $post = $sth->fetch(PDO::FETCH_OBJ);
        return $post;
    }

   /**
     * Récupération des données utilisateur
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function displayUserLocation(int $id)
    {
        $pdo = Database::getInstance();
        $sth = $pdo->query('SELECT * FROM users 
        INNER JOIN registers 
        ON `users`.`id_users` = `registers`.`id_users` 
        WHERE `users`.`id_users` = `registers`.`id_users` ');
        $post = $sth->fetch(PDO::FETCH_OBJ);
        return $post;
    }


    // modifier le profil du utilisateur.
    public function update()
    {
        $modifyUser = 'UPDATE `users` SET `lastname`=:lastname, `firstname`=:firstname,`mail`=:mail, `phone`=:phone, `adress`=:adress, `city`=:city, zipcode=:zipcode, `birthdate`=:birthdate WHERE `id_users`= :id';
        $sth = Database::getInstance()->prepare($modifyUser);
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':mail', $this->getMail());
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':adress', $this->getAdress());
        $sth->bindValue(':city', $this->getCity());
        $sth->bindValue(':zipcode', $this->getZipcode());
        $sth->bindValue(':birthdate', $this->getBirthdate());
        $sth->bindValue(':id', $this->getId(), PDO::PARAM_INT);

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
    public static function deleteUser(int $id): bool
    {
        $pdo = Database::getInstance();
        $sql = 'DELETE   
                FROM `users`
                WHERE `id_users` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

    public static function validateAccount(int $id): bool
    {

        $pdo = Database::getInstance();
        $sql = "UPDATE users SET `validated_at` = NOW() WHERE `id_users` = :id;";
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            if ($sth->rowCount() == 1) {
                return true;
            }
        }
        return false;
    }
}
