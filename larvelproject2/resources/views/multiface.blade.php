<!DOCTYPE html>
<html>
<head>
  <title>Multi-Face Recognition</title>
  <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <h1>Multi-Face Recognition</h1>
  <h2 id="person-count">Detected People: 0</h2>
  <video id="video" width="720" height="560" autoplay muted></video>
  <canvas id="overlay" width="720" height="560"></canvas>

  <script>
    window.addEventListener('DOMContentLoaded', async () => {
      const video = document.getElementById('video');

      // ✅ Load models first
      await Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models')
      ]);

      // ✅ Start the webcam
      navigator.mediaDevices.getUserMedia({ video: {} })
        .then((stream) => {
          video.srcObject = stream;
        })
        .catch((err) => console.error('Camera error:', err));

      video.addEventListener('play', async () => {
        const canvas = document.getElementById('overlay');
        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);

        const labeledDescriptors = await loadLabeledImages();
        const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);

      setInterval(async () => {
  const detections = await faceapi
    .detectAllFaces(video)
    .withFaceLandmarks()
    .withFaceDescriptors();

  const resized = faceapi.resizeResults(detections, displaySize);
  canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

  // ✅ Update detected person count
  document.getElementById('person-count').textContent = `Detected People: ${resized.length}`;

  const results = resized.map(d =>
    faceMatcher.findBestMatch(d.descriptor)
  );

  results.forEach((result, i) => {
    const box = resized[i].detection.box;
    const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
    drawBox.draw(canvas);

    // ✅ Optional: Send match to backend
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/attendance', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
      },
      body: JSON.stringify({
        person: result.label,
        timestamp: Date.now(),
         count: resized.length, // total detected faces
      })
    });
  });
}, 2000);

      });

      async function loadLabeledImages() {
        const labels = ['Person1', 'Person2']; // Match folder names in public/labeled_images
        return Promise.all(
          labels.map(async label => {
            const descriptions = [];
            for (let i = 1; i <= 3; i++) {
              try {
                const img = await faceapi.fetchImage(`/labeled_images/${label}/${i}.jpg`);
                const detection = await faceapi
                  .detectSingleFace(img)
                  .withFaceLandmarks()
                  .withFaceDescriptor();
                if (detection) {
                  descriptions.push(detection.descriptor);
                }
              } catch (e) {
                console.warn(`Failed to load image for ${label} ${i}:`, e);
              }
            }
            return new faceapi.LabeledFaceDescriptors(label, descriptions);
          })
        );
      }
    });
    // 💡 Get number of detected faces


  </script>
</body>
</html>
