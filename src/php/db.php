<?php

$host = 'localhost';
$db = 'atlant';
$user = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host; dbname=$db", "$user", "$password");
} catch (PDOException $e) {
    echo 'Connection error with DB ' . $e->getMessage();
}