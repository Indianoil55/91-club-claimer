<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>91 CLUB - Auto Claimer Pro</title>
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #0f0f0f;
            --card-bg: #1a1a1a;
            --text-gray: #b0b0b0;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: var(--card-bg);
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.8);
            border: 1px solid #333;
            text-align: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-gold);
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .status-badge {
            background: rgba(212, 175, 55, 0.1);
            color: var(--primary-gold);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 15px;
            background: #252525;
            border: 1px solid #444;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--primary-gold);
            outline: none;
            background: #2a2a2a;
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #d4af37 0%, #f9e29c 100%);
            border: none;
            border-radius: 12px;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        button:active {
            transform: scale(0.98);
        }

        #log-container {
            margin-top: 20px;
            background: #000;
            border-radius: 10px;
            padding: 10px;
            height: 150px;
            overflow-y: auto;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            text-align: left;
            border: 1px solid #222;
        }

        .log-entry { margin-bottom: 5px; border-bottom: 1px solid #111; padding-bottom: 2px; }
        .success { color: #4caf50; }
        .error { color: #f44336; }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">91 CLUB</div>
    <div class="status-badge">AUTO-CLAIMER ACTIVE (80 IDs)</div>

    <div class="input-group">
        <label>Gift Code</label>
        <input type="text" id="giftCode" placeholder="Paste your code here...">
    </div>

    <button onclick="startClaiming()" id="mainBtn">CLAIM ON ALL IDs</button>

    <div id="log-container">
        <div class="log-entry" style="color: #666;">> System ready...</div>
    </div>
</div>

<script>
    async function startClaiming() {
        const code = document.getElementById('giftCode').value;
        const btn = document.getElementById('mainBtn');
        const log = document.getElementById('log-container');

        if (!code) {
            alert("Bhai, pehle code toh dalo!");
            return;
        }

        btn.disabled = true;
        btn.innerText = "Processing Milli-seconds...";
        log.innerHTML += `<div class="log-entry">> Sending requests to 80 accounts...</div>`;

        try {
            const response = await fetch('process.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'gift_code=' + encodeURIComponent(code)
            });

            const results = await response.json();
            
            results.forEach((res, index) => {
                const statusClass = res.status === "Success" ? "success" : "error";
                log.innerHTML += `<div class="log-entry ${statusClass}">[ID ${index+1}] Result: ${res.msg || 'Done'}</div>`;
            });

        } catch (e) {
            log.innerHTML += `<div class="log-entry error">> Connection Error!</div>`;
        } finally {
            btn.disabled = false;
            btn.innerText = "CLAIM ON ALL IDs";
            log.scrollTop = log.scrollHeight;
        }
    }
</script>

</body>
</html>
