let video, webCamStream, imageCapture;
navigator.mediaDevices.getUserMedia({
    video: {width: 800, height: 600}
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
    const submitWebcam = document.getElementById('submitWebcam');
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
                submitWebcam.disabled = false;
                img.src = URL.createObjectURL(blob);
            })
            .catch(console.log);
    }
};

const showWebcam = () => {
    const webCamSide = document.getElementById('webCamSide');
    const fileUploadSide = document.getElementById('fileUploadSide');
    const uploadClick = document.getElementById('uploadClick');
    const webCamClick = document.getElementById('webCamClick');
    fileUploadSide.classList.add('is-hidden');
    webCamClick.classList.add("is-active");
    webCamSide.classList.remove("is-hidden");
    uploadClick.classList.remove('is-active');
};

const showUpload = () => {
    const fileUploadSide = document.getElementById('fileUploadSide');
    const webCamSide = document.getElementById('webCamSide');
    const uploadClick = document.getElementById('uploadClick');
    const webCamClick = document.getElementById('webCamClick');
    webCamSide.classList.add("is-hidden");
    uploadClick.classList.add('is-active');
    webCamClick.classList.remove('is-active');
    fileUploadSide.classList.remove('is-hidden');
};