<!-- index.html -->
<video id="video" width="720" height="560" autoplay muted></video>
<canvas id="canvas" style="display:none;"></canvas>
<button onclick="captureLogin()">Login with Face</button>

<script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  const video = document.getElementById('video');

  Promise.all([
    // faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
    // faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
    // faceapi.nets.faceLandmark68Net.loadFromUri('/models')
  ]).then(startVideo);

  function startVideo() {
    navigator.mediaDevices.getUserMedia({ video: {} })
      .then(stream => video.srcObject = stream)
      .catch(err => console.error(err));
  }

  async function captureLogin() {
    const canvas = document.getElementById('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/jpeg');

    // Assume the user ID is known (e.g., from session or input)
    const userId = 'user123';

    fetch('uploadfacerecognition', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ image: imageData, userId })
    })
    .then(res => res.text())
    .then(alert);
  }
</script>
