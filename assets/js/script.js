var currentPlaylist = [];
var audioElement;

function Audio() {
  this.currentlyPlaying;
  this.audio = document.createElement("audio");

 this.audio.addEventListener("canplay",function(){
   //this refers to the object that the event was called on
   $(".progressTime.remaining").text(this.duration);
 });
 //this.audio.d uration here is same as this.duration above

  this.setTrack = function(track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  };

  this.play = function() {
    this.audio.play();
  };
  this.pause = function() {
    this.audio.pause();
  };
}
