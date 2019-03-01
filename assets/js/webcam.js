let video, webCamStream, imageCapture;
navigator.mediaDevices.getUserMedia({
    video: {width: 1280, height: 720}
})
    .then(stream => {
        video = document.querySelector('video');
        webCamStream = stream.getVideoTracks()[0];
        imageCapture = new ImageCapture(webCamStream);
        video.srcObject = stream;
    })
    .catch(console.log);

const allowCapture = () => document.getElementById("captureButton").disabled = false;

const turfu = (a) => {
    const canvas = document.getElementById("videoCanvas");
    const ctx = canvas.getContext('2d');
    const imageChoice = document.getElementById('imageChoice');
    imageChoice.value = a.src;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(a, 0, 0, canvas.width, canvas.height);
    allowCapture();
};

const snapshot = () => {
    const choice = document.getElementById("videoCanvas");
    const webcamImage = document.getElementById('webcamImage');
    if (choice) {
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext('2d');
        const reader = new FileReader();
        let img = new Image();
        imageCapture.takePhoto()
            .then(blob => {
                reader.readAsDataURL(blob);
                reader.onloadend = () => {
                    webcamImage.value = reader.result;
                };
                img.onload = () => {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    ctx.drawImage(choice, 0, 0, canvas.width, canvas.height);

                };
                img.src = URL.createObjectURL(blob);
            })
            .catch(console.log);
    }
};