let video, webCamStream;

navigator.mediaDevices
  .getUserMedia({
    video: { width: 800, height: 600 }
  })
  .then(stream => {
    video = document.querySelector("video");
    video.srcObject = stream;
  })
  .catch(e => console.log(e));

const allowCapture = () =>
  (document.getElementById("captureButton").disabled = false);

const turfu = a => {
  const imageList = document.getElementById("imageList");
  const submitUpload = document.getElementById("submitUpload")
  for (let i = 0; i < imageList.children.length; i++) {
    if (a.src !== imageList.children[i].src) {
      imageList.children[i].classList.remove("has-background-danger");
    }
  }
  const imageChoice = document.getElementsByClassName("imageChoice");
  imageChoice[0].value = a.src;
  imageChoice[1].value = a.src;
  a.classList.add("has-background-danger");
  submitUpload.disabled = false;
  allowCapture();
};

const snapshot = () => {
  const imageChoice = document.getElementsByClassName("imageChoice");
  const webcamImage = document.getElementById("webcamImage");
  const submitWebcam = document.getElementById("submitWebcam");
  const submitUpload = document.getElementById("submitUpload")
  if (
    imageChoice[0] !== undefined &&
    imageChoice[0].value !== undefined &&
    webcamImage !== undefined &&
    submitWebcam !== undefined
  ) {
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    let choiceImage = new Image();
    if (imageChoice[0].value !== undefined) {
      choiceImage.src = imageChoice[0].value;
    } else if (imageChoice[1].value !== undefined) {
      choiceImage.src = imageChoice[1].value;
      submitUpload.disabled = false;
    }
    if (video !== undefined && choiceImage !== undefined) {
      const videoCanvas = document.createElement("canvas");
      videoCanvas.setAttribute('width', 800);
      videoCanvas.setAttribute('height', 600);
      videoCanvas.getContext("2d").drawImage(video, 0, 0, 800, 600);
      ctx.drawImage(video, 0, 0, 800, 600);
      ctx.drawImage(choiceImage, 0, 0, 800, 600);
      submitWebcam.disabled = false;
      const data = videoCanvas.toDataURL("image/jpeg");
      webcamImage.setAttribute("value", data);
    }
  }
};

const showWebcam = () => {
  const webCamSide = document.getElementById("webCamSide");
  const fileUploadSide = document.getElementById("fileUploadSide");
  const uploadClick = document.getElementById("uploadClick");
  const webCamClick = document.getElementById("webCamClick");
  fileUploadSide.classList.add("is-hidden");
  webCamClick.classList.add("is-active");
  webCamSide.classList.remove("is-hidden");
  uploadClick.classList.remove("is-active");
};

const showUpload = () => {
  const webcamImage = document.getElementById("webcamImage");
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d");
  const fileUploadSide = document.getElementById("fileUploadSide");
  const webCamSide = document.getElementById("webCamSide");
  const uploadClick = document.getElementById("uploadClick");
  const webCamClick = document.getElementById("webCamClick");
  webcamImage.value = "";
  ctx.clearRect(0, 0, 800, 600);
  webCamSide.classList.add("is-hidden");
  uploadClick.classList.add("is-active");
  webCamClick.classList.remove("is-active");
  fileUploadSide.classList.remove("is-hidden");
};
