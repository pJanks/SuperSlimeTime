<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover handmade slime in vibrant colors and unique textures. Perfect for play and stress relief, and suggestions are also welcome. Order custom slime today!">
    <meta name="keywords" content="superslimetime slime superslime slimetime homemade purchase buy">
    <meta name="author" content="Johnny Cassidy">
    <meta name="robots" content="index, follow">
    <title>SuperSlimeTime</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="canonical" href="<?= getCanonicalUrl(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap">
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
      <section class="success-or-error-message-modal-wrapper hidden">
        <div class="success-or-error-message-modal">
          <h3 class="success-or-error-message-heading"></h3>
          <span class="success-or-error-message modal-message"></span>
          <button class="success-or-error-message-modal-close-button">Close</button>
        </div>
      </section>
      <section class="loader-modal-wrapper hidden">
        <div class="loader-modal">
          <h3 class="loader-message modal-message">Loading . . .</h3>
        </div>
      </section>