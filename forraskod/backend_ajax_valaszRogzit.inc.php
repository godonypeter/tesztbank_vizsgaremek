<?php

    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kerdID = $_POST['kerdesID'];
    $valSzov = $_POST['valSzoveg'];
    $pont = $_POST['pontErtek'];

    if ($valSzov != '') {
        $sql=mysqli_prepare($k,"SELECT COUNT(id) AS db FROM valaszok WHERE valaszSzoveg=?");
        mysqli_stmt_bind_param($sql,'s',$valSzov);
        mysqli_stmt_execute($sql);
        $e=mysqli_stmt_get_result($sql);
        $sor=mysqli_fetch_assoc($e);
        if ($sor['db']==0) {
            $sql=mysqli_prepare($k,"INSERT INTO valaszok VALUES (NULL, ?)");
            mysqli_stmt_bind_param($sql,'s',$valSzov);
            mysqli_stmt_execute($sql);
        }
        $sql=mysqli_prepare($k,"SELECT id FROM valaszok WHERE valaszSzoveg=?");
        mysqli_stmt_bind_param($sql,'s',$valSzov);
        mysqli_stmt_execute($sql);
        $e=mysqli_stmt_get_result($sql);
        $sor=mysqli_fetch_assoc($e);
        $valID=$sor['id'];
        
        $sql=mysqli_prepare($k,"INSERT INTO kerdesvalasz VALUES (NULL, ?, ?, ?, False)");
        mysqli_stmt_bind_param($sql,'iii',$kerdID, $valID, $pont);
        mysqli_stmt_execute($sql);
    }

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["KerdID" => $kerdID, "Pont" => $pont, "ValID" => $valID]);

    
?>
