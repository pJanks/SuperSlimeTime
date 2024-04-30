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
      case "contact":
      case "favorites":
      case "search":
      case "cart":
      case "shop-all":
      break;

      default:
        http_response_code(404);
        $route = "404";
      break;
    }

    $underscoredRoute = str_replace("-", "_", $route);

    require_once "views/templates/top.php";
    require_once "views/$underscoredRoute/$underscoredRoute.html";
    require_once "views/templates/bottom.php";
  }