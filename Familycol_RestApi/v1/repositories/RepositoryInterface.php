<?php

interface RepositoryInterface
{
    public function get(int $id) : BaseModel;
    public function getAll() : array;    
    public function save($model) : int;
    public function update($model) : int;
    public function delete(int $id) : int;
}