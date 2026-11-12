<?php
/**
 * GHCBT UPDATE PACKAGER (Developer Tool)
 * Gunakan file ini untuk membungkus update secara otomatis.
 */

// --- CONFIGURATION ---
$version_default = date('d F Y'); // Default: Tanggal Hari Ini
$output_name = 'GHCBT_Update_Package_';
// Default exclusions (Folders)
$exclude_dirs = [
    'uploads',
    'public/uploads',
    'public/backups',
    '.git',
    '.vscode',
    'demo',
    '.gemini',
    'scratch',
    'install',
    'application/logs'
];
// Default exclusions (Specific Files)
$exclude_files = [
    'application/config/database.php',
    'public/images/logo.png',
    'public/images/logo_modern.png',
    'public/images/favicon.png',
    'favicon.ico',
    '.htaccess',
    'build_update.php', // Jangan bungkus file ini sendiri
    'PANDUAN_UPDATE_SISTEM.txt',
    'GAS_UPDATE.bat',
    'application/controllers/manager/Developer_studio.php',
    'application/views/manager/developer_studio_view.php'
];


// --- CLI OVERRIDE ---
if (php_sapi_name() === 'cli' && isset($argv)) {
    foreach ($argv as $arg) {
        if (strpos($arg, '--exclude=') === 0) {
            $extra = explode(',', substr($arg, 10));
            $exclude_dirs = array_merge($exclude_dirs, array_map('trim', $extra));
        }
    }
}


// --- LOGIC ---
echo "========================================\n";
echo "    GHCBT SMART UPDATE PACKAGER\n";
echo "========================================\n\n";

// Input Versi (Hanya jika dijalankan via CLI)
if (php_sapi_name() === 'cli') {
    echo "Masukkan Nama Versi [Default: $version_default]: ";
    $input = trim(fgets(STDIN));
    $version = !empty($input) ? $input : $version_default;
} else {
    $version = isset($_GET['v']) ? $_GET['v'] : $version_default;
    echo "<h1>GHCBT Update Packager</h1>";
    echo "<p>Versi Terdeteksi: <b>$version</b></p>";
}

$zip_name = $output_name . str_replace(' ', '_', $version) . '.zip';

// Pastikan ZIP lama dihapus jika ada
if(file_exists($zip_name)) unlink($zip_name);

$zip = new ZipArchive();
if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
    die("Gagal membuat file ZIP!\n");
}

// 1. Tambahkan file version.txt (Paling Penting!)
$zip->addFromString('version.txt', $version);
echo "[+] Menambahkan version.txt ($version)\n";

// 2. Scan dan Tambahkan File secara Recursive
$rootPath = realpath(__DIR__);
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

$count = 0;
foreach ($files as $name => $file) {
    if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        $relativePath = str_replace('\\', '/', $relativePath); // Ubah ke slash ala Linux

        $should_exclude = false;

        // Cek Folder Pengecualian
        foreach($exclude_dirs as $exDir){
            // Cocokkan folder tepat atau sub-folder (mencegah partial match seperti 'uploads_temp')
            if($relativePath === $exDir || strpos($relativePath, $exDir . '/') === 0){
                $should_exclude = true;
                break;
            }
        }

        // Cek File Pengecualian
        if(!$should_exclude){
            if(in_array($relativePath, $exclude_files)){
                $should_exclude = true;
            }
        }

        // Cek jika file adalah ZIP itu sendiri
        if($relativePath === $zip_name) $should_exclude = true;

        if (!$should_exclude) {
            $zip->addFile($filePath, $relativePath);
            $count++;
            if($count % 50 == 0) echo ".";
        }
    }
}

$zip->close();

echo "\n\n========================================\n";
echo "BERHASIL! Paket Update Selesai.\n";
echo "File: $zip_name\n";
echo "Total File: $count\n";
echo "========================================\n";

if (php_sapi_name() !== 'cli') {
    echo "<p style='color:green; font-weight:bold;'>BERHASIL! Paket Update Selesai.</p>";
    echo "<p>File: <a href='$zip_name'>$zip_name</a></p>";
}
?>
