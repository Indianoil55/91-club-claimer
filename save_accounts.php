<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $raw_data = $_POST['data'];
    $lines = explode("\n", str_replace("\r", "", $raw_data));
    $accounts = [];

    foreach ($lines as $line) {
        $parts = explode(",", $line);
        if (count($parts) == 2) {
            $accounts[] = [
                'phone' => trim($parts[0]),
                'pwd' => trim($parts[1])
            ];
        }
    }

    file_put_contents('accounts.json', json_encode($accounts));
    echo json_encode(["status" => "success", "message" => count($accounts) . " Accounts Saved Successfully!"]);
}
?>
