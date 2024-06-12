<?php
  try {
    $pdo = createDBConnection();
    $sql = "SELECT * FROM products";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $products = [];
    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $products[] = $product;
    }
    
    echo json_encode($products, JSON_PRETTY_PRINT);
  } catch (\Throwable $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    formatLogMessage("$errorMessage at line $errorLine in fetch_products.php");

    http_response_code(500);

    echo json_encode([
      "error" => "there was an unexpected error.",
      "message" => "an unexpected error occurred. please try again later.",
      "status" => "failed",
    ]);
  }