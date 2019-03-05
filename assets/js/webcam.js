let video, webCamStream, imageCapture;

navigator.mediaDevices.getUserMedia({
    video: {width: 800, height: 600}
}).then(stream => {
    video = document.querySelector('video');
    webCamStream = stream.getVideoTracks()[0];
    imageCapture = new ImageCapture(webCamStream);
    video.srcObject = stream;
}).catch(console.log);

const allowCapture = () => document.getElementById("captureButton").disabled = false;

const turfu = (a) => {
        const imageList = document.getElementById('imageList');
        for (let i = 0; i < imageList.children.length; i++) {
            if (a.src !== imageList.children[i].src) {
                imageList.children[i].classList.remove('has-background-danger')
            }
        }
        const imageChoice = document.getElementById('imageChoice');
        a.classList.add('has-background-danger');
        imageChoice.value = a.src;
        allowCapture();
    }
;

const snapshot = () => {
    const imageChoice = document.getElementById('imageChoice');
    const webcamImage = document.getElementById('webcamImage');
    const submitWebcam = document.getElementById('submitWebcam');
    if (imageChoice) {
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext('2d');
        const reader = new FileReader();
        let img = new Image();
        let choiceImage = new Image();
        choiceImage.src = imageChoice.value;
        imageCapture.takePhoto()
            .then(blob => {
                reader.readAsDataURL(blob);
                reader.onloadend = () => {
                    webcamImage.value = reader.result;
                };
                img.onload = () => {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    ctx.drawImage(choiceImage, 0, 0, canvas.width, canvas.height);
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