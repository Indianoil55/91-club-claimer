<?php
set_time_limit(0);
$config = json_decode(file_get_contents('config.json'), true);
$gift_code = $_POST['gift_code'];

$mh = curl_multi_init();
$handles = [];

foreach ($config['accounts'] as $i => $acc) {
    $ch = curl_init("https://api.jodhpur91.com/api/web/gift/claim"); // Actual API URL yahan dalein
    
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(["mobile" => $acc['u'], "password" => $acc['p'], "code" => $gift_code]),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT => 3
    ];

    // Agar proxy list hai toh har ID ke liye IP change karein
    if (!empty($config['proxies'])) {
        $proxy = $config['proxies'][array_rand($config['proxies'])];
        $options[CURLOPT_PROXY] = $proxy;
    }

    curl_setopt_array($ch, $options);
    curl_multi_add_handle($mh, $ch);
    $handles[] = $ch;
}

$running = null;
do { curl_multi_exec($mh, $running); } while ($running);

$results = [];
foreach ($handles as $ch) {
    $results[] = json_decode(curl_multi_getcontent($ch), true);
    curl_multi_remove_handle($mh, $ch);
}
curl_multi_close($mh);
echo json_encode($results);
