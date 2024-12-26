<?php
// Tentukan lokasi folder log
$logDir = __DIR__ . '/../logs';
$logFile = $logDir . '/debug.log';

// Periksa apakah folder log ada, jika tidak, buat foldernya
if (!file_exists($logDir)) {
    mkdir($logDir, 0775, true); // Buat folder dengan izin 775
    echo "Folder logs berhasil dibuat.\n";
}

// Periksa apakah file log ada, jika tidak, buat file log kosong
if (!file_exists($logFile)) {
    file_put_contents($logFile, ''); // Buat file log kosong
    echo "File debug.log berhasil dibuat.\n";
} else {
    echo "File debug.log sudah ada.\n";
}

// Tulis pesan untuk memastikan file bisa ditulis
if (is_writable($logFile)) {
    error_log("[INFO] debug.log berhasil disiapkan.", 3, $logFile);
    echo "debug.log berhasil diinisialisasi.\n";
} else {
    echo "Gagal: debug.log tidak bisa ditulis. Periksa izin file.\n";
}
