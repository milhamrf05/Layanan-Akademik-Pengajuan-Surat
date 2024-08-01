<?php
    header('Acces-Control-Allow-Origin:*');
    if (isset($_POST['method'])){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://dashboard.uisi.ac.id/api/queries/102/results");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        echo $output;
        curl_close($ch);
    }
?>