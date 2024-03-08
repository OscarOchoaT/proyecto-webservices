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

    public function login($email, $pass)
    {
        $this->query("SELECT * FROM usuarios WHERE email = :email");
        $this->bind(':email', $email);
        $this->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Verificar la contraseña
            if (password_verify($pass, $row['pass'])) {
                return $row; // Devolver los datos del usuario si la contraseña es correcta
            } else {
                return false; // Contraseña incorrecta
            }
        } else {
            return false; // Usuario no encontrado
        }
    }


    public function register($usuario, $email, $pass)
    {
        // Verificar formato de correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // El correo electrónico no tiene un formato válido
        }

        // Generar un número de cuenta aleatorio único de 6 dígitos
        $numerodecuenta = mt_rand(100000, 999999);
        // Verificar si el número de cuenta generado ya existe en la base de datos
        while ($this->checkAccountExists($numerodecuenta)) {
            $numerodecuenta = mt_rand(100000, 999999);
        }

        // Encriptar la contraseña
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $this->query("INSERT INTO usuarios (usuario, email, pass, numerodecuenta) VALUES (:usuario, :email, :pass, :numerodecuenta)");
        $this->bind(':usuario', $usuario);
        $this->bind(':email', $email);
        $this->bind(':pass', $hashedPassword);
        $this->bind(':numerodecuenta', $numerodecuenta);
        return $this->execute();
    }

    private function checkAccountExists($numerodecuenta)
    {
        $this->query("SELECT numerodecuenta FROM usuarios WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':numerodecuenta', $numerodecuenta);
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

}