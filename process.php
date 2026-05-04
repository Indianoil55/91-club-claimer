<?php
set_time_limit(0);
// replace: include 'accounts.php';
$accounts = json_decode(file_get_contents('accounts.json'), true);

$gift_code = $_POST['gift_code'] ?? '';
$mh = curl_multi_init();
$handles = [];

foreach ($accounts as $i => $acc) {
    $ch = curl_init("https://api.jodhpur91.com/api/web/gift/claim"); // Actual API URL yahan check karke dalein
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode([
            "mobile" => $acc['phone'],
            "password" => $acc['pwd'],
            "code" => $gift_code
        ]),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT => 5
    ]);
    curl_multi_add_handle($mh, $ch);
    $handles[$i] = $ch;
}

// Ek saath saari requests fire karna
$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running);

$results = [];
foreach ($handles as $ch) {
    $results[] = json_decode(curl_multi_getcontent($ch), true);
    curl_multi_remove_handle($mh, $ch);
}
curl_multi_close($mh);

echo json_encode($results);
