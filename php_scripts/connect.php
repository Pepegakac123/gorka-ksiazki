<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
    $host=$_ENV['DB_HOST'];
    $db_user=$_ENV['DB_USER'];
    $db_password=$_ENV['DB_PASS'];
    $db_name="u780588825_books_mountain"; // tu będzie inna baza
?>