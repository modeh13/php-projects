<?php

require 'RepositoryInterface.php';
require 'models/User.php';

class UserRepository implements RepositoryInterface {

    public function getAuthenticate(string $email, string $pass) : BaseModel {
        $pdo = ConnectionDB::getInstance()->getDB();
        $sql = "SELECT Id, FirstName, LastName, Email, Password, Status, CreatedDate " . 
               "FROM tb_users WHERE Email = '" . $email . "' AND Password = '" . $pass . "' AND Status = 1 " .
               "LIMIT 1;";
        echo $sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return $stmt->fetchObject("User");  
        }

        return BaseModel::createInstance(0);
    }

    public function get(int $id) : BaseModel {
        $pdo = ConnectionDB::getInstance()->getDB();
        $sql = "SELECT Id, FirstName, LastName, Email, Password, Status, CreatedDate " . 
               "FROM tb_users WHERE Id = " . $id . " LIMIT 1;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return $stmt->fetchObject("User");  
        }

        return BaseModel::createInstance(0);
    }

    public function getAll() : array {
        $pdo = ConnectionDB::getInstance()->getDB();
        $sql = "SELECT Id, FirstName, LastName, Email, Password, Status, CreatedDate FROM tb_users";
        $stmt = $pdo->prepare($sql);
        //$result = $pdo->query($sql, PDO::FETCH_ASSOC);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_CLASS, "User");
        return $list;
    }
    public function save($model) : int {

    }
    public function update($model) : int {

    }
    public function delete(int $id) : int {

    }
}