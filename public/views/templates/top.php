<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperSlimeTime</title>
    <link rel="stylesheet" href="/styles/reset.css">
    <link rel="stylesheet" href="/styles/global.css">
    <?php
      $cssFile = "/styles/$underscoredRoute.css";
      if (file_exists($_SERVER["DOCUMENT_ROOT"] . $cssFile)) {
        echo "<link rel=stylesheet href=$cssFile>";
      }
    ?>
  </head>
  <body>
    <?php require_once "views/components/main_header.php" ?>
    <main>