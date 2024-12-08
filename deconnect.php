<?php

 session_start();
 session_unset();
 session_destroy();

 include("vue_index.php"); /// changer le lien !!!

 exit;
 ?>
