<?php
  try {
    define("USERNAME", "DB_USER");
    define("SERVER", "localhost");
    define("DB", "DB_NAME");
    define("PASSWORD", "DB_PASSWORD");
    define("ROOT_DIR", "/PATH/TO/ROOT/DIR/");
    
    require_once ROOT_DIR . "utils/functions.php";

    $pdo = new PDO("mysql:host=" . SERVER . ";dbname=" . DB, USERNAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    formatLogMessage("$errorMessage at line $errorLine in config.php");
    http_response_code(500);
  }