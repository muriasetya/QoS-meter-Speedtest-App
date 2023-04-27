<?php
// 1. Menerima input URL dari pengguna
$url = $_POST['url'];

// 2. Membuat koneksi ke URL menggunakan PHP curl
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);

// 3. Menghitung jumlah paket yang dikirim
$packets_sent = curl_getinfo($ch, CURLINFO_TOTAL_TIME);

// 4. Menghitung jumlah paket yang diterima
$packets_received = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);

// 5. Menghitung waktu pengiriman paket pertama dan waktu penerimaan paket terakhir
$first_packet_time = curl_getinfo($ch, CURLINFO_STARTTRANSFER_TIME);
$last_packet_time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);

// 6. Menghitung total waktu yang dibutuhkan untuk mentransfer data
$total_time = $last_packet_time - $first_packet_time;

// 7. Menghitung rata-rata delay dan jitter, serta packet loss
$average_delay = ($total_time / $packets_received) * 1000;
$jitter = ($average_delay / $packets_received) *1000;
$packet_loss = (($packets_sent - $packets_received) *100 ) / $packets_sent;
$packet_loss = max(0, $packet_loss);
if ($packet_loss < 0) {
    $packet_loss = 0;
}
$throughput = ($packets_received / $total_time) / 1000;
$average_delay = round($average_delay, 4);
$jitter = round($jitter, 6);
$throughput = round($throughput, 4);

// 8. Menampilkan hasil dalam tabel
echo '
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <title>Hasil QoS</title>
</head>
<body>
  <div class="centered-text">
        <h1 class="hasil-pengujian">Hasil Pengujian</h1>
    </div>
  <section class="intro">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th scope="col">Metrik</th>
                        <th scope="col">Throughput</th>
                        <th scope="col">Delay</th>
                        <th scope="col">Jitter</th>
                        <th scope="col">Packet loss</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Nilai</th>
                        <td>'. $throughput .' mb</td>
                        <td>'. $average_delay .' ms</td>
                        <td>'. $jitter .' ms</td>
                        <td>'. $packet_loss .' %</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
';

// 9. Menutup koneksi curl
curl_close($ch);
?>
