<?php
$server = 'localhost';
$username = 'imon';
$password = 'p@ssw0rd';
$database = 'php_auth';

try {
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e) {
	die("Connection failed: " . $e->getMessage());
}