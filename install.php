<?php
$vqmod_url = HTTP_CATALOG . 'vqmod/install/index.php';
$vqmod_path = DIR_SYSTEM . '../vqmod/install/index.php';

ob_start();

if (!$res = @file_get_contents($vqmod_path)) {
  if(!$res = @file_get_contents($vqmod_url)) {
    if (!@include($vqmod_path)) {
      @header('Location: '. $vqmod_url);
    }
  }
}

ob_end_clean();