<?php

    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kID = $_POST['kerdesID'];
    $pont = $_POST['pont'];
    $sql=mysqli_prepare($k,"SELECT valaszok.id AS vid, kerdesvalasz.id AS kvid, valaszSzoveg FROM valaszok JOIN kerdesvalasz ON kerdesvalasz.valaszID=valaszok.id WHERE kerdesID=? AND pont=? AND torolt=False ORDER BY 3 ASC");
    mysqli_stmt_bind_param($sql,'ii',$kID, $pont);
    mysqli_stmt_execute($sql);

    $valasz = mysqli_stmt_get_result($sql);

    $adatok = [];
    while ($sor = mysqli_fetch_assoc($valasz)) {
        $adatok[] = $sor;
    }

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode($adatok);
?>
