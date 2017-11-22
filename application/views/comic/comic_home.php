    <div class="container">
      <h1>Comic Home</h1>
      <?
      foreach ($comics as $c) {
        echo "<p>" . implode(", ", $c) . "</p>";
      }
      ?>
    </div>
  </body>
