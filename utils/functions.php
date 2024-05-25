<?php
  function formatDateInPST() {
    $dateTime = new DateTime("now");
    return $dateTime
      ->setTimezone(new DateTimeZone("America/Los_Angeles"))
      ->format("m.d.y h:i:s A T");
  }

  function formatLogMessage($logMessage, $log = "error") {
    $date = formatDateInPST();
    $logLine = "$date: $logMessage\n";
    file_put_contents(ROOT_DIR . "logs/$log.log", $logLine, FILE_APPEND);
  }

  function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
  }

  function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }