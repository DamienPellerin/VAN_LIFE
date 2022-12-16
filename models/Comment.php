<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../helpers/dataBase.php');

class Comment 
{
private int   $_id_comments;
private string $_comment;
private string $_created_at;
//private string $_date;
private string $_id_users;
//private string $_id_agencies;
//private string $_id_vehicles;

public function __construct()
{   
    $this->_pdo = Database::getInstance();
}

/**
 * @return int
 */
public function getId_comments(): int
{
    return $this->_id_comments;     
}

/**
 * @param int $valueId_comments
 * 
 * @return void
 */
public function setId_comments(int $valueId_comments): void
{
    $this->_id_comments = $valueId_comments;
}

/**
 * @return string
 */
public function getComment(): string
{
    return $this->_comment;     
}

/**
 * @param string $valueComment
 * 
 * @return void
 */
public function setComment(string $valueComment): void  
{
    $this->_comment = $valueComment;
}

public function getCreated_at(): string
{
    return $this->_created_at;
}

public function setCreated_at(string $created_at): void
{
    $this->_created_at = $created_at;
}

///**
 //* @return string
 //*/
//public function getDate(): string
//{
 //   return $this->_date;     
//}

///**
 //* @param string $valueDate
 //* 
 //* @return void
 //*/
//public function setDate(string $valueDate): void
//{
//    $this->_date = $valueDate;
//}

/**
 * @return string
 */
public function getId_users(): string
{
    return $this->_id_users;     
}

/**
 * @param string $valueId_users
 * 
 * @return void
 */
public function setId_users(string $valueId_users): void
{
    $this->_id_users = $valueId_users;
}

///**
// * @return string
// */
//public function getId_agencies(): string
//{
//    return $this->_id_agencies;     
//}
//
///**
// * @param string $valueId_agencies
// * 
// * @return void
// */
//public function setId_agencies(string $valueId_agencies): void
//{
//    $this->_id_agencies = $valueId_agencies;
//}
//
//public function getId_vehicles(): string
//{
//    return $this->_id_vehicles; 
//}
//
//
//public function setId_vehicles(string $valueId_vehicles): void  
//{
//    $this->_id_vehicles = $valueId_vehicles;
//}
//

  /**
     * Ajout d'un commentaire
     * @return [type]
     */
    public function addComment():object | bool
    {
        $sql = 'INSERT INTO `comments`(`comment`, `id_users`) 
        VALUES (:comment,  :id_users)';
        $sth = $this->_pdo->prepare($sql);
        $sth->bindValue(':comment', $this->getComment());
        //$sth->bindValue(':date', $this->getDate());
        $sth->bindValue(':id_users', $this->getId_users());
        //$sth->bindValue(':id_vehicles', $this->getId_vehicles());
        //$sth->bindValue(':id_agencies', $this->getId_agencies());
        return $sth->execute();
    }

 /**
     * Récupération des données utilisateur
     * @param mixed $id
     * 
     * @return [type]
     */
    public static function getComments(int $id)
    {
        $pdo = Database::getInstance();
        $sth = $pdo->query('SELECT * FROM comments WHERE id_users =' . $id . ';');
        $post = $sth->fetch(PDO::FETCH_OBJ);
        return $post;
    }

     /**
     * afficher tous les patients
     * @return array
     */
    public static function readAlle(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM `comments`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll();
    }

     /**
     * afficher tous les patients
     * @return array
     */
    public static function readAll(): array
    {
        $pdo = Database::getInstance();
        $sql = 'SELECT * 
                FROM `comments`    
                INNER JOIN `users` 
                ON `comments`.`id_users` = `users`.`id_users`;';
        $sth = $pdo->query($sql);
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

        /**
     *
     * @param int $id
     * 
     * @return bool
     */
    public static function deleteComment(int $id): bool
    {
        $pdo = Database::getInstance();
        $sql = 'DELETE   
                FROM `comments`
                WHERE `id_comments` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        if ($sth->execute()) {
            $result = $sth->rowCount();
            return ($result >= 1) ? true : false;
        }
        return false;
    }

}