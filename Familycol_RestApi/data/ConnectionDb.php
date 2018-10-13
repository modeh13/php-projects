<?php
/**
 * Class that wrap an instance of the PDO class to manage of the Database models
 * para el manejo de la base de modelos
 */

require_once '../utils/Config.php';

class ConnectionDB
{
    /**
     * Class instance
     */
    private static $db = null;

    /**
     * PDO instance
     */
    private static $pdo;

    final private function __construct()
    {
        try {
            // Create a new PDO connection
            self::getDB();
        } catch (PDOException $e) {
            // Handler Exceptions
        }
    }

    /**
     * Return the only class instance
     * @return ConnectionDB|null
     */
    public static function getInstance()
    {
        if (self::$db === null) {
            self::$db = new self();
        }
        return self::$db;
    }

    /**
     * Create a new connection based in PDO.     
     * @return PDO Object PDO
     */
    public function getDB()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO(
                'mysql:dbname=' . DATABASE_NAME .
                ';host=' . SERVERDB . ";",
                USER_DB,
                PASS_DB,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            // Enable exceptions
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }

    /**
     * Avoid the object cloning
     */
    final protected function __clone()
    {
    }

    function _destructor()
    {
        self::$pdo = null;
    }
}