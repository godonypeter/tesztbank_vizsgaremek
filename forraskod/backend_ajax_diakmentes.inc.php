<?php
    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $diakID = $_POST['diakID'];
    $nev = $_POST['nevErtek'];
    $email = $_POST['emailErtek'];
    $csop = $_POST['csopErtek'];
    $akt = $_POST['aktErtek'];
    $sql=mysqli_prepare($k,"UPDATE felhasznalok SET nev=?, email=?, csop=?, aktiv=? WHERE id=?");
    mysqli_stmt_bind_param($sql,'sssii',$nev,$email,$csop,$akt,$diakID);
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["DiakID" => $diakID]);
?>
