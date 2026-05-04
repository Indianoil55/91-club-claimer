<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acc_lines = explode("\n", str_replace("\r", "", $_POST['accounts']));
    $proxy_lines = explode("\n", str_replace("\r", "", $_POST['proxies']));
    
    $config = [
        'accounts' => [],
        'proxies' => array_filter(array_map('trim', $proxy_lines))
    ];

    foreach ($acc_lines as $line) {
        $p = explode(",", $line);
        if(count($p) == 2) $config['accounts'][] = ['u' => trim($p[0]), 'p' => trim($p[1])];
    }

    file_put_contents('config.json', json_encode($config));
    echo json_encode(["message" => "Config Updated! Total Accounts: " . count($config['accounts'])]);
}
?>
