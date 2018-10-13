<?php

class UserService {

    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;        
    }

    public function getAuthenticate(string $email, string $pass) : BaseModel {        
        return $this->repository->getAuthenticate($email, $pass);
    }

    public function get(int $id) : BaseModel {
        //throw new Exception("Error");
        return $this->repository->get($id);
    }

    public function getAll() : array {
        return $this->repository->getAll();
    }

    public function add($user) : int {
        return 0;
    }

    public function update($user) : int {
        return 0;
    }

    public function delete($id) : int {
        return 0;
    } 
}