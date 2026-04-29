<?php

    $kerdID = $_POST['kerdID'];
    $fajlNev = $_POST['fajlNev'];
    if (file_exists($fajlNev)) {
        unlink($fajlNev);
    }

    header('Content-Type: application/json');
    echo json_encode(["KerdID" => $kerdID]);
?>
