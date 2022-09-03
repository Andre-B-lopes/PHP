  var player = document.getElementById('player'); 
  var snapshotCanvas = document.getElementById('snapshot');
  var captureButton = document.getElementById('capture');
  var stopVideo=document.getElementById('closecam');
  var videoTracks;
  var btnCaptureFoto = $("#capture");

function activeWebCam(){
  
  btnCaptureFoto.html("Tirar foto");
  
  var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.srcObject = stream;
    videoTracks = stream.getVideoTracks();
  };

  navigator.mediaDevices.getUserMedia({video: true}).then(handleSuccess);

  captureButton.addEventListener('click', function() {
    var context = snapshot.getContext('2d');
    context.drawImage(player, 10, 10, snapshotCanvas.width, snapshotCanvas.height);
    var imgData = snapshotCanvas.toDataURL();
    //this.href = imgData; // source
    
    //this.download = 'fotoOS.png'; // nome da imagem
  });

  stopVideo.addEventListener('click',function(){
    videoTracks.forEach(function(track) {track.stop()});  
  });
}; 

function stopWebCam(){
  
  btnCaptureFoto.html("Ativar câmera");

  var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.srcObject = stream;
    videoTracks = stream.getVideoTracks();
  };

  stopVideo.addEventListener('click',function(){
    videoTracks.forEach(function(track) {track.stop()});  
  });
}

/*
$(function(){

  var player = $("#player"); 
  var snapshotCanvas = $("#snapshot");
  var captureButton = $("#capture");
  var videoTracks;

  captureButton.on("click", function(){
    console.log("Fui clicado");  
    
    var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.srcObject = stream;
    videoTracks = stream.getVideoTracks();
  };

    captureButton.on("click", function() {
      var context = $("#snapshot").val();
      context.drawImage(player, 10, 10, snapshotCanvas.width, snapshotCanvas.height);
      var imgData = snapshotCanvas.toDataURL();
      this.href = imgData; // source
      //this.download = 'fotoOS.png'; // nome da imagem
    });

    navigator.mediaDevices.getUserMedia({video: true}).then(handleSuccess);

  });

}); 
	*/