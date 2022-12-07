<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id', 'nombre', 'apellido', 'email', 'password',
        'telefono', 'admin', 'confirmado', 'token'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Validación

    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Debes añadir un nombre';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'Debes añadir un apellido';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'Debes añadir un teléfono';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'Debes añadir un email';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'Debes añadir un password de al menos 6 carácteres';
        }
        return self::$alertas;
    }
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        return self::$alertas;
    }
    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }
    public function validarPassword()
    {
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'Debes añadir un password de al menos 6 carácteres';
        }
        return self::$alertas;
    }
    // Verificar que el usuario no esté registrado
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario está registrado';
        }
        return $resultado;
    }
    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken()
    {
        $this->token = uniqid();
    }
    public function comprobarPasswordAndVerificado($password)
    {
        $resultado = password_verify($password, $this->password);
        if (!$this->confirmado || !$resultado) {
            self::$alertas['error'][] = 'Password incorrecto o la cuenta no ha sido verificada';
        } else {
            return true;
        }
    }
}
