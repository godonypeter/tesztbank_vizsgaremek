<?php

    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kerdID = $_POST['kerdesID'];

    $sql=mysqli_prepare($k,"UPDATE kerdesek SET torolt=True WHERE id=?");
    mysqli_stmt_bind_param($sql,'i',$kerdID);
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["KerdesID" => $kerdID]);

?>
