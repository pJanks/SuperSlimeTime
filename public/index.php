<?php
  require_once "../config.php";

  $lowercasedRequestUri = strtolower($_SERVER["REQUEST_URI"]);
  $trimmedRequestUri = trim($lowercasedRequestUri, "/");
  $splitRequestUri = explode("/", $trimmedRequestUri);

  if ($splitRequestUri[0] === "api") {
    $route = $splitRequestUri[1];
    switch ($route) {
      case "submit_contact_form":
      case "fetch_our_team":
      case "fetch_products":
        require_once ROOT_DIR . "backend/$route.php";
      break;
      default:
        http_response_code(404);
        formatLogMessage("unknown api route in index.php");
        echo json_encode(["error" => "unknown route"]);
      break;
    }
  } else {
    $route = $splitRequestUri[0] === "" ? "home" : $splitRequestUri[0];
    switch ($route) {
      case "home":
      case "contact":
      case "about":
      case "our-team":
      case "products":
      break;

      default:
        http_response_code(404);
        $route = "404";
      break;
    }

    $underscoredRoute = str_replace("-", "_", $route);
    $extension = file_exists("views/$underscoredRoute/$underscoredRoute.php") ? "php" : "html";

    require_once "views/templates/top.php";
    require_once "views/$underscoredRoute/$underscoredRoute.$extension";
    require_once "views/templates/bottom.php";
  }