<?php
    include_once('ellenorzes.inc.php');
?>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" title="Belépve: <?php echo($_SESSION['nev']); ?>">TesztBank</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <?php
        if($_SESSION['szerep']=='t'){
      ?>
      <li class="nav-item">
      <?php
        if ($_SESSION['szint']=='site'){
      ?>
      <form method='post'><input type='submit' name='adminValtasGomb' value='Admin felületre váltás' class='nav-link' style='padding: 8px;background-color:transparent;border:none;color:lightyellow;'></form>
      <?php
        } elseif ($_SESSION['szint']=='admin') {
      ?>
      <form method='post'><input type='submit' name='adminValtasGomb' value='Teszt felületre váltás' class='nav-link' style='padding: 8px;background-color:transparent;border:none;color:lightyellow;'></form>
      <?php
        }
      ?>
      </li>
      <?php
        };
        if($_SESSION['imel']!='demo.dani'){
      ?>
      <li class="nav-item">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pwModal" style='padding: 8px;background-color:transparent;border:none;color:lightyellow;'>
        Jelszóváltás
      </button>
      <div class="modal" id="pwModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Jelszóváltás</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <?php include_once('pwReset.inc.php');  ?>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Bezárás</button>
            </div>
          </div>
        </div>
      </div>
      </li>
      <?php
        } 
      ?>
      <li class="nav-item">
        <form method='post'><input type='submit' name='kilepGomb' value='Kijelentkezés' class='nav-link' style='padding: 8px;background-color:transparent;border:none;color:lightyellow;'></form>
      </li>
    </ul>
  </div>
</nav>