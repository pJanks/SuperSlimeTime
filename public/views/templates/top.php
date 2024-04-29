<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperSlimeTime</title>
    <link rel="stylesheet" href="/styles/reset.css">
    <link rel="stylesheet" href="/styles/global.css">
    <?php
      $underscoredRoute = str_replace("-", "_", $route);
      $cssFile = "/styles/$underscoredRoute.css";
      $sanitizedCssFile = htmlspecialchars($cssFile);

      if (file_exists($_SERVER["DOCUMENT_ROOT"] . $sanitizedCssFile)) {
        echo "<link rel=stylesheet href=$sanitizedCssFile>";
      }
    ?>
  </head>
  <body>
    <?php require_once "views/components/main_header.html" ?>
    <main>