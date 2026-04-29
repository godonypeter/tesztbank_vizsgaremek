<?php
if(substr($_SERVER['PHP_SELF'], -9)!='index.php'){
    echo("<div style='background-color:red; color:white; padding:25px;'><h2>Védett oldal</h2><p>Ezt az oldalt nincs jogosultságod direktben elérni!</p><p>A próbálkozást naplóztuk</p></div>");
    die;
  }
?>