<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/login.css" />
    <title>Document</title>
  </head>
  <body>
  <?php
  include_once 'libraries/vendor/autoload.php';
  session_start();
  $google_client = new Google_Client();

  $google_client->setClientId('440118314532-k45ih6qshpfj71i72j5ihjlqu5pqh3i9.apps.googleusercontent.com');

  $google_client->setClientSecret('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');

  $google_client->SetRedirectUri('https://grounddnd.jure-p.eu/googlelogin.php'); 

  $google_client->addScope('email');

  $google_client->addScope('profile');
  ?>
    <form action="login.php" method="post">
      <input id="email" type="email" name="email" placeholder="Email" />
      <input
        id="password"
        type="password"
        name="password"
        placeholder="Password"
      />
      <button type="submit" id="submit">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-arrow-right"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
          />
        </svg>
      </button>
    </form>
    <p>Lahko se tudi prijaviš z Google računom: <a href = "<?php echo $google_client->createAuthUrl()?>">Prijavi se z Google računom</a>
  </body>
  <?php
  require_once 'cookie.php';
  require_once 'alerts.php';
  ?>
</html>
