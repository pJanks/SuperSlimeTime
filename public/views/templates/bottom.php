    </main>
  </body>
  <script src="/scripts/global.js"></script>
  <?php
    $scriptFile = "/scripts/$underscoredRoute.js";
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . $scriptFile)) {
      echo "<script src=$scriptFile></script>";
    }
  ?>
</html>