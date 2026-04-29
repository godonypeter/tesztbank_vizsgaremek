<?php
  session_start();
    $k=mysqli_connect('localhost','root','','tesztbank');
    mysqli_set_charset($k,'utf8');

    $kerdID = $_POST['kerdID'];    
    $sql=mysqli_prepare($k,"UPDATE kerdesek SET ellenorID=? WHERE id=?");
    mysqli_stmt_bind_param($sql,'ii',$_SESSION['felhID'],$kerdID);
    
    mysqli_stmt_execute($sql);

    mysqli_close($k);

    header('Content-Type: application/json');
    echo json_encode(["KerdID" => $kerdID]);
?>
