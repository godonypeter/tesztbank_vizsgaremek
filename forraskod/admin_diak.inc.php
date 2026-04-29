<?php
    include_once('ellenorzes.inc.php');

    if (isset($_POST['ujFelhGomb'])) {
        $sql=mysqli_prepare($k,"INSERT INTO felhasznalok VALUES (NULL, ?, 'd', ?, ?, ?, 0, 1, NULL)");
        $kodoltJelszo=md5($_POST['ujJelszo']);
        mysqli_stmt_bind_param($sql,'ssss',$_POST['ujNev'], $_POST['ujEmail'],$kodoltJelszo,$_POST['ujCsop']);
        mysqli_stmt_execute($sql);
    }
?>

<table class='table table-striped'>
    <thead>
        <form method="post">
            <tr class='table-info'>
                <td>
                    <input type="text" name="ujNev" id="ujNev" class="form-control" style="width:250px;" oninput="emailfrissit();" required>
                </td>
                <td>
                    <div class="input-group">
                    <input type="text" name="ujEmail" id="ujEmail" class="form-control" style="width:250px;text-align:right;" required>
                        <span class="input-group-text" style='font-size:75%;'>@diak.pataky.hu</span>
                    </div>
                </td>
                <td>
                    <select name="ujCsop" class="form-control" required>
                        <?php
                            $betuk="ABC";
                            for ($i=9; $i <=12 ; $i++) { 
                                for ($j=0; $j < 3 ; $j++) { 
                                    $b=$betuk[$j];
                                    echo("<option>$i.$b</option>");
                                }
                            }
                        ?>
                    </select>
                </td>
                <td colspan=3>
                    <div class="input-group">
                        <span class="input-group-text" style='font-size:75%;'>Pw:</span>
                        <input type="text" name="ujJelszo" id="ujJelszo" class="form-control" style="width:250px;" placeholder="Jelszó..." required>                        
                    </div>
                </td>
                <td class='align-middle text-center'><input type='submit' name='ujFelhGomb' value='+' class="btn btn-primary p-1"></td>            
            </tr>
        </form>
        <tr>
            <th>Név</th>
            <th>Iskolai email</th>
            <th>Csoport</th>
            <th>Próbák</th>
            <th>Aktív</th>
            <th>Utolsó belépés</th>
            <th class='align-middle' style='font-size:75%;padding:0px;'>Művelet</th>
        </tr>
    </thead>
    <tbody>        
        
        
        <?php
            $sql="SELECT * FROM felhasznalok WHERE szerep='d' AND id>100 ORDER BY nev ASC";
            $e=mysqli_query($k,$sql);
            while ($sor=mysqli_fetch_assoc($e)) {
                $id=$sor['id'];
                echo("<tr id='sor_$id'>
                        <td><input type='text' id='nev_$id' value='".$sor['nev']."' class='form-control border' style='width: 250px;' oninput='sorMentes(ment_$id,sor_$id)' required></td>
                        <td><div class='input-group'><input type='text' id='email_$id' value='".$sor['email']."' class='form-control border' style='width: 250px;text-align:right;' oninput='sorMentes(ment_$id,sor_$id)' required><span class='input-group-text' style='font-size:75%;'>@diak.pataky.hu</span></div></td>
                        <td><select id='csop_$id' class='form-control' oninput='sorMentes(ment_$id,sor_$id)' required>");
                $betuk="ABC";
                for ($i=9; $i <=12 ; $i++) { 
                    for ($j=0; $j < 3 ; $j++) { 
                        $b=$betuk[$j];
                        if($sor['csop']==$i.".".$b){
                            echo("<option selected>$i.$b</option>");
                        } else {
                            echo("<option>$i.$b</option>");
                        }                        
                    }
                }          
                echo("  </select></td>
                        <td class='align-middle text-center'>".$sor['proba']."</td>
                        <td class='align-middle text-center p-1'>
                          <div class='form-check form-switch'>
                            <input class='form-check-input' type='checkbox' id='akt_$id' ");
                if ($sor['aktiv']==1){
                    echo("value='1' checked");
                } else {
                    echo("value='0'");
                }
                echo (" oninput='sorMentes(ment_$id,sor_$id)' onclick='if(this.checked==false){this.value=0}else{this.value=1};'>
                          </div>
                        </td>
                        <td class='align-middle'>".$sor['lastLog']."</td>
                        <td class='align-middle p-1'><button id='ment_$id' class='btn btn-warning p-1' style='display:none;' onclick='sorMentesGomb(nev_$id,email_$id,csop_$id,akt_$id,sor_$id,$id)'><img src='save.png'></button> </td>
                      </tr>");
            }
        ?>
    </tbody>
</table>

<script>
    function emailfrissit() {
        seged=ujNev.value.toLowerCase();
        ujEmail.value=seged.replaceAll('á','a').replaceAll('é','e').replaceAll('í','i').replaceAll('ó','o').replaceAll('ö','o').replaceAll('ő','o').replaceAll('ú','u').replaceAll('ü','u').replaceAll('ű','u').replaceAll(' ','.');
    }
    
    function sorMentes(gombID,sorID) {
        gombID.style.display='block';
        sorID.className=sorID.className+' table-danger';
    }

    function sorMentesGomb(mentNev,mentEmail,mentCsop,mentAkt,sorID,ID) {
        const nevErtek = mentNev.value;
        const emailErtek = mentEmail.value;
        const csopErtek = mentCsop.value;   
        const aktErtek = mentAkt.value;     

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend_ajax_diakmentes.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                const data = JSON.parse(xhr.responseText);
                sor='sor_' + data.DiakID;
                gomb='ment_' + data.DiakID;
                document.getElementById(sor).className=document.getElementById(sor).className.replaceAll(' table-danger','');
                document.getElementById(gomb).style.display='none';
            }
        };

        const params = `diakID=${encodeURIComponent(ID)}&nevErtek=${encodeURIComponent(nevErtek)}&emailErtek=${encodeURIComponent(emailErtek)}&csopErtek=${encodeURIComponent(csopErtek)}&aktErtek=${encodeURIComponent(aktErtek)}`;
        xhr.send(params);
    }


</script>