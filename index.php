<!-- Pehle wale CSS mein ye add karein -->
<style>
    .manage-link { color: var(--primary-gold); cursor: pointer; font-size: 13px; text-decoration: underline; margin-top: 10px; display: block; }
    #accountSection { display: none; margin-top: 20px; border-top: 1px solid #333; padding-top: 20px; }
    textarea { width: 100%; background: #252525; color: #00ff00; border: 1px solid #444; border-radius: 12px; padding: 10px; font-family: monospace; resize: vertical; }
</style>

<!-- UI ke andar button ke niche ye daalein -->
<span class="manage-link" onclick="toggleAccounts()">+ Manage Accounts (Bulk Add)</span>

<div id="accountSection">
    <label>Paste Accounts (Format: Number,Password)</label>
    <textarea id="bulkAccounts" rows="8" placeholder="9876543210,pass123
9876543211,pass456"></textarea>
    <button onclick="saveAccounts()" style="background: #333; color: #fff; margin-top: 10px;">SAVE ACCOUNTS</button>
</div>

<script>
    function toggleAccounts() {
        const sec = document.getElementById('accountSection');
        sec.style.display = sec.style.display === 'block' ? 'none' : 'block';
    }

    async function saveAccounts() {
        const data = document.getElementById('bulkAccounts').value;
        const res = await fetch('save_accounts.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'data=' + encodeURIComponent(data)
        });
        const final = await res.json();
        alert(final.message);
    }
</script>
