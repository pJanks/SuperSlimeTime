<?php
  require_once "../config.php";
  require_once ROOT_DIR . "utils/functions.php";

  $lowerCaseRequestUri = strtolower($_SERVER["REQUEST_URI"]);
  $trimmedRequestUri = trim($lowerCaseRequestUri, "/");
  $splitRequestUri = explode("/", $trimmedRequestUri);

  if ($splitRequestUri[0] === "api") {
    $rawData = file_get_contents("php://input");
    $route = $splitRequestUri[1];
    switch ($route) {
      case "submit_contact_form":
        require_once "../backend/submit_contact_form.php";
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
      // case "favorites":
      // case "gallery":
      // case "search":
      // case "cart":
      // case "shop-all":
      break;

      default:
        http_response_code(404);
        $route = "404";
      break;
    }

    $underscoredRoute = str_replace("-", "_", $route); // use "-" for urls, "_" for filenames

    // this logic may need to be refactored if we need to use php logic within the views
    // currently this is not necessary but it can be done using a file_exists() condition
    // similar to public/views/templates/*.php files
    require_once "views/templates/top.php";
    require_once "views/$underscoredRoute/$underscoredRoute.html";
    require_once "views/templates/bottom.php";
  }