<?php

    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kerdID = $_POST['kerdID'];
    $megj = $_POST['megjErtek'];
    if ($megj==NULL) {
        $sql=mysqli_prepare($k,"UPDATE kerdesek SET megjegyzes=NULL WHERE id=?");
        mysqli_stmt_bind_param($sql,'i',$kerdID);
    } else {
        $sql=mysqli_prepare($k,"UPDATE kerdesek SET megjegyzes=? WHERE id=?");
        mysqli_stmt_bind_param($sql,'si',$megj,$kerdID);
    }
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["KerdID" => $kerdID]);
?>
