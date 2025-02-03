<?php

// Incluir el autoload de Composer
require_once __DIR__ . '/../vendor/autoload.php'; // Ajusta la ruta si es necesario

use Dotenv\Dotenv;

class Conexion
{
	private $servidor;
	private $db;
	private $puerto;
	private $charset;
	private $usuario;
	private $contrasena;
	public $pdo = null;

	private $atributos = [PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
	function __construct()
	{
		// Cargar las variables de entorno desde el archivo .env
		$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Sube un nivel para llegar a .env
		$dotenv->load();

		// Asignar valores desde las variables de entorno
		$this->servidor = $_ENV['DB_HOST'] ?? 'localhost';
		$this->db = $_ENV['DB_NAME'] ?? '';
		$this->puerto = $_ENV['DB_PORT'] ?? '3306';
		$this->charset = $_ENV['DB_CHARSET'] ?? 'utf8';
		$this->usuario = $_ENV['DB_USER'] ?? 'root';
		$this->contrasena = $_ENV['DB_PASSWORD'] ?? '';

		// Crear la conexión PDO
		$dsn = "mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}";
		$this->pdo = new PDO($dsn, $this->usuario, $this->contrasena, $this->atributos);
	}
}
