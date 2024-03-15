<?php

date_default_timezone_set('America/Bogota');

class DB
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'webservices';

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

    // Ingreso usuario
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


    // Registro usuario
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

        // Iniciar una transacción para garantizar la integridad de los datos
        $this->dbh->beginTransaction();

        try {
            // Insertar el usuario en la tabla 'usuarios'
            $this->query("INSERT INTO usuarios (usuario, email, pass, numerodecuenta) VALUES (:usuario, :email, :pass, :numerodecuenta)");
            $this->bind(':usuario', $usuario);
            $this->bind(':email', $email);
            $this->bind(':pass', $hashedPassword);
            $this->bind(':numerodecuenta', $numerodecuenta);
            $this->execute();

            // Insertar un saldo de 0 para la nueva cuenta en la tabla 'saldos_cuenta'
            $this->query("INSERT INTO saldos_cuenta (numerodecuenta, saldo) VALUES (:numerodecuenta, 0)");
            $this->bind(':numerodecuenta', $numerodecuenta);
            $this->execute();

            // Confirmar la transacción
            $this->dbh->commit();

            return true; // Registro exitoso
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->dbh->rollBack();
            return false; // Error en el registro
        }
    }

    // Obtener numero de cuenta por usuario
    public function consultarNumeroCuenta($usuario)
    {
        $this->query("SELECT numerodecuenta FROM usuarios WHERE usuario = :usuario");
        $this->bind(':usuario', $usuario);
        $this->execute();
        return $this->stmt->fetchColumn();
    }

    // Verificar que la cuenta exista
    private function checkAccountExists($numerodecuenta)
    {
        $this->query("SELECT numerodecuenta FROM usuarios WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':numerodecuenta', $numerodecuenta);
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Enviar fondos a otra cuenta
    public function enviarFondos($numerodecuenta_origen, $numerodecuenta_destino, $monto)
    {
        // Verificar que el monto sea positivo
        if ($monto <= 0) {
            return false; // No se puede enviar un monto negativo o cero
        }

        // Verificar que la cuenta de origen tenga suficientes fondos
        $saldo_actual_origen = $this->consultarSaldo($numerodecuenta_origen);
        if ($saldo_actual_origen < $monto) {
            return false; // No hay suficientes fondos en la cuenta de origen
        }

        // Consulta para transferir fondos de la cuenta de origen a la cuenta de destino
        $this->query("UPDATE saldos_cuenta SET saldo = saldo - :monto WHERE numerodecuenta = :numerodecuenta_origen;
                      UPDATE saldos_cuenta SET saldo = saldo + :monto WHERE numerodecuenta = :numerodecuenta_destino;");
        $this->bind(':monto', $monto);
        $this->bind(':numerodecuenta_origen', $numerodecuenta_origen);
        $this->bind(':numerodecuenta_destino', $numerodecuenta_destino);
        return $this->execute();
    }

    //Verificar saldo
    public function consultarSaldo($numerodecuenta)
    {
        // Consulta para obtener el saldo de una cuenta específica
        $this->query("SELECT saldo FROM saldos_cuenta WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':numerodecuenta', $numerodecuenta);
        $this->execute();
        $saldo = $this->stmt->fetchColumn();
        return $saldo;
    }

    // Agregar fondos
    public function agregarFondos($numerodecuenta, $monto)
    {
        // Verificar que el monto sea positivo
        if ($monto <= 0) {
            return false; // No se puede agregar un monto negativo o cero
        }

        // Consulta para actualizar el saldo de la cuenta
        $this->query("UPDATE saldos_cuenta SET saldo = saldo + :monto WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':monto', $monto);
        $this->bind(':numerodecuenta', $numerodecuenta);
        return $this->execute();
    }

    // Retirar Fondos
    public function eliminarFondos($numerodecuenta, $monto)
    {
        // Verificar que el monto a eliminar sea positivo y que la cuenta tenga suficientes fondos
        if ($monto <= 0) {
            return false; // No se puede eliminar un monto negativo o cero
        }

        // Consulta para verificar si hay suficientes fondos en la cuenta
        $this->query("SELECT saldo FROM saldos_cuenta WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':numerodecuenta', $numerodecuenta);
        $this->execute();
        $saldo_actual = $this->stmt->fetchColumn();

        if ($saldo_actual < $monto) {
            return false; // No hay suficientes fondos en la cuenta
        }

        // Consulta para actualizar el saldo de la cuenta
        $this->query("UPDATE saldos_cuenta SET saldo = saldo - :monto WHERE numerodecuenta = :numerodecuenta");
        $this->bind(':monto', $monto);
        $this->bind(':numerodecuenta', $numerodecuenta);
        return $this->execute();
    }

}