<?php

require 'BaseModel.php';

class User extends BaseModel {    
    public $FirstName;
    public $LastName;    
    public $Email;
    public $Password;
    public $Status;
    public $CreatedDate;
}