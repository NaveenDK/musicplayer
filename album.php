<?php include ("includes/header.php");
if(isset($_GET['id'])){
   $albumId = $_GET['id'];
   //echo $albumId;'
}


else{
    header("Location:index.php"); //Redirect to index page
}

// $albumQuery = mysqli_query($con,"SELECT * FROM albums WHERE id='$albumId'");
// $album = mysqli_fetch_array($albumQuery);

//instead of the above we will use the below


$album =  new Album($con,$albumId);

//$artistId = $album['artist'];
//echo $artistId;
//$artist = new Artist($con,$artistId);
$artist = $album->getArtist();

//echo $album ->getTitle()."<br>";
//echo $artist ->getName();

?>

<div class="entityInfo">
   <div class="leftSection">
      <img src="<?php echo $album->getArtworkPath();?>" />
   </div>
   <div class= "rightSection">
      <h2> <?php echo $album->getTitle(); ?> </h2>
      <p> By <?php echo $artist-> getName(); ?> </p>
      <p> <?php echo $album-> getNumberOfSongs(); ?> songs </p>

   </div>
</div>
<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $album->getSongIds();
        $i=1;
        foreach($songIdArray as $songId){
          //  echo $songId."<br>";
          $albumSong = new Song($con,$songId);
          $albumArtist = $albumSong ->getArtist();
         // echo $albumSong->getTitle();
          echo "<li class='tracklistRow'>
                <div class='trackCount'>
                    <img class='play' src = 'assets/images/icons/play-white.png'>
                    <span class='trackNumber'>$i </span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>". $albumSong->getTitle()."</span>
                  <span class='artistName'>".$albumArtist ->getName()."</span>
                </div>

                <div class='trackOptions'>
                    <img class='optionsButton' src='assets/images/icons/more.png'>
                </div>

                <div class='trackDuration'>
                    <span class='duration'>" . $albumSong-> getDuration() . "</span>
                </div>
          </li>";

          $i=$i+1;


         // $albumSong->getTitle();

        }
        ?>
    </ul>

</div>
<?php include("includes/footer.php"); ?>
