<?php
    include_once('ellenorzes.inc.php');

    if (isset($_POST['ujKerdGomb'])) {
        $sql=mysqli_prepare($k,"INSERT INTO kerdesek VALUES (NULL, ?, ?, ?, NULL, ?,NULL,False)");
        mysqli_stmt_bind_param($sql,'siis',$_POST['ujKerdSzoveg'], $_POST['ujKerdTema'],$_SESSION['felhID'],$_POST['ujKerdForras']);
        mysqli_stmt_execute($sql);
    }

    if (isset($_POST['ujFeltoltesGomb']))
    {
        $kerdID = $_POST['feltoldID'];
        if (file_exists("media/$kerdID.png")) {
            unlink("media/$kerdID.png");
          }
          elseif (file_exists("media/$kerdID.mp4")) {
            unlink("media/$kerdID.mp4");
          }
          elseif (file_exists("media/$kerdID.mp3")) {
            unlink("media/$kerdID.mp3");
          }
        $kit=explode('.',$_FILES['ujFajl']['name'])[1];
        $cel="media/".$kerdID.".".$kit;
        move_uploaded_file($_FILES['ujFajl']['tmp_name'], $cel);
    }

?>

<table class='table table-striped'>
    <thead>
        <form method="post">
          <tr class='table-info'>
            <td class='align-middle'>
                <textarea name='ujKerdSzoveg' class='form-control' required></textarea>
            </td>
            <td class='align-middle text-center' style='width: 240px;'>
                <select name='ujKerdTema' class='form-control'>
                    <?php
                        $sql2="SELECT * FROM temakorok ORDER BY temaNev ASC";
                        $e2=mysqli_query($k,$sql2);
                        while ($sor2=mysqli_fetch_assoc($e2)) {
                            echo("<option value='".$sor2['id']."'>".$sor2['temaNev']."</option>");    
                        }     
                    ?>
                </select>
            </td>
            <td class='align-middle text-center'>
                <input type="text" name="ujKerdForras" value="saját" class="form-control" style="width:150px;" required>
            </td>
            <td class='align-middle text-center' style='font-size:75%;padding:0px;'>
                <p><?php echo($_SESSION['nev']);?></p>
            </td>
            <td class='align-middle text-center'>
                <input type='submit' name='ujKerdGomb' value='+' class="btn btn-primary p-1">
            </td>              
          </tr>
        </form>
        <tr>
            <th class='align-middle p-1'>Kérdés szövege</th>
            <th class='align-middle p-1'>Témakör</th>
            <th class='align-middle p-1' style='width:100px;'>Forrás</th>
            <th class='align-middle p-1' style='width:100px;'>Rögzítő/Ellenőr</th>
            <th class='align-middle p-1' style='font-size:75%;padding:0px;'>Művelet</th>
        </tr>
    </thead>
    <tbody>        
        
        
        <?php
            $sql="SELECT * FROM kerdesek WHERE torolt=False ORDER BY kerdSzoveg ASC";
            $e=mysqli_query($k,$sql);
            while ($sor=mysqli_fetch_assoc($e)) {
                $id=$sor['id'];
                $aktivCsatolas='nincs';
                echo("<tr id='sor1_$id' class='p-0'>
                        <td class='m-0'><textarea id='kerdSzoveg_$id' title='Kid->$id' class='form-control border m-0' rows='2' oninput='sorMentes(ment_$id,sor1_$id)' required title='$id' style='field-sizing: content;'>".$sor['kerdSzoveg']."</textarea>");
                        if (file_exists("media/$id.png")) {
                            $aktivCsatolas="media/$id.png";
                        } elseif (file_exists("media/$id.mp4")) {
                            $aktivCsatolas="media/$id.mp4";
                        } elseif (file_exists("media/$id.mp3")) {
                            $aktivCsatolas="media/$id.mp3";
                        }
                echo("</td>
                        <td><select id='tema_$id' class='form-control' oninput='sorMentes(ment_$id,sor1_$id)' required>");                
                $sql2="SELECT * FROM temakorok ORDER BY temaNev ASC";
                $e2=mysqli_query($k,$sql2);
                while ($sor2=mysqli_fetch_assoc($e2)) {
                    if($sor['temaID']==$sor2['id']){
                        echo("<option value='".$sor2['id']."' selected>".$sor2['temaNev']."</option>");    
                    }else{
                        echo("<option value='".$sor2['id']."'>".$sor2['temaNev']."</option>");    
                    }
                }                
                echo("  </select></td>
                        <td><input type='text' id='forras_$id' value='".$sor['forras']."' class='form-control border' oninput='sorMentes(ment_$id,sor1_$id)' required></td>
                        <td class='align-middle text-center p-1' style='font-size: 75%;width:100px;'>");
                $sql2="SELECT nev FROM felhasznalok WHERE felhasznalok.id=".$sor['rogzitoID'];
                $e2=mysqli_query($k,$sql2);
                $sor2=mysqli_fetch_assoc($e2);
                echo($sor2['nev']."<hr style='padding:0px;margin:3px;'>");
                $sql3="SELECT nev FROM felhasznalok WHERE felhasznalok.id=".$sor['ellenorID'];                
                if ($sor['ellenorID']!=NULL){
                    $e3=mysqli_query($k,$sql3);
                    $sor3=mysqli_fetch_assoc($e3);
                    echo($sor3['nev']);
                } else {
                    if($_SESSION['nev']!=$sor2['nev']){
                        echo("<div id='ellenorNeve_$id'><button class='btn btn-warning m-1' onclick='kerdJovaHagyasGomb($id);' title='Kérdés ellenőrként jóváhagyása!'><img src='csekk.png' style='width:24px;'></button></div>");
                    } else {
                        echo('-');
                    }
                }
                if($aktivCsatolas=='nincs'){
                    $csatGombOsztaly='btn-light';
                } else {
                    $csatGombOsztaly='btn-warning';
                }
                echo(  "</td>
                        <td class='align-middle text-center p-1'>
                          <center>
                          <button id='ment_$id' class='btn btn-warning p-1 m-1' style='display:none;' onclick='sorMentesGomb(kerdSzoveg_$id,tema_$id,forras_$id,sor1_$id,$id)'><img src='save.png' style='width:32px;padding:3px;'></button>
                          <button id='plus_$id' class='btn btn-light p-1' onclick='if(sor2_$id.style.display==\"none\"){sor2_$id.style.display=\"\";mmKep_$id.src=\"mmminus.png\";}else{sor2_$id.style.display=\"none\";mmKep_$id.src=\"mmplus.png\";}'><img id='mmKep_$id' src='mmplus.png' style='width:24px;padding:3px;'></button>
                          <button class='btn $csatGombOsztaly p-1' onclick='if(sor3_$id.style.display==\"none\"){sor3_$id.style.display=\"\";}else{sor3_$id.style.display=\"none\";}'><img src='csatol.png' style='width:24px;padding:3px;'></button>
                          <button class='btn btn-light p-1' onclick='if(sor4_$id.style.display==\"none\"){sor4_$id.style.display=\"\";valKep_$id.src=\"valbe.png\";}else{sor4_$id.style.display=\"none\";valKep_$id.src=\"valki.png\";};valaszListaz($id,0);' onmouseover='valaszListaz($id,1);'><img id='valKep_$id' src='valki.png' style='width:24px;padding:3px;'></button>
                          <button id='kerdDel_$id' class='btn btn-danger p-1 m-1' ondblclick='if(confirm(\"Biztos törlöd a kérdést?\")==true){kerdesTorleseGomb(sor1_$id,sor2_$id,sor3_$id,sor4_$id,$id)}'><img src='delete.png' style='width:32px;padding:3px;'></button>
                          </center>
                        </td>
                      </tr>");
                echo("<tr id='sor2_$id' class='table-warning' style='display:none;'>
                        <td colspan='5'>
                            <table style='width: 100%;'>
                                <tr>
                                    <td class='align-middle' style='width: 150px;text-align:right;' >Megjegyzés:</td>
                                    <td><input type='text' id='megj_$id' value='".$sor['megjegyzes']."' style='width:100%;' oninput='sorMentes(ment2_$id,sor2_$id)'></td>
                                    <td class='align-middle' style='width:100px;'><button id='ment2_$id' class='btn btn-warning m-1' style='display:none;' onclick='megjMentesGomb(megj_$id,sor2_$id,$id)'><img src='save.png'></button></td>
                                </tr>
                            </table>
                        </td>
                      </tr>");
                echo("<tr id='sor3_$id' class='table-warning' style='display:none;'>
                      <td colspan='5'>
                        <table style='width: 100%;'>
                            <tr>
                                <td id='aktivCsatCella_$id' class='align-middle' style='width: 40%;'>");
               
                if (file_exists("media/$id.png")) {                    
                    echo("          <img src='media/$id.png' class='mx-auto d-block w-75'>");
                } elseif (file_exists("media/$id.mp4")) {
                    echo("          <video class='img-fluid mx-auto d-block w-75' controls>
                                        <source src='media/$id.mp4' type='video/mp4'>
                                    </video>");
                } elseif (file_exists("media/$id.mp3")) {
                    echo("          <audio class='w-100' controls>
                                        <source src='media/$id.mp3' type='audio/mpeg'>
                                    </audio>");
                } else {
                    echo("          <p class='font-italic'>Jelenleg nincs csatolmány</p>");
                }
                echo("          </td>
                                <td style='width:60%'>");
                if ($aktivCsatolas!='nincs') {
                    echo("          <p id='csat_torles_valasz_$id' class='font-italic'>
                                        <button class='btn btn-warning p-1' onclick='csatTorlesGomb(\"$aktivCsatolas\",csat_torles_valasz_$id,$id)'><img src='csatoff.png' style='width:24px;padding:3px;'><br>Csatolás törlése</button>
                                    </p><hr>");                            
                }
                echo("              <form method='post' enctype='multipart/form-data'>
                                    Új PNG/MP4/MP3 csatolása: <br> 
                                    <input type='file' name='ujFajl' id='ujFajl' class='btn btn-warning' accept='.png, .mp3, .mp4' required;><br>
                                    <input type='hidden' name='feltoldID' value='$id'><br>
                                    <input type='submit' name='ujFeltoltesGomb' class='btn btn-warning p-2' value='Feltöltés'>
                                    </form>
                                    </p>");                
                echo("           </td>                                
                            </tr>
                        </table>
                        </td>
                    </tr>");
                echo("<tr id='sor4_$id' class='table-warning' style='display:none;'>
                    <td colspan='5'>
                      <table style='width:100%;'>
                        <tr>
                            <th class='table-success' style='width:50%;'>
                                Jó válasz(ok)
                            </th>
                            <th class='table-danger' style='width:50%;'>
                                Rossz válasz(ok)
                            </th>
                        </tr>
                        <tr>
                            <td colsap='2' class='table-success'>
                                <ul id='vlista_1_$id'></ul>
                                <ul class='bg-success' style='padding-top:10px;padding-bottom:10px;'><li><input type='text' id='ujVal1_$id' placeholder='Új JÓ válasz...' oninput='if(this.value!=\"\"){ujVal1Gomb_$id.style.visibility=\"visible\"}else{ujVal1Gomb_$id.style.visibility=\"hidden\"}'>
                                <button id='ujVal1Gomb_$id' class='btn btn-warning p-1' style='visibility:hidden;' onclick='valaszRogzitGomb(ujVal1_$id,$id,1);this.style.visibility=\"hidden\";'>
                                    <img src='save.png' style='width:24px;padding:3px;'>
                                </button>
                                </li></ul>                            
                            </td>
                            <td class='table-danger'>
                                <ul id='vlista_0_$id'></ul>
                                <ul class='bg-danger' style='padding-top:10px;padding-bottom:10px;'><li><input type='text' id='ujVal0_$id' placeholder='Új ROSSZ válasz...' oninput='if(this.value!=\"\"){ujVal0Gomb_$id.style.visibility=\"visible\"}else{ujVal0Gomb_$id.style.visibility=\"hidden\"}'>
                                <button id='ujVal0Gomb_$id' class='btn btn-warning p-1' style='visibility:hidden;' onclick='valaszRogzitGomb(ujVal0_$id,$id,0);this.style.visibility=\"hidden\";'>
                                    <img src='save.png' style='width:24px;padding:3px;'>
                                </button>
                                </li></ul>  
                            </td>                          
                        </tr>                        
                      </table>
                    </td>
                    </tr>");
            }
        ?>
    </tbody>
</table>

<script>  
    aktUserNev='<?php echo($_SESSION["nev"]);?>';

    function valaszListaz(kerdes,pont){
        lista='vlista_'+pont+'_'+kerdes;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_valaszListaz.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                listaelemek="";
                for (const sor of data) {
                    listaelemek += "<li id='vsor_"+sor.kvid+"' title='Vid->"+sor.vid+" KVid->"+sor.kvid+"' style='border-bottom: 1px dotted white;padding: 5px 0px;'>";
                    listaelemek += sor.valaszSzoveg + " <button class='btn btn-danger p-0' >";
                    listaelemek += "<img src='delete.png' ondblclick='if(confirm(\"Biztos törlöd?\")==true){valaszTorlesGomb("+sor.kvid+")}'>";
                    listaelemek += "</button></li>";
                }
                document.getElementById(lista).innerHTML=listaelemek;
            }
        };
        const params = `kerdesID=${encodeURIComponent(kerdes)}&pont=${encodeURIComponent(pont)}`;
        xhr.send(params);
    }

    function sorMentes(gombID,sorID) {
        gombID.style.display='block';
        sorID.className=sorID.className+' table-danger';
    }

    function sorMentesGomb(mentKerdSzoveg,mentTema,mentForras,sorID,ID) {
        const kerdErtek = mentKerdSzoveg.value;
        const temaErtek = mentTema.value;   
        const forrasErtek = mentForras.value;     
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_kerdesmentes.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor='sor1_' + data.KerdID;
                gomb='ment_' + data.KerdID;
                document.getElementById(sor).className=document.getElementById(sor).className.replaceAll(' table-danger','');
                document.getElementById(gomb).style.display='none';
            }
        };
        const params = `kerdID=${encodeURIComponent(ID)}&kerdErtek=${encodeURIComponent(kerdErtek)}&temaErtek=${encodeURIComponent(temaErtek)}&forrasErtek=${encodeURIComponent(forrasErtek)}`;
        xhr.send(params);
    }

    function megjMentesGomb(mentMegj,sorID,ID) {
        const megjErtek = mentMegj.value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_megjegyzesmentes.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor='sor2_' + data.KerdID;
                gomb='ment_' + data.KerdID;
                document.getElementById(sor).className=document.getElementById(sor).className.replaceAll(' table-danger','');
                document.getElementById(gomb).style.display='none';
                document.getElementById(sor).style.display='none';                
            }
        };
        const params = `kerdID=${encodeURIComponent(ID)}&megjErtek=${encodeURIComponent(megjErtek)}`;
        xhr.send(params);
        
    }

    function csatTorlesGomb(fajlNev,valaszBek,ID) {
        valaszBek.innerHTML='Törlés folyamatban...';
        
        const xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'backend_ajax_csatolastorles.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor='csat_torles_valasz_' + data.KerdID;
                erzek='csatErzek_' + data.KerdID;
                aktiv='aktivCsatCella_' + data.KerdID;
                feltoltes='csat_feltolt_valasz_' + data.KerdID;
                document.getElementById(sor).innerHTML='Fájl törölve!';    
                document.getElementById(erzek).innerHTML='';         
                document.getElementById(aktiv).innerHTML="<p class='font-italic'>Jelenleg nincs csatolmány</p>"; 
                document.getElementById(feltoltes).style.display='block';
            }
        };

        const params = `kerdID=${encodeURIComponent(ID)}&fajlNev=${encodeURIComponent(fajlNev)}`;
        xhr.send(params);
    }

    function kerdJovaHagyasGomb(ID) {        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_kerdesJovahagyas.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                ellenor='ellenorNeve_' + data.KerdID;
                document.getElementById(ellenor).innerHTML=aktUserNev;
            }
        };
        const params = `kerdID=${encodeURIComponent(ID)}`;
        xhr.send(params);
    }
    
    function kerdesTorleseGomb(sor1ID,sor2ID,sor3ID,sor4ID,ID) {        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_kerdesTorol.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor1ID.style.display='none';
                sor2ID.style.display='none';
                sor3ID.style.display='none';
                sor4ID.style.display='none';
            }
        };
        const params = `kerdesID=${encodeURIComponent(ID)}`;
        xhr.send(params);
    }

    function valaszTorlesGomb(kvID) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_valaszTorol.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor='vsor_' + data.ValaszID;                
                document.getElementById(sor).style.display='none';
            }
        };
        const params = `kvID=${encodeURIComponent(kvID)}`;
        xhr.send(params);
    }

    function valaszRogzitGomb(ujValasz,ID,pont) {
        const valaszErtek = ujValasz.value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_valaszRogzit.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                valaszListaz(data.KerdID,data.Pont);
                ujValasz.value='';
                ujValasz.focus();
            }
        };
        const params = `kerdesID=${encodeURIComponent(ID)}&valSzoveg=${encodeURIComponent(valaszErtek)}&pontErtek=${encodeURIComponent(pont)}`;
        xhr.send(params);
    }
    
</script>