<?php
function loadEnv($path) {
    if(!file_exists($path)) {
        throw new Exception("The environment file {$path} does not exist");
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
        }
    }
}

// Load the .env file
loadEnv(__DIR__ . '/.env');
    $host=getenv('DB_HOST');
    $db_user=getenv('DB_USER');
    $db_password=getenv('DB_PASS');
    $db_name="u780588825_books_mountain"; // tu będzie inna baza
?>