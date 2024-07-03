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
    $logPath = ROOT_DIR . "logs/$log.log";
    file_put_contents($logPath, $logLine, FILE_APPEND);
  }

  function sanitizeUserInput($userInput) {
    return htmlspecialchars(strip_tags(trim($userInput)), ENT_QUOTES, "UTF-8");
  }

  function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function getCanonicalUrl() {
    $protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" || $_SERVER["SERVER_PORT"] === 443) ? "https://" : "http://";
    $canonicalUrl = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    return sanitizeUserInput($canonicalUrl);
  }