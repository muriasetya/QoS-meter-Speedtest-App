<?php
header('Content-Type: application/json');

function measure_packet_loss($host, $count = 10) {
  $cmd = "ping -n $count $host"; // "-c" => Linux "-n"=> Windows
  $output = [];
  $result = 0;

  exec($cmd, $output, $result);

  $packet_loss = -1;

  if ($result === 0) {
    foreach ($output as $line) {
      if (preg_match('/(\d+)% packet loss/', $line, $matches)) {
        $packet_loss = (int)$matches[1];
        break;
      }
    }
  }

  return $packet_loss;
}

// Jalankan Speedtest CLI dengan jalur lengkap ke speedtest.exe dan simpan outputnya
$output = shell_exec('C:\speedtest\speedtest -f json-pretty');

// Cek jika output tidak kosong
if (!empty($output)) {
    $data = json_decode($output, true);

    // Ambil kecepatan download dan upload dari data (jika ada)
    $download_speed = isset($data['download']['bandwidth']) ? $data['download']['bandwidth'] : null;
    $upload_speed = isset($data['upload']['bandwidth']) ? $data['upload']['bandwidth'] : null;

    // Ambil latency dan jitter dari data (jika ada)
    $latency = isset($data['ping']['latency']) ? $data['ping']['latency'] : null;
    $jitter = isset($data['ping']['jitter']) ? $data['ping']['jitter'] : null;

    // Tambahkan pengukuran packet loss ke data
    $packet_loss = measure_packet_loss('8.8.8.8'); // Ganti dengan host yang ingin Anda uji

    $result = [
        'download' => $download_speed,
        'upload' => $upload_speed,
        'latency' => $latency,
        'jitter' => $jitter,
        'packet_loss' => $packet_loss
    ];

    // Mengembalikan hasil dalam format JSON
    echo json_encode($result);
} else {
    // Jika output kosong, kembalikan pesan kesalahan dalam format JSON
    echo json_encode(['error' => 'Speedtest CLI output is empty.']);
}
