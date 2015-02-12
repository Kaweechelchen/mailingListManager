<?php

  echo '<pre>';

  $mailmanHTML = file_get_contents( 'https://lists.hackerspace.lu/mailman/listinfo' );

  $listPattern = '/<td><a href="listinfo\/(.*?)"><strong>/s';

  preg_match_all( $listPattern, $mailmanHTML, $lists );

  print_r( $lists[1] );

  exit;
