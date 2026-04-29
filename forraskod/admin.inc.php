<?php
    include_once('ellenorzes.inc.php');

    if(isset($_POST['kerdesAdminGomb'])){
        $_SESSION['adminSzint']='kerdes';
      };
      if(isset($_POST['diakAdminGomb'])){
        $_SESSION['adminSzint']='diak';
      };
?>

<div class="container-fluid">
    <div class="row my-2">
        <div class="col-md-2 col-lg-1" >
            <div style='position: fixed; top:100px; padding:5px;'>
                <form method="post">
                    <input type="submit" name="kerdesAdminGomb" value="Kérdések" style="font-size:70%;width:100%;padding:10px 10px;" >
                </form>
                <br><hr><br>
                <form method="post">
                    <input type="submit" name="diakAdminGomb" value="Diákok" style="font-size:70%;width:100%;padding:10px 10px;">
                </form>
            </div>
            <br>            
        </div>
        <div class="col-md-10 col-lg-11">
            <?php
              if(isset($_SESSION['adminSzint'])){
                include_once('admin_'.$_SESSION['adminSzint'].'.inc.php');
              } else {
                echo('Válaszz a menüből...');
              }

            ?>
        </div>
    </div>
</div>

<button class='btn btn-light' style='position:fixed;bottom:0px;left:0px;padding:5px;' onclick='window.scrollTo(0, 0);'><img src="fel.png" alt="Az oldal tetejére" title="Az oldal tetejére"></button>