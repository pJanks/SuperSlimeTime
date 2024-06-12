    </main>
    <?php require_once "views/components/main_footer.html" ?>
  </body>
  <script src="/assets/scripts/global.js"></script>
  <?php
    $scriptFile = "/assets/scripts/$underscoredRoute.js";
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . $scriptFile)) {
      echo "<script src=$scriptFile></script>";
    }
  ?>
</html>