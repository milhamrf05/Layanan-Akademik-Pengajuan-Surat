<?php
// File: proxy.php

// URL endpoint yang ingin diakses dari frontend
$apiUrl = 'https://testing.uisi.ac.id/siakad/api/get_data_mahasiswa?id=' . $_GET['id'];

// Buat permintaan HTTP menggunakan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Set header untuk memastikan response berupa JSON
header('Content-Type: application/json');

// Kirimkan response ke frontend
echo $response;
?>
