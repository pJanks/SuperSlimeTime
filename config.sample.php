<?php
  try {
    define("USERNAME", "DB_USER");
    define("SERVER", "localhost");
    define("DB", "DB_NAME");
    define("PASSWORD", "DB_PASSWORD");
    define("ROOT_DIR", "/PATH/TO/ROOT/DIR/");

    $pdo = new PDO( "mysql:host=" . SERVER . ";dbname=" . DB, USERNAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    error_log($errorMessage);
    $errorMessageToLog = "could not connect to db. $errorMessage at: $errorLine.";
    formatLogMessage($errorMessageToLog);
    http_response_code(500);
  }