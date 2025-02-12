<?php
// Sunucu bilgileri
$server_ip = $_SERVER['SERVER_ADDR'];
$client_ip = $_SERVER['REMOTE_ADDR'];
$client_port = $_SERVER['REMOTE_PORT'];
$server_port = $_SERVER['SERVER_PORT'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$host_name = gethostname();
$server_software = $_SERVER['SERVER_SOFTWARE'];
$php_version = phpversion();
$connection_type = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "Evet (HTTPS)" : "Hayır (HTTP)";
$server_time = date("Y-m-d H:i:s");

// Sistem bilgileri
$os_info = php_uname();
$cpu_info = shell_exec("cat /proc/cpuinfo | grep 'model name' | uniq | cut -d: -f2");
$cpu_cores = shell_exec("nproc");
$cpu_speed = shell_exec("lscpu | grep 'MHz' | awk '{print $2}'") / 1000 . " GHz";
$ram_total = round(shell_exec("grep MemTotal /proc/meminfo | awk '{print $2}'") / 1024, 2) . " MB";
$uptime = shell_exec("uptime -p");
$load_avg = implode(", ", sys_getloadavg());
$disk_usage = shell_exec("df -h --output=used,size,avail | sed -n 2p");
$active_processes = shell_exec("ps aux --no-headers | wc -l");
$total_disk = shell_exec("df -h --total | grep 'total' | awk '{print $2}'");
$free_disk = shell_exec("df -h --total | grep 'total' | awk '{print $4}'");
$mac_address = shell_exec("ip link show | awk '/ether/ {print $2}' | head -n 1");

// Sayfa yüklenme süresi
$start_time = microtime(true);
$load_time = round((microtime(true) - $start_time) * 1000, 2) . " ms";

// HTML Başlangıcı
echo "<!DOCTYPE html>
<html lang='tr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistem Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #2b2b2b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        h1, h2 {
            color: #f8d210;
        }
        .box {
            background: #3a3a3a;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        strong {
            color: #f1c40f;
        }
    </style>
    <script>
        function getClientInfo() {
            document.getElementById('screen-resolution').innerHTML = screen.width + 'x' + screen.height;
            document.getElementById('timezone').innerHTML = Intl.DateTimeFormat().resolvedOptions().timeZone;
        }
    </script>
</head>
<body onload='getClientInfo()'>
    <div class='container'>
        <h1>🌍 Sistem ve Bağlantı Bilgileri</h1>

        <h2>🔗 Bağlantı Bilgileri</h2>
        <div class='box'><strong>Sunucu IP:</strong> $server_ip</div>
        <div class='box'><strong>İstemci IP:</strong> $client_ip</div>
        <div class='box'><strong>İstemci Portu:</strong> $client_port</div>
        <div class='box'><strong>Sunucu Portu:</strong> $server_port</div>
        <div class='box'><strong>Bağlantı Türü:</strong> $connection_type</div>

        <h2>🖥️ Sunucu Bilgileri</h2>
        <div class='box'><strong>Host Adı:</strong> $host_name</div>
        <div class='box'><strong>İşletim Sistemi:</strong> $os_info</div>
        <div class='box'><strong>Sunucu Yazılımı:</strong> $server_software</div>
        <div class='box'><strong>PHP Versiyonu:</strong> $php_version</div>
        <div class='box'><strong>Sunucu Zamanı:</strong> $server_time</div>
        <div class='box'><strong>MAC Adresi:</strong> $mac_address</div>

        <h2>⚙️ Sistem Performansı</h2>
        <div class='box'><strong>CPU Modeli:</strong> $cpu_info</div>
        <div class='box'><strong>CPU Çekirdek Sayısı:</strong> $cpu_cores</div>
        <div class='box'><strong>CPU Hızı:</strong> $cpu_speed</div>
        <div class='box'><strong>Toplam RAM:</strong> $ram_total</div>
        <div class='box'><strong>Disk Kullanımı:</strong> $disk_usage</div>
        <div class='box'><strong>Toplam Disk:</strong> $total_disk</div>
        <div class='box'><strong>Boş Disk:</strong> $free_disk</div>
        <div class='box'><strong>Günlük Sistem Yükü:</strong> $load_avg</div>
        <div class='box'><strong>Çalışma Süresi:</strong> $uptime</div>
        <div class='box'><strong>Aktif İşlem Sayısı:</strong> $active_processes</div>

        <h2>🌐 Tarayıcı ve İstemci Bilgileri</h2>
        <div class='box'><strong>Kullanıcı Tarayıcısı:</strong> $user_agent</div>
        <div class='box'><strong>İstemci Dili:</strong> {$_SERVER['HTTP_ACCEPT_LANGUAGE']}</div>
        <div class='box'><strong>Ekran Çözünürlüğü:</strong> <span id='screen-resolution'>Yükleniyor...</span></div>
        <div class='box'><strong>Zaman Dilimi:</strong> <span id='timezone'>Yükleniyor...</span></div>

        <h2>⏱️ Sayfa Yüklenme Süresi</h2>
        <div class='box'>$load_time</div>
    </div>
</body>
</html>";
?>

