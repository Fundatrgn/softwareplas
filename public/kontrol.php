<?php
// Kurulum kontrol sayfası: https://alanadiniz/kontrol.php
// Sunucunun siteyi çalıştırmaya uygun olup olmadığını gösterir. Şifre
// veya gizli bilgi göstermez. Site çalıştıktan sonra bu dosyayı silin.
// (Eski PHP sürümlerinde de çalışsın diye bilerek sade yazıldı.)
header('Content-Type: text/html; charset=utf-8');
$root = dirname(__DIR__);
$rows = array();
$ok = version_compare(PHP_VERSION, '8.1.0', '>=');
$rows[] = array('PHP sürümü 8.1 veya üstü', $ok, PHP_VERSION . ($ok ? '' : ' — Plesk > PHP Ayarları\'ndan 8.2 veya 8.3 seçin'));
foreach (array('pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'fileinfo', 'gd') as $ext) {
    $rows[] = array('PHP eklentisi: ' . $ext, extension_loaded($ext), extension_loaded($ext) ? 'yüklü' : 'EKSİK — Plesk > PHP Ayarları\'ndan açın');
}
$rows[] = array('.env dosyası', is_file($root . '/.env'), is_file($root . '/.env') ? 'var' : 'YOK — zip içindeki .env yüklenmemiş');
$rows[] = array('vendor klasörü', is_file($root . '/vendor/autoload.php'), is_file($root . '/vendor/autoload.php') ? 'var' : 'YOK');
foreach (array('storage', 'storage/framework/views', 'storage/framework/sessions', 'storage/framework/cache', 'storage/logs', 'bootstrap/cache', 'public/images') as $dir) {
    $w = is_dir($root . '/' . $dir) && is_writable($root . '/' . $dir);
    $rows[] = array('Yazma izni: ' . $dir, $w, $w ? 'yazılabilir' : 'YAZILAMIYOR / klasör yok');
}
$env = array();
if (is_file($root . '/.env')) {
    foreach (file($root . '/.env') as $line) {
        if (preg_match('/^\s*([A-Z_]+)\s*=\s*(.*)\s*$/', $line, $m)) {
            $env[$m[1]] = trim($m[2], "\"' \r\n");
        }
    }
}
$rows[] = array('APP_KEY tanımlı', !empty($env['APP_KEY']), !empty($env['APP_KEY']) ? 'var' : 'BOŞ');
if (extension_loaded('pdo_mysql') && !empty($env['DB_DATABASE'])) {
    try {
        $host = isset($env['DB_HOST']) ? $env['DB_HOST'] : 'localhost';
        $port = isset($env['DB_PORT']) ? $env['DB_PORT'] : '3306';
        $pdo = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $env['DB_DATABASE'] . ';charset=utf8mb4', $env['DB_USERNAME'], $env['DB_PASSWORD'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $rows[] = array('Veritabanı bağlantısı', true, 'başarılı (' . htmlspecialchars($env['DB_DATABASE']) . ')');
        try {
            $n = $pdo->query('SELECT COUNT(*) FROM settings')->fetchColumn();
            $rows[] = array('SQL içe aktarılmış', $n > 0, $n > 0 ? 'tablolar var' : 'settings tablosu boş');
        } catch (Exception $e) {
            $rows[] = array('SQL içe aktarılmış', false, 'TABLOLAR YOK — canzeybek-veritabani.sql dosyasını phpMyAdmin\'den içe aktarın');
        }
    } catch (Exception $e) {
        $rows[] = array('Veritabanı bağlantısı', false, 'BAŞARISIZ: ' . htmlspecialchars($e->getMessage()));
    }
}
$log = $root . '/storage/logs/laravel.log';
$lastError = '';
if (is_file($log)) {
    $content = file_get_contents($log, false, null, max(0, filesize($log) - 4000));
    if (preg_match_all('/\] \w+\.ERROR: (.{0,300})/', $content, $m)) {
        $lastError = end($m[1]);
    }
}
echo '<!doctype html><meta name="viewport" content="width=device-width,initial-scale=1"><title>Kurulum Kontrol</title>';
echo '<body style="font-family:system-ui,Arial;max-width:760px;margin:24px auto;padding:0 16px"><h2>Kurulum Kontrol</h2><table style="border-collapse:collapse;width:100%">';
foreach ($rows as $r) {
    echo '<tr style="border-bottom:1px solid #ddd"><td style="padding:8px">' . ($r[1] ? '✅' : '❌') . '</td><td style="padding:8px">' . $r[0] . '</td><td style="padding:8px;color:' . ($r[1] ? '#555' : '#c00') . '">' . $r[2] . '</td></tr>';
}
echo '</table>';
if ($lastError) {
    echo '<h3>Son hata kaydı</h3><pre style="white-space:pre-wrap;background:#f5f5f5;padding:12px">' . htmlspecialchars($lastError) . '</pre>';
}
echo '<p style="color:#888">Site çalıştıktan sonra public/kontrol.php dosyasını silin.</p></body>';
