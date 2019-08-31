<?php
$songQuery = mysqli_query($con,"SELECT * FROM songs ORDER BY RAND() LIMIT 10");
$resultArray= array();
while($row = mysqli_fetch_array($songQuery)){
 array_push($resultArray,$row['id']);
}

$jsonArray = json_encode($resultArray);
?>
<script>


$(document).ready(function(){
	currentPlaylist = <?php echo $jsonArray;?>;
	
	//console.log(currentPlaylist);
	audioElement = new Audio();
	setTrack(currentPlaylist[0],currentPlaylist,false);
	updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove",function(e){
		e.preventDefault();
	});
	$(".playbackBar .progressBar").mousedown(function(){
		mouseDown = true;
	})
	$(".playbackBar .progressBar").mousemove(function(e){
		//mousedown = true;
		if(mouseDown){
			//Set time of song depending on position of mouse
			timeFromOffset(e,this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e){
		//mousedown = true;
		timeFromOffset(e,this);
	});


	$(".volumeBar .progressBar").mousedown(function(){
		mouseDown = true;
	})
	$(".volumeBar .progressBar").mousemove(function(e){
		//mousedown = true;
		if(mouseDown){
		var percentage = e.offsetX/$(this).width();
		if(percentage >=0 && percentage <=1)
	
		 audioElement.audio.volume = percentage;
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e){
		//mousedown = true;
		//timeFromOffset(e,this);
		var percentage = e.offsetX/$(this).width();
		if(percentage >=0 && percentage <=1)
	
		 audioElement.audio.volume = percentage;
		
	});



    $(document).mouseup(function(){
		mouseDown = false;
	})
});


function timeFromOffset(mouse, progressBar){
	 
	var percentage  = mouse.offsetX / $(progressBar).width()*100;
	var seconds = audioElement.audio.duration * (percentage/100);
	audioElement.setTime(seconds);

}

function nextSong(){
   if(repeat == true ){
	   audioElement.setTime(0);
	   playSong();
	   return;
   }

	if(currentIndex == currentPlaylist.length -1){
		currentIndex = 0;
	}
	else{
		currentIndex++;
	}

	var trackToPlay = currentPlaylist[currentIndex];

	setTrack(trackToPlay,currentPlaylist,true);
}

function setRepeat(){
	repeat = !repeat;
	var imageName  = repeat? "repeat-active.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src","assets/images/icons/"+ imageName);
}

function setTrack(trackId,newPlaylist,play){


	currentIndex = currentPlaylist.indexOf(trackId);
	pauseSong();
  
  $.post("includes/handlers/ajax/getSongJson.php",{ songId: trackId },function(data){


		var track = JSON.parse(data);
		$(".trackName span").text(track.title);
	
				$.post("includes/handlers/ajax/getArtistJson.php",{ artistId: track.artist },function(data){
				var artist = JSON.parse(data);
				//console.log(artist.name);
				$(".artistName span").text(artist.name);
				});

				$.post("includes/handlers/ajax/getAlbumJson.php",{ albumId: track.album },function(data){
				var album = JSON.parse(data);
				//console.log(artist.name);
				$(".albumLink img").attr("src",album.artworkPath);
				});

		audioElement.setTrack(track);

  		});

 	  if(play){ audioElement.play();}
 
}

function playSong(){

if(audioElement.audio.currentTime== 0 ){
	$.post("includes/handlers/ajax/updatePlays.php",{songId: audioElement.currentlyPlaying.id});
}


 $(".controlButton.play").hide();	
 $(".controlButton.pause").show();	
 audioElement.play();
}

function pauseSong(){
$(".controlButton.pause").hide();	
$(".controlButton.play").show();
	audioElement.pause();
}
</script>

<div id="nowPlayingBar">
			<div id="nowPlayingBarContainer">
				<div id="nowPlayingBar">
				<div id="nowPlayingLeft">
					<div class="content">
						<span class="albumLink">
							<img class="albumArtwork" src="http://www.politicalmetaphors.com/wp-content/uploads/2015/04/blog-shapes-square-windows.jpg"/>
						</span>

						<div class="trackInfo">
							<span class="trackName">
								<span></span>
							</span>

							<span class="artistName">
								<span></span>
							</span>

						</div>

					</div>
				</div>		

				<div id="nowPlayingCenter">
					<div class="content playerControls">
						<div class="buttons">
							<button class="controlButton shuffle" title="Shuffle button">		   
									<img src="assets/images/icons/shuffle.png" alt="Shuffle"/>
							</button>

							<button class="controlButton previous" title="Previous button">		   
									<img src="assets/images/icons/previous.png" alt="Previous"/>
							</button>

							<button class="controlButton play" title="Play button" onclick="playSong()">		   
									<img src="assets/images/icons/play.png" alt="Play"/>
							</button>
							<button class="controlButton pause" title="Pause button" style="display:none;" onclick="pauseSong()">		   
									<img src="assets/images/icons/pause.png" alt="Pause"/>
							</button>
							<button class="controlButton next" title="Next button" onclick="nextSong()">		   
									<img src="assets/images/icons/next.png" alt="Next"/>
							</button>

							<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">		   
									<img src="assets/images/icons/repeat.png" alt="Repeat"/>
							</button>

							
						</div>
							
						<div class="playbackBar">
								<span class="progressTime current">0.00</span>
								<div class = "progressBar">
									<div class="progressBarBg">
										<div class="progress"></div>
									</div>
								</div>
								<span class = "progressTime remaining">0.00s</span>
						</div>


						
					</div>
				</div>	

				<div id="nowPlayingRight">
					<div class="volumeBar">
						<button class="controlButton volume" title="Volume button">	
						<img src="assets/images/icons/volume.png" alt="Volume">
						</button>
						
						<div class = "progressBar">
							<div class="progressBarBg">
								<div class="progress"></div>
							</div>
						</div>
					</div>
				</div>	
			


				</div>
			</div>