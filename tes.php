<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Speedtest</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
    }
    .speed-container {
      display: inline-block;
      background-color: #f0f0f0;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin: 10px;
    }
    .speed-value {
      font-size: 2em;
      font-weight: bold;
    }
    .speed-label {
      font-size: 0.8em;
      color: #777;
    }
    .start-button {
      margin-top: 200px;
    }
    #status-message {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <button type="button" class="btn btn-success start-button" onclick="startTest()">Mulai Test</button>
  <p id="status-message"></p>
  <div>
    <div class="speed-container">
      <div class="speed-value" id="download-speed">-</div>
      <div class="speed-label">Download (Mbps)</div>
    </div>
    <div class="speed-container">
      <div class="speed-value" id="upload-speed">-</div>
      <div class="speed-label">Upload (Mbps)</div>
    </div>
    <div class="speed-container">
      <div class="speed-value" id="latency">-</div>
      <div class="speed-label">Latency (ms)</div>
    </div>
    <div class="speed-container">
      <div class="speed-value" id="jitter">-</div>
      <div class="speed-label">Jitter (ms)</div>
    </div>
    <div class="speed-container">
      <div class="speed-value" id="packet-loss">-</div>
      <div class="speed-label">Packet Loss (%)</div>
    </div>
  </div>
  <script>
    async function startTest() {
      document.getElementById('status-message').innerText = 'Mohon tunggu sebentar, proses sedang berjalan...';

      const response = await fetch('speedtest.php');
      const data = await response.json();

      document.getElementById('status-message').innerText = '';

      console.log(data);

      if (data.error) {
        console.error('Error:', data.error);
      } else {
        document.getElementById('download-speed').innerText = (data.download / 125000).toFixed(2); // Konversi bps ke Mbps
        document.getElementById('upload-speed').innerText = (data.upload / 125000).toFixed(2); // Konversi bps ke Mbps
        document.getElementById('latency').innerText = data.latency.toFixed(2);
        document.getElementById('jitter').innerText = data.jitter.toFixed(2);

        if (data.packet_loss === -1) {
          document.getElementById('packet-loss').innerText = '0 ';
        } else {
          document.getElementById('packet-loss').innerText = data.packet_loss;
        }
      }
    }
  </script>
</body>
</html>
