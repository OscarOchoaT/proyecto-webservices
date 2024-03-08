<?php

date_default_timezone_set('America/Bogota');

class DB
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'banco';

    private $dbh;
    private $error;

    private $stmt;

    public function __construct()
    {
        // DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Opciones
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        // Instancia PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } // Atrapar errores
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function execute()
    {
        return $this->stmt->execute();
    }


    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

}