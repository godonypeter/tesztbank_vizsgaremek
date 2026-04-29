<?php
  session_start();
    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kerdID = $_POST['kerdID'];
    $kerd = $_POST['kerdErtek'];
    $tema = $_POST['temaErtek'];
    $forras = $_POST['forrasErtek'];
    $sql=mysqli_prepare($k,"UPDATE kerdesek SET kerdSzoveg=?, temaID=?, rogzitoID=?, forras=? WHERE id=?");
    mysqli_stmt_bind_param($sql,'siisi',$kerd,$tema,$_SESSION['felhID'],$forras,$kerdID);
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["KerdID" => $kerdID]);
?>
