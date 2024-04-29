<?php
  require_once "../config.php";

  $lowerCaseRequestUri = strtolower($_SERVER["REQUEST_URI"]);
  $trimmedRequestUri = trim($lowerCaseRequestUri, "/");
  $splitRequestUri = explode("/", $trimmedRequestUri);

  if ($splitRequestUri[0] === "api") {
    $route = $splitRequestUri[1];
  } else {
    $route = $splitRequestUri[0] === "" ? "home" : $splitRequestUri[0];
    switch ($route) {
      case "home":
      break;

      default:
        http_response_code(404);
        $route = "404";
      break;
    }

    require_once "views/templates/top.php";
    require_once "views/$route/$route.html";
    require_once "views/templates/bottom.php";
  }