<?php
  try {
    $pdo = createDBConnection();
    $sql = "SELECT * FROM our_team";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $teamMembers = [];
    while ($member = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $teamMembers[] = $member;
    }
    
    echo json_encode($teamMembers, JSON_PRETTY_PRINT);
  } catch (\Throwable $error) {
    $errorMessage = $error->getMessage();
    $errorLine = $error->getLine();
    formatLogMessage("$errorMessage at line $errorLine in fetch_our_team.php");
    http_response_code(500);
    echo json_encode([
      "error" => "there was an unexpected error.",
      "message" => "an unexpected error occurred. please try again later.",
      "status" => "failed",
    ]);
  }