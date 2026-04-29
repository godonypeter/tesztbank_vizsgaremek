<?php

    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kvID = $_POST['kvID'];

    $sql=mysqli_prepare($k,"UPDATE kerdesvalasz SET kerdesvalasz.torolt=True WHERE id=?");
    mysqli_stmt_bind_param($sql,'i',$kvID);
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["ValaszID" => $kvID]);

?>
