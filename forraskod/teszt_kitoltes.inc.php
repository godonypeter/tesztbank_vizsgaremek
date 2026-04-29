<?php
    include_once('ellenorzes.inc.php');
?>
<form method="post">
      <div class="container">        
        <div class="card">
          <?php            
            if (isset($_POST['vGomb'])) {   
              $lastK=$_SESSION['lastKerd'];           
              $e=mysqli_query($k,"SELECT kerdesek.*, temaNev, temaLeiras FROM kerdesek INNER JOIN temakorok ON kerdesek.temaID=temakorok.id WHERE kerdesek.id=$lastK");
            } else {
              if($_SESSION['imel']=='demo.dani') {
                $e=mysqli_query($k,"SELECT kerdesek.*, temaNev, temaLeiras FROM kerdesek INNER JOIN temakorok ON kerdesek.temaID=temakorok.id WHERE kerdesek.id BETWEEN 3 AND 6 and kerdesek.ellenorID IS NOT NULL ORDER BY rand() LIMIT 1");
              } else {
                $e=mysqli_query($k,"SELECT kerdesek.*, temaNev, temaLeiras FROM kerdesek INNER JOIN temakorok ON kerdesek.temaID=temakorok.id WHERE kerdesek.ellenorID IS NOT NULL ORDER BY rand() LIMIT 1");
              }
            }            
            $sor=mysqli_fetch_assoc($e);
            $kerdSzoveg=$sor['kerdSzoveg'];
            $kerdID=$sor['id'];
            $kerdTema=$sor['temaNev'];
            $kerdTemaLeir=$sor['temaLeiras'];
            $kerdMegj=$sor['megjegyzes'];
          ?>
            <div class="card-body" style='padding-top:0px;'>
              <?php 
                echo("<p class='text-right font-italic text-monospace text-secondary' style='margin-right:-10px;font-size:75%;'><abbr title='Témakör: $kerdTemaLeir'>$kerdTema</abbr></p>");
                echo("<p>$kerdSzoveg</p>"); 
                if (file_exists("media/$kerdID.png")) {
                  echo("<img src='media/$kerdID.png' class='mx-auto d-block w-75'>");
                }
                elseif (file_exists("media/$kerdID.mp4")) {
                  echo("<video class='img-fluid mx-auto d-block w-75' controls>
                         <source src='media/$kerdID.mp4' type='video/mp4'>
                        </video>");
                }
                elseif (file_exists("media/$kerdID.mp3")) {
                  echo("<audio class='w-100' controls>
                         <source src='media/$kerdID.mp3' type='audio/mpeg'>
                        </audio>");
                }
                $_SESSION['lastKerd']=$kerdID;
              ?>
            </div>
        </div>
          <div class="row">
        <?php
        if (isset($_POST['vGomb'])) {
          $v1=$_POST['v1']; $v2=$_POST['v2']; $v3=$_POST['v3']; $v4=$_POST['v4']; $vu=$_POST['vu'];$fid=$_SESSION['felhID'];
          $sql=mysqli_prepare($k,"INSERT INTO kitoltesek VALUES (NULL,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)");
          mysqli_stmt_bind_param($sql,'iiiiiii',$fid,$kerdID,$v1,$v2,$v3,$v4,$vu);
          mysqli_stmt_execute($sql);
          ?>
            <div class="col-12 row" >
              <?php
              $sql="SELECT valaszok.valaszSzoveg, kerdesvalasz.pont FROM valaszok JOIN kerdesvalasz ON kerdesvalasz.valaszID=valaszok.id WHERE kerdesID=$kerdID AND valaszID=".intval($v1);
              $sor=mysqli_fetch_assoc(mysqli_query($k,$sql));
              $szov=$sor['valaszSzoveg'];
              $pont=$sor['pont'];
              if ($v1==$vu){ 
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-danger';
                }                
              } else {
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-light';
                } 
              };
              echo("<div class='col-12 col-md-6 card'><input type='button' class='$class' value='$szov'></div>");
              
              $sql="SELECT valaszok.valaszSzoveg, kerdesvalasz.pont FROM valaszok JOIN kerdesvalasz ON kerdesvalasz.valaszID=valaszok.id WHERE kerdesID=$kerdID AND valaszID=".intval($v2);
              $sor=mysqli_fetch_assoc(mysqli_query($k,$sql));
              $szov=$sor['valaszSzoveg'];
              $pont=$sor['pont'];
              if ($v2==$vu){ 
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-danger';
                }                
              } else {
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-light';
                } 
              };
              echo("<div class='col-12 col-md-6 card'><input type='button' class='$class' value='$szov'></div>");

              $sql="SELECT valaszok.valaszSzoveg, kerdesvalasz.pont FROM valaszok JOIN kerdesvalasz ON kerdesvalasz.valaszID=valaszok.id WHERE kerdesID=$kerdID AND valaszID=".intval($v3);
              $sor=mysqli_fetch_assoc(mysqli_query($k,$sql));
              $szov=$sor['valaszSzoveg'];
              $pont=$sor['pont'];
              if ($v3==$vu){ 
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-danger';
                }                
              } else {
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-light';
                } 
              };
              echo("<div class='col-12 col-md-6 card'><input type='button' class='$class' value='$szov'></div>");

              $sql="SELECT valaszok.valaszSzoveg, kerdesvalasz.pont FROM valaszok JOIN kerdesvalasz ON kerdesvalasz.valaszID=valaszok.id WHERE kerdesID=$kerdID AND valaszID=".intval($v4);
              $sor=mysqli_fetch_assoc(mysqli_query($k,$sql));
              $szov=$sor['valaszSzoveg'];
              $pont=$sor['pont'];
              if ($v4==$vu){ 
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-danger';
                }                
              } else {
                if ($pont==1) {
                  $class='bg-success';
                } else {
                  $class='bg-light';
                } 
              };
              echo("<div class='col-12 col-md-6 card'><input type='button' class='$class' value='$szov'></div>");
              ?>
            </div>
          <?php
            if (strlen($kerdMegj)>0){
              echo("<div class='col-12'>
                      <fieldset style='margin:10px;background-color:#eeeeee;'>
                        <legend style='background-color:white;font-style:italic;'>Megjegyzés a kérdéshez:</legend>
                        <p style='padding:10px;'>$kerdMegj</p>
                      </fieldset>
                    </div>");
            }
          } else {
            $e=mysqli_query($k,"(SELECT valaszok.*, kerdesvalasz.pont FROM valaszok INNER JOIN kerdesvalasz ON kerdesvalasz.valaszId=valaszok.id WHERE kerdesvalasz.kerdesID=$kerdID AND kerdesvalasz.torolt=False AND kerdesvalasz.pont=1 ORDER BY rand() LIMIT 1) UNION (SELECT valaszok.*, kerdesvalasz.pont FROM valaszok INNER JOIN kerdesvalasz ON kerdesvalasz.valaszId=valaszok.id WHERE kerdesvalasz.kerdesID=$kerdID AND kerdesvalasz.torolt=False AND kerdesvalasz.pont=0 ORDER BY rand() LIMIT 3) ORDER BY rand()");        
          ?>                  
            <div class="col-12 col-sm-6 card">
                <?php
                  $sor=mysqli_fetch_assoc($e);
                  $v1=$sor['id'];
                  $sz=$sor['valaszSzoveg'];
                ?>
                <input type="hidden" name="v1" value="<?php echo($v1); ?>">
                <input id="v<?php echo($v1); ?>" type="button" value="<?php echo($sz); ?>" class="bg-light" onclick="jelol(this);">
            </div>
            <div class="col-12 col-sm-6 card">
                <?php
                  $sor=mysqli_fetch_assoc($e);
                  $v2=$sor['id'];
                  $sz=$sor['valaszSzoveg'];
                ?>
                <input type="hidden" name="v2" value="<?php echo($v2); ?>">
                <input id="v<?php echo($v2); ?>" type="button" value="<?php echo($sz); ?>" class="bg-light" onclick="jelol(this);">
            </div>
            <div class="col-12 col-sm-6 card">
                <?php
                  $sor=mysqli_fetch_assoc($e);
                  $v3=$sor['id'];
                  $sz=$sor['valaszSzoveg'];                  
                ?>
                <input type="hidden" name="v3" value="<?php echo($v3); ?>">
                <input id="v<?php echo($v3); ?>" type="button" value="<?php echo($sz); ?>" class="bg-light" onclick="jelol(this);">
            </div>
            <div class="col-12 col-sm-6 card">
                <?php
                  $sor=mysqli_fetch_assoc($e);
                  $v4=$sor['id'];
                  $sz=$sor['valaszSzoveg'];
                ?>
                <input type="hidden" name="v4" value="<?php echo($v4); ?>">
                <input id="v<?php echo($v4); ?>" type="button" value="<?php echo($sz); ?>" class="bg-light" onclick="jelol(this);">
            </div>
            <?php
        }
            
            ?>
            <div class="col-12 text-center">
                <?php if(isset($_POST['vGomb'])) { ?>
                  <input type="submit" name="kGomb" class="m-3" value="Következő kérdés">

                <?php } else { ?>
                  <input type="hidden" name="vu" id="valasz" readonly>
                  <input type="button" name="vGomb" id="vGomb" value="Beküldés..." onclick="this.submit();">
                <?php }; ?>
            </div>          
          </div>        
      </div>
    </form>
    <script>
    vGomb.style.visibility='hidden';
    function jelol(melyik) {
      v<?php echo($v1); ?>.className='bg-light';
      v<?php echo($v2); ?>.className='bg-light';
      v<?php echo($v3); ?>.className='bg-light';
      v<?php echo($v4); ?>.className='bg-light';
      melyik.className='bg-primary';
      valasz.value=melyik.id.substring(1);
      vGomb.type="submit";
      vGomb.style.visibility='visible';
    }
    function javit(valasz,jo) {
      v<?php echo($v1); ?>.disabled=true;
      v<?php echo($v2); ?>.disabled=true;
      v<?php echo($v3); ?>.disabled=true;
      v<?php echo($v4); ?>.disabled=true;
      jo.className='bg-success';
      if (valasz!=jo) {
        valasz.className='bg-danger';
      }
    }
    </script>