<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author German Alexander Ramirez Vela
 */

class Session
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
    const SESSION_TIMEOUT = 1800;
    const SESSION_PREFIX = 'SDM_WebApp';
    
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
    
    // THE only instance of the class
    private static $instance;   
    
    private function __construct() {}
        
    /**
    *    Returns THE instance of 'Session'.
    *    The session is automatically initialized if it wasn't.
    *    
    *    @return    object
    **/    
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self;
        }

        self::$instance->startSession();            

        return self::$instance;             
    }   
    
    public function validateLogin()
    {
        if($this->isLoginSessionExpired())
        {
            header("Location:logout.php");   
            exit();
        }
    }

    public function isLoginSessionExpired() 
    {	
	$current_time = time();
        
	if(isset($_SESSION[self::SESSION_PREFIX.'LastActivity']) 
                && isset($_SESSION[self::SESSION_PREFIX."IdUsuario"]))
        {        
            if((($current_time - $_SESSION[self::SESSION_PREFIX.'LastActivity']) > self::SESSION_TIMEOUT))
            {                 
                return true; 
            } 
            return false;
	}
        else{
            if(!isset($_SESSION[self::SESSION_PREFIX.'LastActivity']) 
                && isset($_SESSION[self::SESSION_PREFIX."IdUsuario"]))
            {
                return false;
            }
            else{
                return true;
            }            
        }	
    }    
   
    /**
    *    (Re)starts the session.
    *    
    *    @return    bool    TRUE if the session has been initialized, else FALSE.
    **/    
    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();                                
        }
        
        //$this->setValue('LastActivity') = time();
        return $this->sessionState;
    }    
    
    /**
    *    Stores datas in the session.
    *    Example: $instance->foo = 'bar';
    *    
    *    @param    name    Name of the datas.
    *    @param    value    Your datas.
    *    @return    void
    **/
    
    public function setValue( $name , $value )
    {
        $_SESSION[self::SESSION_PREFIX.$name] = $value;
    }    
    
    /**
    *    Gets datas from the session.
    *    Example: echo $instance->foo;
    *    
    *    @param    name    Name of the datas to get.
    *    @return    mixed    Datas stored in session.
    **/
    
    public function getValue( $name )
    {
        if ( isset($_SESSION[self::SESSION_PREFIX.$name]))
        {
            return $_SESSION[self::SESSION_PREFIX.$name];
        }
    }    
    
    public function __isset( $name )
    {
        return isset($_SESSION[self::SESSION_PREFIX.$name]);
    }    
    
    public function __unset( $name )
    {
        unset( $_SESSION[self::SESSION_PREFIX.$name] );
    }    
    
    /**
    *    Destroys the current session.
    *    
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
    
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
            
            return !$this->sessionState;
        }
        
        return FALSE;
    }
}