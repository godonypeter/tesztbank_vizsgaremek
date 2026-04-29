<?php
  session_start();
  if (isset($_POST['kilepGomb'])){
    session_destroy();
    header("Refresh:0");
  }  
  if (!isset($_SESSION['bent'])){
    $_SESSION['bent']='nem';
  };
  $hoszt="http://localhost/teszt/";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kulso/bootstrap.min.css">
    <link rel="stylesheet" href="sajat.css">
    <script src="kulso/jquery.slim.min.js"></script>
    <script src="kulso/popper.min.js"></script>
    <script src="kulso/bootstrap.bundle.min.js"></script>
    <title>TesztFelület</title>
</head>
<?php
  $k=mysqli_connect('localhost','root','','tesztbank');
  mysqli_set_charset($k,'utf8');
?>
<body style="padding-bottom:15px;">
  <?php
    if (isset($_POST['pwReszetGomb'])) 
    {
      include_once('pwReset.inc.php');
      die;
    }

    if (isset($_POST['pwCsereGomb']))
    {
      if ($_SESSION['pwHash']==md5($_POST['oldPW']) && $_POST['new1PW']==$_POST['new2PW']) {
        $sql=mysqli_prepare($k,"UPDATE felhasznalok SET jelszo=md5(?) WHERE email=?");
        mysqli_stmt_bind_param($sql,'ss',$_POST['new1PW'],$_SESSION['imel']);
        mysqli_stmt_execute($sql);
        $_SESSION['pwHash']=md5($_POST['new1PW']);
        echo("<div class='alert alert-success alert-dismissible fade show'>
               <button type='button' class='close' data-dismiss='alert'>&times;</button>
               <h4 class='text-success'>Sikeres művelet</h4>
               <p>A jelszavadat sikeresen megváltoztattuk, a következő belépés már azzal lehetséges!</p>
              </div>");
      } else {
        echo("<div class='alert alert-danger alert-dismissible fade show'>
               <button type='button' class='close' data-dismiss='alert'>&times;</button>
               <h4 class='text-danger'>Hiba történt!</h4>
               <p>A jelenlegi jelszót hibásan adtad meg, vagy az új jelszó kétszeri megadása nem egyezett!</p>
              </div>");
      };      
    }

    if (isset($_POST['belepGomb'])){
      $ki=explode('@',$_POST['imel'])[0];
      $sql=mysqli_prepare($k,"SELECT * FROM felhasznalok WHERE email=? AND aktiv=True");
      mysqli_stmt_bind_param($sql,'s',$ki);
      mysqli_stmt_execute($sql);
      $e=mysqli_stmt_get_result($sql);
      if(mysqli_num_rows($e)==1){
        $sor=mysqli_fetch_assoc($e);
        if($sor['jelszo']==md5($_POST['jelsz'])){
          echo("<div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>SIKERÜLT A BELÉPÉS!</strong> Üdvözöllek ".$sor['nev']."!</div>");
          if ($ki=='demo.dani'){
            echo("<div class='alert alert-info alert-dismissible fade show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>FIGYELEM!</strong> Demo Dani felhasználó erősen korlátozott:<ul>
                  <li>csak 4 demo kérdés rotálódik</li>
                  <li>nem válthat jelszót</li>
                </ul></div>");
          }
          $sql=mysqli_prepare($k,"UPDATE felhasznalok SET lastLog=CURRENT_TIME WHERE email=?");
          mysqli_stmt_bind_param($sql,'s',$ki);
          mysqli_stmt_execute($sql);
          $_SESSION['bent']='igen';
          $_SESSION['nev']=$sor['nev'];
          $_SESSION['felhID']=$sor['id'];
          $_SESSION['imel']=$ki;
          $_SESSION['szerep']=$sor['szerep'];
          $_SESSION['pwHash']=md5($_POST['jelsz']);
          $_SESSION['szint']='site';
          $_SESSION['lastKerd']=0;
        } else {
          unset($_SESSION);
          $_SESSION['bent']='nem';
          echo("<div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>HIBA!</strong> Nincs ilyen regisztrált felhasználó ($ki) vagy hibás jelszó lett megadva!</div>");   
          $sql=mysqli_prepare($k,"UPDATE felhasznalok SET proba=proba+1 WHERE email=?");
          mysqli_stmt_bind_param($sql,'s',$ki);
          mysqli_stmt_execute($sql);
        }
      }else{
        unset($_SESSION);
        $_SESSION['bent']='nem';
        echo("<div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>HIBA!</strong> Nincs ilyen regisztrált felhasználó ($ki) vagy hibás jelszó lett megadva!</div>");                
      }
    }
    if ($_SESSION['bent']=='nem') {
  ?>
    <div class="conatiner" style="padding:25px;">
      <form method="post">
        <div class="form-group">
          <label for="imel">Email address:</label>
          <input type="email" class="form-control" placeholder="@diak.suli.hu címed azonosítója" id="imel" name="imel" onblur="if(this.value.length>5&&this.value.substr(this.value.length-9)!='pataky.hu'){this.value+='@diak.suli.hu';}">
        </div>
        <div class="form-group" id="pwGroup">
          <label for="jelsz">Password:</label>
          <input type="password" class="form-control" placeholder="belépési jelszavad" id="jelsz" name="jelsz">
        </div>
        <div class="form-group form-check" id="anonimGroup">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" onclick="if(this.checked){imel.value='demo.dani@diak.suli.hu';jelsz.value='demo';pwGroup.style.display='none';reszetGroup.style.display='none';}else{imel.value='';jelsz.value='';pwGroup.style.display='block';reszetGroup.style.display='block';}"> Anonim DEMO user
          </label>
        </div>
        <button type="submit" name="belepGomb" class="btn btn-primary" value="G">Belépés</button>
      </form>
    </div>
  <?php
    } else {
      if (isset($_POST['adminValtasGomb'])) {
        if ($_SESSION['szint']=='site'){
          $_SESSION['szint']='admin';
        } else {
          $_SESSION['szint']='site';
        }
      }
      include_once('menusor.inc.php');
  ?>
    
    <?php
    if ($_SESSION['szint']=='admin') {
        include_once('admin.inc.php');
    } else {
        include_once('teszt_kitoltes.inc.php');
    }
    ?>
    
    <?php
    }
    ?>
  </body>
</html>