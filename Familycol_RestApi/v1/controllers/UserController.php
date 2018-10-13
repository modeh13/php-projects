<?php

require_once '../utils/Config.php';
require_once 'services/UserService.php';
require_once 'repositories/UserRepository.php';
require_once '../utils/HttpCodes.php';

class UserController
{
    private $service;
    //get
    //getAll
    //post
    //delete
    //put
    public function getAuthenticate($req, $res, $args) {
        $this->service = new UserService(new UserRepository());
        $json = $req->getBody();
        $mapper = new JsonMapper();
        $user = $mapper->map(
            json_decode($json),
            new User()
        );

        if(isset($user->Email) && isset($user->Password)) {
            $user = $this->service->getAuthenticate($user->Email, $user->Password);

            if($user->Id > 0) {
                $res = $res->withJson($user, HttpCodes::HTTP_OK);    
            }
            else {
                $res->write("Resource not found. 1");
                $res = $res->withStatus(HttpCodes::HTTP_NOT_FOUND);            
            } 
        }
        else {
            $res = $res->withStatus(HttpCodes::HTTP_BAD_REQUEST);
        }         

        return $res;
    }

    public function get($req, $res, $args)
    {
        $this->service = new UserService(new UserRepository());
        $user = $this->service->get($args["id"]);

        if($user->Id > 0) {
            $res = $res->withJson($user, HttpCodes::HTTP_OK);    
        }
        else {
            $res->write("Resource not found.");
            $res = $res->withStatus(HttpCodes::HTTP_NOT_FOUND);            
        }  

        return $res;
    }

    public function getAll($req, $res, $args)
    {        
        $this->service = new UserService(new UserRepository());
        $users = $this->service->getAll();              
        return $res->withJson($users, HttpCodes::HTTP_OK);
        //$autos = array(
        //array('make'=>'Toyota', 'model'=>'Corolla', 'year'=>'2006', 'MSRP'=>'18,000'),
        //array('make'=>'Nissan', 'model'=>'Sentra', 'year'=>'2010', 'MSRP'=>'22,000')
        //);
    }
}