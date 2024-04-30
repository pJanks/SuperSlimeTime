    </main>
  </body>
  <script src="/scripts/global.js"></script>
  <?php
    $scriptFile = "/scripts/$underscoredRoute.js";
    $sanitizedScriptFile = htmlspecialchars($scriptFile);

    if (file_exists($_SERVER["DOCUMENT_ROOT"] . $scriptFile)) {
      echo "<script src=$sanitizedScriptFile></script>";
    }
  ?>
</html>