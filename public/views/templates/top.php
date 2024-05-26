<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We create our slime from scratch. It is available in multiple colors and different textures. Please inquire today!">
    <meta name="keywords" content="slime superslime slimetime superslimetime homemade purchase buy">
    <meta name="author" content="Ioconic">
    <meta name="robots" content="index, follow">
    <title>SuperSlimeTime</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="canonical" href="<?= getCanonicalUrl(); ?>">
    <link rel="stylesheet" href="/assets/styles/reset.css">
    <link rel="stylesheet" href="/assets/styles/global.css">
    <?php
      $cssFile = "/assets/styles/$underscoredRoute.css";
      if (file_exists($_SERVER["DOCUMENT_ROOT"] . $cssFile)) {
        echo "<link rel=stylesheet href=$cssFile>";
      }
    ?>
  </head>
  <body>
    <?php require_once "views/components/main_header.php" ?>
    <main>