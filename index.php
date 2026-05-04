<!-- UI ke andar existing style mein ye add karein -->
<style>
    .admin-panel { background: #222; padding: 15px; border-radius: 10px; margin-top: 20px; display: none; }
    textarea { width: 100%; background: #000; color: #00ff00; border: 1px solid #444; padding: 10px; font-family: monospace; }
    .toggle-btn { color: #d4af37; cursor: pointer; font-size: 14px; text-decoration: underline; margin: 10px 0; display: block; }
</style>

<span class="toggle-btn" onclick="document.getElementById('admin').style.display='block'">⚙ Manage Accounts & Proxies</span>

<div id="admin" class="admin-panel">
    <label>Accounts (Format: Number,Pass)</label>
    <textarea id="accData" rows="5" placeholder="9876543210,pass123"></textarea>
    
    <label style="margin-top:10px; display:block;">Proxy List (Format: IP:Port or IP:Port:User:Pass)</label>
    <textarea id="proxyData" rows="5" placeholder="192.168.1.1:8080"></textarea>
    
    <button onclick="saveConfig()" style="background:#444; color:#fff; margin-top:10px;">SAVE CONFIG</button>
</div>

<script>
async function saveConfig() {
    const accs = document.getElementById('accData').value;
    const proxies = document.getElementById('proxyData').value;
    const res = await fetch('save_config.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `accounts=${encodeURIComponent(accs)}&proxies=${encodeURIComponent(proxies)}`
    });
    const data = await res.json();
    alert(data.message);
}
</script>
