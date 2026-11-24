<?php
/**
 * GHCBT Automatic Version Bumper
 * Auto increments version format: 26.2.2.X (e.g. 26.2.2.1 -> 26.2.2.2)
 */

$version_file = dirname(__DIR__) . '/version.txt';
$config_file  = dirname(__DIR__) . '/application/config/config.php';

$current_version = file_exists($version_file) ? trim(file_get_contents($version_file)) : '26.2.2.0';

// Match 26.2.2.X or any prefix ending with number
// Jika opsi --peek diberikan, hanya tampilkan versi saat ini tanpa menaikkan
if (isset($argv[1]) && $argv[1] === '--peek') {
    echo $current_version;
    exit(0);
}

// Increment: ambil angka di bagian paling akhir
if (preg_match('/^(.*?)(\d+)$/', $current_version, $matches)) {
    $prefix = $matches[1];
    $num = intval($matches[2]) + 1;
    $new_version = $prefix . $num;
} else {
    $new_version = '26.2.2.1';
}

// 1. Update version.txt
file_put_contents($version_file, $new_version);

// 2. Update application/config/config.php
if (file_exists($config_file)) {
    $config_content = file_get_contents($config_file);
    $pattern = "/\\\$config\s*\[\s*(['\"])site_version(['\"]\s*\]\s*=\s*)(['\"])(.*?)(['\"]\s*;)/";
    if (preg_match($pattern, $config_content)) {
        $config_content = preg_replace($pattern, "\$config['site_version'] = '{$new_version}';", $config_content);
        file_put_contents($config_file, $config_content);
    }
}

echo $new_version;

