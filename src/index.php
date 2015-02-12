<?php

  $mailmanHTML = file_get_contents( 'https://lists.hackerspace.lu/mailman/listinfo' );

  $listsPattern = '/<td><a href="listinfo\/(.*?)<\/tr>/s';

  preg_match_all( $listsPattern, $mailmanHTML, $listsHTML );

  foreach ( $listsHTML[1] as $listHTML ) {

    $namePattern = '/(.*?)"/s';

    preg_match_all( $namePattern, $listHTML, $listName );

    $descriptionPattern = '/<td>(.*?)<\/td>/s';

    preg_match_all( $descriptionPattern, $listHTML, $listDescription );

    if ( $listName[1][0] != 'mailman' ) {

      $list[ 'name'        ]  = $listName         [1][0];
      $list[ 'description' ]  = $listDescription  [1][0];

      $lists[] = $list;

    }

  }

?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="@Kaweechelchen">

      <title>syn2cat Mailinglists</title>

      <!-- Custom styles for this template -->
      <link href="bootstrap.min.css" rel="stylesheet">

      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <style>

        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
          padding-top: 20px;
        }

      </style>

    </head>

    <body>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1>Hello, human!</h1>
          <p>Manage your syn2cat mailinglist subscriptions here</p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">

          <?php

            foreach ( $lists as $list ) {

                ?>

                <div class="col-md-4">
                  <h2><?= $list[ 'name' ] ?></h2>
                  <p><?= $list[ 'description' ] ?></p>
                  <p><a class="btn btn-success" href="mailto:<?= $list[ 'name' ] ?>-join@lists.hackerspace.lu?subject=just send this empty email to subscribe" role="button">Subscribe to <?= $list[ 'name' ] ?></a></p>
                  <p><a class="btn btn-warning" href="mailto:<?= $list[ 'name' ] ?>-request@lists.hackerspace.lu?subject=just send this empty email to reset your password&body=password" role="button">Reset password on <?= $list[ 'name' ] ?></a></p>
                  <p><a class="btn btn-danger" href="mailto:<?= $list[ 'name' ] ?>-leave@lists.hackerspace.lu?subject=just send this empty email to unsubscribe" role="button">Unubscribe from <?= $list[ 'name' ] ?></a></p>
                </div>

                <?php

            }

          ?>

        </div>

      </div> <!-- /container -->


      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="../../dist/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
  </html>
